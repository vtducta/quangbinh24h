<?php
    class VideoListHtml5 extends Module implements IModule {

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
        $this->video_model = Loader::load_model("video");
        $this->news_upload_model = Loader::load_model("news_upload");
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


        $current_page = isset($this->input['page']) ? $this->input['page'] : 1;
        $num        =   Application::$config['paging']['DefaultLoad']['NumberLoad'];     
        $page_show  =   Application::$config['paging']['DefaultLoad']['PageShow'];                                         
        $total_page = ceil($total/$num);
        $paging     =   Application::paging($current_page,$total_page,$page_show);  
        $offset     =   ($current_page-1)*$num;
        $limit      =   $num;
        
        $this->data['paging'] = array(
            'page' => $paging,
            'current' => $current_page,
            'total' => $total_page
        );
        
        $list_video = $this->video_model->admin_get_video_by_mysql("","id DESC",$offset,$limit);
        $this->data['list_video'] = $list_video; 
        
            $this->template->assign('data',$this->data);
            $this->template->display("video_html5/index.tpl");            
        }

        public function destroyed() {
            $this->session->rm_session("msg");
            $this->session->rm_session("error");
            $this->session->rm_session("info");
        }          
    }
?>
