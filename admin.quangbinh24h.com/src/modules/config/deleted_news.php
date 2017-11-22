<?php
  class DeletedNews extends Module implements IModule {  
      /**
      * news articles feature data model
      * 
      * @var NewsArticlesFeatureDataModel
      */
      private $news_articles_feature_data_model;
      /**
      * news home log model
      * 
      * @var NewsHomeLogModel
      */
      private $news_home_log_model;
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
          $this->news_articles_feature_data_model = Loader::load_model("news_articles_feature_data");
          $this->news_home_log_model = Loader::load_model("news_home_log");
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
        $view =stripslashes($view);  
        $user_id = $this->session->get_session('userid');    
        if($id && $user_id)
        {   
            switch($view)                                          
            {   
                case 'forcus_home':
                   $this->news_articles_feature_data_model->delete("feature_id =6 AND news_id = {$id}");
                   $this->news_home_log_model->insert_home_log($user_id,$id,8,'deleted');
                break;
                case 'tin_tieu_diem' :               
                    $this->news_articles_feature_data_model->delete("feature_id =8 AND news_id = {$id}");
                    $this->news_home_log_model->insert_home_log($user_id,$id,8,'deleted');                    
                break;
                case 'tinmoinhat' :                               
                    $this->news_articles_feature_data_model->delete("feature_id =19 AND news_id = {$id}");
                    $this->news_home_log_model->insert_home_log($user_id,$id,19,'deleted');
                break;
                case '4tintieudiem' :                               
                    $this->news_articles_feature_data_model->delete("feature_id =26 AND news_id = {$id}");
                    $this->news_home_log_model->insert_home_log($user_id,$id,26,'deleted');
                break;
                case "tinsukien_home":
                    $this->news_articles_feature_data_model->delete("feature_id =27 AND news_id = {$id}");
                    $this->news_home_log_model->insert_home_log($user_id,$id,27,'deleted');
                break;
                case "ttdn":
                    $this->news_articles_feature_data_model->delete("feature_id =28 AND news_id = {$id}");
                    $this->news_home_log_model->insert_home_log($user_id,$id,28,'deleted');
                break;
                
                case "wg_tm":
                    $this->news_articles_feature_data_model->delete("feature_id =29 AND news_id = {$id}");
                    $this->news_home_log_model->insert_home_log($user_id,$id,29,'deleted');
                    break;
                
                case "wg_nl":
                    $this->news_articles_feature_data_model->delete("feature_id =35 AND news_id = {$id}");
                    $this->news_home_log_model->insert_home_log($user_id,$id,35,'deleted');
                    break;
                    
                case "wg_dspl":
                    $this->news_articles_feature_data_model->delete("feature_id =36 AND news_id = {$id}");
                    $this->news_home_log_model->insert_home_log($user_id,$id,36,'deleted');
                    break;
                case "wg_tnthpt":
                    $this->news_articles_feature_data_model->delete("feature_id =37 AND news_id = {$id}");
                    $this->news_home_log_model->insert_home_log($user_id,$id,37,'deleted');
                    break;
                    
                case "wg_video_bottom_art":
                    $this->news_articles_feature_data_model->delete("feature_id =34 AND news_id = {$id}");
                    $this->news_home_log_model->insert_home_log($user_id,$id,34,'deleted');
                    break;
                
                case "wg_video_in_art":
                    $this->news_articles_feature_data_model->delete("feature_id =33 AND news_id = {$id}");
                    $this->news_home_log_model->insert_home_log($user_id,$id,33,'deleted');
                    break;
                        
                case "video_home_top_right":
                    $this->news_articles_feature_data_model->delete("feature_id =30 AND news_id = {$id}");
                    $this->news_home_log_model->insert_home_log($user_id,$id,30,'deleted');
                break;
                /*case 'new_focus_tour' :
                    $this->new_article_feature_data_controller->deleted_feature_data(19,$id);
                break;
                case 'next_tour' :
                    $this->new_article_feature_data_controller->deleted_feature_data(20,$id);
                break;*/
            }
        }else
        {
            Application::redirect($this->linkHelper->linkhome('login'));
        }
      }
  
      public function destroyed() {               
          $this->session->rm_session("msg");
          $this->session->rm_session("error");
          $this->session->rm_session("info");
      }          
  }
?>
