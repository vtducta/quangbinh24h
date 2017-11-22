<?php
    class FilterNews extends Module implements IModule {  

        private $news_articles_view_model;
        private $news_articles_join_category_view_model;
        private $tm_groups_cat_model;
        private $permission_model;

        public function __construct($param=null) {         
            $this->init(get_class($this));

            $this->data = array();
            $lang_global = $this->language->getLang('global.ln');                
            $this->template->assign('Lang', $lang_global);                        
            $this->template->assign('link_helper',$this->linkHelper);
            $this->template->assign('template_helper',$this->templateHelper);
            $this->news_articles_view_model = Loader::load_model("news_articles_view");
            $this->tm_groups_cat_model = Loader::load_model("tm_groups_cat");
            $this->news_articles_join_category_view_model = Loader::load_model("news_articles_join_category_view");
            $this->permission_model = Loader::load_model("permission");
            $user_id = $this->session->get_session("userid");
            $group_user = $this->permission_model->get_group_user($user_id);
            $this->data["group_user_id"] = $group_user;
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
            $date =  isset($this->input['date']) ? $this->input['date'] : null;
            $date = strip_tags($date);
            $cat_id = isset($this->input['id']) ? $this->input['id'] : 0;
            $cat_id = intval($cat_id);
            $user_id = isset($this->input['user_id']) ? $this->input['user_id'] : 0;
            $user_id = intval($user_id);
            $current_page = isset($this->input['page']) ? $this->input['page'] : 1;                            
            $current_page =   intval($current_page);
            $flag =  isset($this->input['flag']) ? $this->input['flag'] : null;         
            $flag = strip_tags($flag);
            if($date)
                $date_int = strtotime($date);     
            else{
                $date_int = 0;
            }

            $end_date_int = $date_int + 3600*24;
            $condition = "";
            if($date_int){
                $condition = " AND a.create_date_int >= {$date_int} AND a.create_date_int < {$end_date_int}";
            }
            if($cat_id){
                $condition .= " AND (b.category_id={$cat_id} OR b.parent_id ={$cat_id})";
            }
            if($user_id){
                $condition .= " AND a.creat_by={$user_id}";
            }
            $num        =   10;
            $page_show  =   7;
            $total= $this->news_articles_join_category_view_model->get_total_news_by_category_sql("a.status=3 AND a.public=1 AND a.timer=0 {$condition}","a.create_date_int DESC",$offset,$limit);             
            $total_page = ceil($total/$num);
            $paging     =   Application::paging($current_page,$total_page,$page_show);  
            $offset     =   ($current_page-1)*$num;
            $limit      =   $num;
            $list_news = $this->news_articles_join_category_view_model->admin_get_news_by_category_sql("a.status=3 AND a.public=1 AND a.timer=0 {$condition}","a.create_date_int DESC",$offset,$limit);             

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
            $this->data['paging'] = array(
                'current' => $current_page,
                'page' => $paging,
                'total' => $total_page
            );       
            $this->data['flag'] = $flag;
            $this->data['list_news'] = $list_news;
            $this->template->assign("data",$this->data);
            $this->template->display("search/fillter.tpl");
        }

        public function destroyed() {               
            $this->session->rm_session("msg");
            $this->session->rm_session("error");
            $this->session->rm_session("info");
        }          
    }
?>
