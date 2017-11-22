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
          $list_event = $this->news_event_model->get_active_event('');        
          $array = array();
          foreach($list_event as $key=>$value)
          {
            $array[$key]  = array(
                'id' => $value->get('id'),
                'title' => $value->get('title'),
                'meta_slug' => $value->get('meta_slug'),
                'total' => $this->news_articles_event_model->get_total_news_by_event($value->get('id'))
            );
          }          
          $this->data['list_event'] = $array;
          $this->template->assign('data',$this->data);              
          $this->template->display("global/index_event.tpl");
      }
  
      public function destroyed() {               
          $this->session->rm_session("msg");
          $this->session->rm_session("error");
          $this->session->rm_session("info");
      }          
  }
?>
