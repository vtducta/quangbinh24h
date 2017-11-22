<?php
    class NewsTagv2 extends Module implements IModule {        

        private $news_event_model;
        private $news_category_model;
        private $news_articles_hit_day_model;
        private $news_tag_model;
        private $news_articles_join_articles_tag_model;
        private $articles_view_join_feature_model;
        private $news_articles_hit_week_model;
        private $news_articles_view_model;
        private $advertise_model;
      
        public function __construct($param=null) {         
            $this->init(get_class($this));

            $this->data = array();
            $lang_global = $this->language->getLang('global.ln');                
            $this->template->assign('Lang', $lang_global);                        
            $this->template->assign('link_helper',$this->linkHelper);
            $this->template->assign('template_helper',$this->templateHelper);
            $this->news_event_model = Loader::load_model("news_event");
            $this->news_category_model = Loader::load_model("news_category");
            $this->news_articles_hit_day_model = Loader::load_model("news_articles_hit_day");
            $this->news_tag_model = Loader::load_model("news_tag");
            $this->news_articles_join_articles_tag_model = Loader::load_model("news_articles_join_articles_tag");            
            $this->articles_view_join_feature_model = Loader::load_model("articles_view_join_feature");
            $this->news_articles_hit_week_model = Loader::load_model("news_articles_hit_week");
            $this->news_articles_view_model = Loader::load_model("news_articles_view");
            $this->advertise_model      = Loader::load_model('advertise');
        }                         

        public function run() {
            $listAds = $this->advertise_model->get_ads('home');
            $this->data['listAds'] = $listAds;
            
            $list_cat_menu = $this->news_category_model->get_list_category_menu();
            $this->data['list_cat_menu'] = $list_cat_menu;
           
            $list_event = $this->news_event_model->list_event(5);
            $list_category = $this->news_category_model->build_child_category();                    
            $slug = isset($this->input['slug_name']) ? $this->input['slug_name'] : null; 
   
            $slug_name = $this->templateHelper->build_slug($slug);
            
            $flag = 1;
            $tag_id = 0;

            $object_tag = $this->news_tag_model->get_once("slug_name='{$slug_name}' and status=1");
            
            if(!$slug)
            {
                $flag= 2;
            }
            
            if(!$object_tag)
            {
                $flag = 0;
                $this->data['list_category'] = $list_category;
                $this->template->assign('data',$this->data);
                $this->notfound();
                die();
            }else{
                $tag_id = $object_tag->get('id');
            }

            $list_news = $this->news_articles_join_articles_tag_model->get_list_news_tag($tag_id,0,30);
            
            $list_docnhieu = $this->news_articles_view_model->get_list_art('',11,12);
            $this->data['list_docnhieu'] = $list_docnhieu;
            
            $this->data['list_event'] = $list_event;
            $this->data['list_category'] = $list_category;
            $this->data['object_tag'] = $object_tag;
            $this->data['list_news'] = $list_news;
            $this->data['object']['flag'] = $flag;            

            $this->data['current_category'] = 0;

            $lang_global = $this->language->getLang('global.ln');
            if($object_tag->get("meta_title")){
                $this->data['object']['title'] = $object_tag->get("meta_title"); 
            }else{
                if ($flag == 1){
                    $this->data['object']['title'] = "{$object_tag->get('tag_name')} - tin tức {$object_tag->get('tag_name')} mới nhất";
                }elseif($flag == 2){
                    $this->data['object']['title'] = "Nội dung không tồn tại !";
                }elseif($flag == 0){
                    $this->data['object']['title'] = "Các bài viết liên quan đến {$this->templateHelper->build_slug($object_tag->get('tag_name'))} , tin tức về {$this->templateHelper->build_slug($object_tag->get('tag_name'))}";            
                }
            }
            if($object_tag->get("meta_keyword")) $this->data['object']['meta_keyword'] = $object_tag->get("meta_keyword");     
            else $this->data['object']['meta_keyword'] = $lang_global['global']['keyword'];
            
            if($object_tag->get("meta_description")) $this->data['object']['meta_description'] = $object_tag->get("meta_description");     
            else $this->data['object']['meta_description'] =  "{$object_tag->get('tag_name')} - cập nhật tin tức {$this->templateHelper->remove_accent($object_tag->get('tag_name'))} nhanh chóng, chính xác và đầy đủ nhất về chủ đề {$this->templateHelper->remove_accent($object_tag->get('tag_name'))}";

            $this->template->assign('data',$this->data);

            if($flag==1)
            {
                $this->template->display('tag/index.tpl');                              
            }else{
                $this->notfound();
            }
        }

        public function destroyed() {                           
        
        }
        
        public function notfound()
        {
            header("HTTP/1.0 404 Not Found");
            $this->template->display("notfound/index.tpl");
        }
    }
?>
