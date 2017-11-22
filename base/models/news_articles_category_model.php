<?php
  class NewsArticlesCategoryModel extends Model 
  {                          
      protected function do_insert($data)
      {                                  
          $this->db->insert( 'news_articles_category' , $data );
          return $this->db->getInsertId(); 
      }
  
      protected function do_update($data,$condition)
      {                                             
          $this->db->update( 'news_articles_category' , $data , $condition );
          return $this->db->getAffectedRows();
      }
  
      protected function do_delete($condition)
      {                                       
          $this->db->delete( 'news_articles_category', $condition );
          return $this->db->getAffectedRows();     
      }
  
      protected function do_select($condition,$order,$offset,$limit)
      {
          return $this->db->buildAndFetchAll(array(
               'select'     => '*',                
               'from'        => 'news_articles_category',           
               'where'         => $condition,      
               'order'        =>  $order,          
               'limit'        => array($offset,$limit)
          ));                                         
      }                                                           
      public function insert_articles_category($category_id,$id_news)
      {
          $now = time();
          $bean = $this->create_bean();
          $bean->set("category_id",$category_id);
          $bean->set("articles_id",$id_news);
          $bean->set("creat_time",$now);   
          $id = $this->insert($bean);
          return $id;
      }
      public function get_cat_seleted($id)
      {
          $cat_selected = $this->get_list("articles_id= {$id}","",0,"");
          $item = array();
          if($cat_selected)
          {
              $i=0;
              foreach($cat_selected as $k=>$v)
              {
                $item[$i]= $v->get('category_id');  
                $i++;
              }               
              return $item;
          }
          return array();
      }
  }
?>
