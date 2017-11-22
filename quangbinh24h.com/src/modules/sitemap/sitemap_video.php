<?php
    class SitemapVideo extends Module implements IModule {  
        /**
        * base api helper
        * 
        * @var BaseApiHelper
        */
        private $base_api_helper;
        /**
        * out data model
        * 
        * @var OutDataModel
        */
        private $out_data_model;
        /**
        * news articles model
        * 
        * @var NewsArticlesModel
        */
        private $news_articles_model;
        /**
        * news articles join category view model
        * 
        * @var NewsArticlesJoinCategoryViewModel
        */
        private $news_articles_join_category_view_model;    
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
            $this->out_data_model = Loader::load_model("out_data");
            $this->base_api_helper = Loader::load_helper("base_api_helper");
            $this->news_articles_model = Loader::load_model("news_articles");
            $this->news_articles_view_model = Loader::load_model("news_articles_view");
            $this->news_articles_join_category_view_model = Loader::load_model("news_articles_join_category_view");
        }                         

        public function run() {              
            $content = $this->news_articles_view_model->site_map_get_list_art(0,time(),100,false,1);
           
            foreach($content as $key=>$value)
            {               
                preg_match('/<script[^>]*src=(["\'])(.*?)\1/',$value['content_text'],$match);
                if(isset($match[2]))
                {
                    $content[$key]['link_video'] = str_replace("/js","",$match[2]);
                    $content[$key]['thumb'] = $this->templateHelper->get_thumb_image($value['images'],400,250);
                }else{
                   unset($content[$key]);
                }
                
            }                                    
            $this->data['content'] = $content;         
            header("Content-Type:text/xml");
            $this->template->assign('data',$this->data);                        
            $this->template->display("sitemap/sitemap_video.tpl");
        }

        public function destroyed() {                          
        }          
    }
?>
