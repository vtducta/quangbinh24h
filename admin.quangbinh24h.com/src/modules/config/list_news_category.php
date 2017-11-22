<?php
  class ListNewsCategory extends Module implements IModule {  
      /**
      * articles view join feature join category view model
      * 
      * @var ArticlesViewJoinFeatureJoinCategoryViewModel
      */
      private $articles_view_join_feature_join_category_view_model;
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
          $this->articles_view_join_feature_join_category_view_model=Loader::load_model("articles_view_join_feature_join_category_view");
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
    //      ("a.status=3 AND a.public=1 AND b.feature_id={$feature_id} AND c.category_id={$cat_id}",$order,$offset,$limit);   
          $list_news = $this->articles_view_join_feature_join_category_view_model->get_news_feature_id_by_category_mysql("a.status=3 AND a.public=1 AND b.feature_id=20 AND c.category_id={$id}","b.id DESC",0,5);                 
          $this->data['list_news'] = $list_news;
          $this->template->assign('data',$this->data);
          $this->template->display("manager/focus_home.tpl");
      }
  
      public function destroyed() {               
          $this->session->rm_session("msg");
          $this->session->rm_session("error");
          $this->session->rm_session("info");
      }          
  }
?>
