<?php
    class Statistic extends Module implements IModule {

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
            $this->news_articles_view_model= Loader::load_model("news_articles_view");                             
            $this->news_articles_category_view_model= Loader::load_model("news_articles_category_view");
            $this->news_category_model = Loader::load_model("news_category");
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
            
            $list_user = $this->tm_users_model->get_list("user_deleted =1","",0,"");
            $this->data['list_user'] = $list_user;
            
            if($_POST['date_from']){
                $date_from = $_POST['date_from'];
                $date_from = explode('/',$date_from);
                $date_from = $date_from[2].'-'.$date_from[0].'-'.$date_from[1].' 00:00:00';
                $date_from = strtotime($date_from);
                
                $date_to = $_POST['date_to'];
                $date_to = explode('/',$date_to);
                $date_to = $date_to[2].'-'.$date_to[0].'-'.$date_to[1].' 23:59:59';
                $date_to = strtotime($date_to);
                
                $user_id = $_POST['select_user'];
                
                $condition = 'AND a.create_date_int>'.$date_from.' AND a.create_date_int<'.$date_to.' AND a.creat_by='.$user_id;
                $list_news = $this->news_articles_join_category_view_model->admin_get_news_by_category_sql("a.status=3 AND a.public=1 AND a.timer=0 {$condition}","a.create_date_int DESC",$offset,$limit);
                
                $total_view = 0;
                foreach($list_news as $one){
                    $total_view += $one['views'];
                }
                
                $total_news = count($list_news);
                
                $this->data['total_view'] = $total_view;
                $this->data['total_news'] = $total_news;
            }
            $this->template->assign("data",$this->data);
            $this->template->display("home/statistic.tpl");
        }

        public function destroyed() {
            $this->session->rm_session("msg");
            $this->session->rm_session("error");
            $this->session->rm_session("info");
        }          
    }
?>
