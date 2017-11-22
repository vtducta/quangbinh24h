<?php
  class NewsArticlesTagModel extends Model 
  {                          
      protected function do_insert($data)
      {                                  
          $this->db->insert( 'news_articles_tag' , $data );
          return $this->db->getInsertId(); 
      }
  
      protected function do_update($data,$condition)
      {                                             
          $this->db->update( 'news_articles_tag' , $data , $condition );
          return $this->db->getAffectedRows();
      }
  
      protected function do_delete($condition)
      {                                       
          $this->db->delete( 'news_articles_tag', $condition );
          return $this->db->getAffectedRows();     
      }
  
      protected function do_select($condition,$order,$offset,$limit)
      {
          return $this->db->buildAndFetchAll(array(
               'select'     => '*',                
               'from'        => 'news_articles_tag',           
               'where'         => $condition,      
               'order'        =>  $order,          
               'limit'        => array($offset,$limit)
          ));                                         
      }                                               
      public function insert_articles_tag($tag_id,$news_id)      
      {
          $bean = $this->create_bean();
          $bean->set("tag_id",$tag_id);
          $bean->set("articles_id",$news_id);
          $id = $this->insert($bean);
          return $id;
      }
  }
?>
