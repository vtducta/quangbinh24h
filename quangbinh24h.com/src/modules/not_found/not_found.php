<?php  
class NotFound extends Module implements IModule {  

    private $articles_view_join_feature_model;        
    private $news_category_model; 
    private $news_event_model;                                   
    private $articles_view_join_feature_join_category_view_model;
    private $news_articles_join_category_view_model;    
    private $news_articles_hit_week_model;
    private $news_articles_hit_day_model;
    private $news_articles_feature_data_model;

    public function __construct($param=null) {         
        $this->init(get_class($this));

        $this->data = array();
        $lang_global = $this->language->getLang('global.ln');                
        $this->template->assign('Lang', $lang_global);                        
        $this->template->assign('link_helper',$this->linkHelper);
        $this->template->assign('template_helper',$this->templateHelper);
        $this->articles_view_join_feature_model = Loader::load_model("articles_view_join_feature");
        $this->news_category_model = Loader::load_model("news_category");            
        $this->news_event_model = Loader::load_model("news_event");            
        $this->news_articles_join_category_view_model = Loader::load_model("news_articles_join_category_view");
        $this->news_articles_feature_data_model = Loader::load_model("news_articles_feature_data");        
        $this->news_articles_hit_day_model = Loader::load_model("news_articles_hit_day");
        $this->news_articles_hit_week_model = Loader::load_model("news_articles_hit_week");        
        $this->articles_view_join_feature_join_category_view_model = Loader::load_model("articles_view_join_feature_join_category_view");
    }                         

    public function run() {
        $list_cat_menu = $this->news_category_model->get_list_category_menu();
        $this->data['list_cat_menu'] = $list_cat_menu;

        $list_category = $this->news_category_model->build_child_category();
        $this->data['list_category'] = $list_category;                                             
      
        $lang_global = $this->language->getLang('global.ln');
        $this->data['object']['title'] = $lang_global['global']['notfound'];   
        $this->data['object']['meta_keyword'] = $lang_global['global']['keyword'];        
    
        header("HTTP/1.0 404 Not Found");
        $this->template->assign('data',$this->data);
        $this->template->display('notfound/index.tpl');  
    }
    public function destroyed() {              
      
    }
    public function notFound()
    {    
        header("HTTP/1.0 404 Not Found");
        $this->template->display('notfound/index.tpl');  
    }
}
