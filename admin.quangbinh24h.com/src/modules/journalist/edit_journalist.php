<?php
    class EditJournalist extends Module implements IModule
    {        
        /**
        * permission  model
        * 
        * @var PermissionModel
        */
        private $permission_model;
        /**
        * TmUsersModel
        * 
        * @var TmUsersModel
        */
        private $tm_users_model; 
        /**
        * journalist model
        * @var JournalistModel
        */
        private $journalist_model;
         
        public function __construct($param=null)
        {
            $this->init(get_class($this));
            
            $this->permission_model = Loader::load_model('permission');
            $this->tm_users_model = Loader::load_model("tm_users");
            $this->journalist_model = Loader::load_model("journalist");
            
            $this->template->assign('link_helper', $this->linkHelper);
            $this->template->assign('template_helper', $this->templateHelper);
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

        public function run()
        {
            $user_id = $this->session->get_session("userid");
            if(!$user_id)
            {
                Application::redirect($this->linkHelper->linkhome("login"));
            }
            $this->data['user_info'] = $this->tm_users_model->get_once("user_id={$user_id}");
            if(!$this->permission_model->check_permission($user_id,array(1,4)))
            {
                die('no permission');
            }    
            else {
                $group_user = $this->permission_model->get_group_user($user_id);
                $this->data['group_user'] = $group_user;
            }    
            
            $id = isset($this->input['id']) ? $this->input['id'] : 0;
            $id = intval($id);
            $journalist = $this->journalist_model->get_journalist_by_id($id);
            if (!count($journalist)) {
                $this->session->set_session('msg', 'Tac gia khong ton tai.');
                Application::redirect($this->linkHelper->link_admin('ListJournalist'));
            }
            
            $this->data['journalist'] = $journalist;
            $this->template->assign('data', $this->data);
            $this->template->display('journalist/edit.tpl');
        }

        public function destroyed()
        {

        }
    }  
?>