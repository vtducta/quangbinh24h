<?php
  class HitViewWeekModel extends Model 
  {                          
      protected function do_insert($data)
      {                                  
          $this->db->insert( 'hit_view_week' , $data );
          return $this->db->getInsertId(); 
      }
  
      protected function do_update($data,$condition)
      {                                             
          $this->db->update( 'hit_view_week' , $data , $condition );
          return $this->db->getAffectedRows();
      }
  
      protected function do_delete($condition)
      {                                       
          $this->db->delete( 'hit_view_week', $condition );
          return $this->db->getAffectedRows();     
      }
  
      protected function do_select($condition,$order,$offset,$limit)
      {
          return $this->db->buildAndFetchAll(array(
               'select'     => '*',                
               'from'        => 'hit_view_week',           
               'where'         => $condition,      
               'order'        =>  $order,          
               'limit'        => array($offset,$limit)
          ));                                         
      } 
      
      public function insert_hit_view_week($w_time,$news_id,$total_hit)
      {
          $bean = $this->create_bean();
          $bean->set("w_time",$w_time);
          $bean->set("news_id",$news_id);
          $bean->set("total_hit",$total_hit);
          $id = $this->insert($bean);
          return $id;
      }
      public function update_hit_view_week($w_time,$news_id,$total_hit)
      {
          $bean = $this->create_bean();
          $bean->set("total_hit",$total_hit);
          $this->update($bean,"news_id={$news_id} AND w_time={$w_time}");
          return true;
      }
      public function check_hit_view_week($w_time,$news_id)
      {
          $result = $this->get_once("w_time={$w_time} AND news_id ={$news_id}");          
          return $result;
      } 
                                                   
  }
?>
