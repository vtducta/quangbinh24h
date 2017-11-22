<?php
  class NewsArticlesSourceModel extends Model 
  {                          
      protected function do_insert($data)
      {                                  
          $this->db->insert( 'news_articles_source' , $data );
          return $this->db->getInsertId(); 
      }
  
      protected function do_update($data,$condition)
      {                                             
          $this->db->update( 'news_articles_source' , $data , $condition );
          return $this->db->getAffectedRows();
      }
  
      protected function do_delete($condition)
      {                                       
          $this->db->delete( 'news_articles_source', $condition );
          return $this->db->getAffectedRows();     
      }
  
      protected function do_select($condition,$order,$offset,$limit)
      {
          return $this->db->buildAndFetchAll(array(
               'select'     => '*',                
               'from'        => 'news_articles_source',           
               'where'         => $condition,      
               'order'        =>  $order,          
               'limit'        => array($offset,$limit)
          ));                                         
      }     
                                                
      public function get_total($condition="1")
        {
            return 10000;
            $total = $this->db->buildAndFetchAll(array(
                'select'     => 'count(*) as total',
                'from'        => 'news_articles_source as a',
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
        
        public function get_list_source($limit=30,$offset=0,$cache=true){
            $key = "news#total##get_list_source#{$limit}#{$offset}";              
            if($cache)
            { 
                $memcache = $this->mem_get(md5($key));
                if($memcache)
                    return $memcache;
            }else{               
                $total = $this->get_list("status=1","`id` desc",$offset,$limit);                            
                $this->mem_set(md5($key),$total,24*3600*10);                
            }
             return $total;
        }
  }
?>
