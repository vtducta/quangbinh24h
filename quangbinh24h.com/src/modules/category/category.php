<?php  
class Category extends Module implements IModule {  

    private $articles_view_join_feature_model;        
    private $news_category_model; 
    private $news_event_model;                                   
    private $articles_view_join_feature_join_category_view_model;
    private $news_articles_join_category_view_model;    
    private $news_articles_hit_week_model;
    private $news_articles_hit_day_model;
    private $news_articles_feature_data_model;
    private $news_articles_view_model;
    private $advertise_model;

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
        $this->news_articles_view_model = Loader::load_model("news_articles_view");
        $this->advertise_model      = Loader::load_model('advertise');
    }                         

    public function run() {
        $listAds = $this->advertise_model->get_ads('cat');
        $this->data['listAds'] = $listAds;
        
        $list_cat_menu = $this->news_category_model->get_list_category_menu();
        $this->data['list_cat_menu'] = $list_cat_menu;

        $slug_name = isset($this->input['slug_name']) ? $this->input['slug_name']  : null;
        $current_page = isset($this->input['p']) ? $this->input['p'] : 1;

        $flag = 0;
        $id = 0;            
        $parent_id = 0;        

        $object_category = $this->news_category_model->get_category_by_slug(trim($slug_name));
        
        $list_category = $this->news_category_model->build_child_category();
        $this->data['list_category'] = $list_category;                                             

        if(!$slug_name)
        {
            $flag = 0;
            $this->data['list_category'] = $list_category;
            $this->template->assign('data',$this->data);
            $this->notfound();
            die();
        }
        elseif(!$object_category)
        {
            $flag = 0;
            $this->data['list_category'] = $list_category;
            $this->template->assign('data',$this->data);
            $this->notfound();
            die();
        }else{               
            $flag =1;
            $id  = $object_category->get('id');
            $this->data['catt'] = $id;     
            $parent_id = $object_category->get('parent_id');                
            if($object_category->get('parent_id') ==0)
            {
                $current_category = $object_category->get('id');                    
            }else{
                $current_category  = $parent_id;
                $cat_parent = $this->news_category_model->get_list_category("id={$parent_id}");                
                $this->data['cat_parent'] = $cat_parent[0];       
            }             
        }
        
        $list_events = array();
        if($id && $parent_id==0) $list_events = $this->news_event_model->list_event(5,0,$id);  
        else $list_events = $this->news_event_model->list_event(5,0,$parent_id);   
                    
        $this->data['list_event'] = $list_events;

        $num =  20;            
        $page_show = 5;            
        $total = $this->news_articles_join_category_view_model->get_total_news_by_category("a.category_id=$id");                                                                                                         
        $total_page = ceil($total/$num);            
        if($current_page<=0)
        {
            $current_page = 1;
        }elseif($current_page>$total_page){
            $current_page = $total_page;
        }
        $paging = Application::paging($current_page,$total_page,$page_show);
        $limit = $num;
        $offset = ($current_page-1)*$limit;
        
        $news_hot_cat = $this->articles_view_join_feature_join_category_view_model->get_news_feature_by_category(4,$id,"b.id DESC",0,1);
        $this->data['news_hot_cat'] = $news_hot_cat;
        
        $list_news = $this->news_articles_join_category_view_model->get_news_by_category_ndt_v2($id,$news_hot_cat[0]['id'],1,"b.create_date_int DESC",$offset,$limit);
        $this->data['list_news'] = $list_news;
        
        $list_docnhieu = $this->news_articles_view_model->get_list_art('',21,12);
        $this->data['list_docnhieu'] = $list_docnhieu;
        
        $this->data['paging'] = array(
            'current' => $current_page,
            'total' => $total_page,
            'page' => $paging
        );
        
        $this->data['paging_mobile'] = array(
            'current' => $current_page,
            'total' => $total_page,
            'page' => Application::paging($current_page,$total_page,3)
        );
        
        $this->data['object_category'] = $object_category;
        $this->data['site'] = "category";
        $this->data['category_parent'] = $object_category;            
        $this->data['current_category'] = $current_category;        
        if($object_category)
        {   
            if($current_page>1)
            {
                $this->data['object']['title'] = "{$object_category->get("meta_title")} - Trang {$current_page}";    
            }else{
                $this->data['object']['title'] = "{$object_category->get("meta_title")}";
            }        
            $this->data['object']['meta_description'] =  "{$object_category->get("meta_description")}";        
            $this->data['object']['meta_keyword'] =  "{$object_category->get("meta_keywork")}";          
        }         
        else{
            $lang_global = $this->language->getLang('global.ln');
            $this->data['object']['title'] = $lang_global['global']['notfound'];   
            $this->data['current_category'] = 0;
            $this->data['object']['meta_keyword'] = $lang_global['global']['keyword'];        
        }              
        $lang_global['global']['description'];          
            
        $this->template->assign('data',$this->data);
        $this->template->display('category/index.tpl');
            
        if($flag==0) $this->notFound();    
    }
    
    public function destroyed() {       
             
    }
    public function notFound()
    {    
        header("HTTP/1.0 404 Not Found");
        $this->template->display('notfound/index.tpl');  
    }
}
