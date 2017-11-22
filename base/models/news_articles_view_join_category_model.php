<?php
  class NewsArticlesViewJoinCategoryModel extends Model 
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
                'select'       => 'a.id,a.title,a.intro_text,a.creat_by,a.images,a.create_date_int,a.modified_date_int,a.status,a.meta_slug,a.public,a.timer,a.content_type',
                'from'         => array('news_articles' => 'a'),
                'where'        => $condition,              
                'order'        => $order,
                'add_join'     => array( 
                    0 => array( 
                    'select' => 'b.category_id', 
                    'from'   => array( 'news_articles_category'=>'b'),    
                    'where'  => 'a.id = b.articles_id',                  
                    'type'   => 'inner' 
                )),                            
                'limit'        => array($offset,$limit)
            ));
      }                                               
      public function get_total_news_by_category_sql($condition,$order,$offset,$limit)
      {
          return 10000;
          $total = $this->db->buildAndFetchAll(array(
                'select'       => 'count(*) as total',
                'from'         => array('news_articles' => 'a'),
                'where'        => $condition,              
                'order'        => $order,
                'add_join'     => array( 
                    0 => array( 
                    'select' => '', 
                    'from'   => array( 'news_articles_category'=>'b'),    
                    'where'  => 'a.id = b.articles_id',                  
                    'type'   => 'inner' 
                )),                            
                'limit'        => array($offset,$limit)
            ));          
          if($total)
          {
               return $total[0]['total'];
          }else{
              return 0;
          }
      }
      public function get_total_news_by_category($condition,$order,$offset,$limit)
      {
          $key = "total#news#by#category#view{$condition}";
          if($total_cache = $this->mem_get(md5($key)))
          {
            return $total_cache;    
          }
          $total = $this->get_total_news_by_category_sql($condition,$order,$offset,$limit);          
          $this->mem_set(md5($key),$total,24*3600);
          return $total;
      }
      public function admin_get_news_by_category_sql($condition,$order,$offset,$limit)
      {       
            $content = $this->get_list($condition,$order,$offset,$limit);                
            $array = array();
            if($content)
            {                    
                foreach($content as $key=>$value)   
                {
                    $array[$key] = array(
                        'id' => $value->get('id'),
                        'title' => $value->get('title'),
                        'intro_text' => $value->get('intro_text'),                    
                        'images' => $this->get_image($value->get('images')),
                        'creat_by' => $this->get_user_name($value->get('creat_by')),
                        'meta_slug' => $value->get('meta_slug'),
                        'create_date_int' => $value->get('create_date_int'),
                        'status' => $value->get('status'),
                        'public' => $value->get('public'),
                        'hotnews' => $value->get('hotnews'),
                        'category' => $this->get_name_category($value->get('id')),
                        'tags' => $this->get_tags($value->get('id')),
                        'content_type' => $value->get('content_type')                        
                    );
                }                         
                return $array;
            }else{
                return array();
            }
        }    
        
        public function get_name_category($film_id){
            $category = $this->db->buildAndFetchAll(array(
                 'select'       => 'a.title as title',
                 'from'         => array('news_category' => 'a'),
                 'where'        => "b.articles_id = {$film_id}",              
                 'order'        => "",
                 'add_join'     => array( 
                        0 => array( 
                            'select' => 'b.articles_id,b.category_id', 
                            'from'   => array( 'news_articles_category' => 'b' ),    
                            'where'  => 'b.category_id = a.id',                  
                            'type'   => 'inner' 
                         )),
                 'limit'        => array($offset,$limit)
            ));           
            if (!count($category)){
                return "Thể loại khác";
            }
            else{
                $return = "";
                foreach ($category as $item){
                    $return .= $item['title'] . ",";
                }
                $return = rtrim($return,",");
                return $return;
            }         
       }      
        public function get_tags($id)
        {
            $tags = $this->db->buildAndFetchAll(array(
                 'select'       => 'a.tag_name as tag_name',
                 'from'         => array('news_tag' => 'a'),
                 'where'        => "b.articles_id = {$id}",              
                 'order'        => "",
                 'add_join'     => array( 
                        0 => array( 
                            'select' => 'b.articles_id,b.tag_id', 
                            'from'   => array( 'news_articles_tag' => 'b' ),    
                            'where'  => 'b.tag_id = a.id',                  
                            'type'   => 'inner' 
                         )),
                 'limit'        => array($offset,$limit)
            ));            
 
            if (!$tags[0]['tag_name']){          
                return "No tags";
            }
            else{
                $return = "";
                foreach ($tags as $item){
                    $return .= $item['tag_name'] . ",";
                }                
                $return = rtrim($return,",");
                return $return;
            }         
        }
        public function get_image($id)
        {
            if(!$id) return '';
           $image =  $this->db->buildAndFetchAll(array(
                'select'     => 'a.id,a.upload_url',
                'from'        => 'news_upload as a',
                'where'         => "a.id={$id}",
                'order'        => "a.id DESC",
                'limit'        => array(0,1)
            ));                               
            if($image)
            {
                return $image[0]['upload_url'];
            }
            else{
                $image_default = 'http://admin.nguoiduatin.vn/images/noimg.gif';
                return  $image_default;
            }
        }
        public function get_user_name($id)
        {
            $user_name = $this->db->buildAndFetch(array(
                'select'     => 'a.user_id,a.username',
                'from'        => 'tm_users as a',
                'where'         => "a.user_id={$id}",
                'order'        => "a.user_id DESC",
                'limit'        => array(0,1) 
            ));            
            if($user_name)
            {
                return $user_name['username'];
            }else{
                return "No name";
            }
            
        }
      
  }
?>
