<?php
    class MyPost extends Module implements IModule {  
        private $news_articles_view_model;  
        private $news_category_model;
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
            $this->news_articles_view_model= Loader::load_model("news_articles_view");                             
            $this->news_articles_category_view_model= Loader::load_model("news_articles_category_view");
            $this->news_category_model = Loader::load_model("news_category");
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
            if(!$this->premission_model->check_permission($user_id,array(1,4)))
            {
                die('no permission');
            }
            if($this->premission_model->check_permission($user_id,4)){
                $this->data['edit_action'] = 'AcpEditNews';
            }else{
                $this->data['edit_action'] = 'AdminEditNews';
            }
            $current_page = isset($this->input['page']) ? $this->input['page'] : 1;
            $current_page = intval($current_page);
            $num        =   Application::$config['paging']['DefaultLoad']['NumberLoad'];     
            $page_show  =   Application::$config['paging']['DefaultLoad']['PageShow'];                                         
            $total= $this->news_articles_view_model->get_total_by_mysql("a.status=3 AND a.public=1 AND a.timer=0 AND creat_by={$user_id}","",0,"");           
            $total_page = ceil($total/$num);
            $paging     =   Application::paging($current_page,$total_page,$page_show);  
            $offset     =   ($current_page-1)*$num;
            $limit      =   $num;                                         

            $list_news = $this->news_articles_view_model->admin_get_news_by_mysql("status=3 AND public=1 AND timer=0 AND creat_by ={$user_id}","create_date_int DESC,id DESC",$offset,$limit);           
            $this->data['paging'] = array(
                'page' => $paging,
                'current' => $current_page,
                'total' => $total_page
            ); 
            $this->data['list_news'] = $list_news;
            $this->template->assign('data',$this->data);
            $this->template->display("home/my_post.tpl");            
        }

        public function destroyed() {
            $this->session->rm_session("msg");
            $this->session->rm_session("error");
            $this->session->rm_session("info");
        }          
    }
?>
