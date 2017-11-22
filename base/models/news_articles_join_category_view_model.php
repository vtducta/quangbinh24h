<?php
    class NewsArticlesJoinCategoryViewModel extends Model 
    {
        private $news_articles_model;
        
        public function __construct(){
            parent::__construct();
            $this->news_articles_model = Loader::load_model("news_articles");
        }
        
        protected function do_insert($data)
        {                                  
            $this->db->insert( 'table' , $data );
            return $this->db->getInsertId(); 
        }

        protected function do_update($data,$condition)
        {                                             
            $this->db->update( 'table' , $data , $condition );
            return $this->db->getAffectedRows();
        }

        protected function do_delete($condition)
        {                                       
            $this->db->delete( 'table', $condition );
            return $this->db->getAffectedRows();     
        }

        protected function do_select($condition,$order,$offset,$limit)
        { 
            return $this->db->buildAndFetchAll(array(
                'select'       => 'a.id,a.title,a.intro_text,a.creat_by,a.modified_by,a.meta_slug,a.create_date_int,a.status,a.public,a.hotnews,a.timer,a.images',
                'from'         => array('news_articles_view ' => 'a'),
                'where'        => $condition,              
                'order'        => $order,
                'add_join'     => array( 
                    0 => array( 
                        'select' => 'b.category_id,b.parent_id', 
                        'from'   => array( 'news_articles_category_view'=>'b'),    
                        'where'  => 'a.id = b.articles_id ',                  
                        'type'   => 'inner' 
                )),                            
                'limit'        => array($offset,$limit)
            ));
        }                                               
        public function get_total_news_by_category_sql($condition,$order,$offset,$limit)
        {
            return 10000;
            $total = $this->db->buildAndFetchAll(array(
                'select'       => 'count(*) as total',
                'from'         => array('news_articles_view ' => 'a'),
                'where'        => $condition,              
                'add_join'     => array( 
                    0 => array( 
                        'select' => '', 
                        'from'   => array( 'news_articles_category_view'=>'b'),    
                        'where'  => 'a.id = b.articles_id',                  
                        'type'   => 'inner' 
                )),                            
            ));
            if($total)
            {
                return $total[0]['total'];
            }else{
                return 0;
            }
        }

        public function get_total_news_by_category($condition,$order,$offset,$limit)
        {         
            $key = "total#news#by#category{$condition}";
            $total = $this->mem_get(md5($key));          
            if($total==false)
            {
                $total = $this->get_total_news_by_category_sql($condition,$order,$offset,$limit);   
                $this->mem_set(md5($key),$total,24*3600);            
            }                   

            return $total;
        }           
        public function reset_total_news_by_category($condition,$order,$offset,$limit)
        {
            $key = "total#news#by#category{$condition}";          
            $total = $this->get_total_news_by_category_sql($condition,$order,$offset,$limit);  
            if($total)                
                $this->mem_set(md5($key),$total,24*60*60);
            else
                $this->mem_set(md5($key),0,24*60*60);
            return $total;
        }
        public function admin_get_news_by_category_sql($condition,$order,$offset,$limit)
        {       
            $content = $this->get_list($condition,$order,$offset,$limit);                          
            $array = array();
            if($content)
            {                    
                foreach($content as $key=>$value)   
                {
                    $array[$key] = array(
                        'id' => $value->get('id'),
                        'title' => $value->get('title'),
                        'intro_text' => $value->get('intro_text'),
                        'images' => $this->news_articles_model->get_image_cache($value->get('images')),
                        //'images' => $value->get('upload_url'),
                        'creat_by' => $this->get_user_name($value->get('creat_by')),
                        'user_id' => $value->get('creat_by'),
                        'modified_by'=> $this->get_user_name($value->get('modified_by')),
                        'meta_slug' => $value->get('meta_slug'),
                        'create_date_int' => $value->get('create_date_int'),
                        'status' => $value->get('status'),
                        'public' => $value->get('public'),
                        'hotnews' => $value->get('hotnews'),
                        'category' => $this->get_name_category($value->get('id')),
                        'tags' => $this->get_tags($value->get('id')),
                        'timer' => $value->get('timer'),
                        'views' => $this->get_total_hit($value->get('id'))                         
                    );
                }                         
                return $array;
            }else{
                return array();
            }
        }         
        public function admin_get_news_by_category_royal($condition,$order,$offset,$limit)
        {       
            $content = $this->get_list($condition,$order,$offset,$limit);                          
            $array = array();
            if($content)
            {                    
                foreach($content as $key=>$value)   
                {
                    $array[$key] = array(
                        'id' => $value->get('id'),
                        'title' => $value->get('title'),
                        'images' => $value->get('upload_url'),
                        'creat_by' => $this->get_user_name($value->get('creat_by')),
                        'user_id' => $value->get('creat_by'),
                        'version' => $value->get("version"),
                        'meta_slug' => $value->get('meta_slug'),
                        'cmtnd' => $value->get('cmtnd'), 
                        'create_date_int' => $value->get('create_date_int'),
                        'hotnews' => $value->get('hotnews'),
                        'category' => $this->get_name_category($value->get('id')),
                        'views' => $this->get_total_hit($value->get('id')),
                        'royalties'=> $this->get_royalties($value->get('id'))
                    );
                }                         
                return $array;
            }else{
                return array();
            }
        }     
        public function get_royalties($news_id)
        {
            $content =  $this->db->buildAndFetchAll(array(
                'select' => '*',
                'from' => 'royaltiesv2',
                'where' => "news_id ={$news_id}"
            ));            
            if($content[0])             
                return $content[0];
            return array();
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
        public function get_news_by_category_sql($condition,$order,$offset,$limit)
        {       
            $content = $this->get_list($condition,$order,$offset,$limit);                          
            $array = array();
            if($content)
            {               
                foreach($content as $key=>$value)   
                {
                    $array[$value->get('id')] = array(
                        'id' => $value->get('id'),
                        'title' => $value->get('title'),
                        'intro_text' => $value->get('intro_text'),                    
                        'images' => $value->get('upload_url'),                        
                        'upload_url' => $value->get('upload_url'),                        
                        'meta_slug' => $value->get('meta_slug'),
                        'create_date_int' => $value->get('create_date_int'),
                        'status' => $value->get('status'),
                        'public' => $value->get('public'),
                        'content_type' => $value->get('content_type')
                    );
                }               
                return $array;
            }else{
                return array();
            }
        }                    

        public function get_news_by_category_ndt($cat_id,$current_page,$order,$offset,$limit)  
        {          
            $key = "get_news_by#category#2#{$cat_id}#{$offset}#{$order}#{$limit}";                                     
            $list_news = $this->mem_get(md5($key));
            if(!$list_news)
            { 
                $list_news = $this->get_list_arts("a.public=1 AND a.timer<1 AND b.category_id={$cat_id}",$order,$offset,$limit);   
                $this->mem_set(md5($key),$list_news,60*5);                

            }  
            return $list_news;
        }
        public function get_news_by_category_ndt_v2($cat_id,$news_id,$current_page,$order,$offset,$limit)  
        {          
            $key = "get_news_by#category#2#v2#{$cat_id}#{$news_id}#{$offset}#{$order}#{$limit}";                                     
            $list_news = $this->mem_get(md5($key));
            if(!$list_news)
            { 
                $list_news = $this->get_list_arts("a.public=1 AND a.timer<1 AND a.id != {$news_id} AND b.category_id={$cat_id}",$order,$offset,$limit);   
                $this->mem_set(md5($key),$list_news,60*5);                

            }  
            return $list_news;
        }
        public function reset_get_news_by_category_ndt($cat_id,$current_page,$order,$offset,$limit)
        {               
            $key = "get_news_by#category#2#{$cat_id}#{$offset}#{$order}#{$limit}";            
            $list_news = $this->get_list_arts("a.public=1 AND a.timer<1 AND b.category_id={$cat_id}",$order,$offset,$limit);

            $this->mem_set(md5($key),$list_news,60*5);            
            return true;
        }

        public function get_news_by_category($condition,$current_page,$order,$offset,$limit)  
        {          
            $key = "news112sss2#category#{$condition}#{$offset}#{$limit}";                                      
            $list_news = $this->mem_get(md5($key));
            if($list_news == false)
            {                                                 
                //   $list_news = $this->get_news_by_category_sql($condition,$order,$offset,$limit);     
                $list_news = $this->get_list_arts($condition,$order,$offset,$limit);   

                $this->mem_set(md5($key),$list_news,60*15);                

            }         

            return $list_news;
        }
        public function reset_get_news_by_category($condition,$current_page,$order,$offset,$limit)
        {               
            $key = "news112sss2#category#{$condition}#{$offset}#{$limit}";
            //$list_news = $this->get_news_by_category_sql($condition,$order,$offset,$limit);         
            $list_news = $this->get_list_arts($condition,$order,$offset,$limit);          

            $this->mem_set(md5($key),$list_news,60*15);            
            return true;
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
                'select'     => 'a.id',
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

        public function get_user_name($id)
        {
            if(!$id)
                return "no name";
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
                return "No name";
            }

        }

        public function get_news_all($condition,$order,$offset,$limit,$is_cache=true)  
        {          
            $key = "news112sss2#get_news_all#{$condition}#{$offset}#{$limit}";                                      
            $list_news = $this->mem_get(md5($key));

            if($is_cache){
                if($list_news)
                    return $list_news;

                return array();    
            }

            $list_news = $this->get_list_arts1($condition,$order,$offset,$limit);             
            $this->mem_set(md5($key),$list_news,60*15);                              
            return $list_news;
        }

        public function get_list_arts1($condition,$order,$offset,$limit){
            $result =  $this->db->buildAndFetchAll(array(
                'select'       => 'a.id as id, a.title as title,a.intro_text as intro_text,a.status as status,a.public as public,a.create_date_int as create_date_int,a.meta_slug as meta_slug,a.content_type,a.image_url as upload_url',
                'from'         => array('news_articles_view ' => 'a'),
                'where'        => $condition,              
                'order'        => $order,                 
                'limit'        => array($offset,$limit)
            ));

            $array = array();
            if($result)
            {               
                foreach($result as $key=>$value)   
                {
                    $array[$value["id"]] = array(
                        'id' => $value["id"],
                        'title' => stripslashes($value["title"]),
                        'intro_text' => stripslashes($value["intro_text"]),                    
                        'images' => $value["upload_url"],                        
                        'upload_url' => $value["upload_url"],                        
                        'meta_slug' => $value["meta_slug"],
                        'create_date_int' => $value["create_date_int"],
                        'status' => $value["status"],
                        'public' => $value["public"],
                        'content_type' => $value["content_type"]
                    );
                }               
                return $array;
            }else{
                return array();
            }
        }



        public function get_list_arts($condition,$order,$offset,$limit){
            $result =  $this->db->buildAndFetchAll(array(
                'select'       => 'a.id,a.title,a.intro_text,a.creat_by,a.modified_by,a.meta_slug,a.create_date_int,a.status,a.public,a.hotnews,a.timer,a.images',
                'from'         => array('news_articles_view ' => 'a'),
                'where'        => $condition,              
                'order'        => $order,
                'add_join'     => array( 
                    0 => array( 
                        'select' => 'b.category_id', 
                        'from'   => array( 'news_articles_category_view'=>'b'),    
                        'where'  => 'a.id = b.articles_id ',                  
                        'type'   => 'inner' 
                )),                            
                'limit'        => array($offset,$limit)
            ));

            $array = array();
            if($result)
            {               
                foreach($result as $key=>$value)   
                {
                    $array[$value["id"]] = array(
                        'id' => $value["id"],
                        //'title' => htmlspecialchars(stripslashes($value["title"]),ENT_QUOTES),
                        'title' => stripslashes($value["title"]),
                        'intro_text' => stripslashes($value["intro_text"]),                    
                        'images' => $this->news_articles_model->get_image_cache($value['images']),
                        'upload_url' => $value["upload_url"],                        
                        'meta_slug' => $value["meta_slug"],
                        'create_date_int' => $value["create_date_int"],
                        'status' => $value["status"],
                        'public' => $value["public"],
                        'content_type' => $value["content_type"]
                    );
                }
                return $array;
            }else{
                return array();
            }
        }

    }
?>
