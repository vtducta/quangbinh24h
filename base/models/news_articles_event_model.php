<?php
  class NewsArticlesEventModel extends Model 
  {                          
      protected function do_insert($data)
      {                                  
          $this->db->insert( 'news_articles_event' , $data );
          return $this->db->getInsertId(); 
      }
  
      protected function do_update($data,$condition)
      {                                             
          $this->db->update( 'news_aricles_event' , $data , $condition );
          return $this->db->getAffectedRows();
      }
  
      protected function do_delete($condition)
      {                                       
          $this->db->delete( 'news_articles_event', $condition );
          return $this->db->getAffectedRows();     
      }
  
      protected function do_select($condition,$order,$offset,$limit)
      {
          return $this->db->buildAndFetchAll(array(
               'select'     => '*',                
               'from'        => 'news_articles_event',           
               'where'         => $condition,      
               'order'        =>  $order,          
               'limit'        => array($offset,$limit)
          ));                                         
      }                                               
      public function insert_articles_event($event_id,$news_id)
      {
          $bean = $this->create_bean();
          $bean->set("event_id",$event_id);
          $bean->set("articles_id",$news_id);
          $id = $this->insert($bean);
          return $id;
      }
      public function get_total_news_by_event($id)
      {
          $total = $this->db->buildAndFetch(array(
            'select' => 'count(a.id) as total',
            'from' => 'news_articles_event as a',
            'where' => "event_id ={$id}"
          ));        
          return $total['total'];
      }
      
      public function get_event_by_article($art_id){
          $this->news_event_model = Loader::load_model("news_event");
          $cat_selected = $this->get_list("articles_id= {$art_id}","",0,"");
          $result = array();
          foreach($cat_selected as $item){
              $event = $this->news_event_model->get_event($item->get("event_id"));
              if($event)
                $result[] = $event;    
          }
          return $result;  
      }
      public function get_event_seleted($id)
      {
          $cat_selected = $this->get_list("articles_id= {$id}","",0,"");
          $item = array();
          if($cat_selected)
          {
              $i=0;
              foreach($cat_selected as $k=>$v)
              {
                $item[$i]= $v->get('event_id');  
                $i++;
              }               
              return $item;
          }
          return array();
      }            
      public function get_articles_id($event_id)
      {          
            $result = $this->db->buildAndFetch(array(
                'select' => 'a.*',
                'from' => 'news_articles_event as a',
                'where' => "a.event_id ={$event_id}",
                'order by' => "a.id DESC"
              ));                 
         
            if(!count($result))
            {
                return null;
            }            
            return $result['articles_id'];
      }
      public function get_thumb($id)
      {
          $result = $this->db->buildAndFetch(array(
            'select' => 'a.title',
            'from' => array('news_articles_view' => "a"),
            'where' => "a.id ={$id}",
            'add_join'     => array( 
                    0 => array( 
                        'select' => 'c.upload_url', 
                        'from'   => array('news_upload' => "c"),    
                        'where'  => 'c.id = a.images',                  
                        'type'   => 'inner' 
                    )
                ),
                'order'        =>  $order,
                'limit'        => array(0,1)
            ));            
            if(!count($result))
            {
                return null;
            }
            return $result['upload_url'];
      }
  }
?>
