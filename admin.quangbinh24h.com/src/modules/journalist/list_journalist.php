<?php
    class ListJournalist extends Module implements IModule
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
            
            $current_page = isset($this->input['page']) ? $this->input['page'] : 1;
            $limit = 20;
            $page_show = 5;
            $offset = ($current_page - 1) * $limit;
            $total = $this->journalist_model->get_total_journalist("1");
            $total_page = ceil($total / $limit);
            
            $list_journalist = $this->journalist_model->get_list_journalist("","id DESC", $offset, $limit);
            
            $paging = Application::paging($current_page, $total_page, $page_show);
            $pager = array(
                'current' => $current_page,
                'total' => $total_page,
                'show' => $page_show,
                'paging' => $paging
            );
            
            $this->data['list_journalist'] = $list_journalist;
            $this->data['pager'] = $pager;
            $this->template->assign('data', $this->data);
            $this->template->display('journalist/list.tpl');
        }

        public function destroyed()
        {

        }
    }  
?>