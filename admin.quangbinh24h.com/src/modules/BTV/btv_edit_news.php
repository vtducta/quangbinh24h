<?php
    class BtvEditNews extends Module implements IModule {  

        private $news_articles_view_model;
        private $news_category_model;      
        private $news_articles_relationship_model;
        private $news_event_model;
        private $news_tag_join_articles_tag_model;
        private $news_articles_category_model;
        private $news_articles_event_model;
        private $news_upload_model;
        private $news_articles_model;
        private $tm_groups_cat_model;         
        private $premission_model;
        public function __construct($param=null) {         
            $this->init(get_class($this));

            $this->data = array();
            $lang_global = $this->language->getLang('global.ln');                
            $this->template->assign('Lang', $lang_global);                        
            $this->template->assign('link_helper',$this->linkHelper);
            $this->template->assign('template_helper',$this->templateHelper);
            $this->news_articles_model = Loader::load_model("news_articles");
            $this->news_articles_view_model = Loader::load_model("news_articles_view");
            $this->news_category_model = Loader::load_model("news_category");
            $this->news_event_model = Loader::load_model("news_event");
            $this->news_articles_event_model = Loader::load_model("news_articles_event");
            $this->news_articles_relationship_model = Loader::load_model("news_articles_relationship");
            $this->news_tag_join_articles_tag_model = Loader::load_model("news_tag_join_articles_tag");
            $this->news_articles_category_model = Loader::load_model("news_articles_category");
            $this->news_articles_source_model = Loader::load_model("news_articles_source");
            $this->news_upload_model = Loader::load_model("news_upload");
            $this->tm_groups_cat_model = Loader::load_model("tm_groups_cat");
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

            $userid = $this->session->get_session("userid");                    
            $action = isset($this->input['action']) ? $this->input['action'] : null;          
            $news_id = isset($this->input['id']) ? $this->input['id'] : 0;                   
            $news_id = intval($news_id);
            if(!$userid)
            {
                Application::redirect($this->linkHelper->linkhome("login"));
            }          
            if(!$this->premission_model->check_permission($userid,array(2,5)))
            {
                die('no permission');
            } 
            if($action =="newswait")
            {
                $content = $this->news_articles_model->get_once("id={$news_id} AND status=2 AND public =3");
            }else{
                $content = $this->news_articles_model->get_once("id={$news_id} AND creat_by={$userid}");        
            }
            if(!$content)
            {
                die("not news id");
            }
            $list_category = $this->news_category_model->build_child_category_sql();            

            $list_event = $this->news_event_model->get_active_event('');                              

            $event_selected = $this->news_articles_event_model->get_event_seleted($content->get('id'));            

            $list_news_relationship = $this->news_articles_relationship_model->get_relationship_art_by_new($content->get('id'),"");

            $lis_cat_user = $this->tm_groups_cat_model->get_list_cat_user($userid);

            $list_cat_selected = $this->news_articles_category_model->get_cat_seleted($content->get('id'));                             

            $this->data['list_cat_user'] = $lis_cat_user;

            $this->data['cat_selected'] = $list_cat_selected;
            $this->data['event_selected'] = $event_selected;   

            $list_event_selected = array();
            foreach($event_selected as $_event_id){
                $v = $this->news_event_model->get_once("id={$_event_id}"); 
                $list_event_selected[] = array(
                    'id' => $v->get('id'),
                    'name' => $v->get('title')
                );
            }
            $this->data['list_event_selected'] = json_encode($list_event_selected);

            $link_thumb = $this->news_upload_model->get_list("id={$content->get('images')}","",0,1);                              
            $array = array();
            foreach($list_news_relationship as $k=>$v)
            {
                $array[$k] = array(
                    'id' => $v->get('id'),
                    'name' => $v->get('title')
                );
            }

            //$list_tag = $this->news_tag_join_articles_tag_model->get_list_tag($content->get('id'),"");
            $tag = $this->news_tag_join_articles_tag_model->get_list("b.articles_id ={$content->get('id')}","",0,'');
            $list_tag = array();
            foreach ($tag as $key=>$value) {
                $list_tag[$key] = array(
                    'id' => $value->tag_name,
                    'name' => $value->tag_name
                );
            }
            $list_tag = json_encode($list_tag);
            
            $list_source = $this->news_articles_source_model->get_list("status=1","`name` asc",0,200);
            $this->data["list_source"] = $list_source;      
            $this->data['action'] = $action;
            $this->data['content'] = $content;               
            $this->data['token_input'] = json_encode($array);
            $this->data['list_category'] = $list_category;
            $this->data['link_thumb'] = $link_thumb[0];
            $this->data['list_event'] = $list_event;
            $this->data['tags'] = $list_tag;
            $this->template->assign('data',$this->data);
            $this->template->display("BTV/index_edit.tpl");
        }

        public function destroyed() { 
            $this->session->rm_session("msg");
            $this->session->rm_session("error");
            $this->session->rm_session("info");              
        }          
    }
?>