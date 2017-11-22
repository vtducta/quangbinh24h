<?php
    class NewsAction extends Module implements IModule {  

        private $news_articles_model;
        private $news_articles_view_model;
        private $news_tag_model;
        private  $new_articles_tag_model;
        private $news_articles_event_model;
        private $news_articles_category_model;
        private $news_articles_category_view_model;
        private $articles_relationship_model;
        private $news_articles_history_model;
        private $news_articles_relationship_model;
        private $news_journalist_model;
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
            $this->news_articles_model = Loader::load_model("news_articles");
            $this->news_articles_view_model = Loader::load_model("news_articles_view");
            $this->news_tag_model = Loader::load_model("news_tag");
            $this->new_articles_tag_model = Loader::load_model("news_articles_tag");
            $this->news_articles_category_model = Loader::load_model("news_articles_category");
            $this->news_articles_category_view_model = Loader::load_model("news_articles_category_view");
            $this->news_articles_event_model = Loader::load_model("news_articles_event");
            $this->articles_relationship_model = Loader::load_model("articles_relationship");
            $this->news_articles_history_model = Loader::load_model("news_articles_history");
            $this->news_articles_relationship_model = Loader::load_model("news_articles_relationship");
            $this->news_journalist_model = Loader::load_model("news_journalist");
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
            $public = isset($this->input['public']) ? $this->input['public'] : 3;
            $status = isset($this->input['status']) ? $this->input['status'] : 0;
            $meta_title = isset($this->input['meta_title']) ? $this->input['meta_title'] : null;
            $meta_title = trim($meta_title);
            $slug_name = isset($this->input['slug_name']) ? $this->input['slug_name'] : "";          
            $meta_keyword = isset($this->input['meta_keyword']) ? $this->input['meta_keyword'] : null;
            $meta_description = isset($this->input['meta_description']) ? $this->input['meta_description'] : null;
            $short_desc = isset($this->input['short_desc']) ? $this->input['short_desc'] : null;
            $short_desc = nl2br($short_desc);
            $short_desc = str_replace(array("\\rn","\\n","\\r"),"",$short_desc);
            $short_desc = trim($short_desc);
            $meta_description = str_replace(array("\\rn","\\n","\\r"),"",$meta_description);
            $meta_description = trim($meta_description);
            $content = isset($this->input['content']) ? $this->input['content'] : null;            
            $timer = isset($this->input['timer']) ? $this->input['timer'] : 0;
            $thumb_id = isset($this->input['id_thumb']) ? $this->input['id_thumb'] : 0;          
            $reason = isset($this->input['reason']) ? $this->input['reason'] : null;
            $draft = isset($this->input['draft']) ? $this->input['draft'] : 0;                    
            $news_relations = isset($this->input['news_relations']) ? $this->input['news_relations'] : null;          
            $news_cat = isset($this->input['news_cat']) ? $this->input['news_cat'] : null;
            $news_event = isset($this->input['news_event']) ? $this->input['news_event'] : null;
            $note = isset($this->input['news_note']) ? $this->input['news_note'] : "";
            $news_events = isset($this->input['news_events']) ? $this->input['news_events'] : "";
            
            $check_seo_title        = isset($this->input['check_seo_title']) ? $this->input['check_seo_title'] : 0;
            $check_seo_description  = isset($this->input['check_seo_description']) ? $this->input['check_seo_description'] : 0;
            $check_seo_keyword      = isset($this->input['check_seo_keyword']) ? $this->input['check_seo_keyword'] : 0;
            $check_seo_tag          = isset($this->input['check_seo_tag']) ? $this->input['check_seo_tag'] : 0;
            $check_seo_image        = isset($this->input['check_seo_image']) ? $this->input['check_seo_image'] : 0;
            $check_seo_h            = isset($this->input['check_seo_h']) ? $this->input['check_seo_h'] : 0;
            $check_seo_social       = isset($this->input['check_seo_social']) ? $this->input['check_seo_social'] : 0;
            
            $allow_question = isset($this->input['allow_question']) ? $this->input['allow_question'] : 0;
            $end_live = isset($this->input['end_live']) ? $this->input['end_live'] : 0;    
            $topic = isset($this->input['chk_topic']) ? $this->input['chk_topic'] : 0;    
            
            if($news_events){
                $news_events = explode(",",$news_events);
            }
            if($news_events)
                $news_event = $news_events; 
                
            $news_tag = isset($this->input['news_tag']) ? $this->input['news_tag'] : "";
            $news_tag = trim($news_tag);
            $news_tag  = strip_tags($news_tag);
            $news_tag  = preg_replace('/(\s+)/i', " ", $news_tag);
                    
            $content_type = isset($this->input['content_type']) ? $this->input['content_type'] : 0;     
            $source_id = isset($this->input['source_id']) ? $this->input['source_id'] : 0;         
            
            $id_video = isset($this->input['id_video']) ? $this->input['id_video'] : null;
            $title_video = isset($this->input['title_video']) ? $this->input['title_video'] : null;
            
            $cmtnd = isset($this->input['cmtnd']) ? $this->input['cmtnd'] : "";
            $cmtnd = trim($cmtnd);

            $news_journalist = isset($this->input['news_journalist']) ? $this->input['news_journalist'] : null;

            $type = isset($this->input['type']) ? $this->input['type'] : "article";

            $action = isset($this->input['action']) ? $this->input['action'] : null;                
            $id = isset($this->input['id']) ? $this->input['id'] : 0;
            $url = $this->linkHelper->linkhome("home");

            $writter = isset($this->input['writter']) ? $this->input['writter'] : 0;
            $user_id = $this->session->get_session("userid");          
            if(!$user_id)
            {
                Application::redirect($this->linkHelper->linkhome("Login"));
            }        
            
            if($writter==0){
                $writter = $user_id;
            }  
            
            if($timer)           
            {
                $now = time();
                $timer= strtotime($timer);
                $d_time_now = mktime(0,0,0,date('n',$now),date('j',$now),date('Y',$now));
                $d_timer = mktime(0,0,0,date('n',$timer),date('j',$timer),date('Y',$timer));            
                if($d_timer >= $d_time_now)
                {
                    $timer =$timer;
                }
            }else{
                $timer =0;
            }               
            
            if(!$slug_name)                                      
            {
                $slug_name = $this->templateHelper->build_slug($meta_title);
            }else{
                $slug_name = $this->templateHelper->build_slug($slug_name);
            }
            
            if(!$slug_name)
                $slug_name = $this->templateHelper->build_slug($title);
            
            switch($action)
            {
                case "addnews" :
                    if($title && $news_cat)
                    {
                        $news_id = $this->news_articles_model->insert_articles($title,$short_desc,$content,$writter,$thumb_id,$status,$slug_name,$meta_title,$meta_keyword,$meta_description,$public,$timer,$content_type,$type,$id_video,$title_video,$cmtnd,$source_id,$note,$end_live,$allow_question,$topic);                  
                        foreach($news_cat as $key=>$val)
                        {               
                            if($val)
                            {
                                $this->news_articles_category_model->insert_articles_category($val,$news_id);
                            }
                        }
                        if($news_event[0])
                        {
                            foreach($news_event as $key=>$val)
                            {
                                if($val)
                                {
                                    $this->news_articles_event_model->insert_articles_event($val,$news_id);
                                }
                            }    
                        }

                        $news_relations  = explode(',',$news_relations);
                        foreach($news_relations as  $key=>$val)
                        {
                            if($val)
                            {
                                $this->articles_relationship_model->insert_news_relationship($news_id,$val);
                            }
                        }

                        $news_tag = explode(',',$news_tag);            
                        foreach($news_tag as $key=>$val)
                        {
                            if($val)
                            {
                                $tag_id = $this->news_tag_model->check_tag_exits($val);
                                if(!$tag_id)
                                {
                                    $tag_id = $this->news_tag_model->insert_tag($val);
                                }
                                $this->new_articles_tag_model->insert_articles_tag($tag_id,$news_id);
                            }

                        }

                        # add tac gia                             
                        $news_journalist = explode(',',$news_journalist);         
                        $news_journalist = array_unique($news_journalist);
                        foreach ($news_journalist as $key=>$val) {
                            if ($val)
                            {
                                $this->news_journalist_model->insert_news_journalist($news_id,$val);
                            }
                        }
                        # end add tac gia

                        $this->news_articles_view_model->push_news_articles($news_id);
                        $this->news_articles_category_view_model->push_news_category_view($news_id);                                   
                        
                        $this->news_articles_history_model->insert_history($news_id,$title,$short_desc,$content,$thumb_id,$user_id,$slug_name,$meta_title,$meta_keyword,$meta_description,$status,$public,$timer);                  

                        $this->session->set_session("msg","Thêm bài mới thành công!");
                        Application::redirect($url);

                    }else{
                        $this->session->set_session("error","Thêm bài mới không thành công!");
                        Application::redirect($url);
                    }
                    break;
                case "editnews":          
                    if($title && $news_cat && $id)
                    {
                        if($public==-2) $public = 2;

                        $this->news_articles_model->update_articles($id,$title,$short_desc,$content,$user_id,$thumb_id,$status,$slug_name,$meta_title,$meta_keyword,$meta_description,$public,$content_type,$timer,$type,$id_video,$title_video,$reason,0,$cmtnd,$writter,$source_id,$note,$end_live,$allow_question,$topic);
                        $this->news_articles_view_model->update_articles_view($id,$title,$short_desc,$content,$user_id,$thumb_id,$status,$slug_name,$meta_title,$meta_keyword,$meta_description,$public,$content_type,$timer,$type,$id_video,$title_video,$cmtnd,$writter,$source_id,$note,$end_live,$allow_question,$topic);                     

                        $this->news_articles_category_model->delete("articles_id={$id}");
                        $this->news_articles_category_view_model->delete("articles_id ={$id}");                  
                        foreach($news_cat as $key=>$val)
                        {               
                            if($val)                                                         
                            {
                                $this->news_articles_category_model->insert_articles_category($val,$id);
                            }
                        }

                        $this->news_articles_event_model->delete("articles_id ={$id}");
                        if($news_event[0])
                        {
                            foreach($news_event as $key=>$val)
                            {
                                if($val)
                                {
                                    $this->news_articles_event_model->insert_articles_event($val,$id);
                                }
                            }     
                        }

                        $this->articles_relationship_model->delete("articles_id ={$id}");
                        $news_relations  = explode(',',$news_relations);
                        foreach($news_relations as  $key=>$val)
                        {
                            if($val)
                            {
                                $this->articles_relationship_model->insert_news_relationship($id,$val);
                            }
                        }

                        $this->new_articles_tag_model->delete("articles_id ={$id}");
                        $news_tag = explode(',',$news_tag);            
                        foreach($news_tag as $key=>$val)
                        {
                            if($val)
                            {
                                $tag_id = $this->news_tag_model->check_tag_exits($val);
                                if(!$tag_id)
                                {
                                    $tag_id = $this->news_tag_model->insert_tag($val);
                                }
                                $this->new_articles_tag_model->insert_articles_tag($tag_id,$id);
                            }

                        }       
                        # add tac gia
                        $this->news_journalist_model->delete("news_id=$id");                               
                        $news_journalist = explode(',',$news_journalist);         
                        $news_journalist = array_unique($news_journalist);
                        foreach ($news_journalist as $key=>$val) {
                            if ($val)
                            {
                                $this->news_journalist_model->insert_news_journalist($id,$val);
                            }
                        }
                        # end add tac gia
                        $this->news_articles_category_view_model->push_news_category_view($id);                 

                        $this->news_articles_view_model->reset_get_art_by_id($id);
                        $this->news_articles_relationship_model->reset_get_news_relationship_by_id($id,'');

                        $this->news_articles_history_model->insert_history($id,$title,$short_desc,$content,$thumb_id,$user_id,$slug_name,$meta_title,$meta_keyword,$meta_description,$status,$public,$timer);                  

                        $this->session->set_session("msg","Cập nhật bài thành công!");
                        Application::redirect($url);                  
                    }else{
                        $this->session->set_session("error","Cập nhật bài không thành công!");
                        Application::redirect($url);
                    }
                    break;
                case "editnewswait":
                    if($title && $news_cat && $id)
                    {   
                        /*if(!$slug_name)
                        {
                            $slug_name = $this->templateHelper->build_slug($title);
                        }
                        else{
                            $slug_name = $this->templateHelper->build_slug($slug_name);
                        }        */          
                        $flag = 0;
                        if($public ==1)                                     
                        {
                            $flag=1;
                        }
                        $this->news_articles_model->update_articles($id,$title,$short_desc,$content,$user_id,$thumb_id,$status,$slug_name,$meta_title,$meta_keyword,$meta_description,$public,$content_type,$timer,$type,$id_video,$title_video,$reason,$flag,$cmtnd,$writter,$source_id,$note,$topic);                             
                        $this->news_articles_category_model->delete("articles_id={$id}");                  
                        foreach($news_cat as $key=>$val)
                        {               
                            if($val)                                                         
                            {
                                $this->news_articles_category_model->insert_articles_category($val,$id);
                            }
                        }
                        $this->news_articles_event_model->delete("articles_id ={$id}");
                        if($news_event[0])
                        {
                            foreach($news_event as $key=>$val)
                            {
                                if($val)
                                {
                                    $this->news_articles_event_model->insert_articles_event($val,$id);
                                }
                            }    
                        }

                        $this->articles_relationship_model->delete("articles_id ={$id}");
                        $news_relations  = explode(',',$news_relations);
                        foreach($news_relations as  $key=>$val)
                        {
                            if($val)
                            {
                                $this->articles_relationship_model->insert_news_relationship($id,$val);
                            }
                        }
                        # add tac gia
                        $this->news_journalist_model->delete("news_id=$id");                               
                        $news_journalist = explode(',',$news_journalist);         
                        $news_journalist = array_unique($news_journalist);
                        foreach ($news_journalist as $key=>$val) {
                            if ($val)
                            {
                                $this->news_journalist_model->insert_news_journalist($id,$val);
                            }
                        }

                        $this->new_articles_tag_model->delete("articles_id ={$id}");
                        $news_tag = explode(',',$news_tag);            
                        foreach($news_tag as $key=>$val)
                        {
                            if($val)
                            {
                                $tag_id = $this->news_tag_model->check_tag_exits($val);
                                if(!$tag_id)
                                {
                                    $tag_id = $this->news_tag_model->insert_tag($val);
                                }
                                $this->new_articles_tag_model->insert_articles_tag($tag_id,$id);
                            }

                        }
                        if($public==1)       
                        {
                            $this->news_articles_view_model->push_news_articles($id);
                        }        
                        
                        $this->news_articles_category_view_model->push_news_category_view($id);      
                       
                                 
                        $this->news_articles_history_model->insert_history($id,$title,$short_desc,$content,$thumb_id,$user_id,$slug_name,$meta_title,$meta_keyword,$meta_description,$status,$public,$timer);                  
                        if($public==1)
                        {
                            $this->session->set_session("msg","Xuất bản bài thành công!");    
                        }else{
                            if($public==-2)
                                $this->session->set_session("msg","Sửa bài thành công!");   
                            else
                             $this->session->set_session("msg","Trả bài thành công!");    
                        }                        
                        Application::redirect($url);                  
                    }else{
                        $this->session->set_session("error","Cập nhật không thành công!");
                        Application::redirect($url);
                    }
                    break;
                case "btvaddnews":              
                    if($title && $news_cat)
                    {
                        $news_id = $this->news_articles_model->insert_articles1($title,$short_desc,$content,$writter,$thumb_id,$status,$slug_name,$meta_title,$meta_keyword,$meta_description,$content_type,$type,$draft,$id_video,$title_video,$cmtnd,$source_id,$note,$topic);              
                        foreach($news_cat as $key=>$val)
                        {               
                            if($val)
                            {
                                $this->news_articles_category_model->insert_articles_category($val,$news_id);
                            }
                        }                 
                        $news_relations  = explode(',',$news_relations);
                        foreach($news_relations as  $key=>$val)
                        {
                            if($val)
                            {
                                $this->articles_relationship_model->insert_news_relationship($news_id,$val);
                            }
                        }
                        if($news_event[0])
                        {
                            foreach($news_event as $key=>$val)
                            {
                                if($val)
                                {
                                    $this->news_articles_event_model->insert_articles_event($val,$news_id);
                                }
                            }    
                        }

                        $news_tag = explode(',',$news_tag);            
                        foreach($news_tag as $key=>$val)
                        {
                            if($val)
                            {
                                $tag_id = $this->news_tag_model->check_tag_exits($val);
                                if(!$tag_id)
                                {
                                    $tag_id = $this->news_tag_model->insert_tag($val);
                                }
                                $this->new_articles_tag_model->insert_articles_tag($tag_id,$news_id);
                            }
                        }       
                        $this->news_articles_history_model->insert_history($news_id,$title,$short_desc,$content,$thumb_id,$user_id,$slug_name,$meta_title,$meta_keyword,$meta_description,$status,0,0);                  
                        $this->session->set_session("msg","Viết bài mới thành công!");                  
                        Application::redirect($url);

                    }else{
                        $this->session->set_session("error","Viết bài mới không thành công!");
                        Application::redirect($url);
                    }
                    break;
                case "btveditnews":               
                    if($title && $news_cat && $id)
                    {  
                        $this->news_articles_model->update_articles1($title,$short_desc,$content,$user_id,$thumb_id,$status,$slug_name,$meta_title,$meta_keyword,$meta_description,$content_type,$type,$id,$reason,$draft,$id_video,$title_video,$source_id,$note,$topic);                  
                        $this->news_articles_category_model->delete("articles_id ={$id}");
                        foreach($news_cat as $key=>$val)
                        {               
                            if($val)
                            {
                                $this->news_articles_category_model->insert_articles_category($val,$id);
                            }
                        }                 
                        if($status!=-2)
                        {
                            $this->news_articles_event_model->delete("articles_id ={$id}");
                            if($news_event[0])
                            {
                                foreach($news_event as $key=>$val)
                                {
                                    if($val)
                                    {
                                        $this->news_articles_event_model->insert_articles_event($val,$id);
                                    }
                                }    
                            }    
                        }

                        $news_relations  = explode(',',$news_relations);
                        $this->articles_relationship_model->delete("articles_id={$id}");
                        foreach($news_relations as  $key=>$val)
                        {
                            if($val)
                            {
                                $this->articles_relationship_model->insert_news_relationship($id,$val);
                            }
                        }                  
                        $news_tag = explode(',',$news_tag);            
                        $this->new_articles_tag_model->delete("articles_id={$id}");
                        foreach($news_tag as $key=>$val)
                        {
                            if($val)
                            {
                                $tag_id = $this->news_tag_model->check_tag_exits($val);
                                if(!$tag_id)
                                {
                                    $tag_id = $this->news_tag_model->insert_tag($val);
                                }
                                $this->new_articles_tag_model->insert_articles_tag($tag_id,$id);
                            }
                        }       
                        $this->news_articles_history_model->insert_history($id,$title,$short_desc,$content,$thumb_id,$user_id,$slug_name,$meta_title,$meta_keyword,$meta_description,$status,0,0);                  
                        $this->session->set_session("msg","Cập nhật bài thành công!");                  
                        Application::redirect($url);

                    }else{
                        $this->session->set_session("error","Cập nhật bài không thành công!");
                        Application::redirect($url);
                    }
                    break;
            }

        }

        public function destroyed() {               
        }          
    }
?>
