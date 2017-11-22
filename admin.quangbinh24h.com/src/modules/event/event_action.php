<?php
    class EventAction extends Module implements IModule {  
        /**
        * news event model
        * 
        * @var NewsEventModel
        */
        private $news_event_model;
        private $news_category_model;
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
            $this->news_event_model = Loader::load_model("news_event");
            $this->news_category_model = Loader::load_model("news_category");
            $this->news_articles_view_model = Loader::load_model("news_articles_view");
            $this->news_articles_event_model = Loader::load_model("news_articles_event");
            $this->news_event_articles_model = Loader::load_model("news_event_articles");
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
            $title = isset($this->input['title']) ? $this->input['title'] : null;
            $title = strip_tags($title);
            $meta_title = isset($this->input['meta_title']) ? $this->input['meta_title'] : null;
            $meta_title = strip_tags($meta_title);
            $meta_description = isset($this->input['meta_description']) ? $this->input['meta_description'] : null;
            $meta_description = strip_tags($meta_description);
            $meta_description = str_replace(array("\\rn","\\n","\\r"),"",$meta_description);

            $description = isset($this->input['description']) ? $this->input['description'] : null;    
            $description = strip_tags($description);
            $description = str_replace(array("\\rn","\\n","\\r"),"",$description);
            $meta_keyword = isset($this->input['meta_keyword']) ? $this->input['meta_keyword'] : null;
            $meta_keyword = strip_tags($meta_keyword);
            $action = isset($this->input['action']) ? $this->input['action'] : null;
            $status_home  = isset($this->input['status_home']) ? $this->input['status_home'] : 0;
            $status_home = intval($status_home);
            $category_id = isset($this->input['category_id']) ? $this->input['category_id'] : 0;
            $category_id = intval($category_id);
            $id = isset($this->input['id']) ? $this->input['id'] : 0;         
            $id = intval($id);
            $status = isset($this->input['status']) ? $this->input['status'] : 0;

            $feature_home = isset($this->input['feature_home']) ? $this->input['feature_home'] : 0;
            $feature_category = isset($this->input['feature_category']) ? $this->input['feature_category'] : 0;

            $status = intval($status);
            $url = $this->linkHelper->linkhome("home");
            switch($action)
            {
                case "addevent" : 
                    $category_object = $this->news_category_model->get_once("id ={$category_id} and status = 1");
                    if (!$category_object && $category_id != 0){
                        die("Category invalid. Add event not successful !");
                    }
                    if($title)
                    {
                        $bean = $this->news_event_model->create_bean();
                        $bean->set("title",$title);
                        $bean->set("meta_slug",$this->templateHelper->build_slug($title));
                        $bean->set("meta_title",$meta_title);
                        $bean->set("meta_keywork",$meta_keyword);
                        $bean->set("status",1);
                        $bean->set("category_id",$category_id);
                        $bean->set("meta_description",$meta_description); 
                        $bean->set("description",$description); 
                        $bean->set("status",$status); 
                        $bean->set("feature_home",$feature_home); 
                        $bean->set("ordering",time());
                        $this->news_event_model->insert($bean);                   
                        $this->session->set_session("msg","Add event successful !");
                        Application::redirect($this->linkHelper->linkhome("ListEvent"));
                    }else{
                        $this->session->set_session("error","Add event not successful !");
                        Application::redirect($this->linkHelper->linkhome("AddEvent"));
                    }
                    break;
                case "editevent" :
                    $category_object = $this->news_category_model->get_once("id ={$category_id} and status = 1");
                    if (!$category_object && $category_id != 0){
                        die("Category invalid. Add event not successful !");
                    }
                    if($title && $id)
                    {
                        $bean = $this->news_event_model->create_bean();
                        $bean->set("title",$title);
                        $bean->set("meta_slug",$this->templateHelper->build_slug($title));
                        $bean->set("meta_title",$meta_title);
                        $bean->set("meta_keywork",$meta_keyword);
                        $bean->set("meta_description",$meta_description); 
                        $bean->set("description",$description); 
                        $bean->set("status",$status); 
                        if($status_home){
                            $bean->set("ordering",time());
                        }
                        $bean->set("feature_home",$feature_home);
                        $bean->set("category_id",$category_id);                       
                        $this->news_event_model->update($bean,"id={$id}");                   
                        $this->news_event_model->reset_get_event($id);
                        $this->session->set_session("msg","Update event successful !");
                        Application::redirect($this->linkHelper->linkhome("ListEvent"));
                    }else{
                        $this->session->set_session("error","Update event not successful !");
                        Application::redirect($this->linkHelper->linkhome("ListEvent"));
                    }
                    break;
                case "addNews" :
                    $event_id = isset($this->input['event_id']) ? $this->input['event_id'] : 0;
                    $art_id = isset($this->input['art_id']) ? $this->input['art_id'] : 0 ;

                    if($event_id && $art_id){
                        $check = $this->news_event_articles_model->get_once("a.id = {$art_id} AND a.public = 1 AND a.timer = 0 AND e.event_id = {$event_id}");    
                        if(!$check)
                            $this->news_articles_event_model->insert_articles_event($event_id,$art_id);
                    }
                    echo 1;
                    die();
                    break;
            }
        }

        public function destroyed() {               
            $this->session->rm_session("msg");
            $this->session->rm_session("error");
            $this->session->rm_session("info");
        }          
    }
?>
