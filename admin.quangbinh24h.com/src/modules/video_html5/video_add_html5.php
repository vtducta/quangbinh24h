<?php
    class VideoAddHtml5 extends Module implements IModule {

    private $news_articles_view_model;
    private $news_category_model;
    private $premission_model;
    private $news_articles_join_category_view_model;
     
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
      
        

            $this->template->assign('data',$this->data);
            $this->template->display("video_html5/index_add.tpl");            
        }

        public function destroyed() {
            $this->session->rm_session("msg");
            $this->session->rm_session("error");
            $this->session->rm_session("info");
        }          
    }
?>
