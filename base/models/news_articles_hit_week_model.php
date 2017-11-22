<?php
    class NewsArticlesHitWeekModel extends Model
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

            'select'     => 'a.id as id, a.title as title,a.intro_text as intro_text,a.status as status,a.content_type,a.public as public,a.create_date_int as create_date_int,a.meta_slug as meta_slug,a.image_url as upload_url,d.total_hit as total_hit',
            'from'        => array('news_articles_view' => "a"),
            'where'         => $condition,
            'add_join'     => array( 
                0 => array( 
                    'select' => '', 
                    'from'   => array( 'news_articles_category_view' => 'b',"hit_view_week" => 'd'),    
                    'where'  => 'b.articles_id = a.id AND d.news_id = a.id',                  
                    'type'   => 'inner' 
                )
            ),            
            'order'        =>  $order,
            'limit'        => array($offset,$limit)
            ));                              
            return $data;

        } 
        /**
        * function get news hit view by week by sql
        * @author hoangbv
        * @param mixed $id
        * @param mixed $offset
        * @param mixed $limit
        * @return array
        */       
        public function get_news_hit_view_by_week_by_sql($id,$offset,$limit)
        {
            $now = time();                
            $w_time = mktime(0,0,0,date('n',$now),date('j',$now)-date('N',$now)+1,date('Y',$now));    
          //  $w_time_day = "";  
            
                $w_time_day = mktime(0,0,0,date('m'),date('d')-2,date('Y'));
                                                 
            $result = $this->get_list("a.status=3 AND  a.public=1 AND a.timer=0 AND a.create_date_int > {$w_time_day} AND d.w_time = {$w_time} AND  ( b.category_id = {$id} OR b.parent_id ={$id})","total_hit DESC",$offset,$limit);
            return $result;      
        }
        /**
        * get news hit view by week
        * @author hoangbv
        * @param mixed $id
        * @param mixed $offset
        * @param mixed $limit
        * @return array
        */
        public function get_news_hit_view_by_week($id,$offset,$limit)
        {           
            $key = "hit#view#art#by#week#categoryde#{$id}#{$offset}#{$limit}";
            $list_news = $this->mem_get(md5($key));                 
            if($list_news ==false)
            {
                $list_news = $this->get_news_hit_view_by_week_by_sql($id,$offset,$limit);    
            }
            if(!$list_news)
            {
                return array();
            }else{
                $this->mem_set(md5($key),$list_news,3600*24*30);                
            }            
            return $list_news;
        }
        /**
        * reset news hit view by week
        * @author hoangbv
        * @param mixed $id
        * @param mixed $offset
        * @param mixed $limit
        */
        public function reset_news_hit_view_by_week($id,$offset,$limit)
        {            
            $key = "hit#view#art#by#week#categoryde#{$id}#{$offset}#{$limit}";
            $list_news = $this->get_news_hit_view_by_week_by_sql($id,$offset,$limit);            
            if(!count($list_news))
            {
                return false;
            }
            $this->mem_set(md5($key),$list_news,3600*24*30);
            return true;            
        }
    }
?>