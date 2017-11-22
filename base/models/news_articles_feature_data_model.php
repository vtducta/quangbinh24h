<?php
  class NewsArticlesFeatureDataModel extends Model 
  {                          
      protected function do_insert($data)
      {                                  
          $this->db->insert( 'news_articles_feature_data' , $data );
          return $this->db->getInsertId(); 
      }
  
      protected function do_update($data,$condition)
      {                                             
          $this->db->update( 'news_articles_feature_data' , $data , $condition );
          return $this->db->getAffectedRows();
      }
  
      protected function do_delete($condition)
      {                                       
          $this->db->delete( 'news_articles_feature_data', $condition );
          return $this->db->getAffectedRows();     
      }
  
      protected function do_select($condition,$order,$offset,$limit)
      {
          return $this->db->buildAndFetchAll(array(
               'select'     => '*',                
               'from'        => 'news_articles_feature_data',           
               'where'         => $condition,      
               'order'        =>  $order,          
               'limit'        => array($offset,$limit)
          ));                                         
      }
      public function insert_feature($feature_id,$news_id)
      {
          $bean = $this->create_bean();
          $bean->set('feature_id',$feature_id);
          $bean->set('news_id',$news_id);
          $this->insert($bean);          
      }
      public function get_feature_data($id)
      {
          $key = get_class($this)."feature#data#{$id}";
          $feature_data = $this->mem_get(md5($key));
          if(!$feature_data)
          {
            $feature_data = $this->get_list("feature_id ={$id}","id DESC",0,1);              
          }
          if(!count($feature_data))
          {
              return array();
          }else{
                $this->mem_set(md5($key),$feature_data,0.4*60);    
          }
          return $feature_data;
      }
      public function reset_get_feature_date($id)
      {
          $key = get_class($this)."feature#data#{$id}";          
          $feature_data = $this->get_list("feature_id ={$id}","id DESC",0,1);          
          if(!$feature_data)
          {
              return false;
          }
          $this->mem_set(md5($key),$feature_data,0.4*60);
          return $feature_data;
      }
  }
?>
