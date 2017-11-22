<?php
    class NewsArticlesViewModel extends Model
    {
        protected function do_insert($data)
        {          
            $this->db->insert( 'news_articles_view' , $data );
            return $this->db->getInsertId();
        }

        protected function do_update($data,$condition)
        {
            $this->db->update( 'news_articles_view' , $data , $condition );
            return $this->db->getAffectedRows();
        }

        protected function do_delete($condition)
        {
            $this->db->delete( 'news_articles_view', $condition );
            return $this->db->getAffectedRows(); 
        }

        protected function do_select($condition,$order,$offset,$limit)
        {
            return $this->db->buildAndFetchAll(array(
                'select'     => '*',
                'from'        => 'news_articles_view',
                'where'         => $condition,
                'order'        =>  $order,
                'limit'        => array($offset,$limit)
            ));                              
        }

        public function get_article_by_id($id){
            $data = $this->get_once("id ={$id} AND status = 3 and public = 1");
            if ($data){
                return $data;
            }
            else return false;
        }

        public function get_art_by_id($id)
        {                      
            $key = "news_articles_view11#{$id}";
            $news_view = $this->mem_get($key);              
            if($news_view==false)
            {
                $news_view = $this->get_once("id ={$id} AND status=3 AND public =1");    
            }             
            if(!$news_view)
            {
                return array();
            }else{
                $this->mem_set($key,$news_view,1*60);    
            }
            return $news_view;
        }
        /**
        * reset get art by id
        * @author hoangbv
        * @param mixed $id
        */
        public function reset_get_art_by_id($id) 
        {            
            $key = "news_articles_view11#{$id}";
            $news_view = $this->get_once("id ={$id} AND status=3 AND public =1");               
            $this->mem_set($key,$news_view,1*60);           
            return true;
        }
        public function get_total_by_mysql1($condition,$order,$offset,$limit)
        {
            return 10000;
            $total = $this->db->buildAndFetchAll(array(
                'select'     => 'count(a.id) as total',
                'from'        => 'news_articles as a',
                'where'         => $condition,
                'order'        =>  $order,
                'limit'        => array($offset,$limit)
            ));            
            if($total)
            {
                return $total[0]['total'];
            }
            else{
                return 0;
            }
        }        

        public function get_total_by_mysql($condition,$order,$offset,$limit)
        {
            return 10000;
            $total = $this->db->buildAndFetchAll(array(
                'select'     => 'count(*) as total',
                'from'        => 'news_articles_view as a',
                'where'         => $condition,
                'order'        =>  $order,
                'limit'        => array($offset,$limit)
            ));            
            if($total)
            {
                return $total[0]['total'];
            }
            else{
                return 0;
            }
        }

        public function get_total_view_by_conditions($condition,$order,$offset,$limit)
        {  
            $key = "news#total##nguoiduatin#{$condition}";              
            if($memcache = $this->mem_get(md5($key)))
            { 
                return $memcache;
            }else{               
                $total = $this->get_total_by_mysql($condition,$order,$offset,$limit);                            
                $this->mem_set(md5($key),$total,24*1*3600);                
            }
            return $total;
        }

        public function get_list_art($condition="",$limit=10,$offset=0,$is_cache=true)
        {
            $cache_time = 1*60;
            
            $key_cache = md5("get_list_art".$condition."-".$offset."-".$limit."-");
            $result  = array();
            if($is_cache){
                $result = $this->mem_get($key_cache);
            }
            
            if($result) return $result;
            
            $condition1 = "status=3 AND public=1 AND timer=0"; 
            if($condition) $condition1 .= " and ".$condition;  

            $content = $this->get_list($condition1,"create_date_int desc",$offset,$limit);                
            $array = array();
            if($content)
            {                    
                foreach($content as $key=>$value)   
                {
                    $user_modified = 0;
                    if($value->get('modified_by'))
                    {
                        $user_modified = $value->get('modified_by');
                    }

                    $array[$key] = array(
                        'id' => $value->get('id'),
                        'title' => $value->get('title'),
                        'intro_text' => $value->get('intro_text'),                    
                        'images' => $this->get_image($value->get('images')),
                        'meta_slug' => $value->get('meta_slug'),
                        'create_date_int' => $value->get('create_date_int'),
                    );
                }

                $this->mem_set($key_cache,$array,$cache_time);                          
                return $array;
            }else{
                return array();
            }
        }  

        public function site_map_get_list_art($start_time=0,$end_time=0,$limit=1000,$is_cache=true,$is_video=0)
        {   
            if($limit>6000)
                return array(); 

            $cache_time = 60*60*24*7;

            $key_cache = md5("272site_map".$start_time."-".$end_time."-".$limit."-".$is_video);
            $result  = array();
            if($is_cache){
                $result = $this->mem_get($key_cache);   
            }

            if($result)
                return $result;
            if($is_video)
                $condition = "status=3 AND public=1 AND timer=0 and content_type='video' and create_date_int >= $start_time and create_date_int< $end_time";  
            else
                $condition = "status=3 AND public=1 AND timer=0 and content_type!='video' and create_date_int >= $start_time and create_date_int< $end_time";  

            $content = $this->get_list($condition,"create_date_int desc",0,$limit);                
            $array = array();
            if($content)
            {                    
                foreach($content as $key=>$value)   
                {
                    $user_modified = 0;
                    if($value->get('modified_by'))
                    {
                        $user_modified = $value->get('modified_by');
                    }

                    if(!$is_video)
                        $array[$key] = array(
                            'id' => $value->get('id'),
                            'title' => $value->get('title'),
                            'intro_text' => $value->get('intro_text'),                    
                            //      'images' => $this->get_image($value->get('images')),
                            'creat_by' => $this->get_user_name($value->get('creat_by')),
                            /*     'modified_by' => $this->get_user_name($user_modified),   */
                            'meta_slug' => $value->get('meta_slug'),
                            'create_date_int' => $value->get('create_date_int'),
                            'category' => $this->get_name_cat($value->get('id')),     
                            'tags' => $this->get_tags($value->get('id')),  
                            /* 'timer' => $value->get('timer'),   */
                            /*   "content_type" => $value->get('content_type'),    */
                            //   'views' => $this->get_total_hit($value->get('id'))
                        );
                    else
                        $array[$key] = array(
                            'id' => $value->get('id'),
                            'title' => $value->get('title'),
                            'intro_text' => $value->get('intro_text'),                    
                            'images' => $value->get('image_url'),
                            'creat_by' => $this->get_user_name($value->get('creat_by')),
                            /*     'modified_by' => $this->get_user_name($user_modified),   */
                            'meta_slug' => $value->get('meta_slug'),
                            'create_date_int' => $value->get('create_date_int'),
                            'category' => $this->get_name_cat($value->get('id')),     
                            //     'tags' => $this->get_tags($value->get('id')),  
                            /* 'timer' => $value->get('timer'),   */
                            "content_text" => $value->get('content_text'),    
                            //   'views' => $this->get_total_hit($value->get('id'))
                        );
                }

                $this->mem_set($key_cache,$array,$cache_time);                          
                return $array;
            }else{
                return array();
            }
        }  

        public function admin_get_news_by_mysql_vd($condition,$order,$offset,$limit)
        {        
            $content = $this->get_list($condition,$order,$offset,$limit);                
            $array = array();
            if($content)
            {                    
                foreach($content as $key=>$value)   
                {
                    $user_modified = 0;
                    if($value->get('modified_by'))
                    {
                        $user_modified = $value->get('modified_by');
                    }
                    $content = $value->get("content_text");
                    $content = stripslashes($content);
                    $pattern = '/Meme\_([^\"]+)\"/is';     

                    preg_match($pattern,$content,$match);    

                    if($match && isset($match[1])){
                        $id_video = $match[1];     
                        $content = '<div id="Meme_'.$id_video.'" style="display: block; margin: 0 auto !important; width: 560px; height: 315px; max-width: 100%; background: url(\'http://embed.meme.vn/images/holder.png\') center center no-repeat;"><script type="text/javascript" src="http://embed.meme.vn/'.$id_video.'/js">// <![CDATA[ 
                        rnrn rnrn
                        // ]]></script>
                        </div> ';
                        $tmp = array();
                        $tmp["code"] = 1;
                        $tmp["data"] = $content;
                        $content =json_encode($tmp);    
                    }else{
                        $content= "";
                    }         
                    $array[$key] = array(
                        'id' => $value->get('id'),
                        'title' => $value->get('title'),
                        'intro_text' => $value->get('intro_text'),                    
                        'images' => $this->get_image($value->get('images')),
                        'creat_by' => $this->get_user_name($value->get('creat_by')),
                        'modified_by' => $this->get_user_name($user_modified),
                        'meta_slug' => $value->get('meta_slug'),
                        'create_date_int' => $value->get('create_date_int'),  
                        'content' => $content,
                        'status' => $value->get('status'),
                        'public' => $value->get('public'),
                        'hotnews' => $value->get('hotnews'),
                        'category' => $this->get_name_category($value->get('id')),
                        'tags' => $this->get_tags($value->get('id')),
                        'timer' => $value->get('timer'),
                        "content_type" => $value->get('content_type'),
                        'views' => $this->get_total_hit($value->get('id'))
                    );
                }                         
                return $array;
            }else{
                return array();
            }
        }  

        public function admin_get_news_by_mysql($condition,$order,$offset,$limit)
        {        
            $content = $this->get_list($condition,$order,$offset,$limit);                
            $array = array();
            if($content)
            {                    
                foreach($content as $key=>$value)   
                {
                    $user_modified = 0;
                    if($value->get('modified_by'))
                    {
                        $user_modified = $value->get('modified_by');
                    }
                    $array[$key] = array(
                        'id' => $value->get('id'),
                        'title' => $value->get('title'),
                        'intro_text' => $value->get('intro_text'),                    
                        'images' => $this->get_image($value->get('images')),
                        'creat_by' => $this->get_user_name($value->get('creat_by'),$value->get('id')),
                        'modified_by' => $this->get_user_name($user_modified),
                        'meta_slug' => $value->get('meta_slug'),
                        'create_date_int' => $value->get('create_date_int'),
                        'status' => $value->get('status'),
                        'public' => $value->get('public'),
                        'hotnews' => $value->get('hotnews'),
                        'category' => $this->get_name_category($value->get('id')),
                        'tags' => $this->get_tags($value->get('id')),
                        'timer' => $value->get('timer'),
                        "content_type" => $value->get('content_type'),
                        'views' => $this->get_total_hit($value->get('id'))
                    );
                }                         
                return $array;
            }else{
                return array();
            }
        }  
        public function get_total_hit($id)
        {
            $now = time();
            $m_time = mktime(0,0,0,date('n',$now),0,date('Y',$now));
            $total_hit = $this->db->buildAndFetchAll(array(
                'select' => '*',
                'from' => 'hit_view',
                'where' => "news_id ={$id}"
            ));                        
            if($total_hit)
            {
                return $total_hit[0]['hit_view'];
            }else{
                return 0;    
            }            
        }   
        public function get_name_cat($id){
            $category = $this->db->buildAndFetchAll(array(
                'select'       => 'DISTINCT a.id,a.title as title',
                'from'         => array('news_category' => 'a'),
                'where'        => "b.articles_id = {$id}",              
                'order'        => "",
                'add_join'     => array( 
                    0 => array( 
                        'select' => ' b.category_id, b.articles_id', 
                        'from'   => array( 'news_articles_category_view' => 'b' ),    
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
                    $return .= $item['title']. ",";
                }
                $return = trim($return,",");
                return $return;
            }         
        }      

        public function get_name_category($id){
            $category = $this->db->buildAndFetchAll(array(
                'select'       => 'DISTINCT a.id,a.title as title',
                'from'         => array('news_category' => 'a'),
                'where'        => "b.articles_id = {$id}",              
                'order'        => "",
                'add_join'     => array( 
                    0 => array( 
                        'select' => ' b.category_id, b.articles_id', 
                        'from'   => array( 'news_articles_category_view' => 'b' ),    
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
            $image =  $this->db->buildAndFetchAll(array(
                'select'     => 'a.*',
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
        public function get_user_name($id,$articles_id='')
        {
            if($articles_id && $articles_id<=484176) return 'Bài lấy về';
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
                return "Bài chưa sửa";
            }
        }
        public function push_news_articles($news_id)
        {   
            $result = $this->db->buildAndFetch(array(
                'select' => 'a.*',
                'from' => 'news_articles as a',
                'where'=> "a.id ={$news_id}",               
                'limit' => array(0,1)
            ));
            if(!count($result))
            {
                return '';
            }    
            $create_time = time();                    
            $bean = $this->create_bean();
            $bean->set('id',$result['id']);            
            $bean->set('title',$result['title']);
            $bean->set('intro_text',$result['intro_text']);
            $bean->set('content_text',$result['content_text']);            
            $bean->set('source_id',$result['source_id']);
            $bean->set('category_id',$result['category_id']);
            $bean->set('tag_detail',$result['tag_detail']);
            $bean->set('creat_by',$result['creat_by']);
            $bean->set('modified_by',$result['modified_by']);
            $bean->set('images',$result['images']);
            $bean->set('image_url',$result['image_url']);
            $bean->set('version',$result['version']);
            $bean->set('hit_view',$result['hit_view']);
            $bean->set('creat_date',$result['creat_date']);
            $bean->set('create_date_int',$create_time);
            $bean->set('modified_date',$result['modified_date']);
            $bean->set('modified_date_int',$result['modified_date_int']);
            $bean->set('allow_comment',$result['allow_comment']);
            $bean->set('status',$result['status']);
            $bean->set('meta_slug',$result['meta_slug']);
            $bean->set('meta_title',$result['meta_title']);
            $bean->set('meta_keywork',$result['meta_keywork']);
            $bean->set('meta_description',$result['meta_description']);
            $bean->set('is_tm',$result['is_tm']);
            $bean->set('head_line',$result['head_line']);
            $bean->set('forcus',$result['forcus']);
            $bean->set('hotnews',$result['hotnews']);
            $bean->set('draft',$result['draft']);
            $bean->set('public',$result['public']);
            $bean->set('reason',$result['reason']);
            $bean->set('timer',$result['timer']);
            $bean->set('content_type',$result['content_type']);            
            $bean->set('id_video',$result['id_video']);
            $bean->set('title_video',$result['title_video']);
            $bean->set('title_video',$result['title_video']);
            $bean->set('cmtnd',$result['cmtnd']);
            $bean->set('source_id',$result['source_id']);
            $bean->set("note",$result['note']); 
            $bean->set('flag',$result['flag']);
            $bean->set("end_live",$result['end_live']); 
            $bean->set("topic",$result['topic']); 
            $this->insert($bean);
        }                
        public function update_articles_view($id,$title,$short_desc,$content,$modified_by,$image,$status,$meta_slug,$meta_title,$meta_keyword,$meta_description,$public,$content_type,$timer=0,$type="article",$id_video=null,$title_video=null,$cmtnd="",$writer="",$source_id=0,$note="",$endlive=0,$flag=0,$topic=0)
        {
            $create_time = 0;
            $check_art = $this->get_once("id={$id}");
            if($check_art->get("status")!=3 && $check_art->get("public")!=1){
                if($status==3 && $public==1){
                    $create_time = time();
                }

            }

            $bean = $this->create_bean();
            $bean->set("title",$title);            
            $bean->set("intro_text",$short_desc);
            $bean->set("content_text",$content);
            $bean->set("modified_by",$modified_by);
            $bean->set("modified_date_int",time());
            /*  if($create_time)
            $bean->set("create_date_int",$create_time);      */

            $this->news_upload_model = Loader::load_model("news_upload");
            $_image = $this->news_upload_model->get_once("id={$image}");
            $image_url = "";
            if($_image && $_image->get("upload_url")){
                $image_url = $_image->get("upload_url");    
            }
            $bean->set("image_url",$image_url);

            $bean->set("images",$image);
            $bean->set("status",$status);
            $bean->set("meta_slug",$meta_slug);
            $bean->set("meta_title",$meta_title);
            $bean->set("meta_keywork",$meta_keyword);
            $bean->set("meta_description",$meta_description);
            $bean->set("public",$public);           
            $bean->set("timer",$timer);  
            $bean->set("hotnews",$content_type);          
            $bean->set("content_type",$type);
            $bean->set("note",$note);
            $bean->set("flag",$flag);
            $bean->set("end_live",$endlive);
            $bean->set("topic",$topic);
            if($cmtnd)
                $bean->set("cmtnd",$cmtnd);  
            $bean->set("source_id",$source_id);

            if($writer)
                $bean->set("creat_by",$writer);  

            $id_ = $this->update($bean,"id={$id}");

            return $id_;
        }

        public function check_show_box_video($news_id){
            return $this->mem_get(md5($news_id."news_relations"));     
        }
        
        public function get_arr_id_by_keyword($keyword){
            $res = $this->db->buildAndFetchAll(array(
                'select'       => 'id',
                'from'         => 'news_articles_view',
                'where'        => 'meta_slug LIKE "'.$keyword.'%"',              
                'order'        => "id DESC",
                'limit'        => array(0,10)
            ));
            $return = array();
            foreach($res as $item){
                $return[] = $item['id'];
            }
            return $return;
        }
    }
?>
