<?php
  class SitemapNews extends Module implements IModule {  
      /**
      * news articles model
      * 
      * @var NewsArticlesModel
      */
      private $news_articles_model;
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
          $this->news_articles_model = Loader::load_model("news_articles");
          $this->news_articles_view_model = Loader::load_model("news_articles_view");
      }                         
  
      public function run() {  
          $content = $this->news_articles_view_model->site_map_get_list_art(0,time(),100,false);
          $this->data['content'] = $content;  
          header("Content-Type:text/xml");        
          $this->template->assign('data',$this->data);
          $this->template->display("sitemap/sitemap_news.tpl");
      }
  
      public function destroyed() {                        
      }          
  }
?>
