<?php
    class NewsEventArticlesModel extends Model

    {

        protected function do_insert($data){          
        }

        protected function do_update($data,$condition){
        }

        protected function do_delete($condition){
        }

        protected function do_select($condition,$order,$offset,$limit){
            $return = $this->db->buildAndFetchAll(array(
                'select'     => 'a.id as id, a.title as title,a.intro_text as intro_text,a.status as status,a.content_type,a.public as public,a.create_date_int as create_date_int,a.meta_slug as meta_slug,a.image_url as upload_url,d.title as category',
                'from'        => array('news_articles_view' => "a"),
                'where'         => $condition,
                'add_join'     => array( 
                    0 => array( 
                        'select' => '', 
                        'from'   => array( 'news_articles_category_view' => 'b',"news_category" => 'd','news_articles_event'=>'e'),    
                        'where'  => 'b.articles_id = a.id AND d.id = b.category_id AND e.articles_id = a.id',                  
                        'type'   => 'inner' 
                    )
                ),
                'order'        =>  $order,
                'limit'        => array($offset,$limit)
            ));
            return $return;
        }     
        
        public function check_art_event($art_id,$event_id){
            $key = "check_art_event_{$art_id}#{$event_id}";
            $key = md5($key);
            $check = $this->mem_get($key);
            if(is_numeric($check))
            {
                return $check;
            }
            
            $check = $this->get_list("a.id = {$art_id} and a.status = 3 AND a.public = 1 AND a.timer = 0 AND e.event_id = {$event_id}","a.create_date_int desc",0,1);
            if(!$check)
            {
                $check = -1;
            }else
                $check = 1;
                
            $this->mem_set($key,$check,5*60);
            return $check;        
        }  
        
        public function get_art_by_event($id,$limit =20,$offset=0){
            $data = $this->get_list("a.status = 3 AND a.public = 1 AND a.timer = 0 AND e.event_id = {$id}","a.create_date_int desc",$offset,$limit);
            return $data;
        }
        public function get_artilces_event($id,$limit,$offset=0)
        {           
            $key = "list#eventsa#{$id}#{$limit}{$offset}";
            if($list_event = $this->mem_get(md5($key)))
            {
                return $list_event;
            }
            $list_event = $this->get_art_by_event($id,$limit,$offset);
            if(!$list_event)
            {
                return null;
            }
            $this->mem_set(md5($key),$list_event,3*60);
            return $list_event;
        }
        public function reset_get_artilces_event($id,$limit,$offset=0)
        {
            $key = "list#eventsa#{$id}#{$limit}{$offset}"; 
            $list_event = $this->get_art_by_event($id,$limit,$offset);
            if(!$list_event)
            {
                return false;
            }
            $this->mem_set(md5($key),$list_event,3*60);
            return true;            
        }
        public function get_current_category($id){
            $list_category = $this->db->buildAndFetchAll(array(
                'select'       => 'a.title as title,a.meta_slug',
                'from'         => array('news_category' => 'a'),
                'where'        => "b.articles_id = {$id}",              
                'order'        => "",
                'add_join'     => array( 
                0 => array( 
                    'select' => 'b.articles_id,b.category_id,b.parent_id', 
                    'from'   => array( 'news_articles_category_view' => 'b' ),    
                    'where'  => 'b.category_id = a.id',                  
                    'type'   => 'inner' 
                )),
                'limit'        => array(0,1)
            ));
            if (!count($list_category)){
                return array("title" => "Thể loại khác","meta_slug"=>"the-loai-khac");
            }
            else{
                $list_category[0]['parent_id'] = $this->get_parent_category($list_category[0]['parent_id']);
                return $list_category[0];
            }            
        }
        public function get_parent_category($id){
            $category_parent = $this->db->buildAndFetchAll(array(
                'select'       => 'a.title as title,a.meta_slug',
                'from'         => array('news_category' => 'a'),
                'where'        => "a.id = {$id}",              
                'order'        => "",              
                'limit'        => array(0,1)
            ));
            if (!count($category_parent)){
                return null;
            }
            else{                
                return $category_parent[0];
            }            
        }

    }
?>