<?php  
    class ReporterAdd extends Module implements IModule {  
        /**
        * tm groups cat model
        * 
        * @var TmGroupsCatModel
        */
        private $tm_groups_cat_model;     
        /**
        * news event model
        * 
        * @var NewsEventModel
        */
        private $news_event_model;  
        /**
        * news category model
        * 
        * @var NewsCategoryModel
        */
        private $news_category_model;  
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
            $this->tm_groups_cat_model = Loader::load_model("tm_groups_cat");
            $this->news_category_model = Loader::load_model("news_category");
            $this->premission_model = Loader::load_model("permission");
            $this->news_articles_source_model = Loader::load_model("news_articles_source");  
            $this->news_event_model = Loader::load_model("news_event");
            $list_event = $this->news_event_model->get_active_event('');
            $this->data['list_event'] = $list_event;
            
            $this->tm_users_model =  Loader::load_model("tm_users");
            $_list_user = $this->tm_users_model->get_list("user_deleted=1","",0,"");
         $this->tm_users_model = Loader::load_model("tm_users");
            $user_id = $this->session->get_session("userid");   
            if(!$user_id || !is_integer($user_id)){            
                Application::redirect($this->linkHelper->linkhome("Login"));
            }else{
                $user_info = $this->tm_users_model->get_list("user_id = '{$user_id}' AND user_deleted=1","",0,1); 
                if(!$user_info) 
                    Application::redirect($this->linkHelper->linkhome("Login"));
                
            }
            $this->data["user_id_login"] = $user_id;
            $this->data['list_user_']=  $_list_user;
        }                         

        public function run() {  
            $user_id = $this->session->get_session("userid");                                 
            if(!$user_id)
            {               
                Application::redirect($this->linkHelper->linkhome("Login"));
            }
            if(!$this->premission_model->check_permission($user_id,3))
            {
                die('no permission');
            } 
            
            $list_source = $this->news_articles_source_model->get_list("status=1","`name` asc",0,200);
            $this->data["list_source"] = $list_source;    
            $list_cat_user = $this->tm_groups_cat_model->get_list_cat_user($user_id);                                    
            $list_category = $this->news_category_model->build_child_category_sql();            
            $this->data['cat_selected'] = $list_cat_user;
            $this->data['list_category'] = $list_category;          
            $this->template->assign('data',$this->data);
            $this->template->display("reporter/index_add.tpl");
        }

        public function destroyed() {               
            $this->session->rm_session("msg");
            $this->session->rm_session("error");
            $this->session->rm_session("info");
        }          
    }
?>