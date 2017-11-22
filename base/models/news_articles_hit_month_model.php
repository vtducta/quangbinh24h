<?php
    class NewsArticlesHitMonthModel extends Model
    {
        public function __construct(){
            parent::__construct();
            $this->template_helper = Loader::load_helper("template_helper");
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
            $data = $this->db->buildAndFetchAll(array(

            'select'     => 'a.id as id, a.title as title,a.intro_text as intro_text,a.status as status,a.content_type,a.public as public,a.create_date_int as create_date_int,a.meta_slug as meta_slug,a.image_url as upload_url,d.total_hit as total_hit',
            'from'        => array('news_articles_view' => "a"),
            'where'         => $condition,
            'add_join'     => array( 
                0 => array( 
                    'select' => '', 
                    'from'   => array( 'news_articles_category_view' => 'b',"hit_view_month" => 'd'),    
                    'where'  => 'b.articles_id = a.id  AND d.news_id = a.id',                  
                    'type'   => 'inner' 
                )
            ),            
            'order'        =>  $order,
            'limit'        => array($offset,$limit)
            ));                              
            return $data;

        } 
    }
?>