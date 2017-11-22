<?php
    class VideoActionHtml5 extends Module implements IModule {  
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
            $this->tm_users_model = Loader::load_model("tm_users");
            $this->premission_model = Loader::load_model("permission");
            $this->video_model = Loader::load_model("video");
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
       
            $title = isset($this->input['title']) ? $this->input['title'] : null;
            $action = isset($this->input['action']) ? $this->input['action'] : null;     
            
            $id = isset($this->input['id']) ? $this->input['id'] : 0;
            $thumb_id = isset($this->input['id_thumb']) ? $this->input['id_thumb'] : 0; 
            $link = isset($this->input['link']) ? $this->input['link'] : '';   
               
            switch($action)
            {
                case "addvideo":
                    if($title)
                    {
                        $this->video_model->insertVideo($title,$thumb_id,$link);
                        $this->session->set_session("msg","create video successful!") ;
                        Application::redirect($this->linkHelper->linkhome("VideoListHtml5"));
                    }else{
                        $this->session->set_session("msg","create video no successful!") ;
                        Application::redirect($this->linkHelper->linkhome("VideoListHtml5"));
                    }
                    break;
                case "editvideo":    
                    if($id !=0){
                        $object_video = $this->video_model->get_once("id = {$id}");
                        if(empty($object_video)){
                            die("input error");
                        }
                        $this->video_model->editVideo($id,$title,$thumb_id,$link);    
                        $this->session->set_session("msg","Update video successful!") ;
                        Application::redirect($this->linkHelper->linkhome("VideoListHtml5"));
                    }else{
                        $this->session->set_session("msg","Update video no successful!") ;
                        Application::redirect($this->linkHelper->linkhome("VideoListHtml5"));
                    }
                    break;
                case "deleteVideo";
                    $id = isset($this->input['id']) ? $this->input['id'] : 0;
                    $this->video_model->delete("id={$id}");
                    
                    $this->session->set_session("msg","Xóa video thành công!") ;                        
                    Application::redirect($this->linkHelper->linkhome("VideoListHtml5"));                    
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
