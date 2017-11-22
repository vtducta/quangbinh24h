<?php
    class EditEvent extends Module implements IModule {  
        /**
        * news event model
        * 
        * @var NewsEventModel
        */
        private $news_event_model;
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
            $this->news_event_model = Loader::load_model("news_event");
            $this->premission_model = Loader::load_model("permission");
            $this->news_category_model = Loader::load_model("news_category");
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
            $id = isset($this->input['id']) ? $this->input['id'] : 0;
            $id = intval($id);
            if(!$user_id)
            {
                Application::redirect($this->linkHelper->linkhome("login"));
            }
            if(!$this->premission_model->check_permission($user_id,array(1,4)))
            {
                   die('no permission');
            }
            $content = $this->news_event_model->get_once("id={$id}");
            if(!$content)
            {
               Application::redirect($this->linkHelper->linkhome("ListEvent"));
            }
            $list_category = $this->news_category_model->build_child_category();
            $this->data['list_category']= $list_category;
            $this->data['event'] = $content;
            $this->template->assign('data',$this->data);
            $this->template->display("event/index_edit_event.tpl");
        }

        public function destroyed() {               
            $this->session->rm_session("msg");
            $this->session->rm_session("error");
            $this->session->rm_session("info");
        }          
    }
?>
