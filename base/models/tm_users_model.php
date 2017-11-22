<?php
  class TmUsersModel extends Model 
  {                          
      protected function do_insert($data)
      {                                  
          $this->db->insert( 'tm_users' , $data );
          return $this->db->getInsertId(); 
      }
  
      protected function do_update($data,$condition)
      {                                             
          $this->db->update( 'tm_users' , $data , $condition );
          return $this->db->getAffectedRows();
      }
  
      protected function do_delete($condition)
      {                                       
          $this->db->delete( 'tm_users', $condition );
          return $this->db->getAffectedRows();     
      }
  
      protected function do_select($condition,$order,$offset,$limit)
      {
          return $this->db->buildAndFetchAll(array(
               'select'     => '*',                
               'from'        => 'tm_users',           
               'where'         => $condition,      
               'order'        =>  $order,          
               'limit'        => array($offset,$limit)
          ));                                         
      }                                               
      public function get_groups_user($id)
      {
          $group = $this->db->buildAndFetch(array(
                'select'=> '*',
                'from' => 'tm_group_user',
                'where' => "user_id ={$id}",
                'limit'        => array(0,1)
          ));         
          if($group)
          {
              return $group['group_id'];
          }else{
              return 0;
          }
      }
  }
?>
