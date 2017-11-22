<?php  
    class Event extends Module implements IModule {  

        private $articles_view_join_feature_model;
        private $news_category_model;
        private $news_event_model;
        private $news_articles_join_category_model;
        private $news_articles_view_model;
        private $news_event_articles_model;        
        private $news_articles_hit_day_model;
        private $news_articles_event_model;
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
            $this->news_articles_join_category_model = Loader::load_model("news_articles_join_category");
            $this->news_articles_view_model = Loader::load_model("news_articles_view");
            $this->news_event_articles_model = Loader::load_model("news_event_articles");            
            $this->news_articles_hit_day_model = Loader::load_model("news_articles_hit_day");
            $this->news_articles_event_model = Loader::load_model("news_articles_event");
        }                         

        public function run() {
            $list_cat_menu = $this->news_category_model->get_list_category_menu();
            $this->data['list_cat_menu'] = $list_cat_menu;
            
            $list_events = $this->news_event_model->list_event(5);
            $list_category = $this->news_category_model->build_child_category();         
            $id = isset($this->input['id']) ? $this->input['id'] : 0;
            if (!preg_match('/^[0-9]*$/', $id)) {
               $block_news_not_found = $this->articles_view_join_feature_model->get_news_not_found("b.feature_id =6","RAND()",0,20);
                $this->data['block_news_not_found'] = $block_news_not_found;
                $this->data['list_category'] = $list_category;
                $this->not_found();
                exit(); 
            }
            $slug = isset($this->input['slug_name']) ? $this->input['slug_name'] : null;        
            $current_page = isset($this->input['p']) ? $this->input['p'] : 1; 
            $current_page = intval($current_page);
            
            $object_event = $this->news_event_model->get_event($id);            
             $flag = 1;            
            if (!$object_event || $id==1802 || $object_event->get("status")==3){
                $flag = 0;
                $this->data['list_category'] = $list_category;
                $this->template->assign('data',$this->data);
                $this->notfound();
                die();
            }             
            if($slug != $object_event->get('meta_slug') && $object_event)
            {
                Application::redirect($this->linkHelper->link_to_event($object_event->get('meta_slug'),$object_event->get('id'),$current_page));
            }
           
            $num =  20;            
            $page_show = 5;            
            $total = $this->news_articles_event_model->get_total_news_by_event($id);            
            $total_page=  ceil($total/$num);            
            if($current_page <=0)
            {
                $current_page = 1;
            }elseif($current_page>$total_page){
                $current_page = $total_page;
            }
            $paging = Application::paging($current_page,$total_page,$page_show);
            $limit = $num;
            $offset = ($current_page-1)*$limit; 
            $list_news = $this->news_event_articles_model->get_artilces_event($id,$limit,$offset);                     
          
            $block_hit_view = $this->news_articles_hit_day_model->get_hit_view_home();

            $this->data['paging'] = array(
            'current' => $current_page,
            'total' => $total_page,
            'page' => $paging
            );   

            $this->data['list_event'] = $list_events;
            $this->data['list_category'] = $list_category;
            $this->data['current_category'] = 0;
            $this->data['block_news_hit'] = $block_hit_view;
            $this->data['event'] = $object_event;
            $this->data['list_news'] = $list_news;

            $lang_global = $this->language->getLang('global.ln');      
            $title = $object_event->get('meta_title') ? $object_event->get('meta_title') : $object_event->get('title');  
            if($current_page>1)    
            {
                $this->data['object']['title'] = "{$title} - Trang {$current_page}";    
            }else{
                $this->data['object']['title'] = $title;
            }
            
            $this->data['object']['meta_keyword'] = $object_event->get('meta_keywork') ? $object_event->get('meta_keywork') : $lang_global['global']['keyword'];
            $this->data['object']['meta_description'] = $object_event->get('meta_description') ? $object_event->get('meta_description') : $lang_global['global']['description'];                   
            $this->template->assign("data",$this->data);
            if($flag)
            {
                $this->template->display("event/index.tpl");    
            }else{
                $this->not_found();
            }
        }

        public function destroyed(){               
        }          
        function notfound()
        {
            header("HTTP/1.0 404 Not Found");
            $this->template->assign("data",$this->data);
            $this->template->display("notfound/index.tpl");
        }
    }
?>
