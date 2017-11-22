<?php
  class AddPermission extends Module implements IModule {  
      /**
      * tm users model
      * 
      * @var TmUsersModel
      */
      private $tm_users_model;
      /**
      * tm groups cat model
      * 
      * @var TmGroupsCatModel
      */
      private $tm_groups_cat_model;
      /**
      * tm user permissions model
      * 
      * @var TmUserPermissionsModel
      */
      private $tm_user_permissions_model;
      /**
        * permission  model
        * 
        * @var PermissionModel
        */
        private $premission_model;    
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
          $this->tm_users_model = Loader::load_model("tm_users");
          $this->tm_groups_cat_model = Loader::load_model("tm_groups_cat");
          $this->tm_user_permissions_model = Loader::load_model("tm_user_permissions");
          $this->premission_model = Loader::load_model("permission");
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
          if(!$this->premission_model->check_permission($user_id,4))
           {
               die('no permission');
           }
          $list_user = $this->tm_users_model->get_list("user_deleted =1","",0,"");
          $array = array();
          foreach($list_user as $key=>$value)
          {
              $array[$key] = array(
                'id' => $value->get('user_id'),
                'user_name' => $value->get('username'),
                'group_id' => $this->tm_users_model->get_groups_user($value->get('user_id')),
                'cat' => $this->tm_groups_cat_model->list_cat_user($value->get('user_id'))
              );
          }          
          $user_permission = $this->tm_user_permissions_model->get_list("","id DESC",0,"");                      
          
          $this->data['list_user'] = $array;                    
          $this->template->assign('data',$this->data);
          $this->template->display("user/add_permission.tpl");
      }
  
      public function destroyed() {               
          $this->session->rm_session("msg");
          $this->session->rm_session("error");
          $this->session->rm_session("info");
      }          
  }
?>
