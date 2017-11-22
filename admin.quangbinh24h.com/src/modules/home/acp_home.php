<?php
    class AcpHome extends Module implements IModule {

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
            setcookie("tbt_editable","1",time()+3600,null,'danang24h.vn');
            
            $user_id = $this->session->get_session("userid");                                 
            if(!$user_id)
            {               
                Application::redirect($this->linkHelper->linkhome("Login"));
            }            
            if(!$this->premission_model->check_permission($user_id,4))
            {
                die('no permission');
            }

            $date =  isset($this->input['date']) ? $this->input['date'] : 0;
            $cat_id = isset($this->input['id']) ? $this->input['id'] : 0;          

            $content_type = isset($this->input['content_type']) ? $this->input['content_type'] : 0;     

            if(!preg_match('/^[0-9]*$/',$content_type))
            {
                Application::redirect($this->linkHelper->linkhome("AcpHome"));           
            }         
            $list_category = $this->news_category_model->get_list_category_mysql("parent_id=0 and status=1","ordering desc",0,"");          
            $arr_cat = array();
            foreach($list_category as $k=>$v)
            {
                $arr_cat[$v->get('id')]= array(                    
                    'id' => $v->get('id'),
                    'title' => $v->get('title'),
                    'status' => $v->get('status'),
                    'home_display' => $v->get('home_display'),
                    'child' => $this->news_category_model->get_list_category_mysql("parent_id={$v->get('id')} and status=1","ordering desc",0,"")
                );
            }                               

            $conditions=  "a.status=3 AND a.public=1 AND a.timer >0";        
            if($content_type)
            {
                $conditions .= " AND a.hot_news={$content_type}";
            }
            if($cat_id && isset($arr_cat[$cat_id]))
            {        
                $_cat .= "({$cat_id},";                        
                foreach($arr_cat[$cat_id]['child'] as $key=>$value)
                {                
                    $_cat .=  "{$value->get('id')},";            
                }                          
                $_cat = substr($_cat,0,-1);
                $_cat .= ")";            
                $conditions .= " AND (b.category_id in {$_cat}) OR b.parent_id in {$_cat}";            
            }elseif($cat_id)
            {
                $conditions .= " AND (b.category_id={$cat_id} OR b.parent_id ={$cat_id})";
            }

            $current_page = isset($this->input['page']) ? $this->input['page'] : 1;
            $num        =   Application::$config['paging']['DefaultLoad']['NumberLoad'];     
            $page_show  =   Application::$config['paging']['DefaultLoad']['PageShow'];                                         
            if($content_type){
                $total= $this->news_articles_view_model->get_total_by_mysql("a.status=3 AND a.public=1 AND hotnews ={$content_type}","",0,"");               
            }else{
                $total= $this->news_articles_view_model->get_total_by_mysql("a.status=3 AND a.public=1 AND a.timer<1","",0,"");           
            }
            $total_page = ceil($total/$num);
            $paging     =   Application::paging($current_page,$total_page,$page_show);  
            $offset     =   ($current_page-1)*$num;
            $limit      =   $num;                   

            if($content_type)
            {
                $list_news = $this->news_articles_view_model->admin_get_news_by_mysql("status=3 AND public=1  AND hotnews ={$content_type} AND timer<1","create_date_int DESC",$offset,$limit);              
            }else{
                $list_news = $this->news_articles_view_model->admin_get_news_by_mysql("status=3 AND public=1 AND timer<1","create_date_int DESC",$offset,$limit);           
            }

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

            if($content_type)        
            {   
                if($content_type ==0)
                {
                    $msg ="Có {$total} bài viết thuộc thể loại khác";
                }
                elseif($content_type==1)
                {
                    $msg ="Có {$total} bài viết sản xuất hiện trường";
                }elseif($content_type==2)
                {
                    $msg ="Có {$total} bài viết sản xuất";
                }elseif($content_type==3)
                {
                    $msg ="Có {$total} bài viết khai thác";
                }
                elseif($content_type==4)
                {
                    $msg ="Có {$total} bài viết tổng hợp";
                }
                elseif($content_type==5)
                {
                    $msg ="Có {$total} bài viết phóng sự điều tra";
                }
                elseif($content_type==6)
                {
                    $msg ="Có {$total} bài dịch";
                }
                $this->session->set_session("msg",$msg);   
            }

            $this->data['paging'] = array(
                'page' => $paging,
                'current' => $current_page,
                'total' => $total_page
            );

            $list_user = $this->tm_users_model->get_list("user_deleted =1","",0,"");
            $this->data['list_user'] = $list_user;

            $this->data['content_type'] = $content_type;
            $this->data['list_news'] = $list_news;
            $this->data['list_category'] = $arr_cat;

            $this->template->assign('data',$this->data);
            $this->template->display("TBT/index.tpl");            
        }

        public function destroyed() {
            $this->session->rm_session("msg");
            $this->session->rm_session("error");
            $this->session->rm_session("info");
        }          
    }
?>
