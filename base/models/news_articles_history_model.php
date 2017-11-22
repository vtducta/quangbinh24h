<?php
  class NewsArticlesHistoryModel extends Model 
  {                          
      protected function do_insert($data)
      {                                  
          $this->db->insert( 'news_articles_history' , $data );
          return $this->db->getInsertId(); 
      }
  
      protected function do_update($data,$condition)
      {                                             
          $this->db->update( 'news_articles_history' , $data , $condition );
          return $this->db->getAffectedRows();
      }
  
      protected function do_delete($condition)
      {                                       
          $this->db->delete( 'news_articles_history', $condition );
          return $this->db->getAffectedRows();     
      }
  
      protected function do_select($condition,$order,$offset,$limit)
      {
          return $this->db->buildAndFetchAll(array(
               'select'     => '*',                
               'from'        => 'news_articles_history',           
               'where'         => $condition,      
               'order'        =>  $order,          
               'limit'        => array($offset,$limit)
          ));                                         
      }                                                     
      public function insert_history($news_id,$title,$intro_text,$content_text,$images,$modified_by,$meta_slug,$meta_title,$meta_keywork,$meta_description,$status,$public,$timer)      
      {
          $bean = $this->create_bean();
          $bean->set("article_id",$news_id);
          $bean->set("title",$title);
          $bean->set("images",$images);
          $bean->set("modified_by",$modified_by);
          $bean->set("intro_text",$intro_text);
          $bean->set("content_text",$content_text);
          $bean->set("modified_date_int",time());
          $bean->set("meta_slug",$meta_slug);
          $bean->set("meta_title",$meta_title);
          $bean->set("meta_keywork",$meta_keywork);
          $bean->set("meta_description",$meta_description);
          $bean->set("status",$status);
          $bean->set("public",$public);
          $bean->set("timer",$timer);                
          $this->insert($bean);
          return true;
      }
  }
?>
