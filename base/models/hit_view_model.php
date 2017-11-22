<?php
  class HitViewModel extends Model 
  {                          
      protected function do_insert($data)
      {                                  
          $this->db->insert( 'hit_view' , $data );
          return $this->db->getInsertId(); 
      }
  
      protected function do_update($data,$condition)
      {                                             
          $this->db->update( 'hit_view' , $data , $condition );
          return $this->db->getAffectedRows();
      }
  
      protected function do_delete($condition)
      {                                       
          $this->db->delete( 'hit_view', $condition );
          return $this->db->getAffectedRows();     
      }
  
      protected function do_select($condition,$order,$offset,$limit)
      {
          return $this->db->buildAndFetchAll(array(
               'select'     => '*',                
               'from'        => 'hit_view',           
               'where'         => $condition,      
               'order'        =>  $order,          
               'limit'        => array($offset,$limit)
          ));                                         
      } 
      public function optimize()                                              
      {
          $this->db->optimize("hit_view");
      }      
      public function get_hit_view_by_condition($conditions,$offset,$limit)
      {
           $result = $this->db->buildAndFetchAll(array(
            'select' => '*,SUM(hit_view) as hit',
            'from' => 'hit_view',
            'where' => "{$conditions}",
            'group' => "news_id",
            'order' => 'hit DESC',            
            'limit' => array($offset,$limit)
           ));
           return $result;
      }
  }
?>
