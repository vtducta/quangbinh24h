<?php  
    class home extends Module implements IModule {  
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
            $this->tm_user_permissions_model = Loader::load_model("tm_user_permissions");
            $this->tm_group_user_model = Loader::load_model("tm_group_user");
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
            $now = time();
            $user_permission = $this->tm_user_permissions_model->get_list("user_id={$user_id} AND  ({$now} >=start_time AND {$now}<=end_time)","id DESC",0,1);                                                                                  
            if(!$user_permission)
            {                                
                $group_user = $this->tm_group_user_model->get_list("user_id = {$user_id}","",0,1);
                $group_user_ = $group_user[0]->get('group_id');              
            }else {
                $group_user_ = $user_permission[0]->get('group_user');          
            } 
            if($group_user_==1)
            {
                Application::redirect($this->linkHelper->linkhome('AdminHome'));    
            }  
            if($group_user_==2||$group_user_==5)
            {   
                Application::redirect($this->linkHelper->linkhome('BtvNewsPublic'));    
            }
            if($group_user_==3)
            {
                Application::redirect($this->linkHelper->linkhome('HomeReporter'));        
            }
            if($group_user_==4)
            {                              
                Application::redirect($this->linkHelper->linkhome('AcpHome'));
            } 
        }

        public function destroyed() {               
        }          
    }
?>
