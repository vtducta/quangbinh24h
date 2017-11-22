<?php
  class NewsDeletedAction extends Module implements IModule {  
       /**
      * news articles model
      * 
      * @var NewsArticlesModel
      */
      private $news_articles_model;
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
          $this->news_articles_model = Loader::load_model("news_articles");
          $this->news_articles_view_model = Loader::load_model("news_articles_view");
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
          $action = isset($this->input['action']) ? $this->input['action'] : null;
          $id = isset($this->input['id']) ? $this->input['id'] : 0;
          $url = isset($_SERVER["HTTP_REFERER"]) ? $_SERVER["HTTP_REFERER"] : Application::redirect($this->linkHelper->linkhome("home"));
          switch($action)
          {
            case "hiddennnews" :
                $bean = $this->news_articles_model->create_bean();
                $bean->set("public",0);
                $this->news_articles_model->update($bean,"id={$id}");
                
                $bean_articles_view = $this->news_articles_view_model->create_bean();
                $bean_articles_view->set("public",0);
                $this->news_articles_model->update($bean_articles_view,"id={$id}");                
                
                Application::redirect($url);                                            
            break;
          }
      }
  
      public function destroyed() {               
      }          
  }
?>
