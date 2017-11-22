<?php
  class About extends Module implements IModule {  
      /**
      * news category model
      * 
      * @var NewsCategoryModel
      */
      private $news_category_model;
      /**
      * news event model
      * 
      * @var NewsEventModel
      */
      private $news_event_model;
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
          $this->news_event_model = Loader::load_model("news_event");
          $this->news_category_model = Loader::load_model("news_category");
      }                         
  
      public function run() {
          $list_cat_menu = $this->news_category_model->get_list_category_menu();
          $this->data['list_cat_menu'] = $list_cat_menu;
          
          $list_category = $this->news_category_model->build_child_category();
          $list_event = $this->news_event_model->list_event(5);          
          
          $this->data['list_category'] = $list_category;
          
          $this->data['list_event'] = $list_event;
          
          $this->template->assign("data",$this->data);          
          $this->template->display("about/index.tpl");          
      }
  
      public function destroyed() {                        
      }          
  }
?>
