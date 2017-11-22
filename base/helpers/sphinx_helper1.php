<?php
    class SphinxHelper1 {
        /** 
        * SphinxClient
        * @var       SphinxClient
        * @access  private
        */
        private $sp;

        /**
        * Constructor
        *
        * @access       public     
        * @return       void
        */
        public function __construct()
        {   
            $this->sp = new SphinxClient();
            $this->sp->SetServer('localhost',9312);
        }      

        public function get_total_art_by_keyword($keyword,$category=0)
        {             
            $this->sp->SetMatchMode(SPH_MATCH_ALL);   
            $this->sp->SetSortMode(SPH_SORT_EXPR, "@weight +  ln(art_create_date)*200");   
            $this->sp->SetFieldWeights(array('art_title' => 90, 'art_content' => 30, 'cat_name' => 5 , 'art_meta_slug' => 5 ));     
            if ($category){
                $this->sp->SetFilter("cat_id",$category);
            }
            $this->sp->SetFilter('art_status',array(3));
            $this->sp->SetFilter('art_public',array(1));
            $this->sp->SetFilter('cat_status',array(1));
            $this->sp->SetFilter('timer',array(0));

            $result = $this->sp->Query("{$keyword}",'news_articles_main_idx,news_articles_delta_idx');

            if (!$this->sp->GetLastError()){
                return array(
                'total' => $result['total_found'],
                'time'  => $result['time']
                );
            }
            else return array(
                'total' => 0,
                'time'  => 0
                );
        }

        /**
        * get search
        * 
        * @param mixed $keyword
        * @param mixed $num
        * @param mixed $offset
        * @param mixed $category
        */
        public function get_search_art($keyword,$num,$offset,$category=0)
        {                                              
            $this->sp->SetMatchMode(SPH_MATCH_ALL);   
            $this->sp->SetSortMode(SPH_SORT_EXPR, "@weight +  ln(art_create_date)*200");   
            $this->sp->SetFieldWeights(array('art_title' => 90, 'art_content' => 30, 'cat_name' => 5 , 'art_meta_slug' => 5 ));             
            if ($category){
                $this->sp->SetFilter("cat_id",$category);
            }
            $this->sp->SetFilter('art_status',array(3));
            $this->sp->SetFilter('art_public',array(1));
            $this->sp->SetFilter('cat_status',array(1));
            $this->sp->SetFilter('timer',array(0));
            $this->sp->SetLimits($offset,$num);

            $result = $this->sp->Query("{$keyword}",'news_articles_main_idx,news_articles_delta_idx');
            if (!$this->sp->GetLastError() && isset($result['matches']) && count($result['matches'])){
                $art_result = array();
                foreach ($result['matches'] as $key=>$val){
                    $art_result[$key] = $val;
                }
                return $art_result;
            }
            else return array();
        }    
        public function get_search_art_relation($keyword,$num,$offset)
        {                                              
            $this->sp->SetMatchMode(SPH_MATCH_ALL);   
            $this->sp->SetSortMode(SPH_SORT_EXPR, "@weight +  ln(art_create_date)*200");   
            $this->sp->SetFieldWeights(array('art_title' => 200, 'art_content' => 30, 'cat_name' => 5 , 'art_meta_slug' => 5 ));     
            $this->sp->SetFilter('art_status',array(3));
            $this->sp->SetFilter('art_public',array(1));
            $this->sp->SetFilter('cat_status',array(1));
            $this->sp->SetFilter('timer',array(0));
            $this->sp->SetLimits($offset,$num);  
            $result = $this->sp->Query("{$keyword}",'news_articles_main_idx,news_articles_delta_idx');  
            if (!$this->sp->GetLastError() && isset($result['matches']) && count($result['matches'])){
                $art_result = array();
                foreach ($result['matches'] as $key=>$val){
                    $art_result[$key] = $val;
                }
                return $art_result;
            }
            else return array();
        }
    }
?>
