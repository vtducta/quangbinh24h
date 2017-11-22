<?php
    class ListUser extends Module implements IModule {  
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
        * permission  model
        * 
        * @var PermissionModel
        */
        private $premission_model;    
        /**
        * news category model
        * 
        * @var NewsCategoryModel
        */
        private $news_category_model;      
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
            $this->premission_model = Loader::load_model("permission");
            $this->news_category_model = Loader::load_model("news_category");
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
            $list_category = $this->news_category_model->build_child_category_sql();            

            $list_user = $this->tm_users_model->get_list("user_deleted =1","",0,"");
            $array = array();
            foreach($list_user as $key=>$value)
            {
                $array[$key] = array(
                'id' => $value->get('user_id'),
                'user_name' => $value->get('username'),
                'fullname' => $value->get('fullname'),
                'group_id' => $this->tm_users_model->get_groups_user($value->get('user_id')),
                );
            }                      
            $this->data['list_user'] = $array;                    
            $this->template->assign('data',$this->data);
            $this->template->display("user/list_user.tpl");
        }

        public function destroyed() {               
            $this->session->rm_session("msg");
            $this->session->rm_session("error");
            $this->session->rm_session("info");
        }          
    }
?>
