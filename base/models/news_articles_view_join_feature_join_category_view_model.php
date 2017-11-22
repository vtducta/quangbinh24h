<?php
    class NewsArticlesViewJoinFeatureJoinCategoryViewModel extends Model 
    {           
        private $template_helper;               
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
            'select'       => 'a.id, a.title, a.intro_text, a.create_date_int, a.status, a.public, a.meta_slug,a.content_type',
            'from'         => array('news_articles_view ' => 'a'),
            'where'        => $condition,              
            'order'        => $order,
            'add_join'     => array( 
                0 => array( 
                'select' => 'b.feature_id,c.upload_url,d.category_id,d.parent_id', 
                'from'   => array( 'news_articles_feature_data ' => 'b','news_upload'=>'c','news_articles_category_view' =>'d' ),    
                'where'  => 'a.id = b.news_id AND c.id = a.images AND a.id=d.articles_id ',                  
                'type'   => 'inner' 
            )),
            'limit'        => array($offset,$limit)
            ));
        }                                               
        public function get_news_feature_id_by_category_mysql($condition,$oder,$offset,$limit)      
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
                    'meta_slug' => $value->get('meta_slug'),
                    'images' => $value->get('upload_url'),
                    "date_int" => $value->get('create_date_int'),
                    );
                }              
            }
            return $array;
        }
    }
?>
