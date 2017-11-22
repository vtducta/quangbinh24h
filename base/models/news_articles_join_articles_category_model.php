<?php
    class NewsArticlesJoinArticlesCategoryModel extends Model 
    {   
        public function __construct(){
            parent::__construct();
            $this->template_helper = Loader::load_helper("template_helper");
        }
                               
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
                'select'       => 'a.id,a.title,a.intro_text,a.creat_by,a.modified_by,a.meta_slug,a.create_date_int,a.status,a.public,a.hotnews,a.timer',
                'from'         => array('news_articles' => 'a'),
                'where'        => $condition,              
                'order'        => $order,
                'add_join'     => array( 
                0 => array( 
                    'select' => 'b.category_id,b.articles_id,c.id as category_id,c.parent_id as parent_id', 
                    'from'   => array( 'news_articles_category'=>'b','news_category'=>"c"),    
                    'where'  => 'a.id = b.articles_id and c.id=b.category_id',                  
                    'type'   => 'inner' 
                    )),                            
                'limit'        => array($offset,$limit)
            ));
        }                                               
        public function get_total($condition,$cat_id=0)
        {
            return 10000;
             $condition1 = "";
              if($cat_id){
                  $condition1 .= " and (c.id={$cat_id} or c.parent_id={$cat_id})";
              }
            $total = $this->db->buildAndFetchAll(array(
                'select'       => 'count(*) as total',
                'from'         => array('news_articles' => 'a'),
                'where'        => $condition,              
                'add_join'     => array( 
                0 => array( 
                    'select' => '', 
                    'from'   => array( 'news_articles_category'=>'b','news_category'=>"c"),    
                    'where'  => 'a.id = b.articles_id and c.id=b.category_id'.$condition1,                  
                    'type'   => 'inner' 
                    )),                            
            ));
            if($total)
            {
                return $total[0]['total'];
            }else{
                return 0;
            }
        }
        
        public function get_list_art($cat_id=0,$condition,$order,$offset,$limit){
             $condition1 = "";
              if($cat_id){
                  $condition1 .= " and (c.id={$cat_id} or c.parent_id={$cat_id})";
              }
            $list_news =  $this->db->buildAndFetchAll(array(
                'select'       => 'a.id,a.title,a.intro_text,a.creat_by,a.modified_by,a.meta_slug,a.create_date_int,a.status,a.public,a.hotnews,a.timer',
                'from'         => array('news_articles' => 'a'),
                'where'        => $condition,              
                'order'        => $order,
                'add_join'     => array( 
                0 => array( 
                    'select' => 'b.category_id,b.articles_id,c.id as category_id,c.parent_id as parent_id', 
                    'from'   => array( 'news_articles_category'=>'b','news_category'=>"c"),    
                    'where'  => 'a.id = b.articles_id and c.id=b.category_id'.$condition1,                  
                    'type'   => 'inner' 
                    )),                            
                'limit'        => array($offset,$limit)
            ));
          
            $_list_news = array();
            $check_existed = array();
            if($list_news){
                foreach($list_news as $news){
                    $news["title"] = stripslashes($news["title"]);
                    $news["intro_text"] = stripslashes($news["intro_text"]);
                    $news["creat_by"] = $this->get_user_name($news['creat_by']);
                    $news["modified_by"] = $this->get_user_name($news['modified_by']);
                    $news['category'] = $this->get_name_category($news['id']);
                    if(!in_array($news["id"],$check_existed)){
                        $check_existed[] = $news["id"];
                        $_list_news[] = $news;
                    }
                }

                $list_news = $_list_news;    
            }else
                return array();   
            
            return $list_news;                        
        }
        
        public function get_name_category($id){
            $category = $this->db->buildAndFetchAll(array(
                 'select'       => 'a.title as title',
                 'from'         => array('news_category' => 'a'),
                 'where'        => "b.articles_id = {$id}",              
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
       
        public function get_user_name($id)
        {
	if(!$id)
		return "unKnow";
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
                return "Unknow";
            }
            
        }      
    }
?>
