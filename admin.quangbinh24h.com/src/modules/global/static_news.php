<?php
  class StaticNews extends Module implements IModule {  
      /**
      * news articles view model
      *   
      * @var NewsArticlesViewModel
      */
      private $news_articles_view_model;
      /**
      * news category model
      * 
      * @var NewsCategoryModel
      */
      private $news_category_model;
      /**
      * news event model
      * 
      * @var NewsEventModel
      */
      private $news_event_model;     
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
          $this->news_category_model = Loader::load_model("news_category");
          $this->news_event_model = Loader::load_model("news_event");
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
          $total_news_public = $this->news_articles_view_model->get_total_view_by_conditions("a.status=3 AND a.public=1 AND a.timer=0","",0,"");           
          $total_category = count($this->news_category_model->get_list_category("status =1","",0,""));
          $total_event = count($this->news_event_model->get_list("status=1","",0,""));          
          $this->data['total'] = array(
            'public' => $total_news_public,
            'category' => $total_category,
            'event' => $total_event
          );
          $this->template->assign('data',$this->data);
          $this->template->display('block/statics_news.tpl');
      }
  
      public function destroyed() {               
          $this->session->rm_session("msg");
          $this->session->rm_session("error");
          $this->session->rm_session("info");
      }          
  }
?>
