<?php
    class Rss extends Module implements IModule {  
        /**
        * news event model
        * 
        * @var NewsEventModel
        */
        private $news_event_model;
        /**
        * news category model
        * 
        * @var NewsCategoryModel 
        */
        private $news_category_model;
        /**
        * news articles hit day model
        * 
        * @var NewsArticlesHitDayModel
        */
        private $news_articles_hit_day_model;
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
            $this->news_articles_hit_day_model = Loader::load_model("news_articles_hit_day");
            $this->news_event_model = Loader::load_model("news_event");
            $this->news_category_model = Loader::load_model("news_category");
        }                         

        public function run() {
            $list_cat_menu = $this->news_category_model->get_list_category_menu();
            $this->data['list_cat_menu'] = $list_cat_menu;
            
            $list_event = $this->news_event_model->list_event(5);

            $list_category = $this->news_category_model->build_child_category();

            $block_news_hit = $this->news_articles_hit_day_model->get_hit_view_home();
            
            $this->data['list_event'] = $list_event;
            $this->data['list_category'] = $list_category;
            $this->data['block_news_hit'] = $block_news_hit;

            $lang_global = $this->language->getLang('global.ln');
            $this->data['object']['title'] = $lang_global['global']['title'];
            $this->data['object']['meta_keyword'] = $lang_global['global']['keyword'];
            $this->data['object']['meta_description'] = $lang_global['global']['description'];

            $this->template->assign('data',$this->data);
            $this->template->display("Rss/index.tpl");
        }

        public function destroyed() {                           
        }          
    }
?>
