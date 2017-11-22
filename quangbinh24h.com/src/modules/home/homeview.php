<?php  
    class home extends Module implements IModule {  

        private $articles_view_join_feature_model;
        private $news_category_model;
        private $news_event_model;
        private $news_articles_hit_day_model;
        private $news_articles_view_model;
        private $articles_view_join_feature_join_category_view_model;
        private $news_articles_join_category_view_model;
        private $news_articles_feature_data_model;
        private $news_event_articles_model;
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
            $this->news_articles_hit_day_model = Loader::load_model("news_articles_hit_day");
            $this->news_articles_view_model = Loader::load_model("news_articles_view");
            $this->articles_view_join_feature_join_category_view_model = Loader::load_model("articles_view_join_feature_join_category_view");
            $this->news_articles_join_category_view_model = Loader::load_model("news_articles_join_category_view");
            $this->news_articles_feature_data_model = Loader::load_model("news_articles_feature_data");
            $this->news_event_articles_model = Loader::load_model("news_event_articles");
            $this->advertise_model      = Loader::load_model('advertise');
        } 

        public function run() {
            $listAds = $this->advertise_model->get_ads('home');
            $this->data['listAds'] = $listAds;
            
            $list_cat_menu = $this->news_category_model->get_list_category_menu();
            $this->data['list_cat_menu'] = $list_cat_menu;
            
            $list_events = $this->news_event_model->list_event(5);
            $this->data['list_event'] = $list_events;            

            $list_category = $this->news_category_model->build_child_category();   
            $this->data['list_category'] = $list_category;
            
            //$list_lastest = $this->news_articles_view_model->get_list_art('',12,0);

            $block_hot = $this->articles_view_join_feature_model->get_news_feature_by_id_ndt(1,"b.id DESC",0,1);
            $block_noibat = $this->articles_view_join_feature_model->get_news_feature_by_id_ndt(2,"b.id DESC",0,9);
            $block_moinhat = $this->articles_view_join_feature_model->get_news_feature_by_id_ndt(3,"b.id DESC",0,7);
            $block_hot_chuyenmuc = $this->articles_view_join_feature_model->get_news_feature_by_id_ndt(4,"b.id DESC",0,1);
            $list_lastest = array_merge($block_hot,$block_noibat,$block_moinhat);

            $this->data['list_lastest'] = $list_lastest;

            //$list_docnhieu = $this->news_articles_view_model->get_list_art('',21,12);
            $list_docnhieu = $this->news_articles_hit_day_model->get_news_hit_view_24h(0,11);
            $this->data['list_docnhieu'] = $list_docnhieu;

            $list_quantam = $this->news_articles_view_model->get_list_art('',10,33);
            $this->data['list_quantam'] = $list_quantam;

            // danh sach bai viet tieu diem chuyen muc
            $list_news_cat = array();
            
            foreach($list_cat_menu as $key=>$value) 
            {
                $news_hot_cat = $this->articles_view_join_feature_join_category_view_model->get_news_feature_by_category(4,$value['id'],"b.id DESC",0,1);
                if($value['id']==1) $limit = 8;
                else $limit = 4;
                $list_news_cat[] = array(
                    'id' => $value['id'],
                    'title' => $value['title'],
                    'meta_slug' => $value['meta_slug'],
                    //'list_news' => $this->articles_view_join_feature_join_category_view_model->get_news_feature_by_category(20,$value['id'],"b.id DESC",0,5)
                    'list_news' => $this->news_articles_join_category_view_model->get_news_by_category_ndt_v2($value['id'],$news_hot_cat[0]['id'],1,"b.create_date_int DESC",0,$limit),
                    'news_hot_cat' => $news_hot_cat
                );
                if($value['id']==1){
                  $news_hot_cat = $this->articles_view_join_feature_join_category_view_model->get_news_feature_by_category(4,17,"b.id DESC",0,1);
                    $list_news_cat[] = array(
                        'id' => 17,
                        'title' => 'Tin địa phương',
                        'meta_slug' => 'tin-dia-phuong',
                        'list_news' => $this->news_articles_join_category_view_model->get_news_by_category_ndt_v2(17,$news_hot_cat[0]['id'],1,"b.create_date_int DESC",0,4),
                        'news_hot_cat' => $news_hot_cat
                    );
                }
                if($value['id']==20){
                    
                }
            }
            $this->data['list_news_cat'] = $list_news_cat;
            
            $this->data['current_category'] = 0;
            $lang_global = $this->language->getLang('global.ln');
            $this->data['object']['title'] = "Tin tuc - Đọc báo tin tức online mới nhất trong ngày";
            $this->data['object']['meta_keyword'] = "Tin tức, tin tuc, tin mới, tin tức trong ngày, đọc báo, tin tức online,tin tức 24h";
            $this->data['object']['meta_description'] = "Tin tức mới nhất trong ngày, thông tin nhanh nhất 24h hàng ngày. Đọc báo tin tức online cập nhật tin nóng thời sự pháp luật, giải trí..."; 
            $this->data['object']['url'] = $this->linkHelper->get_current_url();
            $this->data['object']['site'] = "Home";
            $this->data['site'] = "Home";
            $this->template->assign("data",$this->data);
            $this->template->display("home/index.tpl");
        }

        public function destroyed() {               
        }          
    }
?>
