<?php
    class NewsArticlesHitModel extends Model
    {
        public function __construct(){
            parent::__construct();
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

            'select'     => 'a.id as id, a.title as title,a.intro_text as intro_text,a.status as status,a.content_type,a.public as public,a.create_date_int as create_date_int,a.meta_slug as meta_slug,a.image_url as upload_url,sum(d.hit_view) as hit_view',
            'from'        => array('news_articles_view' => "a"),
            'where'         => $condition,
            'add_join'     => array( 
                0 => array( 
                    'select' => '', 
                    'from'   => array( 'news_articles_category_view' => 'b',"hit_view" => 'd'),    
                    'where'  => 'b.articles_id = a.id AND d.news_id = a.id',                  
                    'type'   => 'inner' 
                )
            ),
            'group' => "a.id",
            'order'        =>  $order,
            'limit'        => array($offset,$limit)
            ));                              
            return $data;

        }        
        public function get_news_hit_view_by_day_by_sql($id,$offset,$limit)
        {           
            $now = time();    
            $d_time = mktime(0,0,0,date('n',$now),date('j',$now),date('Y',$now));  
            $w_time_day = mktime(0,0,0,date('m'),date('d')-10,date('Y'));            
            $result = $this->get_list("a.status =3 AND  a.public =1 AND a.timer=0 AND a.create_date_int > {$w_time_day} AND d.d_time = {$d_time} AND ( b.category_id = {$id} OR b.parent_id ={$id})","hit_view DESC",$offset,$limit);          
            return $result;
        }        
        public function get_news_hit_view_24h($offset=0,$limit)
        {
            $starttime = mktime(0, 0, 0, date('m'), date('d'), date('Y'))-24*60*60;                  
            $end_time = mktime(23,59,0,date('m'),date('d'),date('Y'));            
            $key = "news#hit#view#24h#{$offset}#{$limit}#";                        
            $list_news = $this->mem_get(md5($key));           
            if($list_news ==false)
            {          
                $list_news = $this->get_list("a.status=3 AND a.public=1 AND a.timer=0 AND (a.create_date_int>{$starttime} AND a.create_date_int<{$end_time})","a.create_date_int DESC,a.id DESC",$offset,$limit);
            }            
            if(!$list_news)
            {
                return array();                
            }else{
                $this->mem_set(md5($key),$list_news,15*60);    
            }            
            return $list_news;            
        }
        public function reset_get_news_hit_view_24h($offset=0,$limit)
        {
            $starttime = mktime(0, 0, 0, date('m'), date('d'), date('Y'))-24*60*60;                  
            $end_time = mktime(23,59,0,date('m'),date('d'),date('Y'));            
            $key = "news#hit#view#24h#{$offset}#{$limit}#";                        
            $list_news = $this->get_list("a.status=3 AND a.public=1 AND a.timer=0 AND (a.create_date_int>{$starttime} AND a.create_date_int<{$end_time})","a.create_date_int DESC,a.id DESC",$offset,$limit);
            if(!$list_news)
            {
                return false;
            }
            $this->mem_set(md5($key),$list_news,15*60);
            return true;            
        }
        public function get_news_hit_view_by_week_by_sql($id,$offset,$limit)
        {
            $now = time();                
            $w_time = mktime(0,0,0,date('n',$now),date('j',$now)-date('N',$now)+1,date('Y',$now));
            $w_time_day = mktime(0,0,0,date('m'),date('d')-15,date('Y'));            
            $result = $this->get_list("a.status =3 AND  a.public =1 AND a.timer=0 AND a.create_date_int > {$w_time_day} AND d.w_time = {$w_time} AND  ( b.category_id = {$id} OR b.parent_id ={$id})","hit_view DESC",$offset,$limit);
            return $result;      
        }
        public function get_news_hit_view_by_day($id,$offset,$limit)
        {           
            $key = "hit#view#news#category{$id}#{$offset}#{$limit}";
            $list_news = $this->mem_get(md5($key));
            if(!$list_news)
            {
                $list_news = $this->get_news_hit_view_by_day_by_sql($id,$offset,$limit);
            }             
            if(!$list_news)
            {
                return array();
            }else{
                $this->mem_set(md5($key),$list_news,24*60*60);                
            }            
            return $list_news;
        }
        public function reset_news_hit_view_by_day($id,$offset,$limit)
        {
            $key = "hit#view#news#category{$id}#{$offset}#{$limit}";
            $list_news = $this->get_news_hit_view_by_day_by_sql($id,$offset,$limit);            
            if(!count($list_news))
            {
                return false;
            }
            $this->mem_set(md5($key),$list_news,24*60*60);
            return true;            
        }
         public function get_news_hit_view_by_week($id,$offset,$limit)
        {           
            $key = "hit#view#week#category#{$id}#{$offset}#{$limit}";
            $list_news = $this->mem_get(md5($key));
            if(!$list_news)
            {
                $list_news = $this->get_news_hit_view_by_week_by_sql($id,$offset,$limit);    
            }
            if(!$list_news)
            {
                return array();
            }else{
                $this->mem_set(md5($key),$list_news,24*60*60);                
            }            
            return $list_news;
        }
        public function reset_news_hit_view_by_week($id,$offset,$limit)
        {
            $key = "hit#view#week#category#{$id}#{$offset}#{$limit}";
            $list_news = $this->get_news_hit_view_by_week_by_sql($id,$offset,$limit);            
            if(!count($list_news))
            {
                return false;
            }
            $this->mem_set(md5($key),$list_news,24*60*60);
            return true;            
        }
        
        function get_most_hit_view_art(){
            $key = "mb#home#hitview1";
            if ($data_cache = $this->mem_get($key)){
                return $data_cache;
            }
            else{
                $data = $this->get_most_hit_view_art_sql();
                if ($data){
                    $this->mem_set($key,$data,15*60);
                }
                return $data;
            }
        }        
        public function get_hit_view_home_Sql()
        {
            $arr = array(5,199, 12, 16, 31, 34,6, 21,10);      
            $now = time();    
            $d_time = mktime(0,0,0,date('n',$now),date('j',$now),date('Y',$now));  
            $w_time_day = mktime(0,0,0,date('m'),date('d')-10,date('Y'));
            $array = array();
            foreach($arr as $val)
            {
                $data = $this->get_list("a.status =3 AND  a.public =1 AND a.timer=0 AND a.create_date_int > {$w_time_day} AND d.d_time = {$d_time} AND  ( b.category_id = {$val} OR b.parent_id = {$val})","hit_view DESC",0,1);                    
                if (isset($data[0])){
                    $array[] = $data[0];
                }
            }
            if (isset($array)){                
                return $array;
            }
            else{
                return array();
            }
        }
        public function get_hit_view_home()
        {
            $key = "hit#view#home#";
            $list_news = $this->mem_get(md5($key));
            if($list_news ==false)
            {                
                $list_news = $this->get_hit_view_home_Sql();    
            }            
            if(!count($list_news))
            {
                return array();                
            }else{
                $this->mem_set(md5($key),$list_news,15*60*60);    
            }            
            return $list_news;
        }        
        public function reset_get_hit_view_home()
        {
            $key = "hit#view#home#";           
            $list_news = $this->get_hit_view_home_Sql();
            if(!count($list_news))
            {
                return false;
            }
            $this->mem_set(md5($key),$list_news,15*60*60);
            return true;
        }        
        
        function push_most_hit_view_art(){
            $key = "mb#home#hitview";
            $data = $this->get_most_hit_view_art_sql();
            if ($data){
                $this->mem_set($key,$data,15*60);
            }
            return $data;
        }
        
        function get_most_hit_view_art_sql(){
            $arr = "(5,199, 12, 16, 31, 34,6, 21,10)";      
            $now = time();    
            $d_time = mktime(0,0,0,date('n',$now),date('j',$now),date('Y',$now));  
            $w_time_day = mktime(0,0,0,date('m'),date('d')-10,date('Y'));
            $data = $this->get_list("a.status =3 AND  a.public =1 AND a.timer=0 AND a.create_date_int > {$w_time_day} AND d.d_time = {$d_time} AND  ( b.category_id in {$arr} OR b.parent_id  in {$arr})","hit_view DESC",0,1);
            if (isset($data[0])){
                return $data[0];
            }
            else{
                return false;
            }
        }
    }
?>
