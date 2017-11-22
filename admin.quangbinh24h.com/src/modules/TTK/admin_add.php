<?php  
    class AdminAdd extends Module implements IModule {  

        private $tm_groups_cat_model;
        private $news_category_model;  
        private $news_event_model; 
        private $premission_model;
        private $journalist_model;
        public function __construct($param=null) {         
            $this->init(get_class($this));

            $this->data = array();
            $lang_global = $this->language->getLang('global.ln');                
            $this->template->assign('Lang', $lang_global);                        
            $this->template->assign('link_helper',$this->linkHelper);
            $this->template->assign('template_helper',$this->templateHelper);         
            $this->tm_groups_cat_model = Loader::load_model("tm_groups_cat");
            $this->news_category_model = Loader::load_model("news_category");
            $this->news_articles_source_model = Loader::load_model("news_articles_source");
            $this->news_event_model = Loader::load_model("news_event");   
            $this->premission_model = Loader::load_model("permission");
            $this->journalist_model = Loader::load_model("journalist");
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
        //    echo $user_id;
            $user_id = $this->session->get_session("userid");                                 
            if(!$user_id)
            {               
                Application::redirect($this->linkHelper->linkhome("Login"));
            }
            if(!$this->premission_model->check_permission($user_id,1))
            {
                die('no permission');
            }
            
            $list_journalist = $this->journalist_model->get_list_journalist("","id DESC", 0, "");
            $this->data['list_journalist'] = $list_journalist;

            $this->data['news_journalist'] = json_encode($array_journalist);
                  
            $list_cat_user = $this->tm_groups_cat_model->get_list_cat_user($user_id);            
            $list_category = $this->news_category_model->build_child_category_sql();
            $list_event = $this->news_event_model->get_active_event(''); 
            $list_source = $this->news_articles_source_model->get_list("status=1","`name` asc",0,200);
            $this->data["list_source"] = $list_source;
            $this->data['cat_selected']=  $list_cat_user;
            $this->data['list_category'] = $list_category;
            $this->data['list_event'] = $list_event;        
            $this->template->assign('data',$this->data);
            $this->template->display("TTK/index_add.tpl");
        }

        public function destroyed() {               
            $this->session->rm_session("msg");
            $this->session->rm_session("error");
            $this->session->rm_session("info");
        }          
    }
?>