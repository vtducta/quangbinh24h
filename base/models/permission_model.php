<?php  
class PermissionModel extends Model 
{                          
    protected function do_insert($data)
    {                                  
        $this->db->insert( 'table' , $data );
        return $this->db->getInsertId(); 
    }

    protected function do_update($data,$condition)
    {                                             
        $this->db->update( 'table' , $data , $condition );
        return $this->db->getAffectedRows();
    }

    protected function do_delete($condition)
    {                                       
        $this->db->delete( 'table', $condition );
        return $this->db->getAffectedRows();     
    }

    protected function do_select($condition,$order,$offset,$limit)
    {
        return $this->db->buildAndFetchAll(array(
             'select'     => '*',                
             'from'        => 'tm_user',           
             'where'         => $condition,      
             'order'        =>  $order,          
             'limit'        => array($offset,$limit)
        ));                                         
    }                                               
    public function check_permission($user_id,$group)
    {
        $group_user = $this->get_user_permision($user_id); 
     
        if(!$group_user)
        {
            $group_user = $this->get_group_user($user_id);
        }       
        if(!$group_user)
        {
            die("session expire !");
        }
        if(is_array($group))
        { 
            if(in_array($group_user,$group)){
                return true;
            }
            return false;
        }else{
              if($group_user == $group)
             {
                    return true;
             }
             return false;
        }
    }
    
    public function get_user_permision($id)
    {
        $now = time();
        $permission = $this->db->buildAndFetch(array(
            'select' => '*',
            'from' => 'tm_user_permissions',
            'where' => "user_id={$id} AND ({$now}>= start_time  AND {$now} <= end_time)",                        
            'order' => '',
            'limit' => array(0,1)
        )); 
        if($permission)
        {
            return $permission['group_user'];
        }else{
            return 0;
        }
    }
    public function get_group_user($id)
    {
        $group = $this->db->buildAndFetch(array(
            'select' => '*',
            'from' => 'tm_group_user',
            'where' => "user_id ={$id}",
            'order' => '',
            'limit' => array(0,1)
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
