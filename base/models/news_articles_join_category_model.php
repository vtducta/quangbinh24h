<?php
    class NewsArticlesJoinCategoryModel extends Model
    {

        /**
        * sphinx helper
        * 
        * @var SphinxHelper
        */
        private $sphinx_helper;
        private $link_helper;
        public function __construct(){
            parent::__construct();
            $this->template_helper = Loader::load_helper("template_helper");
            $this->sphinx_helper = Loader::load_helper("sphinx_helper");
            $this->link_helper = Loader::load_helper("link_helper");
        }
        
        protected function do_insert($data)
        {          

        }

        protected function do_update($data,$condition)

        {

        }

        protected function do_delete($condition)

        {

        }
        protected function do_select($condition,$order,$offset,$limit)
        {
            return $this->db->buildAndFetchAll(array(

            'select'     => 'a.id as id, a.title as title,a.intro_text as intro_text,a.status as status,a.content_type,a.public as public,a.create_date_int as create_date_int,a.meta_slug as meta_slug,c.upload_url as upload_url,d.title as category',
            'from'        => array('news_articles_view' => "a"),
            'where'         => $condition,
            'add_join'     => array( 
                0 => array( 
                    'select' => '', 
                    'from'   => array( 'news_articles_category_view' => 'b','news_upload' => "c","news_category" => 'd'),    
                    'where'  => 'b.articles_id = a.id AND c.id = a.images AND d.id = b.category_id',                  
                    'type'   => 'inner' 
                )
            ),
            'order'        =>  $order,
            'limit'        => array($offset,$limit)
            ));                              

        }
        
        public function get_count_articles_by_category_id($id){
            $key = "mb#ca#{$id}";//mobile key
            if ($return_cache = $this->mem_get($key)){
                $return = $return_cache;
            }
            else{
                $return = $this->get_count_articles_by_category_id_sql($id);
                if (isset($return[0])){
                    $this->mem_set($key,$return,24*60*60);
                }
            }
            if (isset($return[0])){
                return $return[0]['c'];
            }
            return 0;
        }
        
        public function push_count_articles_by_category_id($id){
            $return = $this->get_count_articles_by_category_id_sql($id);
            if (isset($return[0])){
                $this->mem_set($key,$return,24*60*60);
            }
        }
        
        public function get_count_articles_by_category_id_sql($id){
            $return = $this->db->buildAndFetchAll(array(

                'select'     => 'count(a.id) as c',
                'from'        => array('news_articles_view' => "a"),
                'where'         => "(b.category_id = {$id} OR b.parent_id = {$id}) AND a.status = 3 AND a.public = 1 AND a.timer = 0",
                'add_join'     => array( 
                    0 => array( 
                        'select' => '', 
                        'from'   => array( 'news_articles_category_view' => 'b','news_upload' => "c"),    
                        'where'  => 'b.articles_id = a.id AND c.id = a.images',                  
                        'type'   => 'inner' 
                    )
                ),
                'order'        =>  $order,
                'limit'        => array($offset,$limit)
            ));
            return $return;
        }
        
        public function get_articles_by_category_id($id,$limit,$offset){
            $list_art = $this->get_list("(b.category_id = {$id} OR b.parent_id = {$id}) AND a.status = 3 AND a.public = 1 AND a.timer = 0","create_date_int desc",$offset,$limit);
            $return = array();
            foreach ($list_art as $item){
                $_item['id'] = $item->get('id');
                $_item['title'] = $item->get('title');
                $_item['intro_text'] = $item->get('intro_text');
                $_item['meta_slug'] = $item->get('meta_slug');
                $_item['status'] = $item->get('status');
                $_item['create_date_int'] = $this->template_helper->convert_time_to_string($item->get('create_date_int'));
                $_item['images'] = $item->get('upload_url');
                $_item['category'] = $item->get('category');
                $_item['thumb_small'] =  $this->template_helper->get_thumb_image($item->get('upload_url'),236,198);
                $_item['thumb_medium'] = $this->template_helper->get_thumb_image($item->get('upload_url'),320,160);
                $_item['link_view'] = $this->link_helper->xemnhanh($item->get('meta_slug'),$item->get('id'));
                $return[] = $_item;
            }
            return $return;
        }
        public function search_sphinx($id)
        {
            $item = $this->get_once("a.id = {$id} AND a.status = 3 AND a.public = 1 AND a.timer = 0");
            if ($item){
                return $item;
            }
            return array();
        }
        
        public function get_sphinx_relation_news($title,$limit){
            $data = $this->sphinx_helper->get_search_art_relation($title,$limit,1);
            $_data = array();
            if (count($data)){
                foreach ($data as $key=>$value){
                    $item = $this->get_once("a.id = {$key} AND a.status = 3 AND a.public = 1 AND a.timer = 0");
                    if ($item){
                        $_data[] = $item;
                    }
                }
                return $_data;
            }
            else{
                return array();
            }
        }
        public function get_sphinx_relation($title,$limit)
        {
            $key = "news#sphinx#{$title}#{$limit}";
            $list_news = $this->mem_get(md5($key));
            if($list_news == false)
            {
                $list_news = $this->get_sphinx_relation_news($title,$limit);    
            }
                      
            if(!$list_news)
            {
                return array();
            }else{
                $this->mem_set(md5($key),$list_news,24*60*60);    
            }            
            return $list_news;
        }

    }
?>