<?php
  class ListEvent extends Module implements IModule {  
      /**
      * news event model
      * 
      * @var NewsEventModel
      */
      private $news_event_model;
      /**
      * news articles event model
      * 
      * @var NewsArticlesEventModel
      */
      private $news_articles_event_model;
      /**
      * news articles view model
      * 
      * @var NewsArticlesViewModel
      */
      private $news_articles_view_model;
       /**
        * permission  model
        * 
        * @var PermissionModel
        */
       private $premission_model; 
       /**
       * news category model
       * 
       * @var NewsCategoryModel
       */
       private $news_category_model;
      public function __construct($param=null) {         
          $this->init(get_class($this));
          /*
          * init
          */
          $this->data = array();
          $lang_global = $this->language->getLang('global.ln');                
          $this->template->assign('Lang', $lang_global);                        
          $this->template->assign('link_helper',$this->linkHelper);
          $this->template->assign('template_helper',$this->templateHelper);
          $this->news_event_model = Loader::load_model("news_event");
          $this->news_articles_event_model = Loader::load_model("news_articles_event");
          $this->premission_model = Loader::load_model("permission");
          $this->news_articles_view_model = Loader::load_model("news_articles_view");
          $this->news_category_model = Loader::load_model("news_category");
          $this->tm_users_model = Loader::load_model("tm_users");
            $user_id = $this->session->get_session("userid");   
            if(!$user_id || !is_integer($user_id)){            
                Application::redirect($this->linkHelper->linkhome("Login"));
            }else{
                $user_info = $this->tm_users_model->get_list("user_id = '{$user_id}' AND user_deleted=1","",0,1); 
                if(!$user_info) 
                    Application::redirect($this->linkHelper->linkhome("Login"));
                
            }
      }                         
  
      public function run() {  
          $user_id = $this->session->get_session("userid");
          if(!$user_id)
          {
              Application::redirect($this->linkHelper->linkhome("login"));
          }
          if(!$this->premission_model->check_permission($user_id,array(1,4)))
          {
                   die('no permission');
          }
          
          $list_category = $this->news_category_model->build_child_category();          
          $this->data['list_category']= $list_category;
            
           $keyword = isset($this->input['name']) ? $this->input['name'] : ""; 
            $page    = isset($this->input['page']) ? $this->input['page'] : ""; 
            $category_id    = isset($this->input['category_id']) ? $this->input['category_id'] : 0; 
            $status    = isset($this->input['status']) ? $this->input['status'] : 1;
            
            $condition = "";
            if($status){
                $condition .= "`status`={$status} ";
            }
            
             if($category_id){
                $condition .= "and `category_id`={$category_id} ";
            }
            if($keyword){
                $keyword = stripcslashes($keyword);
                $_keyword = $this->templateHelper->build_slug($keyword);
                $condition .= "and `meta_slug` like '%{$_keyword}%'";
            }
            
            $num = 25;
            $total = $this->news_event_model->get_total($condition);
            $total_page = ceil($total/$num);
            
            if($page<=0 || $page>$total_page){
                $page = 1;
            }
            
            $limit = $num;
            $offset = ($page-1)*$num;
            
            $list_event = $this->news_event_model->get_list($condition,"`id` desc",$offset,$limit);
            $paging  = Application::paging($page,$total_page,5);
            $page = array(
                "current_page" => $page,
                "page"       => $paging,
                "total"        => $total,
                "total_page"   => $total_page,
            );
            $this->data["paging"] = $page;
            $this->data["search_data"] = $_GET;
                       
          $array = array();
          foreach($list_event as $key=>$value)
          {
            $array[$key]  = array(
                'id' => $value->get('id'),
                'title' => strip_tags($value->get('title')),
                'meta_slug' => $value->get('meta_slug'),
                'meta_title' => $value->get('meta_title'),
                'meta_description' => $value->get('meta_description'),
                'description' => $value->get('description'),
                'create_date_int' => $value->get('create_date_int'),
                'meta_keywork' => $value->get('meta_keywork'),
                'total' => $this->news_articles_event_model->get_total_news_by_event($value->get('id')),
                'category' => $this->news_category_model->get_name_category_by_id($value->get('category_id'))
            );
          }          
          $this->data['list_event'] = $array;
          $this->template->assign('data',$this->data);              
          $this->template->display("event/index_event.tpl");
      }
  
      public function destroyed() {               
          $this->session->rm_session("msg");
          $this->session->rm_session("error");
          $this->session->rm_session("info");
      }          
  }
?>
