<?php
class NewsArticlesRelationshipModel extends Model

{

    protected function do_insert($data){
    }

    protected function do_update($data,$condition){
    }

    protected function do_delete($condition){
    }

    protected function do_select($condition,$order,$offset,$limit){
        return $this->db->buildAndFetchAll(array(

            'select'     => 'a.id as id, a.title as title,a.intro_text as intro_text, 3 as status,a.public as public,a.create_date_int as create_date_int,a.meta_slug as meta_slug,a.image_url as upload_url',
            'from'        => array('news_articles_view' => "a"),
            'where'         => $condition,
            'add_join'     => array( 
                0 => array( 
                    'select' => '', 
                    'from'   => array( 'news_articles_relationship' => 'b'),    
                    'where'  => 'b.articles_id_relationship = a.id ',                  
                    'type'   => 'inner' 
                )
            ),
            'order'        =>  $order,
            'limit'        => array($offset,$limit)
        ));
    }
    
    public function get_relationship_art_by_new($id,$limit){
        $data = $this->get_list("b.articles_id = {$id}","",0,$limit);
        return $data;
    }
    
    /**
    * get news relationshop by id
    * @author hoangbv
    * @param mixed $id
    * @param mixed $limit
    * @return array
    */
    public function get_news_relationship_by_id($id,$limit=5)
    {   
        $limit = 5;
        $key = "news#relationshipsss#{$id}#{$limit}";
        $list_news = $this->mem_get(md5($key)); 
        
        if(!$list_news)
        {              
            $list_news = $this->get_list("b.articles_id = {$id}","",0,5);    
        }        
        if(!$list_news)
        {
            return array();
        }else{
            $this->mem_set(md5($key),$list_news,3600*24*7);    
        }        
        return $list_news;
    }
    
    /**
    * reset get news relationship by id
    * @author hoangbv
    * @param mixed $id
    * @param mixed $limit
    */
    public function reset_get_news_relationship_by_id($id,$limit)
    {   
    $limit= 5;     
        $key = "news#relationshipsss#{$id}#{$limit}";        
        $list_news = $this->get_list("b.articles_id = {$id}","",0,5);    
        if(!$list_news)
        {
            return false;
        }        
        $this->mem_set(md5($key),$list_news,3600*24*7);            
        return true;
    }
}
?>
