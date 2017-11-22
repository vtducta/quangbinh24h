<?php
    class AdminEditNews extends Module implements IModule {  

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
        private $news_articles_history_model;
        private $journalist_model;
        private $news_journalist_model;

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
            $this->news_upload_model = Loader::load_model("news_upload");
            $this->tm_groups_cat_model = Loader::load_model("tm_groups_cat");
            $this->premission_model = Loader::load_model("permission");
            $this->news_articles_source_model = Loader::load_model("news_articles_source");
            $this->news_articles_history_model = Loader::load_model("news_articles_history");
            $this->journalist_model = Loader::load_model("journalist");
            $this->news_journalist_model = Loader::load_model("news_journalist");

            $this->tm_users_model =  Loader::load_model("tm_users");
            $_list_user = $this->tm_users_model->get_list("user_deleted=1","",0,"");
            $this->data['list_user_']=  $_list_user;

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

            $action = isset($this->input['action']) ? $this->input['action'] : null;          
            $news_id = isset($this->input['id']) ? $this->input['id'] : 0;                   
            $news_id = intval($news_id);
            if(!$user_id)
            {
                Application::redirect($this->linkHelper->linkhome("login"));
            }
            if(!$this->premission_model->check_permission($user_id,1))
            {
                die('no permission');
            } 

            if( $action && $action != 'newswait')
            {
                die('not action');
            }

            if($action =='newswait')
            {
                $content = $this->news_articles_model->get_once("id={$news_id}");    
            }else{
                $content = $this->news_articles_view_model->get_once("id={$news_id}");
            }
            if(!$content)
            {
                Application::redirect($this->linkHelper->linkhome("Home"));
            }                       
            $list_category = $this->news_category_model->build_child_category_sql();
            $list_event = $this->news_event_model->get_active_event('');                    

            $list_news_relationship = $this->news_articles_relationship_model->get_relationship_art_by_new($content->get('id'),"");

            $list_cat_user = $this->tm_groups_cat_model->get_list_cat_user($user_id);
            $this->data['list_cat_user'] = $list_cat_user;
            $list_cat_selected = $this->news_articles_category_model->get_cat_seleted($content->get('id'));                    
            $this->data['cat_selected'] = $list_cat_selected;
            $event_selected = $this->news_articles_event_model->get_event_seleted($content->get('id'));

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

            $link_thumb = "";
            $link_thumb = $this->news_upload_model->get_list("id={$content->get('images')}","",0,1);          
            if($link_thumb)
            {
                $link_thumb = $link_thumb[0];
            }
            $array = array();
            foreach($list_news_relationship as $k=>$v)
            {
                $array[$k] = array(
                    'id' => $v->get('id'),
                    'name' => $v->get('title')
                );
            }
            $list_event_art = $this->news_articles_history_model->get_list("article_id={$content->get('id')}","id asc",0,100);
            $msg_array = array();
            $his_tmp = 0;
            $i=0;
            foreach($list_event_art as $event_art){   
                $art_user = $this->tm_users_model->get_once("user_id={$event_art->get('modified_by')}");   
                $_msg = date("d-m-Y H:i:s",$event_art->get("modified_date_int"))."  :  ".$art_user->get("fullname")." - ".$art_user->get("username");
                if($i==0){
                    $_msg .= " Thêm bài viết";
                }else{
                    if($his_tmp==0 && $event_art->get("public")==1)
                        $_msg .= " Xuất bản bài viết";
                    else
                        $_msg .= " Sửa bài viết";
                }
                $i++;
                $msg_array[] =  $_msg; 
                $his_tmp = $event_art->get("public");   
            }
            $this->data["msg_array"] = $msg_array;

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
            
            $news_journalist = $this->news_journalist_model->get_news_journalist_sql($news_id, 1000);
            $array_journalist = array();
            foreach ($news_journalist as $k=>$v) 
            {
                $array_journalist[$k] = array(
                    'id' => $v['id'],
                    'name' => $v['full_name'] . "(" . $v['pen_name'] . ")"
                );
            }

            $list_journalist = $this->journalist_model->get_list_journalist("","total_article DESC", 0, "");
            $this->data['list_journalist'] = $list_journalist;

            $this->data['news_journalist'] = json_encode($array_journalist);
            
            $list_source = $this->news_articles_source_model->get_list("status=1","`name` asc",0,200);
            $this->data["list_source"] = $list_source;
            $this->data['action'] = $action;
            $this->data['content'] = $content;               
            $this->data['token_input'] = json_encode($array);
            $this->data['list_category'] = $list_category;
            $this->data['link_thumb'] = $link_thumb;
            $this->data['tags'] = $list_tag;
            $this->data['list_event'] = $list_event;        
            $this->template->assign('data',$this->data);
            $this->template->display("TTK/index_edit.tpl");
        }

        public function destroyed() { 
            $this->session->rm_session("msg");
            $this->session->rm_session("error");
            $this->session->rm_session("info");              
        }          
    }
?>