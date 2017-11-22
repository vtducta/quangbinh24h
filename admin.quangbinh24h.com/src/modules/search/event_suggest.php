<?php
  class Event_suggest extends Module implements IModule {  
      /**
      * sphinx helper
      * 
      * @var SphinxHelper
      */
      private $sphinx_helper;
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
            $q = isset($this->input['q']) ? $this->input['q'] : '';      
            $list_event = array();       
            if($q){
                $q = $this->templateHelper->build_slug($q);    
                $list_event = $this->news_event_model->get_list("status=1 and `meta_slug` like '%{$q}%'","create_date_int desc",0,10); 
            }else{
                $list_event = $this->news_event_model->get_list("status=1","create_date_int","create_date_int desc",0,10);     
            }
          
            $i=0;
            foreach($list_event as $key=>$value)
            {   
                $array[$i] = array(
                    'id' => $value->get("id"),
                    'name' => $value->get("title")
                );  
                $i++;  
                
            } 
            $json_response = json_encode($array);           
            print($json_response);    
      }
  
      public function destroyed() {               
      }          
  }
?>
