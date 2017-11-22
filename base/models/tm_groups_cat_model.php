<?php
  class TmGroupsCatModel extends Model 
  {                          
      protected function do_insert($data)
      {                                  
          $this->db->insert( 'tm_groups_cat' , $data );
          return $this->db->getInsertId(); 
      }
  
      protected function do_update($data,$condition)
      {                                             
          $this->db->update( 'tm_groups_cat' , $data , $condition );
          return $this->db->getAffectedRows();
      }
  
      protected function do_delete($condition)
      {                                       
          $this->db->delete( 'tm_groups_cat', $condition );
          return $this->db->getAffectedRows();     
      }
  
      protected function do_select($condition,$order,$offset,$limit)
      {
          return $this->db->buildAndFetchAll(array(
               'select'     => '*',                
               'from'        => 'tm_groups_cat',           
               'where'         => $condition,      
               'order'        =>  $order,          
               'limit'        => array($offset,$limit)
          ));                                         
      }                                               
      public function get_list_cat_user($user_id)
      {
            $list_cat =  $this->get_list("user_id ={$user_id}","id ASC",0,"");
            $array = array();
            if($list_cat)
            {
                foreach($list_cat as $key=>$val)
                {
                    $array[] = $val->get('cat_id');                    
                }                
                return $array;
            }
            return array();
      }
      public function insert_cat($user_id,$cat)
      {
          $bean = $this->create_bean();
          $bean->set("user_id",$user_id);
          $bean->set("cat_id",$cat);
          $id = $this->insert($bean);
          return $id;
      }
      public function list_cat_user($user_id)
      {
            $list_cat =  $this->get_list("user_id ={$user_id}","id ASC",0,"");
            $item ='';
            if($list_cat)
            {
                foreach($list_cat as $key=>$val)
                {
                    $item .= $val->get('cat_id').',';                    
                }                                
                $item = substr($item,0,-1);
                return $item;
            }else{
                return '';
            }
      }
  }
?>
