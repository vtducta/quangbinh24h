<?php
  class NewsHomeLogModel extends Model 
  {                          
      protected function do_insert($data)
      {                                  
          $this->db->insert( 'news_home_log' , $data );
          return $this->db->getInsertId(); 
      }
  
      protected function do_update($data,$condition)
      {                                             
          $this->db->update( 'news_home_log' , $data , $condition );
          return $this->db->getAffectedRows();
      }
  
      protected function do_delete($condition)
      {                                       
          $this->db->delete( 'news_home_log', $condition );
          return $this->db->getAffectedRows();     
      }
  
      protected function do_select($condition,$order,$offset,$limit)
      {
          return $this->db->buildAndFetchAll(array(
               'select'     => '*',                
               'from'        => 'news_home_log',           
               'where'         => $condition,      
               'order'        =>  $order,          
               'limit'        => array($offset,$limit)
          ));                                         
      }                                               
      public function insert_home_log($user_id,$news_id,$postion,$action)
      {
          $now = time();
          $bean =  $this->create_bean();
          $bean->set("user_id",$user_id);
          $bean->set("news_id",$news_id);
          $bean->set("postion",$postion);
          $bean->set("action",$action);
          $bean->set("create_time",$now);
          $this->insert($bean);
      }
  }
?>
