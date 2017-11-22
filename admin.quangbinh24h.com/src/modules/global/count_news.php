<?php
  class CountNews extends Module implements IModule {  
      /**
      * news articles view model
      *   
      * @var NewsArticlesViewModel
      */
      private $news_articles_view_model;
      /**
      * tm user permissions model
      * 
      * @var TmUserPermissionsBean
      */
      private $tm_user_permissions_model;
      /**
      * tm group user model  
      * 
      * @var TmGroupUserModel
      */
      private $tm_group_user_model;   
      /**
      * news event model
      * 
      * @var NewsEventModel
      */
      private $news_event_model;
      /**
      * tm groups cat model
      * 
      * @var TmGroupsCatModel
      */
      private $tm_groups_cat_model;
      /**
      * news articles join category view  model
      * 
      * @var NewsArticlesJoinCategoryViewModel
      */
      private $news_articles_join_category_view_model; 
      /**
      * news articles view join category model
      * 
      * @var NewsArticlesViewJoinCategoryModel
      */
      private $news_articles_view_join_category_model;
      /**
      * news articles  model
      * 
      * @var NewsArticlesModel
      */
      private $news_articles_model;                     
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
          $this->news_articles_view_model = Loader::load_model("news_articles_view");
          $this->tm_user_permissions_model = Loader::load_model("tm_user_permissions");
          $this->tm_group_user_model = Loader::load_model("tm_group_user");
          $this->news_event_model = Loader::load_model("news_event");
          $this->tm_groups_cat_model = Loader::load_model("tm_groups_cat");
          $this->news_articles_join_category_view_model = Loader::load_model("news_articles_join_category_view");
          $this->news_articles_view_join_category_model = Loader::load_model("news_articles_view_join_category");
          $this->news_articles_model = Loader::load_model("news_articles");
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
               Application::redirect($this->linkHelper->linkhome("Login"));
           }
           $now = time();
           $user_permission = $this->tm_user_permissions_model->get_list("user_id={$user_id} AND  ({$now} >=start_time AND {$now}<=end_time)","id DESC",0,1);                                                                                  
            if(!$user_permission)
            {                                
                $group_user = $this->tm_group_user_model->get_list("user_id = {$user_id}","",0,1);
                $group_user_ = $group_user[0]->get('group_id');              
            }else {
                $group_user_ = $user_permission[0]->get('group_user');          
           }            
           if($group_user_!=4)
           {
              $list_cat = $this->tm_groups_cat_model->list_cat_user($user_id);                                        
              $total_not_public= $this->news_articles_view_join_category_model->get_total_news_by_category_sql("a.status=3 AND a.public=3 AND a.timer =0 AND b.category_id in({$list_cat}) ","",0,"");           
              $total_user_public= $this->news_articles_join_category_view_model->get_total_news_by_category_sql("a.status=3 AND a.public=1 AND a.timer =0 AND b.category_id in({$list_cat}) ","",0,"");                    
           }else{
                $total_not_public = 0;
                $total_user_public = 0;
           }
          
          
           
          $total_news_public = $this->news_articles_view_model->get_total_by_mysql("a.status=3 AND a.public=1 AND a.timer=0","",0,"");           
          $not_public =  $this->news_articles_model->get_total_by_sql("a.public=3 AND (a.status=3 or a.status=2)","",0,"");               
          $total_timer= $this->news_articles_view_model->get_total_by_mysql("status=3 AND public=1 AND timer > 0","",0,"");                  
          
          
          $total_event = count($this->news_event_model->get_list("status=1","",0,""));          
          
          $this->data['total'] = array(
            'public' => $total_news_public,            
            'event' => $total_event,
            'no_public' => $not_public,
            'timer' => $total_timer
          );          
          $this->data['total_user'] = array(
              'public' => $total_user_public,            
              'no_public' => $total_not_public
          );
          $this->data['group_user'] = $group_user_;
          $this->template->assign('data',$this->data);
          $this->template->display('block/action.tpl');
      }
  
      public function destroyed() {               
          $this->session->rm_session("msg");
          $this->session->rm_session("error");
          $this->session->rm_session("info");
      }          
  }
?>
