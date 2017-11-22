<?php
  class NewsUploadModel extends Model 
  {                          
      protected function do_insert($data)
      {                                  
          $this->db->insert( 'news_upload' , $data );
          return $this->db->getInsertId(); 
      }
  
      protected function do_update($data,$condition)
      {                                             
          $this->db->update( 'news_upload' , $data , $condition );
          return $this->db->getAffectedRows();
      }
  
      protected function do_delete($condition)
      {                                       
          $this->db->delete( 'news_upload', $condition );
          return $this->db->getAffectedRows();     
      }
  
      protected function do_select($condition,$order,$offset,$limit)
      {
          return $this->db->buildAndFetchAll(array(
               'select'     => '*',                
               'from'        => 'news_upload',           
               'where'         => $condition,      
               'order'        =>  $order,          
               'limit'        => array($offset,$limit)
          ));                                         
      }
      public function insert_link_upload($upload_author,$upload_url)                                               
      {
          $now = time();
          $bean = $this->create_bean();
          $bean->set("upload_author",$upload_author);
          $bean->set("upload_url",$upload_url);
          $bean->set("create_date_int",$now);
          $id= $this->insert($bean);
          return $id;
      }
  }
?>
