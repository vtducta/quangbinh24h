<?php
    class NewsArticlesCategoryViewModel extends Model 
    {                          
        protected function do_insert($data)
        {                                  
            $this->db->insert( 'news_articles_category_view' , $data );
            return $this->db->getInsertId(); 
        }

        protected function do_update($data,$condition)
        {                                             
            $this->db->update( 'news_articles_category_view' , $data , $condition );
            return $this->db->getAffectedRows();
        }

        protected function do_delete($condition)
        {                                       
            $this->db->delete( 'news_articles_category_view', $condition );
            return $this->db->getAffectedRows();     
        }

        protected function do_select($condition,$order,$offset,$limit)
        {
            return $this->db->buildAndFetchAll(array(
                'select'     => '*',                
                'from'        => 'news_articles_category_view',           
                'where'         => $condition,      
                'order'        =>  $order,          
                'limit'        => array($offset,$limit)
            ));                                         
        }                                               
        public function push_news_category_view($news_id)
        {
            $news_articles_category_view_model = Loader::load_model("news_articles_category_view");

            $result = $this->db->buildAndFetchAll(array(
                'select'       => 'a.id, a.articles_id,a.category_id',
                'from'         => array('news_articles_category' => 'a'),
                'where'        => "a.articles_id = {$news_id}",              
                'order'        => "",
                'add_join'     => array( 
                    0 => array( 
                        'select' => 'b.parent_id,b.status', 
                        'from'   => array( 'news_category' => 'b' ),    
                        'where'  => 'b.id = a.category_id',                  
                        'type'   => 'inner' 
                ))                 
            )); 
            if(!count($result))
            {
                return '';
            }

            $news_articles_category_view_model->delete("articles_id ={$news_id}");  
            $this->delete("articles_id ={$news_id}");  

            $this->news_articles_view = Loader::load_model("news_articles_view");
            $_art    = $this->news_articles_view->get_once("id={$news_id}");

            $_tmp = array();
            foreach($result as $key=>$value)
            {
                if(!in_array($value["category_id"],$_tmp)){
                    $bean = $this->create_bean();
                    $bean->set('id',$value['id']);
                    $bean->set('articles_id',$value['articles_id']);
                    $bean->set('category_id',$value['category_id']);
                    $bean->set('parent_id',$value['parent_id']);
                    if($_art)
                        $bean->set('create_date_int',$_art->get("create_date_int"));
                    $bean->set('status',$value['status']);
                    $this->insert($bean);

                    $_tmp[] = $value["category_id"];   
                }           
            }         
        }
        public function get_category_articles($id)
        {
            $key = get_class($this)."news#category#articles11#{$id}";
            $category = array();// $this->mem_get(md5($key));
            if(!$category){         
                $category = $this->get_list("articles_id={$id}","id DESC",0,1);            
            }                    
            if(!$category)
            {
                return array();
            }else{
                $this->mem_set(md5($key),$category,24*60*60);              
            }
            return $category;         
        }

    }
?>
