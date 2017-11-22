<?php
    class NewsArticlesJoinArticlesTagModel extends Model 
    {                          
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
            'select'     => 'a.id,a.title,a.intro_text,a.meta_slug,a.create_date_int,a.status,a.content_type,a.image_url as upload_url',
            'from'        => array('news_articles_view' => "a"),
            'where'         => "{$condition}",
            'order'        => "{$order}",
            'add_join'     => array(
                0 => array(
                'select' => 'b.tag_id',
                'from'   => array( 'news_articles_tag' => 'b'),   
                'where'  => 'b.articles_id = a.id ',
                'type'   => 'inner'
            )),
            'limit'        => array($offset,$limit)
            ));                                             
        }  
        public function get_list_news_tag($tag_id,$offset=0,$limit)
        {
            $key ="taglist#news#tag#{$tag_id}{$offset}{$limit}";
            $list_news = $this->mem_get(md5($key));
            if(!$list_news)
            {
                $list_news = $this->get_list("b.tag_id ={$tag_id}","a.create_date_int DESC,a.id DESC",$offset,$limit);    
            }            
            if(!$list_news)
            {
                return array();
            }else{
                $this->mem_set(md5($key),$list_news,15*60);    
            }            
            return $list_news;
        }

    }
?>
