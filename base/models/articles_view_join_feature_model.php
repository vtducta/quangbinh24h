<?php
    class ArticlesViewJoinFeatureModel extends Model 
    {           
        private $template_helper;
        private $link_helper;
        private $news_articles_model;
        
        public function __construct(){
            parent::__construct();
            $this->news_articles_model = Loader::load_model("news_articles");
            $this->template_helper = Loader::load_helper("template_helper");
            $this->link_helper = Loader::load_helper("link_helper");
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
            'select'       => 'a.id, a.title, a.intro_text, a.create_date_int,a.content_text,a.status, a.public, a.meta_slug,a.content_type,a.images as images',
            'from'         => array('news_articles_view ' => 'a'),
            'where'        => $condition,              
            'order'        => $order,
            'add_join'     => array( 
                0 => array( 
                'select' => 'b.feature_id', 
                'from'   => array( 'news_articles_feature_data ' => 'b'),    
                'where'  => 'a.id = b.news_id',                  
                'type'   => 'inner' 
            )),
            'limit'        => array($offset,$limit)
            ));
        }                                               
        public function  get_news_not_found($condition,$order,$offset,$limit)
        {
            $result = $this->get_list($condition,$order,$offset,$limit);
            return $result;
        }
        
        public function get_news_feature_id_mysql($condition,$oder,$offset,$limit)      
        {
            $content = $this->get_list($condition,$oder,$offset,$limit);
            $array = array();
            if($content)
            {
                foreach($content as $key=>$value)
                {
                    $array[] = array(
                    'id' => $value->get('id'),
                    'title' => stripslashes($value->get('title')),
                    'intro_text' => stripslashes($value->get('intro_text')),
                    'create_date_int' => $this->template_helper->convert_time_to_string($value->get('create_date_int')),
                    'date_int' => $value->get('create_date_int'),
                    'meta_slug' => $value->get('meta_slug'),
                    'category' => $this->get_category($value->get('id')),
                    'images' => $this->news_articles_model->get_image_cache($value->get('images')),
                    'list_category' => $this->get_current_category($value->get('id')),
                    'link_view' => $this->link_helper->xemnhanh($value->get('meta_slug'),$value->get('id')),
                    'content_type' => $value->get('content_type')
                    );
                }
            }
            return $array;
        }        
        public function get_news_feature_id_mqsql_content($condition,$oder,$offset,$limit)
        {
           $content = $this->get_list($condition,$oder,$offset,$limit);                             
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
                    'content_text' => preg_replace('/(<[^>]+) style=".*?"/i', '$1', $value->get('content_text')), 
                    'meta_slug' => $value->get('meta_slug'),
                    'category' => $this->get_category_by_news_id($value->get('id')),
                    'images' => $value->get('upload_url'),
                    'list_category' => $this->get_current_category($value->get('id')),
                    'thumb_small' => $this->template_helper->get_thumb_image($value->get('upload_url'),236,198),
                    'thumb_medium' => $this->template_helper->get_thumb_image($value->get('upload_url'),320,160),
                    'link_view' => $this->link_helper->xemnhanh($value->get('meta_slug'),$value->get('id')),
                    );
                }              
            }
            return $array; 
        }
        public function get_news_feature_by_id_ndt($id,$order,$offset,$limit)
        {
            $key = "ndt#news#feature1#{$id}#{$offset}#{$limit}";
            $list_news = $this->mem_get(md5($key));
            if($list_news) return $list_news;
            
            $list_news = $this->get_news_feature_id_mysql("a.status=3 AND a.public=1 AND b.feature_id={$id}",$order,$offset,$limit);
            if(!count($list_news))
            {
                return array();
            }
            else{
                $this->mem_set(md5($key),$list_news,0.5*60);              
            }
            return $list_news;
        }
        public function reset_get_news_feature_by_id_ndt($id,$order,$offset,$limit)
        {            
            $key = "ndt#news#feature1#{$id}#{$offset}#{$limit}";
            $list_news = $this->get_news_feature_id_mysql("a.status=3 AND a.public=1 AND b.feature_id ={$id}",$order,$offset,$limit);
            if(!count($list_news))
            {
                return false;
            }else{
                $this->mem_set(md5($key),$list_news,0.5*60);
                return true;
            }
        }                
        
        
        public function get_news_feature_by_id($condition,$order,$offset,$limit)
        {
            $key = "mobile#newsfeature1".$condition."#".$offset."#".$limit;                 
            $list_news = $this->mem_get(md5($key));
            if(!$list_news)  
            {  
                $list_news = $this->get_news_feature_id_mysql($condition,$order,$offset,$limit);              
            }        
            if(!count($list_news))
            {
                return array();
            }
            else{
                $this->mem_set(md5($key),$list_news,15*60*60);              
            }
            return $list_news;
        }   
        public function reset_get_news_feature_by_id($condition,$order,$offset,$limit)
        {
            $key = "mobile#newsfeature1".$condition."#".$offset."#".$limit;                 
            $list_news = $this->get_news_feature_id_mysql($condition,$order,$offset,$limit);
            if(!count($list_news))
            {
                return false;
            }else{
                $this->mem_set(md5($key),$list_news,15*60*60);
                return true;
            }
        }

        public function get_category_list_by_news_id($news_id){
            $list_category = $this->db->buildAndFetchAll(array(
                'select'       => 'a.title as title',
                'from'         => array('news_category' => 'a'),
                'where'        => "b.articles_id = {$news_id}",              
                'order'        => "",
                'add_join'     => array( 
                0 => array( 
                    'select' => 'b.articles_id,b.category_id,b.parent_id', 
                    'from'   => array( 'news_articles_category_view' => 'b' ),    
                    'where'  => 'b.category_id = a.id',                  
                    'type'   => 'inner' 
                )),
                'limit'        => array(0,10)
            ));
            if (!count($list_category)){
                return "Thể loại khác";
            }
            else{
                $return = "";
                foreach ($list_category as $item){
                    $return = $item['title'] . ",";
                }
                $return = rtrim($return,",");
                return $return;
            }

        }
        
        public function get_category_by_news_id($news_id){
            $list_category = $this->db->buildAndFetchAll(array(
                'select'       => 'a.title as title',
                'from'         => array('news_category' => 'a'),
                'where'        => "b.articles_id = {$news_id}",              
                'order'        => "",
                'add_join'     => array( 
                0 => array( 
                    'select' => 'b.articles_id,b.category_id,b.parent_id', 
                    'from'   => array( 'news_articles_category' => 'b' ),    
                    'where'  => 'b.category_id = a.id',                  
                    'type'   => 'inner' 
                )),
                'limit'        => array(0,10)
            ));
            if (!count($list_category)){
                return array();
            }
            else{
                $return = "";
                foreach ($list_category as $item){
                    $return = $item['title'] . ",";
                }
                $return = rtrim($return,",");
                return $return;
            }

        }
        
        
        public function get_category($news_id){
            $list_category = $this->db->buildAndFetchAll(array(
                'select'       => '*',
                'from'         => array('news_category' => 'a'),
                'where'        => "b.articles_id = {$news_id}",              
                'order'        => "",
                'add_join'     => array( 
                0 => array( 
                    'select' => 'b.articles_id,b.category_id', 
                    'from'   => array( 'news_articles_category' => 'b' ),    
                    'where'  => 'b.category_id = a.id',                  
                    'type'   => 'inner' 
                )),
                'limit'        => array(0,1)
            ));
            if (!count($list_category)){
                return array("title" => "Thể loại khác","meta_slug"=>"the-loai-khac","parent"=>array());
            }
            else{
                $list_category[0]['parent'] = $this->get_parent_category($list_category[0]['parent_id']);
                return $list_category[0];
            }                
            
        }
        
        public function get_current_category($id){
            $list_category = $this->db->buildAndFetchAll(array(
                'select'       => 'a.title as title,a.meta_slug',
                'from'         => array('news_category' => 'a'),
                'where'        => "b.articles_id = {$id}",              
                'order'        => "",
                'add_join'     => array( 
                0 => array( 
                    'select' => 'b.articles_id,b.category_id,b.parent_id', 
                    'from'   => array( 'news_articles_category_view' => 'b' ),    
                    'where'  => 'b.category_id = a.id',                  
                    'type'   => 'inner' 
                )),
                'limit'        => array(0,1)
            ));
            if (!count($list_category)){
                return array("title" => "Thể loại khác","meta_slug"=>"the-loai-khac");
            }
            else{
                $list_category[0]['parent_id'] = $this->get_parent_category($list_category[0]['parent_id']);
                return $list_category[0];
            }            
        }
        
        public function get_parent_category($id){
            $category_parent = $this->db->buildAndFetchAll(array(
                'select'       => 'a.title as title,a.meta_slug',
                'from'         => array('news_category' => 'a'),
                'where'        => "a.id = {$id}",              
                'order'        => "",              
                'limit'        => array(0,1)
            ));
            if (!count($category_parent)){
                return null;
            }
            else{                
                return $category_parent[0];
            }            
        }
    }
?>
