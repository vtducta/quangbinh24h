<?php
  class NameFeature extends Module implements IModule {  
      /**
      * name feature home model
      * 
      * @var NameFeatureHomeModel
      */
      private $name_feature_home_model;
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
          $this->name_feature_home_model = Loader::load_model("name_feature_home");
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
            $userId = $this->session->get_session('userid');        
            $title = isset($this->input['title']) ? $this->input['title'] : null;        
            $option = isset($this->input['option']) ? $this->input['option'] : 1;                    
            $meta_slug = $this->templateHelper->build_slug($title);
            $description = $title;              
            if ($userId)
            {   
                $bean = $this->name_feature_home_model->create_bean();
                $bean->set("title",$title);
                $bean->set("meta_slug",$meta_slug);
                $bean->set("postion",$option);
                $bean->set("description",$description);
                $this->name_feature_home_model->insert($bean);
                $data = array(
                 'msg' => 'ok'           
                );
                echo json_encode($data);
            }
            
      }
  
      public function destroyed() {               
          $this->session->rm_session("msg");
          $this->session->rm_session("error");
          $this->session->rm_session("info");
      }          
  }
?>
