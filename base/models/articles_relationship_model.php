<?php
  class ArticlesRelationshipModel extends Model 
  {                          
      protected function do_insert($data)
      {                                  
          $this->db->insert( 'news_articles_relationship' , $data );
          return $this->db->getInsertId(); 
      }
  
      protected function do_update($data,$condition)
      {                                             
          $this->db->update( 'news_articles_relationship' , $data , $condition );
          return $this->db->getAffectedRows();
      }
  
      protected function do_delete($condition)
      {                                       
          $this->db->delete( 'news_articles_relationship', $condition );
          return $this->db->getAffectedRows();     
      }
  
      protected function do_select($condition,$order,$offset,$limit)
      {
          return $this->db->buildAndFetchAll(array(
               'select'     => '*',                
               'from'        => 'news_articles_relationship',           
               'where'         => $condition,      
               'order'        =>  $order,          
               'limit'        => array($offset,$limit)
          ));                                         
      }                                               
      public function insert_news_relationship($id_news,$id_relation)
      {
          $bean  = $this->create_bean();
          $bean->set("articles_id",$id_news);
          $bean->set("articles_id_relationship",$id_relation);
          $id = $this->insert($bean);
          return $id;
      }
  }
?>
