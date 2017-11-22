<?php
    class JournalistModel extends Model 
    {                          
        protected function do_insert($data)
        {                                  
            $this->db->insert( 'journalist' , $data );
            return $this->db->getInsertId(); 
        }

        protected function do_update($data,$condition)
        {                                             
            $this->db->update( 'journalist' , $data , $condition );
            return $this->db->getAffectedRows();
        }

        protected function do_delete($condition)
        {                                       
            $this->db->delete( 'journalist', $condition );
            return $this->db->getAffectedRows();     
        }

        protected function do_select($condition,$order,$offset,$limit)
        {
            return $this->db->buildAndFetchAll(array(
            'select'     => '*',                
            'from'        => 'journalist',           
            'where'         => $condition,      
            'order'        =>  $order,          
            'limit'        => array($offset,$limit)
            ));                                         
        }   
        
        public function insert_journalist($info)
        {
            $bean = $this->create_bean();
            foreach ($info as $key=>$val) {
                if (is_string($val)) $val = stripcslashes($val);
                $bean->set($key, $val);
            }
            $this->insert($bean);
            return $this->db->getInsertId();
        }
        
        public function update_journalist($update_info, $id) {
            $bean = $this->create_bean();
            foreach ($update_info as $key=>$val) {                
                if (is_string($val)) $val = stripcslashes($val);
                $bean->set($key, $val);
            }
            $this->update($bean, "id=$id");
        }
        
        public function delete_journalist($id) {
            $this->delete("id=$id");
        }
        
        public function get_list_journalist($condition, $order, $offset, $limit)
        {
            $result = $this->get_list($condition, $order, $offset, $limit);
            foreach ($result as $key=>$val) {
                $result[$key] = $val->to_array();
            }
            return $result;
        }
        
        public function check_valid_journalist($email, $pen_name)
        {
            $check = $this->get_once("`email`='$email' AND `pen_name`='$pen_name'");
            if (isset($check)) {
                return $check->get('id');
            }
            return 0;
        }
        
        public function get_journalist_by_id($id)
        {
            $result = $this->get_once("id=$id");
            if (isset($result)) {
                return $result->to_array();
            }
            return array();
        }
        
        public function get_total_journalist($condition)
        {
            $result = $this->db->buildAndFetchAll(array(
                'select' => 'sum(cnt) as total',
                'from' => 'journalist',
                'where' => $condition
            ));
            if (isset($result[0]))
                return $result[0]['total'];
            return 0;
        }
        
        public function search_journalist($keyword, $num)
        {
            $result = $this->db->buildAndFetchAll(array(
                'select' => '*',
                'from' => 'journalist',
                'where' => "full_name LIKE '%$keyword%' OR pen_name LIKE '%$keyword%'",
                'order' => "id",
                'limit' => $num
            ));
            if (isset($result[0]))
                return $result;
            return array();
        }
    }
?>
