<?php  
    class AdminNewsDeleted extends Module implements IModule {  
        /**
        * tm groups cat model
        * 
        * @var TmGroupsCatModel
        */
        private $tm_groups_cat_model;
        /**
        * news articles join category view  model
        * 
        * @var NewsArticlesJoinCategoryViewModel
        */
        private $news_articles_join_category_view_model;
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
            $this->news_articles_join_category_view_model = Loader::load_model("news_articles_join_category_view");
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
            if(!$this->premission_model->check_permission($user_id,1))
            {
                die('no permission');
            }           
            $list_cat = $this->tm_groups_cat_model->list_cat_user($user_id);          
            $current_page = isset($this->input['page']) ? $this->input['page'] : 1;
            $num        =   Application::$config['paging']['DefaultLoad']['NumberLoad'];     
            $page_show  =   Application::$config['paging']['DefaultLoad']['PageShow'];                                           
            if($list_cat)
            {                
                $total= $this->news_articles_join_category_view_model->get_total_news_by_category("a.status=3 AND a.public=0 AND a.timer =0 AND b.category_id in({$list_cat}) ","",0,"");           
            }else{
                $total= $this->news_articles_view_model->get_total_by_mysql("a.status=3 AND a.public=0 AND a.timer=0","",0,"");                           
            }
            $total_page = ceil($total/$num);
            $paging     =   Application::paging($current_page,$total_page,$page_show);  
            $offset     =   ($current_page-1)*$num;
            $limit      =   $num;
            if($list_cat)
            {                                
                $list_news = $this->news_articles_join_category_view_model->admin_get_news_by_category_sql("a.status=3 AND a.public=0 AND a.timer =0 AND b.category_id in ({$list_cat}) ","a.create_date_int DESC,a.id DESC",$offset,$limit);           
            }else{                
                $list_news = $this->news_articles_view_model->admin_get_news_by_mysql("status=3 AND public=0 AND timer=0","create_date_int DESC,id DESC",$offset,$limit);           
            }

            $this->data['paging'] = array(
            'page' => $paging,
            'current' => $current_page,
            'total' => $total_page
            );   
            
            $_list_news = array();
            $check_existed = array();
            if($list_news){
            foreach($list_news as $news){
                if(!in_array($news["id"],$check_existed)){
                    $check_existed[] = $news["id"];
                    $_list_news[] = $news;
                }
            }

                $list_news = $_list_news;    
            }
            $this->data['list_news'] = $list_news; 
            $this->template->assign('data',$this->data);
            $this->template->display("TTK/index_deleted.tpl");            
        }

        public function destroyed() {               
            $this->session->rm_session("msg");
            $this->session->rm_session("error");
            $this->session->rm_session("info");
        }          
    }
?>
