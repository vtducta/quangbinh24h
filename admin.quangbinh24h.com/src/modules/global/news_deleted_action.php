<?php
    class NewsDeletedAction extends Module implements IModule {  

        private $news_articles_model;
        private $news_articles_view_model;
        private $news_articles_category_view_model;
        private $news_event_model;
        private $news_articles_category_model;

        public function __construct($param=null) {         
            $this->init(get_class($this));

            $this->data = array();
            $lang_global = $this->language->getLang('global.ln');                
            $this->template->assign('Lang', $lang_global);                        
            $this->template->assign('link_helper',$this->linkHelper);
            $this->template->assign('template_helper',$this->templateHelper);
            $this->news_articles_model = Loader::load_model("news_articles");
            $this->news_articles_view_model = Loader::load_model("news_articles_view");
            $this->news_articles_category_view_model = Loader::load_model("news_articles_category_view");
            $this->news_event_model = Loader::load_model("news_event");
            $this->news_articles_category_model = Loader::load_model("news_articles_category");
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
            $id = isset($this->input['id']) ? $this->input['id'] : 0;
            $url = $this->linkHelper->linkhome("home");
            if(!$user_id)
            {
                Application::redirect($this->linkHelper->linkhome("Login"));
            }
            switch($action)
            {
                case "hiddennews" :
                    $bean = $this->news_articles_model->create_bean();
                    $bean->set("public",0);
                    $bean->set("modified_by",$user_id);
                    $this->news_articles_model->update($bean,"id={$id}"); 
                    $bean_articles_view = $this->news_articles_view_model->create_bean();
                    $bean_articles_view->set("public",0);
                    $bean_articles_view->set("modified_by",$user_id) ;
                    $this->news_articles_view_model->update($bean_articles_view,"id={$id}");                
                    $this->news_articles_view_model->reset_get_art_by_id($id);             
                    
                    Application::redirect($url);                                            
                    break;
                case "restorenews" :
                    $bean = $this->news_articles_model->create_bean();
                    $bean->set("public",1);
                    $bean->set("modified_by",$user_id);
                    $this->news_articles_model->update($bean,"id={$id}");

                    $bean_articles_view = $this->news_articles_view_model->create_bean();
                    $bean_articles_view->set("public",1);
                    $bean_articles_view->set("modified_by",$user_id);
                    $this->news_articles_view_model->update($bean_articles_view,"id={$id}");              

                    Application::redirect($url);                                             
                    break;
                case "publicnewstimer" :
                    $now = time();
                    $bean = $this->news_articles_model->create_bean();
                    $bean->set("timer",0);
                    $bean->set("create_date_int",$now);
                    $bean->set("modified_by",$user_id);
                    $bean->set("status",3);
                    $bean->set("public",1);
                    $this->news_articles_model->update($bean,"id={$id}");

                    $bean_articles_view = $this->news_articles_view_model->create_bean();
                    
                    $bean_articles_view->set("timer",0);
                    $bean_articles_view->set("create_date_int",$now);
                    $bean_articles_view->set("modified_by",$user_id);
                    $bean_articles_view->set("status",3);
                    $bean_articles_view->set("public",1);
                    $this->news_articles_view_model->update($bean_articles_view,"id={$id}");  
                    $this->news_articles_view_model->reset_get_art_by_id($id);    

                    $this->news_articles_category_view_model->push_news_category_view($id);
                    Application::redirect($url);                                             
                    break;
                case "publicnews" :
                    $now = time();
                    $bean = $this->news_articles_model->create_bean();
                    $bean->set("public",1);
                    $bean->set("status",3);
                    $bean->set("create_date_int",$now);
                    $bean->set("modified_by",$user_id);                   
                    $this->news_articles_model->update($bean,"id={$id}");                
                    $this->news_articles_view_model->push_news_articles($id);
                    $this->news_articles_category_view_model->push_news_category_view($id);
                    Application::redirect($url);                                             
                    break;
                case "publicnewsdraft":
                    $bean = $this->news_articles_model->create_bean();
                    $bean->set("status",3);
                    $bean->set("draft",0);
                    $bean->set("modified_by",$user_id);
                    $this->news_articles_model->update($bean,"id={$id}");                
                    Application::redirect($url);                                             
                break;
                case "reportersend":
                    $bean = $this->news_articles_model->create_bean();
                    $bean->set("status",2);
                    $bean->set("draft",0);
                    $bean->set("modified_by",$user_id);
                    $this->news_articles_model->update($bean,"id={$id}");                
                    Application::redirect($url);                                             
                break;
                case "deletedEvent":
                    $id = intval($id);                    
                    $event = $this->news_event_model->get_once("id={$id}");
                    if(!$event)
                    {
                        Application::redirect($this->linkHelper->linkhome("ListEvent"));
                    }
                    $bean = $this->news_event_model->create_bean();
                    $bean->set('status',3);
                    $this->news_event_model->update($bean,"id={$id}");
                    Application::redirect($this->linkHelper->linkhome("ListEvent"));
                break;
                
                case "publicdraft" :
                    $bean = $this->news_articles_model->create_bean();
                    $now = time();
                    $bean->set("public",1);
                    $bean->set('create_date_int',$now);
                    $bean->set('modified_by',$user_id);
                    $this->news_articles_model->update($bean,"id={$id}");
                    
                    $bean_articles_view = $this->news_articles_view_model->create_bean();
                    $bean_articles_view->set("public",1);
                    $bean_articles_view->set('create_date_int',$now);
                    $bean_articles_view->set('modified_by',$user_id);
                    $this->news_articles_view_model->update($bean_articles_view,"id={$id}");   
                    $this->news_articles_category_view_model->push_news_category_view($id);                 
                    Application::redirect($url);
                break;
                case "deletednews" :                                    
                    $content_articles = $this->news_articles_model->get_once("id ={$id}  AND public=3");       
                    $content_articles_view = $this->news_articles_view_model->get_once("id={$id}");                    
                    if($content_articles && !$content_articles_view)
                    {                        
                        $this->news_articles_model->delete("id={$id}");
                        $this->news_articles_category_model->delete("articles_id={$id}");
                        $this->session->set_session("msg","Xóa bài thành công !");
                    }else{
                        $this->session->set_session("msg","Không đủ điều kiện xóa bài viết !");
                    }
                    Application::redirect($url);
                break;
                case "editnews" :
                    $bean = $this->news_articles_model->create_bean();
                    $bean->set('flag_edit',1);
                    $this->news_articles_model->update($bean,"id={$id}");
                    echo json_encode(array('msg'=>'thành công','status'=>1));
                break;
            }
        }

        public function destroyed() {               
        }          
    }
?>
