<?php
    class ActionCategory extends Module implements IModule {  
        /**
        * news category model
        * 
        * @var NewsCategoryModel
        */
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
            $this->news_category_model = Loader::load_model("news_category");
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
            $description = isset($this->input['description']) ? $this->input['description'] : null;
            $meta_title = isset($this->input['meta_title']) ? $this->input['meta_title'] : null;
            $meta_description = isset($this->input['meta_description']) ? $this->input['meta_description'] : null;
            $meta_keyword = isset($this->input['meta_keyword']) ? $this->input['meta_keyword'] : null;   
            $meta_slug = isset($this->input['meta_slug']) ? $this->input['meta_slug'] : ""; 
            $display = isset($this->input['display']) ? $this->input['display'] : 0;                    
           
            $ordering = isset($this->input['ordering']) ? $this->input['ordering'] : 0;  
            if(!is_numeric($ordering))
                $ordering = 1;
            $parent_Cat = isset($this->input['parent_cat']) ? $this->input['parent_cat'] : 0;

            $action = isset($this->input['action']) ? $this->input['action'] : null;     
            
            
            $news_id = isset($this->input['news_id']) ? $this->input['news_id'] : 0;
            $cat_id = isset($this->input['id']) ? $this->input['id'] : 0;
            $question = isset($this->input['question']) ? $this->input['question'] : null;            
            $content_type = isset($this->input['content_type']) ? $this->input['content_type'] : 'note';
            $email = isset($this->input['email']) ? $this->input['email'] : null;          
            $username = isset($this->input['username']) ? $this->input['username'] : null;                      
            $user_role = isset($this->input['user_id']) ? $this->input['user_id'] : 0;                      
            $flag = isset($this->input['flag']) ? $this->input['flag'] : 0;
            $address = isset($this->input['address']) ? $this->input['address'] : null;
            $age = isset($this->input['age']) ? $this->input['age'] : null;
            $status = isset($this->input['status']) ? $this->input['status'] : 0;
            $content = isset($this->input['content']) ? $this->input['content'] : null;
               
            switch($action)
            {
                case "addcategory":
                    if($title)
                    {
                        $bean = $this->news_category_model->create_bean();
                        $bean->set("title",$title);
                        $bean->set("parent_id",$parent_Cat);
                        $bean->set('description',$description);
                        $bean->set("status",1);
                        if(!$meta_slug){
                            $meta_slug = $this->templateHelper->build_slug($title);
                        }else{
                            $meta_slug = $this->templateHelper->build_slug($meta_slug);
                        }
                        $bean->set("meta_slug",$meta_slug);
                        $bean->set("meta_title",$meta_title);
                        $bean->set("meta_description",$meta_description);
                        $bean->set("meta_keywork",$meta_keyword);
                        $bean->set("ordering",$ordering);
                        $bean->set("home_display",$display);  
                        $this->news_category_model->insert($bean);
                        $this->session->set_session("msg","create category successful!") ;
                        Application::redirect($this->linkHelper->linkhome("ListCategory"));
                    }else{
                        $this->session->set_session("msg","create category no successful!") ;
                        Application::redirect($this->linkHelper->linkhome("ListCategory"));
                    }
                case "editcategory":                   
                    $id = isset($this->input['id']) ? $this->input['id'] : 0;
                    $id = intval($id);
                    $object_category = $this->news_category_model->get_once("id = {$id}");
                    if (!$object_category){
                        die("input error");
                    }
                    if($title)
                    {
                        $bean = $this->news_category_model->create_bean();
                        $bean->set("title",$title);
                        $bean->set("parent_id",$parent_Cat);
                        $bean->set('description',$description);
                        $bean->set("status",1);
                        if(!$meta_slug){
                            $meta_slug = $this->templateHelper->build_slug($title);
                        }else{
                            $meta_slug = $this->templateHelper->build_slug($meta_slug);
                        }
                        $bean->set("meta_slug",$meta_slug);
                        $bean->set("ordering",$ordering);
                        $bean->set("meta_title",$meta_title);
                        $bean->set("meta_description",$meta_description);            
                        $bean->set("meta_keywork",$meta_keyword);              
                        $bean->set("home_display",$display);         
                        $this->news_category_model->update($bean,"id = {$id}");
                        $this->news_category_model->reset_get_category_by_slug($object_category->get("meta_slug"));
                        $this->session->set_session("msg","Update category successful!") ;
                        Application::redirect($this->linkHelper->linkhome("ListCategory"));
                    }else{
                        $this->session->set_session("msg","Update category no successful!") ;
                        Application::redirect($this->linkHelper->linkhome("ListCategory"));
                    }

                    break;
                case "userrole":                   
                    if($user_id && $cat_id)
                    {
                        echo json_encode(array("msg"=>"okie","status"=>1));
                    }else{
                        echo json_encode(array("msg"=>"","status"=>1));    
                    }                                        
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
