<?php
  class DetectedView extends Module implements IModule {  
      /**
      * news articles view model
      * 
      * @var NewsArticlesViewModel
      */
      private $news_articles_view_model;
      /**
      * news articles join category view model
      * 
      * @var NewsArticlesjoinCategoryViewModel
      */
      private $news_articles_join_category_view_model;
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
          $this->news_articles_join_category_view_model = Loader::load_model("news_articles_join_category_view");
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
        $id = isset($this->input['id']) ? $this->input['id'] : 0;                   
        $id = intval($id);        
        $view = isset($this->input['view']) ? $this->input['view'] : null;        
        $view = strip_tags($view);
        $view = stripcslashes($view);        
        $user_id = $this->session->get_session('userid');    
        if($id && $user_id)
        {           
            if($view =='cat_homeview' or $view =='chuyen_muc_noi_bat')
            {                
                $news_content =$this->news_articles_join_category_view_model->admin_get_news_by_category_sql("a.status=3 AND a.public=1 AND a.timer =0 AND (b.category_id={$id} OR b.parent_id ={$id})","a.create_date_int DESC,a.id DESC",0,5);
                $this->data['content'] = $news_content;            
            }else           
            {
                $news_content = $this->news_articles_view_model->admin_get_news_by_mysql("id ={$id} AND status=3 AND public=1 AND timer=0","create_date_int DESC,id DESC",0,1);              
                $this->data['content'] = $news_content[0];            
            }                    
            $this->data['style_view'] = $view;                        
            $this->template->assign('data',$this->data); 
            $this->template->display('manager/display_news.tpl');
           
        }else
        {
            Application::redirect($this->linkHandler->linkAction('login'));
        }
      }
  
      public function destroyed() {               
          $this->session->rm_session("msg");
          $this->session->rm_session("error");
          $this->session->rm_session("info");
      }          
  }
?>
