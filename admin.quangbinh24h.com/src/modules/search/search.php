<?php
  class Search extends Module implements IModule {  
      /**
      * sphin helper
      * 
      * @var SphinxHelper
      */
      private $sphinx_helper;
      
      /**
        * permission  model
        * 
        * @var PermissionModel
        */
        private $permission_model; 
        
      /**
      * news articles view model
      * 
      * @var NewsArticlesViewModel
      */
      private $news_articles_view_model;
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
          $this->sphinx_helper = Loader::load_helper("sphinx_helper");
          $this->news_articles_view_model = Loader::load_model("news_articles_view");
          
          $this->permission_model = Loader::load_model("permission");
          $user_id = $this->session->get_session("userid");
          $group_user = $this->permission_model->get_group_user($user_id);
             $this->news_category_model =  Loader::load_model("news_category");
       
          $this->data["group_user_id"] = $group_user;
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
        $cat_id= isset($this->input['id']) ? $this->input['id'] : 0;          
        $keyword = isset($this->input['keyword']) ? $this->input['keyword'] : 'Người đưa tin';      
        
        if($cat_id){
            $list_category = $this->news_category_model->get_list_category_mysql("status=1 and home_display=0 and parent_id=$cat_id","",0,"");
            $tmp = array();
            $tmp[] = $cat_id;
            foreach($list_category as $cate)
                $tmp[] = $cate->get("id");
            
            $cat_id = $tmp;        
            
        }    
   //     var_dump($cat_id); 
        $total = $this->sphinx_helper->get_total_art_by_keyword($keyword,$cat_id);                
        $total= $total['total'];
        $num        =   10;
        $page_show  =   7;
        $total= 100;      
        $total_page = ceil($total/$num);
        $paging     =   Application::paging($current_page,$total_page,$page_show);  
        $offset     =   ($current_page-1)*$num;
        $limit      =   $num;    
                
        $list_key_search = $this->sphinx_helper->get_search_art($keyword,$limit,$offset,$cat_id);   
        
        $list_news = array();
        foreach($list_key_search as $key=>$value){ 
                    $a = $this->news_articles_view_model->admin_get_news_by_mysql("id ={$key}","",0,1);
                    $list_news[] = $a[0];
        } 
        $this->data['list_news'] = $list_news;
        $this->data['paging'] = array(
                    'page' => $paging,
                    'current' => $current_page,
                    'total' => $total_page
        );       
        $this->template->assign('data',$this->data);
        $this->template->display("manager/list_news.tpl");
      }
  
      public function destroyed() {               
          $this->session->rm_session("msg");
          $this->session->rm_session("error");
          $this->session->rm_session("info");
      }          
  }
?>
