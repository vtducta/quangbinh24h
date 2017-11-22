<?php
  class HitViewDayModel extends Model 
  {                          
      protected function do_insert($data)
      {                                  
          $this->db->insert( 'hit_view_day' , $data );
          return $this->db->getInsertId(); 
      }
  
      protected function do_update($data,$condition)
      {                                             
          $this->db->update( 'hit_view_day' , $data , $condition );
          return $this->db->getAffectedRows();
      }
  
      protected function do_delete($condition)
      {                                       
          $this->db->delete( 'hit_view_day', $condition );
          return $this->db->getAffectedRows();     
      }
  
      protected function do_select($condition,$order,$offset,$limit)
      {
          return $this->db->buildAndFetchAll(array(
               'select'     => '*',                
               'from'        => 'hit_view_day',           
               'where'         => $condition,      
               'order'        =>  $order,          
               'limit'        => array($offset,$limit)
          ));                                         
      }
      public function insert_hit_view_day($d_time,$news_id,$total_hit)
      {
          $bean = $this->create_bean();
          $bean->set("d_time",$d_time);
          $bean->set("news_id",$news_id);
          $bean->set("total_hit",$total_hit);
          $id = $this->insert($bean);
          return $id;
      }
      public function update_hit_view_day($d_time,$news_id,$total_hit)
      {
          $bean = $this->create_bean();
          $bean->set("total_hit",$total_hit);       
          $this->update($bean,"news_id={$news_id}");
          return true;
      }
      public function check_hit_view_day($d_time,$news_id)
      {
          $key = "ndt#check#hit#view#day#{$news_id}";
          $result = $this->mem_get(md5($key));
          if(empty($result))
          {
            $result = $this->get_once("d_time={$d_time} AND news_id ={$news_id}");
            $this->mem_set(md5($key),$result,60);             
          }
          return $result;
      }
                                                     
  }
?>
