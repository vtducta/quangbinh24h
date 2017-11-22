<?php
  class ProcessNews extends Module implements IModule {  
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
        $view =trim(stripslashes($view));        
        $user_id = $this->session->get_session('userid');            
        if($id && $user_id)
        {   
            switch($view)                                          
            {
                case 'ft1' :                      
                      $this->news_articles_feature_data_model->delete("feature_id =1 AND news_id = {$id}");
                      $this->news_articles_feature_data_model->insert_feature(1,$id);                       
                      $this->news_home_log_model->insert_home_log($user_id,$id,1,'add');
                   break;
               case 'ft2' :
                      $this->news_articles_feature_data_model->delete("feature_id =2 AND news_id = {$id}");
                      $this->news_articles_feature_data_model->insert_feature(2,$id);                       
                      $this->news_home_log_model->insert_home_log($user_id,$id,2,'add');                                                    
                   break;
                case 'event1' :                    
                      $this->news_articles_feature_data_model->delete("feature_id =3 AND news_id = {$id}");
                      $this->news_articles_feature_data_model->insert_feature(3,$id);                       
                      $this->news_home_log_model->insert_home_log($user_id,$id,3,'add');
                break;
                case 'event2' :                   
                     $this->news_articles_feature_data_model->delete("feature_id =4 AND news_id = {$id}");
                     $this->news_articles_feature_data_model->insert_feature(4,$id);                       
                     $this->news_home_log_model->insert_home_log($user_id,$id,4,'add');
                break;
                case 'tinmoinhat' :                     
                    $this->news_articles_feature_data_model->delete("feature_id =19 AND news_id = {$id}");
                    $this->news_articles_feature_data_model->insert_feature(19,$id);                       
                    $this->news_home_log_model->insert_home_log($user_id,$id,19,'add');
                break;                    
               case 'focus_home_cateogory' :                                                           
                    $this->news_articles_feature_data_model->delete("feature_id =20 AND news_id = {$id}");
                    $this->news_articles_feature_data_model->insert_feature(20,$id);                       
                    $this->news_home_log_model->insert_home_log($user_id,$id,20,'add');
               break;
                case 'cat_homeview':                                         
                      $this->news_articles_feature_data_model->delete("feature_id =5 AND news_id = {$id}");
                      $this->news_articles_feature_data_model->insert_feature(5,$id);                       
                      $this->news_home_log_model->insert_home_log($user_id,$id,5,'add');
                break;
                case 'forcus_home':                                                         
                      $this->news_articles_feature_data_model->delete("feature_id =6 AND news_id = {$id}");
                      $this->news_articles_feature_data_model->insert_feature(6,$id);                       
                      $this->news_home_log_model->insert_home_log($user_id,$id,6,'add');
                break;                
                case 'tin_noi_bat' :                   
                     $this->news_articles_feature_data_model->delete("feature_id =7 AND news_id = {$id}");
                     $this->news_articles_feature_data_model->insert_feature(7,$id);                       
                     $this->news_home_log_model->insert_home_log($user_id,$id,7,'add');      
                break;
                case 'tin_tieu_diem' :                   
                    $this->news_articles_feature_data_model->delete("feature_id =8 AND news_id = {$id}");
                    $this->news_articles_feature_data_model->insert_feature(8,$id);                       
                    $this->news_home_log_model->insert_home_log($user_id,$id,8,'add');  
                break;
                case 'chuyen_muc_noi_bat' :                                   
                    $this->news_articles_feature_data_model->delete("feature_id =9 AND news_id = {$id}");
                    $this->news_articles_feature_data_model->insert_feature(9,$id);                       
                    $this->news_home_log_model->insert_home_log($user_id,$id,9,'add');
                break;
                case 'new_hot_1' :                     
                    $this->news_articles_feature_data_model->delete("feature_id =10 AND news_id = {$id}");
                    $this->news_articles_feature_data_model->insert_feature(10,$id);                       
                    $this->news_home_log_model->insert_home_log($user_id,$id,10,'add');   
                break;
                case 'new_hot_2' :                     
                    $this->news_articles_feature_data_model->delete("feature_id =11 AND news_id = {$id}");
                    $this->news_articles_feature_data_model->insert_feature(11,$id);                       
                    $this->news_home_log_model->insert_home_log($user_id,$id,11,'add');   
                break;
                case 'new_hot_3':                                        
                    $this->news_articles_feature_data_model->delete("feature_id =12 AND news_id = {$id}");
                      $this->news_articles_feature_data_model->insert_feature(12,$id);                       
                      $this->news_home_log_model->insert_home_log($user_id,$id,12,'add');
                break;
                case 'new_hot_4' :                    
                      $this->news_articles_feature_data_model->delete("feature_id =13 AND news_id = {$id}");
                      $this->news_articles_feature_data_model->insert_feature(13,$id);                       
                      $this->news_home_log_model->insert_home_log($user_id,$id,13,'add');   
                break;
               case 'feature1' :                    
                      $this->news_articles_feature_data_model->delete("feature_id =14 AND news_id = {$id}");
                      $this->news_articles_feature_data_model->insert_feature(14,$id);                       
                      $this->news_home_log_model->insert_home_log($user_id,$id,14,'add');
               break;
               case 'feature2' :                     
                    $this->news_articles_feature_data_model->delete("feature_id =15 AND news_id = {$id}");
                    $this->news_articles_feature_data_model->insert_feature(15,$id);                       
                    $this->news_home_log_model->insert_home_log($user_id,$id,15,'add');    
               break;
               case 'feature3':                     
                    $this->news_articles_feature_data_model->delete("feature_id =16 AND news_id = {$id}");
                    $this->news_articles_feature_data_model->insert_feature(16,$id);                       
                    $this->news_home_log_model->insert_home_log($user_id,$id,16,'add');    
               break;
               case 'feature4' :                   
                   $this->news_articles_feature_data_model->delete("feature_id =17 AND news_id = {$id}");
                   $this->news_articles_feature_data_model->insert_feature(17,$id);                       
                   $this->news_home_log_model->insert_home_log($user_id,$id,17,'add');    
               break;
               case 'feature5' :                     
                    $this->news_articles_feature_data_model->delete("feature_id =18 AND news_id = {$id}");
                    $this->news_articles_feature_data_model->insert_feature(18,$id);                       
                    $this->news_home_log_model->insert_home_log($user_id,$id,18,'add');    
               break;                              
               case 'feature1_star':                                                            
                    $this->news_articles_feature_data_model->delete("feature_id =21 AND news_id = {$id}");
                    $this->news_articles_feature_data_model->insert_feature(21,$id);                       
                    $this->news_home_log_model->insert_home_log($user_id,$id,21,'add');    
               case 'feature2_star':                   
                   $this->news_articles_feature_data_model->delete("feature_id =22 AND news_id = {$id}");
                   $this->news_articles_feature_data_model->insert_feature(22,$id);                       
                   $this->news_home_log_model->insert_home_log($user_id,$id,22,'add');    
               break;
               case 'feature3_star':                   
                   $this->news_articles_feature_data_model->delete("feature_id =23 AND news_id = {$id}");
                   $this->news_articles_feature_data_model->insert_feature(23,$id);                       
                   $this->news_home_log_model->insert_home_log($user_id,$id,23,'add');    
               break;
               case 'feature4_star':                   
                   $this->news_articles_feature_data_model->delete("feature_id =24 AND news_id = {$id}");
                   $this->news_articles_feature_data_model->insert_feature(24,$id);                       
                   $this->news_home_log_model->insert_home_log($user_id,$id,24,'add');    
               break;
               case 'feature5_star':                    
                   $this->news_articles_feature_data_model->delete("feature_id =25 AND news_id = {$id}");
                   $this->news_articles_feature_data_model->insert_feature(25,$id);                       
                   $this->news_home_log_model->insert_home_log($user_id,$id,25,'add');    
               break;
               case '4tintieudiem' :
                    $this->news_articles_feature_data_model->delete("feature_id=26 AND news_id= {$id}");
                    $this->news_articles_feature_data_model->insert_feature(26,$id);
                    $this->news_home_log_model->insert_home_log($user_id,$id,26,'add');
               break;
               case "tinsukien_home" :
                    $this->news_articles_feature_data_model->delete("feature_id=27 AND news_id= {$id}");
                    $this->news_articles_feature_data_model->insert_feature(27,$id);
                    $this->news_home_log_model->insert_home_log($user_id,$id,27,'add');
               break;
               case "ttdn" :
                    $this->news_articles_feature_data_model->delete("feature_id=28 AND news_id= {$id}");
                    $this->news_articles_feature_data_model->insert_feature(28,$id);
                    $this->news_home_log_model->insert_home_log($user_id,$id,28,'add');
               break;
               case "wg_tm" :
                    $this->news_articles_feature_data_model->delete("feature_id=29 AND news_id= {$id}");
                    $this->news_articles_feature_data_model->insert_feature(29,$id);
                    $this->news_home_log_model->insert_home_log($user_id,$id,29,'add');
               break;
               case "wg_nl" :
                    $this->news_articles_feature_data_model->delete("feature_id=35 AND news_id= {$id}");
                    $this->news_articles_feature_data_model->insert_feature(35,$id);
                    $this->news_home_log_model->insert_home_log($user_id,$id,35,'add');
               break;               
               case "wg_dspl" :
                    $this->news_articles_feature_data_model->delete("feature_id=36 AND news_id={$id}");
                    $this->news_articles_feature_data_model->insert_feature(36,$id);
                    $this->news_home_log_model->insert_home_log($user_id,$id,36,'add');
               break;   
                case "wg_tnthpt" :
                    $this->news_articles_feature_data_model->delete("feature_id=37 AND news_id={$id}");
                    $this->news_articles_feature_data_model->insert_feature(37,$id);
                    $this->news_home_log_model->insert_home_log($user_id,$id,37,'add');
               break;            
               case "wg_video_in_art" :
                    $this->news_articles_feature_data_model->delete("feature_id=33 AND news_id= {$id}");
                    $this->news_articles_feature_data_model->insert_feature(33,$id);
                    $this->news_home_log_model->insert_home_log($user_id,$id,33,'add');
               break;               
               case "wg_video_bottom_art" :
                    $this->news_articles_feature_data_model->delete("feature_id=34 AND news_id= {$id}");
                    $this->news_articles_feature_data_model->insert_feature(34,$id);
                    $this->news_home_log_model->insert_home_log($user_id,$id,34,'add');
               break;                                                                                              
               case "video_home_top_right" :
                    $this->news_articles_feature_data_model->delete("feature_id=30 AND news_id= {$id}");
                    $this->news_articles_feature_data_model->insert_feature(30,$id);
                    $this->news_home_log_model->insert_home_log($user_id,$id,30,'add');
               break;
            }
        }else
        {
            Application::redirect($this->linkHelper->link_admin('login'));
        }
      }
  
      public function destroyed() {               
          $this->session->rm_session("msg");
          $this->session->rm_session("error");
          $this->session->rm_session("info");
      }          
  }
?>
