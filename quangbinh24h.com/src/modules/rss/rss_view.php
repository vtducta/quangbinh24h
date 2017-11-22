<?php
    class RssView extends Module implements IModule {  
        /** 
        * news articles join category model
        * 
        * @var NewsArticlesJoinCategoryModel
        */
        private $news_articles_join_category_model;
        /**
        * news articles join category view model
        * 
        * @var NewsArticlesJoinCategoryViewModel
        */
        private $news_articles_join_category_view_model;
        /**
        * news category model
        * 
        * @var NewsCategoryModel
        */
        private $news_category_model;
        /**
        * articles view join feature join category view model
        * 
        * @var ArticlesViewJoinFeatureJoinCategoryViewModel
        */
        private $articles_view_join_feature_join_category_view_model;
        public function __construct($param=null) {         
            $this->init(get_class($this));
            /*
            * init
            */
            $this->data = array();
            $lang_global = $this->language->getLang('global.ln');                
            $this->template->assign('Lang', $lang_global);                        
            $this->template->assign('link_helper',$this->linkHelper);
            $this->template->assign('template_helper',$this->templateHelper);
            $this->news_category_model = Loader::load_model("news_category");
            $this->news_articles_join_category_model = Loader::load_model("news_articles_join_category");
            $this->news_articles_join_category_view_model = Loader::load_model("news_articles_join_category_view");
            $this->articles_view_join_feature_join_category_view_model = Loader::load_model("articles_view_join_feature_join_category_view");
        }                         

        public function run() {        
           
            $slug_name = isset($this->input['slug_name']) ? $this->input['slug_name'] : null;           
            $object_category = array();
            $list_news = array();            
            if(!$slug_name)
            {                 
                $flag = 0;                
            }else{
                $object_category = $this->news_category_model->get_once("meta_slug ='{$slug_name}' ");          
                if($object_category)
                {                    
                    $flag = 1;                    
                }else{
                    $flag = 0;                    
                }
            }
            if(!$object_category)
            {      
                $list_news = $this->news_articles_join_category_view_model->get_news_all("a.status=3 AND a.public=1 AND a.timer <1","a.create_date_int DESC",0,20); 
            }else{
                $list_news = $this->news_articles_join_category_view_model->get_news_by_category_ndt($object_category->get('id'),1,"b.create_date_int DESC",0,20);    
            }
            $this->data['title'] = $object_category;

            $data_type = isset($this->input['datatype']) ? $this->input['datatype'] : "xml";
            if($data_type =="xml")
            {   
                $this->data['list_news'] = $list_news;             
                $lang_global = $this->language->getLang('global.ln');
                $this->data['object']['title'] = $lang_global['global']['title'];
                $this->data['object']['meta_keyword'] = $lang_global['global']['keyword'];
                $this->data['object']['meta_description'] = $lang_global['global']['description']; 
                header("Content-Type:text/xml;charset:utf-8");
                $this->template->assign('data',$this->data);
                if($slug_name=="editor-picks")
                    $this->template->display("Rss/editor_picks.tpl");
                else
                    $this->template->display("Rss/view.tpl");
            }elseif($data_type =="json")
            {   
                foreach($list_news as $key=>$value)
                {
                    $list_news[$key]['link'] = $this->linkHelper->xemnhanh($value['meta_slug'],$value['id']);
                    $list_news[$key]['thumbnail'] = $this->templateHelper->get_thumb_image($value['images'],250,250) ;
                }
                header("Content-type : application/json");
                echo json_encode($list_news);
                exit();
            }
        }

        public function destroyed() {                           
        }          
    }
?>