<?php
    class ArticlesViewJoinFeatureJoinCategoryViewModel extends Model 
    {           
        private $template_helper;
        private $news_articles_model;
        
        public function __construct(){
            parent::__construct();
            $this->news_articles_model = Loader::load_model("news_articles");
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
            'select'       => 'a.id, a.title, a.intro_text, a.create_date_int, a.status, a.public, a.meta_slug,a.content_type,a.image_url as upload_url',
            'from'         => array('news_articles_view ' => 'a'),
            'where'        => $condition,              
            'order'        => $order,
            'add_join'     => array( 
                0 => array( 
                'select' => 'b.feature_id,c.category_id,c.parent_id', 
                'from'   => array( 'news_articles_feature_data ' => 'b','news_articles_category_view' =>'c' ),    
                'where'  => 'a.id = b.news_id AND a.id=c.articles_id ',                  
                'type'   => 'inner' 
            )),
            'limit'        => array($offset,$limit)
            ));
        }                                               
        public function get_news_feature_id_by_category_mysql($condition,$order,$offset,$limit)      
        {
            $content = $this->get_list($condition,$order,$offset,$limit);                             
            $array = array();
            if($content)
            {
                foreach($content as $key=>$value)
                {
                    $array[] = array(
                    'id' => $value->get('id'),
                    'title' => $value->get('title'),
                    'intro_text' => $value->get('intro_text'),
                    'create_date_int' => $this->template_helper->convert_time_to_string($value->get('create_date_int')), 
                    'date_int' => $value->get('create_date_int'),          
                    'meta_slug' => $value->get('meta_slug'),
                    'images' => $value->get('upload_url'),
                    'content_type' => $value->get('content_type')
                    );
                }              
            }
            return $array;
        }

        
        public function get_video_feature_by_category($cat_id){
            $key = md5("get_video_feature_by_category#$cat_id");
            $list_news = $this->mem_get($key);
            
            if($list_news) return $list_news;
            
            $list_news = $this->db->buildAndFetchAll(array(
            'select'       => 'a.id, a.title, a.intro_text, a.create_date_int, a.status, a.public, a.meta_slug,a.content_type,a.content_text,a.image_url as upload_url, a.images as images',
            'from'         => array('news_articles_view ' => 'a'),
            'where'        => "a.status=3 AND a.public=1 AND c.category_id={$cat_id}",
            'order'        => "b.id DESC",
            'add_join'     => array(
                0 => array(
                'select' => 'b.feature_id,c.category_id',
                'from'   => array( 'news_articles_feature_data ' => 'b','news_articles_category_view' =>'c' ),
                'where'  => 'a.id = b.news_id AND a.id=c.articles_id ',
                'type'   => 'inner'
            )),
            'limit'        => array(0,4)
            ));
            
            if($list_news)
            {
                foreach($list_news as $key=>$value)
                {
                    $array[] = array(
                    'id' => $value['id'],
                    'title' => $value['title'],
                    'intro_text' => $value['intro_text'],
                    'create_date_int' => $this->template_helper->convert_time_to_string($value['create_date_int']),
                    'date_int' => $value['create_date_int'],
                    'meta_slug' => $value['meta_slug'],
                    'images' => $this->news_articles_model->get_image_cache($value['images']),
                    'content_type' => $value['content_type']
                    );
                }
            }
            
            $this->mem_set($key,$array,3600); 
            return $array;                    
        }
        
        public function get_news_feature_by_category($feature_id,$cat_id,$order,$offset,$limit)
        {
            $key = "list#news#category#4#{$feature_id}#{$cat_id}#{$offset}#{$limit}";
            $list_news = $this->mem_get(md5($key));                        
            if($list_news == false)
            {
                $list_news = $this->get_news_feature_id_by_category_mysql("a.status=3 AND a.public=1 AND b.feature_id={$feature_id} AND c.category_id={$cat_id}",$order,$offset,$limit);                
            }            
            if(!$list_news)
            {
                return array();
            }else{
                $this->mem_set(md5($key),$list_news,60);    
            }            
            return $list_news;            
        }
        
        public function reset_news_feature_by_category($feature_id,$cat_id,$order,$offset,$limit)
        {   
            $key = "list#news#category#{$feature_id}#{$cat_id}#{$offset}#{$limit}";            
            $list_news = $this->get_news_feature_id_by_category_mysql("a.status=3 AND a.public=1 AND b.feature_id={$feature_id} AND c.category_id={$cat_id}",$order,$offset,$limit);                
            if(!$list_news)
            {
                return false;
            }
            $this->mem_set(md5($key),$list_news,60);
            return true;
        }
    }
?>
