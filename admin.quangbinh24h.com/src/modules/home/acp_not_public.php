<?php
  class AcpNotPublic extends Module implements IModule {  
      /**
      * news articles  model
      * 
      * @var NewsArticlesModel
      */
      private $news_articles_model;
      /**
        * permission  model
        * 
        * @var PermissionModel
        */
        private $premission_model; 
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
          $this->news_articles_model = Loader::load_model("news_articles");
          $this->news_articles_join_articles_category_model = Loader::load_model("news_articles_join_articles_category");
            $this->news_category_model = Loader::load_model("news_category");
          $this->premission_model = Loader::load_model("permission");
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
          
          if(!$this->premission_model->check_permission($user_id,4))
          {
               die('no permission');
          }
          
          $cat_id = isset($this->input['select_cat']) ? $this->input['select_cat'] : 0;          
          $cat_id = intval($cat_id);
          $this->data["cat_id"] = $cat_id;
                    
          $current_page = isset($this->input['page']) ? $this->input['page'] : 1;
          $current_page = intval($current_page);
          
          $condition = "";
          if($cat_id){
              $condition .= " and (c.id={$cat_id} or c.parent_id={$cat_id})";
          }
          
          if($cat_id)             
            $total= $this->news_articles_join_articles_category_model->get_total("a.public=3 AND a.draft=0 AND (a.status=3 or a.status=2)",$cat_id);             
          else
            $total = $this->news_articles_model->get_total_by_sql("a.public=3 AND a.draft=0 AND (a.status=3 or a.status=2)","",0,"");  
            
          
          $num        =   20;     
          $page_show  =   Application::$config['paging']['DefaultLoad']['PageShow'];                                        
          $total_page = ceil($total/$num);
          $paging     =   Application::paging($current_page,$total_page,$page_show);  
          $offset     =   ($current_page-1)*$num;
          $limit      =   $num;                   
         
         $list_news = $this->news_articles_join_articles_category_model->get_list_art($cat_id,"(a.status=3 or a.status=2) AND a.draft=0 AND a.public=3","a.create_date_int DESC",$offset,$limit);                   
         
          $time = time();
          $list_category = $this->news_category_model->get_list_category("parent_id=0 and status=1 and home_display=0 and $time","ordering desc",0,"");          
          $arr_cat = array();
          foreach($list_category as $k=>$v)
          {
                $arr_cat[$k]= array(                    
                    'id' => $v->get('id'),
                    'title' => $v->get('title'),
                    'status' => $v->get('status'),
                    'child' => $this->news_category_model->get_list_category("parent_id={$v->get('id')} and status=1 and home_display=0 and $time","ordering desc",0,"")
                );
          }        
          $this->data['list_category'] = $arr_cat;        
          $this->data['paging'] = array(
                    'page' => $paging,
                    'current' => $current_page,
                    'total' => $total_page
           );   
          $this->data['list_news'] = $list_news;
          
          $this->template->assign('data',$this->data);
          $this->template->display("TBT/index_news_wait.tpl");                                
      }
  
      public function destroyed() {               
           $this->session->rm_session("msg");
           $this->session->rm_session("error");
           $this->session->rm_session("info");
      }          
  }
?>
