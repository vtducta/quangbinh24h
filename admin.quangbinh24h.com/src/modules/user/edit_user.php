<?php
  class EditUser extends Module implements IModule {  
      /**
      * news category model
      * 
      * @var NewsCategoryModel
      */
      private $news_category_model;
      /**
      * tm users model
      * 
      * @var TmUsersModel
      */
      private $tm_users_model;
      /**
      * tm user permissions model
      * 
      * @var TmUserPermissionsBean
      */
      private $tm_user_permissions_model;
      /**
      * tm group user model  
      * 
      * @var TmGroupUserModel
      */
      private $tm_group_user_model;
      /**
      * tm groups cat model
      * 
      * @var TmGroupsCatModel
      */
      private $tm_groups_cat_model;
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
          $this->news_category_model = Loader::load_model("news_category");
          $this->tm_user_permissions_model = Loader::load_model("tm_user_permissions");
          $this->tm_group_user_model = Loader::load_model("tm_group_user");
          $this->tm_users_model = Loader::load_model("tm_users");
          $this->tm_groups_cat_model = Loader::load_model("tm_groups_cat");
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
          $user_id = isset($this->input['id']) ? $this->input['id'] : 0;             
          if(!preg_match('/^[0-9]*$/',$user_id))
          {
              Application::redirect($this->linkHelper->linkhome("ListUser"));
          }
          $user = $this->session->get_session("userid");
          if(!$user)
          {
              Application::redirect($this->linkHelper->linkhome("login"));
          }          
          if(!$this->premission_model->check_permission($user,4))
           {
               die('no permission');
           }
          $user_info = $this->tm_users_model->get_list("user_id={$user_id}","",0,1);
          $list_cat_user = $this->tm_groups_cat_model->get_list_cat_user($user_id);
          $list_category = $this->news_category_model->build_child_category_sql();
          $this->data['list_cat_user'] = $list_cat_user;       
          $group_user = $this->tm_group_user_model->get_list("user_id = {$user_id}","",0,1);
          $this->data['list_cat'] = $list_category;
          $this->data['user_info']= $user_info[0];
          $this->data['group'] = $group_user[0]->get('group_id');                                   
          $this->template->assign('data',$this->data);
          $this->template->display("user/index_edit.tpl");
      }
  
      public function destroyed() {               
          $this->session->rm_session("msg");
          $this->session->rm_session("error");
          $this->session->rm_session("info");
      }          
  }
?>
