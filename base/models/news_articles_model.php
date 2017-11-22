<?php
    class NewsArticlesModel extends Model 
    {                          
        protected function do_insert($data)
        {                                  
            $this->db->insert( 'news_articles' , $data );
            return $this->db->getInsertId(); 
        }

        protected function do_update($data,$condition)
        {                                             
            $this->db->update( 'news_articles' , $data , $condition );
            return $this->db->getAffectedRows();
        }

        protected function do_delete($condition)
        {                                       
            $this->db->delete( 'news_articles', $condition );
            return $this->db->getAffectedRows();     
        }

        protected function do_select($condition,$order,$offset,$limit)
        {
            return $this->db->buildAndFetchAll(array(
                'select'     => '*',                
                'from'        => 'news_articles',           
                'where'         => $condition,      
                'order'        =>  $order,          
                'limit'        => array($offset,$limit)
            ));                                         
        }                                               
        public function get_total_by_sql($conditon,$order,$offset,$limit)
        {
            return 10000;
            $total = $this->db->buildAndFetch(array(
                'select'=> 'count(a.id) as total',
                'from' => 'news_articles as a',
                'where' => $conditon,
                'order' => $order,
                'limit' => array($offset,$limit)
            ));         
            if($total)
            {
                return $total['total'];
            }else{
                return 0;
            }
        }
        public function get_total_by_condition($condition,$order,$offset,$limit)
        { 
            $key = "total#news#articles".$condition;
            if($total_cache = $this->mem_get(md5($key)))
            {
                return $total_cache;
            }else{ 
                $total = $this->get_total_by_sql($condition,$order,$offset,$limit);

                $this->mem_set(md5($key),$total,24*1*3600);              
            }
            return $total;  
        }
        public function admin_get_news_by_mysql($conditon,$order,$offset,$limit)
        {        
            $content = $this->get_list($conditon,$order,$offset,$limit);                
            $array = array();
            if($content)
            {                    
                foreach($content as $key=>$value)   
                {
                    $array[$key] = array(
                        'id' => $value->get('id'),
                        'title' => $value->get('title'),
                        'intro_text' => $value->get('intro_text'),                    
                        'images' => $this->get_image($value->get('images')),
                        'creat_by' => $this->get_user_name($value->get('creat_by')),
                        'modified_by' => $this->get_user_name($value->get('modified_by')),
                        'meta_slug' => $value->get('meta_slug'),
                        'create_date_int' => $value->get('create_date_int'),
                        'status' => $value->get('status'),
                        'public' => $value->get('public'),
                        'hotnews' => $value->get('hotnews'),
                        'category' => $this->get_name_category($value->get('id')),
                        'tags' => $this->get_tags($value->get('id')),
                        'timer' => $value->get('timer'),
                        'reason' => $value->get('reason'),
                        "content_type" => $value->get('content_type')
                    );
                }                         
                return $array;
            }else{
                return array();
            }
        }    

        public function get_name_category($id){
            $category = $this->db->buildAndFetchAll(array(
                'select'       => 'a.title as title',
                'from'         => array('news_category' => 'a'),
                'where'        => "b.articles_id = {$id}",              
                'order'        => "",
                'add_join'     => array( 
                    0 => array( 
                        'select' => 'b.articles_id,b.category_id', 
                        'from'   => array( 'news_articles_category' => 'b' ),    
                        'where'  => 'b.category_id = a.id',                  
                        'type'   => 'inner' 
                )),
                'limit'        => array($offset,$limit)
            ));           
            if (!count($category)){
                return "Thể loại khác";
            }
            else{
                $return = "";
                foreach ($category as $item){
                    $return .= $item['title'] . ",";
                }
                $return = rtrim($return,",");
                return $return;
            }         
        }      
        public function get_tags($id)
        {
            $tags = $this->db->buildAndFetchAll(array(
                'select'       => 'a.tag_name as tag_name',
                'from'         => array('news_tag' => 'a'),
                'where'        => "b.articles_id = {$id}",              
                'order'        => "",
                'add_join'     => array( 
                    0 => array( 
                        'select' => 'b.articles_id,b.tag_id', 
                        'from'   => array( 'news_articles_tag' => 'b' ),    
                        'where'  => 'b.tag_id = a.id',                  
                        'type'   => 'inner' 
                )),
                'limit'        => array($offset,$limit)
            ));            

            if (!$tags[0]['tag_name']){          
                return "No tags";
            }
            else{
                $return = "";
                foreach ($tags as $item){
                    $return .= $item['tag_name'] . ",";
                }                
                $return = rtrim($return,",");
                return $return;
            }         
        }
        public function get_image($id)
        {
            if(!$id) return '';
            $image =  $this->db->buildAndFetchAll(array(
                'select'     => 'a.id,a.upload_url',
                'from'        => 'news_upload as a',
                'where'         => "a.id={$id}",
                'order'        => "a.id DESC",
                'limit'        => array(0,1)
            ));                               
            if($image)
            {
                return $image[0]['upload_url'];
            }
            else{
                $image_default = 'http://admin.nguoiduatin.vn/images/noimg.gif';
                return  $image_default;
            }
        }
        public function get_image_cache($id)
        {
            if(!$id) return '';
            $key = "get_image_cache#{$id}#";
            $image =  $this->mem_get(md5($key));
            if(empty($image))
            {
                $image =  $this->db->buildAndFetchAll(array(
                    'select'     => 'a.upload_url',
                    'from'        => 'news_upload as a',
                    'where'         => "a.id={$id}",
                    'order'        => "a.id DESC",
                    'limit'        => array(0,1)
                ));
                $this->mem_set(md5($key),$image,2*60);
            }
            if($image){
                return $image[0]['upload_url'];
            }else{
                $image_default = '/images/default/no-img/noimg214x122.gif';
                return  $image_default;
            }
        }
        public function get_user_name($id)
        {
            $user_name = $this->db->buildAndFetch(array(
                'select'     => 'a.user_id,a.username',
                'from'        => 'tm_users as a',
                'where'         => "a.user_id={$id}",
                'order'        => "a.user_id DESC",
                'limit'        => array(0,1) 
            ));            
            if($user_name)
            {
                return $user_name['username'];
            }else{
                return "Unknow";
            }

        }
        public function insert_articles($title,$short_desc,$content,$creat_by,$image,$status,$meta_slug,$meta_title,$meta_keyword,$meta_description,$public,$timer,$content_type,$type="article",$id_video=null,$title_video=null,$cmtnd=null,$source_id=0,$note="",$endlive=0,$flag=0,$topic=0)
        {
            $bean = $this->create_bean();
            $this->news_upload_model = Loader::load_model("news_upload");
            $_image = $this->news_upload_model->get_once("id={$image}");
            $image_url = "";
            if($_image && $_image->get("upload_url")){
                $image_url = $_image->get("upload_url");    
            }
            $bean->set("image_url",$image_url);
            $bean->set("title",$title);            
            $bean->set("intro_text",$short_desc);
            $bean->set("content_text",$content);
            $bean->set("creat_by",$creat_by);
            $bean->set("images",$image);
            $bean->set("status",$status);
            $bean->set("create_date_int",time());
            $bean->set("meta_slug",$meta_slug);
            $bean->set("meta_title",$meta_title);
            $bean->set("meta_keywork",$meta_keyword);
            $bean->set("meta_description",$meta_description);            
            $bean->set("public",$public);
            $bean->set("timer",$timer);
            $bean->set("hotnews",$content_type);
            $bean->set("content_type",$type);
            $bean->set("id_video",$id_video);
            $bean->set("title_video",$title_video);
            $bean->set("cmtnd",$cmtnd);
            $bean->set("source_id",$source_id);
            $bean->set("note",$note);
            $bean->set("flag",$flag);
            $bean->set("end_live",$endlive);
            $bean->set("topic",$topic);
            $id = $this->insert($bean);
            return $id;
        }
        public function insert_articles1($title,$short_desc,$content,$creat_by,$image,$status,$meta_slug,$meta_title,$meta_keyword,$meta_description,$content_type,$type="article",$draft=0,$id_video=null,$title_video=null,$cmtnd="",$source_id=0,$note="",$topic=0)
        {                      
            $bean = $this->create_bean();
            $this->news_upload_model = Loader::load_model("news_upload");
            $_image = $this->news_upload_model->get_once("id={$image}");
            $image_url = "";
            if($_image && $_image->get("upload_url")){
                $image_url = $_image->get("upload_url");    
            }
            $bean->set("image_url",$image_url);
            $bean->set("title",$title);            
            $bean->set("intro_text",$short_desc);
            $bean->set("content_text",$content);
            $bean->set("creat_by",$creat_by);
            $bean->set("images",$image);
            $bean->set("status",$status);
            $bean->set("create_date_int",time());
            $bean->set("meta_slug",$meta_slug);
            $bean->set("meta_title",$meta_title);
            $bean->set("draft",$draft);
            $bean->set("public",3);
            $bean->set("meta_keywork",$meta_keyword);
            $bean->set("meta_description",$meta_description);            
            $bean->set("hotnews",$content_type);
            $bean->set("content_type",$type);
            $bean->set("id_video",$id_video);
            $bean->set("title_video",$title_video);
            $bean->set("cmtnd",$cmtnd);  
            $bean->set("source_id",$source_id); 
            $bean->set("note",$note);    
            $bean->set("topic",$topic); 
            $id = $this->insert($bean);            
            return $id;
        }
        public function update_articles1($title,$short_desc,$content,$modified_by,$image,$status,$meta_slug,$meta_title,$meta_keyword,$meta_description,$content_type,$type="article",$id,$reason=null,$draft=0,$id_video=null,$title_video=null,$source_id=0,$note="",$topic=0)
        {
            $bean = $this->create_bean();
            $this->news_upload_model = Loader::load_model("news_upload");
            $_image = $this->news_upload_model->get_once("id={$image}");
            $image_url = "";
            if($_image && $_image->get("upload_url")){
                $image_url = $_image->get("upload_url");    
            }
            $bean->set("image_url",$image_url);
            $bean->set("title",$title);            
            $bean->set("intro_text",$short_desc);
            $bean->set("content_text",$content);
            $bean->set("modified_by",$modified_by);
            $bean->set("images",$image);
            $bean->set("status",$status);
            $bean->set("meta_slug",$meta_slug);
            $bean->set("meta_title",$meta_title);
            $bean->set("public",3);
            $bean->set("draft",$draft);
            $bean->set("meta_keywork",$meta_keyword);
            $bean->set("meta_description",$meta_description);
            $bean->set("hotnews",$content_type);
            $bean->set("content_type",$type);
            $bean->set("id_video",$id_video);
            $bean->set("source_id",$source_id);
            $bean->set("title_video",$title_video);
            $bean->set("reason",$reason);        
            $bean->set("note",$note);   
            $bean->set("topic",$topic);  
            $id = $this->update($bean,"id={$id}");
            return $id;
        }

        public function update_articles($id,$title,$short_desc,$content,$modified_by,$image,$status,$meta_slug,$meta_title,$meta_keyword,$meta_description,$public,$content_type,$timer=0,$type="article",$id_video=null,$title_video=null,$reason=null,$flag=0,$cmtnd="",$writer="",$source_id=0,$note="",$endlive=0,$flag=0,$topic=0)
        {
            $bean = $this->create_bean();
            $this->news_upload_model = Loader::load_model("news_upload");
            $_image = $this->news_upload_model->get_once("id={$image}");
            $image_url = "";
            if($_image && $_image->get("upload_url")){
                $image_url = $_image->get("upload_url");    
            }
            $bean->set("image_url",$image_url);
            $bean->set("title",$title);            
            $bean->set("intro_text",$short_desc);
            $bean->set("content_text",$content);
            $bean->set("modified_by",$modified_by);
            if($flag)
            {
                $bean->set("create_date_int",time());
            }
            if($cmtnd){
                $bean->set("cmtnd",$cmtnd);    
            }

            $bean->set("source_id",$source_id);

            if($writer){
                $bean->set("creat_by",$writer);    
            }
            $bean->set("modified_date_int",time());
            $bean->set("images",$image);
            $bean->set("meta_slug",$meta_slug);
            $bean->set("meta_title",$meta_title);
            $bean->set("meta_keywork",$meta_keyword);
            $bean->set("meta_description",$meta_description);
            $bean->set("hotnews",$content_type);
            $bean->set("content_type",$type);
            $bean->set("id_video",$id_video);
            $bean->set("title_video",$title_video);
            $bean->set("note",$note); 
            $bean->set("flag",$flag);
            $bean->set("end_live",$endlive);
            $bean->set("topic",$topic);
            if($public ==-1)
            {
                $bean->set("status",-1);
                $bean->set("reason",$reason);
                $bean->set("public",3);
                $bean->set("timer",0);
            }else{
                if($public ==-2){
                    ;
                }else{
                    $bean->set("draft",0);
                    $bean->set("status",$status);
                    $bean->set("public",$public);
                    $bean->set("timer",$timer);        
                }    
            }                        
            $id = $this->update($bean,"id={$id}");
            return $id;
        }        
    }
?>
