<?php
  class NewsTagModel extends Model 
  {                          
      protected function do_insert($data)
      {                                  
          $this->db->insert( 'news_tag' , $data );
          return $this->db->getInsertId(); 
      }
  
      protected function do_update($data,$condition)
      {                                             
          $this->db->update( 'news_tag' , $data , $condition );
          return $this->db->getAffectedRows();
      }
  
      protected function do_delete($condition)
      {                                       
          $this->db->delete( 'news_tag', $condition );
          return $this->db->getAffectedRows();     
      }
  
      protected function do_select($condition,$order,$offset,$limit)
      {
          return $this->db->buildAndFetchAll(array(
               'select'     => '*',                
               'from'        => 'news_tag',           
               'where'         => $condition,      
               'order'        =>  $order,          
               'limit'        => array($offset,$limit)
          ));                                         
      }                                               
      public function insert_tag($tag_name)
      {
          $templateHelper = Loader::load_helper("template_helper");
          $slug_name = $templateHelper->build_slug(trim($tag_name));
          $bean = $this->create_bean();
          $bean->set("tag_name",trim($tag_name));
          $bean->set("tag_md5",md5((strtolower(trim($tag_name)))));
          $bean->set("hits",0);
          $bean->set("tag_name2",trim($tag_name));
          $bean->set("slug_name",$slug_name);
          $bean->set("status",1);
          $id = $this->insert($bean);
          return $id;
      }
      
      public function get_total($condition="1"){
            return 10000;
            $total = $this->db->buildAndFetchAll(array(
                'select'     => 'count(*) as total',
                'from'        => 'news_tag as a',
                'where'         => $condition,
                'order'        =>  "",
                'limit'        => array()
            ));            
            if($total)
            {
                return $total[0]['total'];
            }
            else{
                 return 0;
            }
      }
        
      public function check_tag_exits($tag_name)
      {
          $tag_md5  = md5(strtolower(trim($tag_name)));
          $tag = $this->get_list("tag_md5 = '{$tag_md5}' ","id DESC",0,1);
          if($tag)
          {
              return $tag[0]->get('id');
          }else{
              return 0;
          }
      }
      
      public function check_tag_exits1($tag_name)
      {
          $tag_md5  = md5(strtolower(trim($tag_name)));
          $tag = $this->get_list("tag_md5 = '{$tag_md5}' ","id DESC",0,1);
          if($tag)
          {
              $name = $tag[0]['tag_name'];
              $name = stripslashes($name);
              $tag_md5_ = md5((strtolower($name)));
              if($tag_md5!=$tag_md5_){
                  $bean = $this->create_bean();
                  $bean->set("tag_md5",$tag_md5_);
                  $this->update($bean,"id={$tag[0]->get('id')}");  
                  return 0;  
              }
              return $tag[0]->get('id');
          }else{
              return 0;
          }
      }
  }
?>
