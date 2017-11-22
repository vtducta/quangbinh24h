<?php
    class AcpNewsDraft extends Module implements IModule {  

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
            $this->news_articles_view_model = Loader::load_model("news_articles_view");
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
                Application::redirect($this->linkHelper->linkhome("login"));
            }
            if(!$this->premission_model->check_permission($user_id,4))
            {
                die('no permission');
            }

            $current_page = isset($this->input['page']) ? $this->input['pager'] : 1;
            $current_page = intval($current_page);
            $page_show = 7;
            $num = 10;
            $total = $this->news_articles_view_model->get_total_by_mysql("creat_by ={$user_id} AND status=3 AND public=2","id DESC",0,"");
            $total_page = ceil($total/$num);
            $paging = Application::paging($current_page,$total_page,$page_show);
            $offset = ($current_page-1)*$num;
            $limit = $num;

            $list_news = $this->news_articles_view_model->admin_get_news_by_mysql("creat_by ={$user_id} AND status=3 AND public=2","id DESC",$offset,$limit);

            if(isset($_GET['khanh'])) {
                print_r($list_news);
                die();
            }

            $list_category = $this->news_category_model->get_list_category("parent_id=0","",0,"");          
            $arr_cat = array();
            foreach($list_category as $k=>$v)
            {
                $arr_cat[$k]= array(                    
                    'id' => $v->get('id'),
                    'title' => $v->get('title'),
                    'status' => $v->get('status'),
                    'child' => $this->news_category_model->get_list_category("parent_id={$v->get('id')}","",0,"")
                );
            }                    

            $this->data['list_news'] = $list_news;
            $this->data['list_category'] = $arr_cat;
            $this->data['paging'] = array(
                'total' => $total_page,
                'current' => $current_page,
                'paging' => $paging
            );
            $this->template->assign("data",$this->data);
            $this->template->display("TBT/index_news_draft.tpl");          
        }

        public function destroyed() {               
            $this->session->rm_session("msg");
            $this->session->rm_session("error");
            $this->session->rm_session("info");
        }          
    }
?>
