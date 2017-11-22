<?php
    class NewsArticlesHitDayModel extends Model
    {
        private $news_articles_model;
        
        public function __construct(){
            parent::__construct();
            $this->news_articles_model = Loader::load_model("news_articles");
            $this->template_helper = Loader::load_helper("template_helper");
        }

        protected function do_insert($data)
        {          

        }

        protected function do_update($data,$condition)

        {

        }

        protected function do_delete($condition)

        {

        }
        protected function do_select($condition,$order,$offset,$limit)
        {
            $data = $this->db->buildAndFetchAll(array(

            'select'     => 'DISTINCT a.id as id, a.title as title,a.intro_text as intro_text,a.status as status,a.public as public,b.create_date_int as create_date_int,a.meta_slug as meta_slug,a.content_type,a.image_url as upload_url,a.images as images,d.total_hit',
            'from'        => array('news_articles_view' => "a"),
            'where'         => $condition,
            'add_join'     => array( 
            0 => array( 
            'select' => '', 
            'from'   => array( 'news_articles_category_view' => 'b',"hit_view_day" => 'd'),    
            'where'  => 'b.articles_id = a.id AND d.news_id = a.id',                  
            'type'   => 'inner' 
            )
            ),            
            'order'        =>  $order,
            'limit'        => array($offset,$limit)
            ));                              
            return $data;
        }   

        public function get_news_hit_view_by_day_by_sql($id,$offset=0,$limit=5)
        {           
            $now = time();    
            $d_time = mktime(0,0,0,date('n',$now),date('j',$now),date('Y',$now));              
            $w_time = mktime(0,0,0,date('n',$now),date('j',$now)-date('N',$now)+1,date('Y',$now));                                
            if($d_time == $w_time)
            {
                $offset = $offset+5;
            }
            $w_time_day = mktime(0,0,0,date('m'),date('d')-10,date('Y'));             
            //$result = $this->get_list("a.status=3 AND a.public=1 AND a.timer=0 AND b.create_date_int > {$w_time_day} AND d.d_time = {$d_time} AND b.category_id = {$id}","d.total_hit DESC",$offset,$limit);
            if($id) $result = $this->get_list("a.status=3 AND a.public=1 AND a.timer=0 AND b.category_id = {$id}","d.total_hit DESC",$offset,$limit);
            else $result = $this->get_list("a.status=3 AND a.public=1 AND a.timer=0","d.total_hit DESC",$offset,$limit);
            if($result)
            {
                foreach($result as $key=>$value)   
                {
                    $array[$value->get('id')] = array(
                        'id' => $value->get('id'),
                        'title' => $value->get('title'),
                        'intro_text' => stripslashes($value->get('intro_text')),                    
                        'images' => $this->news_articles_model->get_image_cache($value->get('images')),
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
        public function get_news_hit_view_24h($offset=0,$limit=5)
        {
            $starttime = time()-24*60*60;                  
            $end_time = mktime(23,59,0,date('m'),date('d'),date('Y'));            
            $key = "#news#hit#view#by#24h#2#{$offset}#{$limit}#";                        
            $list_news = $this->mem_get(md5($key));                    
            if(!$list_news)
            {
                $list_news = $this->get_list("a.status=3 AND a.public=1 AND a.timer=0 AND b.create_date_int>{$starttime}","total_hit DESC",$offset,$limit);
                $this->mem_set(md5($key),$list_news,600);    
            }
            
            if($list_news)
            {
                foreach($list_news as $key=>$value)   
                {
                    $array[$value->get('id')] = array(
                        'id' => $value->get('id'),
                        'title' => stripslashes($value->get('title')),
                        'intro_text' => stripslashes($value->get('intro_text')),                    
                        'images' => $this->news_articles_model->get_image_cache($value->get('images')),
                        'meta_slug' => $value->get('meta_slug'),
                        'create_date_int' => $value->get('create_date_int'),
                        'status' => $value->get('status'),
                        'public' => $value->get('public'),
                        'content_type' => $value->get('content_type')
                    );
                }
                return $array;
            }

            return $list_news;            
        }
        public function reset_get_news_hit_view_24h($offset=0,$limit=5)
        {
            $starttime = time()-24*60*60;                  
            $end_time = mktime(23,59,0,date('m'),date('d'),date('Y'));            
            $key = "news#hit#view#by#24h#{$offset}#{$limit}#";                        
            $list_news = $this->get_list("a.status=3 AND a.public=1 AND a.timer=0 AND b.create_date_int>{$starttime}","total_hit DESC",$offset,$limit);
         
            $this->mem_set(md5($key),$list_news,1200);
            return true;            
        }
        /**
        * get news hit view by day
        * @author hoangbv
        * @param mixed $id
        * @param mixed $offset
        * @param mixed $limit
        * @return array
        */
        public function get_news_hit_view_by_day($id,$offset,$limit)
        {           
            $key = "hit#view#news#by#day2#{$id}#{$offset}#{$limit}";
            $list_news = $this->mem_get(md5($key));             
            if($list_news==false)
            {
                $list_news = $this->get_news_hit_view_by_day_by_sql($id,$offset,$limit);
                $this->mem_set(md5($key),$list_news,1200); 
            }             
                   
            return $list_news;
        }
        
        /**
        * reset get news hit view by day
        * @author hoangbv
        * @param mixed $id
        * @param mixed $offset
        * @param mixed $limit
        */
        public function reset_news_hit_view_by_day($id,$offset,$limit)
        {            
            $key = "hit#view#news#by#day#category{$id}#{$offset}#{$limit}";
            $list_news = $this->get_news_hit_view_by_day_by_sql($id,$offset,$limit);            
            $this->mem_set(md5($key),$list_news,1200);
            return true;            
        }        


        public function get_hit_view_home_Sql()
        {                        
            $now = time();    
            $d_time = mktime(0,0,0,date('n',$now),date('j',$now),date('Y',$now));  
            $w_time_day = mktime(0,0,0,date('m'),date('d')-1,date('Y'));
            //$data = $this->get_list("a.status=3 AND a.public =1 AND a.timer=0 AND b.create_date_int > {$w_time_day} AND d.d_time = {$d_time}","total_hit DESC",0,8);
            $data = $this->get_list("a.status=3 AND a.public=1 AND a.timer=0","total_hit DESC",0,8);
            if(count($data))
            {
                return $data;                
            }else{
                return array();
            }
        }

        public function get_hit_6h($limit=6,$is_cache=true){
            if($limit>12)
                $limit = 12;
            $key = md5("get_hit_6h#12222_".$limit);        
            $list_news = $this->mem_get($key);          
            
            if($is_cache){
                if($list_news)
                    return $list_news ;
                return array();
            }
           
            $now = time();    
            $d_time = mktime(0,0,0,date('n',$now),date('j',$now),date('Y',$now));  
            
            $w_time_day = $now - 6*3600;
            $w_time_day1 = $now - 24*3600;
            
            $data = $this->get_list("a.status =3 AND  a.public =1 AND a.timer=0 AND b.create_date_int > {$w_time_day} AND d.d_time = {$d_time} AND b.parent_id !=211","total_hit DESC",0,$limit);  
            
            if(!$data || count($data)<6){
                $data = $this->get_list("a.status =3 AND  a.public =1 AND a.timer=0 AND b.create_date_int > {$w_time_day1} AND d.d_time = {$d_time} AND b.parent_id !=211","total_hit DESC",0,$limit);      
            }
            
            if($data){
                $this->mem_set($key,$data,3600*24*7);    
                return $data;
            }
            
            return array();                   
        }
        
        public function get_hit_view_home()
        {            
            $key = "hit#view#home#ndt#12222";        
            $list_news = $this->mem_get(md5($key));          
            if($list_news ==false)
            {                
                $list_news = $this->get_hit_view_home_Sql();    
                $this->mem_set(md5($key),$list_news,15*60);   
            }  
            return $list_news;
        }        

        public function reset_get_hit_view_home()
        {
            $key = "hit#view#home#ndt#12222";           
            $list_news = $this->get_hit_view_home_Sql();           
          
            $this->mem_set(md5($key),$list_news,15*60*60);
            return true;
        }                
        
        function get_most_hit_view_art(){
            $key = "mb#home#hitview#ndt";           
            $data_cache = $this->mem_get($key);
            if($data_cache ==false)
            {
                $data_cache = $this->get_most_hit_view_art_sql();
            } 
            if(!$data_cache)           
            {
                return array();
            }
            $this->mem_set($key,$data_cache,15*60);            
            return $data_cache;
        }        
        function push_most_hit_view_art(){
            $key = "mb#home#hitview#ndt";
            $data = $this->get_most_hit_view_art_sql();
            if ($data){
                $this->mem_set($key,$data,15*3600);
            }
            return $data;
        }

        function get_most_hit_view_art_sql(){
            $arr = "(5,199, 12, 16, 31, 34,6, 21,10)";      
            $now = time();    
            $d_time = mktime(0,0,0,date('n',$now),date('j',$now),date('Y',$now));  
            $w_time_day = mktime(0,0,0,date('m'),date('d')-10,date('Y'));
            $data = $this->get_list("a.status =3 AND  a.public =1 AND a.timer=0 AND b.create_date_int > {$w_time_day} AND d.d_time = {$d_time} AND  b.category_id in {$arr}","total_hit DESC",0,1);
            if (isset($data[0])){
                return $data[0];
            }
            else{
                return false;
            }
        }
    }
?>
