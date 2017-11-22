<?php
  class NewsTagJoinArticlesTagModel extends Model 
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
  
      protected function do_select($condition,$order,$offset=0,$limit=50)
      {
          return $this->db->buildAndFetchAll(array(
               'select'     => 'a.*',                
               'from'        => array('news_tag' => 'a'),
               'where'         => $condition,      
               'add_join'     => array( 
                    0 => array( 
                        'select' => 'b.articles_id,b.tag_id', 
                        'from'   => array( 'news_articles_tag' => 'b'),    
                        'where'  => 'a.id=b.tag_id',                  
                        'type'   => 'inner' 
                    )
                ),
               'order'        =>  $order,          
               'limit'        => array($offset,$limit)
          ));                                         
      }                                                     
      public function get_list_tag_art($id)
      {
          $key= "tag1#articles#{$id}3433";
          $list_tag = $this->mem_get(md5($key));
          if($list_tag==false)
          {
            $list_tag = $this->get_list("b.articles_id={$id} and a.status=1","a.id DESC",0,20);    
          }          
          if(!$list_tag)
          {
              return null;
          }else{
            $this->mem_set(md5($key),$list_tag,60);    
          }          
          return $list_tag;
      }
      
      public function get_list_tag($id,$limit)
      {
          $list_tag = $this->get_list("b.articles_id ={$id} and a.status=1","",0,$limit);
          $return ='';
          if($list_tag)
          {
                foreach($list_tag as $key=>$value)   
                {
                    $return .=  $value->get('tag_name').",";
                }
                $return = substr($return,0,-1);
                return $return;
          }
          return '';
      }
  }
?>
