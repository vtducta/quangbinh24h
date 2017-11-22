<?php  
    class ViewNews extends Module implements IModule {          

        private $news_category_model;
        private $news_event_model;
        private $news_articles_join_category_model;
        private $news_articles_view_model;
        private $news_articles_relationship_model;
        private $news_articles_category_view_model;                
        private $news_articles_hit_day_model;
        private $news_articles_hit_week_model;
        private $news_articles_join_category_view_model;
        private $articles_view_join_feature_join_category_view_model;        
        private $news_tag_join_articles_tag_model;
        private $articles_view_join_feature_model;       
        private $news_upload_model;
        private $advertise_model;
        private $news_articles_source_model;
        private $news_journalist_model;

        public function __construct($param=null) {         
            $this->init(get_class($this));

            $this->data = array();
            
            $lang_global = $this->language->getLang('global.ln');                
            $this->template->assign('Lang', $lang_global);                        
            $this->template->assign('link_helper',$this->linkHelper);
            $this->template->assign('template_helper',$this->templateHelper);                        
            $this->news_category_model = Loader::load_model("news_category");            
            $this->news_event_model = Loader::load_model("news_event");
            $this->news_event_articles_model = Loader::load_model("news_event_articles");            
            $this->news_articles_join_category_model = Loader::load_model("news_articles_join_category");            
            $this->news_articles_view_model = Loader::load_model("news_articles_view");                        
            $this->news_articles_hit_day_model = Loader::load_model("news_articles_hit_day");
            $this->news_articles_hit_week_model = Loader::load_model("news_articles_hit_week");            
            $this->news_articles_relationship_model = Loader::load_model("news_articles_relationship");            
            $this->news_articles_category_view_model = Loader::load_model("news_articles_category_view");
            $this->news_articles_join_category_view_model = Loader::load_model("news_articles_join_category_view");
            $this->news_tag_join_articles_tag_model = Loader::load_model("news_tag_join_articles_tag");
            $this->articles_view_join_feature_model = Loader::load_model("articles_view_join_feature");
            $this->articles_view_join_feature_join_category_view_model = Loader::load_model("articles_view_join_feature_join_category_view");
            $this->news_upload_model= Loader::load_model("news_upload");
            $this->news_articles_event_model       = Loader::load_model("news_articles_event");
            $this->advertise_model      = Loader::load_model('advertise');
            $this->news_articles_source_model = Loader::load_model("news_articles_source");
            $this->news_journalist_model = Loader::load_model("news_journalist");

            /*Loader::load(PATH_APP_BASE_HELPER . "netlinkid.php");      */
            $config = array(
            'client_id' => '52a52dde6feb5',
            'client_secret' => 'cd7c97a69eca6dd82b2f95cbfa92062f',
            'redirect_uri' => 'http://danang24h.vn'                
            );
            $this->data['client_id'] = $config['client_id'];       
        }                         

        public function run() {
            $listAds = $this->advertise_model->get_ads('detail');
            $this->data['listAds'] = $listAds;
            
            $list_cat_menu = $this->news_category_model->get_list_category_menu();
            $this->data['list_cat_menu'] = $list_cat_menu;
        
            $list_events = $this->news_event_model->list_event(5);                        
            $this->data['list_event'] = $list_events;     

            $list_category = $this->news_category_model->build_child_category();       
            $id = isset($this->input['id']) ? $this->input['id'] : 0;
            $this->data["news_id"] = $id;
            $slug = isset($this->input['slug_name']) ? $this->input['slug_name'] : "";        
            $_action = isset($this->input['action']) ? $this->input['action'] : "";
            
            $flag = 1;
            $cat_id = 0;

            $object_art = $this->news_articles_view_model->get_art_by_id($id);
            if($object_art && $object_art->get("timer")!=0 && !isset($_GET['preview'])){
                die("bai chua xuat ban !");
            }
            
            if(isset($_GET['preview'])){
                $this->data['noindex'] = 1;
            }
            
            if($object_art && ($slug !=$object_art->get('meta_slug')))
            {
                header("HTTP/1.1 301 Moved Permanently"); 
                Application::redirect($this->linkHelper->link_to_news($object_art->get('meta_slug'),$object_art->get('id')));
            }      

            if(!count($object_art))
            {
                $flag = 0;
                $block_news_not_found = $this->articles_view_join_feature_model->get_news_not_found("b.feature_id =6","",0,20);
                $this->data['block_news_not_found'] = $block_news_not_found;
                $this->data['list_category'] = $list_category;
                $this->NotFound();              
                exit();
            } 
            else {
                $this->data['object_news_title'] = $object_art->get('title');
            }
            
            $current_category = $this->news_articles_category_view_model->get_category_articles($id);          
            if($current_category)
            {
                $cat_id = $current_category[0]->get('category_id'); 
                $this->data['catt'] = $cat_id;                     
                $cat_parent = $this->news_category_model->get_list_category("id={$current_category[0]->get('parent_id')}");                
                $cat_sub = $this->news_category_model->get_list_category("id={$current_category[0]->get('category_id')}");                                        
                if(isset($cat_parent))
                {
                    $this->data['cat_parent'] = $cat_parent[0];               
                }else{
                    $this->data['cat_parent'] = array();
                }
                if(isset($cat_sub))
                {
                    $this->data['cat_sub'] = $cat_sub[0];
                }else{
                    $this->data['cat_sub'] = array() ;
                }                
            } 
            $category_parent = 0;
            if($current_category && $current_category[0]->get('parent_id') !=0) {
                $category_parent = $current_category[0]->get('parent_id');
            }
            elseif($current_category) {
                $category_parent = $current_category[0]->get('category_id');
            }
                   
                   
            $content = $object_art->get('content_text');
            $content = str_replace("&nbsp;"," ",$content);                                                                         
            $content = str_replace("<iframe","<iframe allowfullscreen ",$content);
            //$content = str_replace("text-align: justify;","",$content);
            $content = str_replace('src="/','src="http://nghean24h.vn/',$content);
            $content = str_replace('src="uploads','src="http://nghean24h.vn/uploads',$content);
            $content = preg_replace("/(font-family[^;]*);/i","",$content);
            $content = preg_replace("/(font-size[^;]*);/i","",$content);

            $content = html_entity_decode($content,null,"UTF-8");
            
            $content = str_replace("mediadanang24h.vn/","mediadanang24h.vn/thumb_x500x/",$content);
            
            $content = str_replace("mce-","",$content);      

            if(strpos($content,"presscloud")!==false){
                $content = preg_replace('/\[presscloud\](.*?)\[\/presscloud\]/si',
                                                            '<video width="100%" controls>
                                                              <source src="$1" type="video/mp4">
                                                            Your browser does not support the video tag.
                                                            </video>',
                                                            $content);
            }

            $this->data_content = $object_art;
            
            if(isset($_COOKIE["tbt_editable"])) $html_edit = '<a href="http://admin.danang24h.vn/?act=AcpEditNews&id='.$id.'" target="_blank" style="display: block;text-align: center;width: 100px;background: #2f59ba;color: #fff;margin: 0 auto;">Sửa bài</a>';
            elseif(isset($_COOKIE["admin_editable"])) $html_edit = '<a href="http://admin.danang24h.vn/?act=AdminEditNews&id='.$id.'" target="_blank" style="display: block;text-align: center;width: 100px;background: #2f59ba;color: #fff;margin: 0 auto;">Sửa bài</a>';
            else $html_edit = '';
            $this->data['html_edit'] = $html_edit;
            
            $journalist = $this->news_journalist_model->get_news_journalist($id);
            if($journalist) $this->data['journalist'] = $journalist[0]['pen_name'];
            else $this->data['journalist'] = '';
            
            $art_source = $this->news_articles_source_model->get_list("status=1 and `id`={$object_art->get('source_id')}","`name` asc",0,1);
            if($art_source && count($art_source)>0) $this->data['art_source'] = $art_source[0];
            else $this->data['art_source'] = array();
            
            if($listAds['mobile-middle-content']){
                $ads_giuabaiviet = '<p id="palace_holder" class="block_mobile"></p><div id="netlink_ads_code" style="display: none;">'.$listAds['mobile-middle-content'].'</div>';
            }else{
                $ads_giuabaiviet = '';
            }
            
            $content_table = explode("<p",$content);
            $count_content_table = count($content_table);
            if($count_content_table>4){
                $content_table_num = intval($count_content_table / 2) - 1; 
                $content_table[$content_table_num] .= $ads_giuabaiviet;
                $content_table[$count_content_table-1] = $content_table[$count_content_table-1];
                $content = implode($content_table, "<p");
            }
            
            $object_art->set('content_text',$content);

            if($object_art)
            {
                $object_art->set('content_text',$this->templateHelper->autofix_html($object_art->get('content_text')));
            }

            $start_time = $object_art->get('create_date_int');
            $end_time = $start_time-3600*24*10;
            
            $list_event_detail = $this->news_event_model->get_list("status=1 AND category_id={$category_parent}","id DESC",0,7);
            $this->data['list_event_detail'] = $list_event_detail;

            $list_tag = $this->news_tag_join_articles_tag_model->get_list_tag_art($id);

            $this->data['list_category'] = $list_category;            

            $this->data['list_tag'] = $list_tag;             

            $this->data['current_category'] = $category_parent;  
                
            $this->data['cat_id'] = $cat_id;            
            $this->data['content'] = $object_art;            

            $upload_image = $this->news_upload_model->get_once("id={$object_art->get("images")}");

            if($upload_image)
            {
                $this->data['flag_fb_image'] = 1;
                $this->data['news_content_thumb'] = $this->templateHelper->get_thumb_image($upload_image->get("upload_url"),480,250);
            }elseif($object_art)
            {
                $image_thumb_data = "";
                $this->data['flag_fb_image'] = 1;
                $this->data['news_content_thumb'] = $image_thumb_data;
            }                                   
            $lang_global = $this->language->getLang('global.ln');        
            if($object_art && $object_art->get('public') == 1) 
            {
                $title = $this->templateHelper->remove_accent($object_art->get('title'));            
                $this->data['object']['facebook'] = htmlspecialchars(strip_tags($object_art->get('title')));
                $this->data['object']['facebookDesc'] =  htmlspecialchars($this->templateHelper->truncate_char($object_art->get('intro_text'),255));                
                if($object_art->get('meta_title')) $title = $object_art->get('meta_title'); else $title = $object_art->get('title');
                $this->data['object']['title'] = $title;
                if($object_art->get('meta_description')) $description = $object_art->get('meta_description');
                else $description = $object_art->get('intro_text');

                $this->data['object']['meta_description'] = htmlspecialchars($description);
                if($object_art->get('meta_keywork')){
                    $keyword = $object_art->get('meta_keywork');
                    $keyword = str_replace(array("\r","\t","\n"),"",$keyword);
                    $this->data['object']['meta_keyword'] = htmlspecialchars($keyword);
                }else
                    $this->data['object']['meta_keyword'] = $this->news_tag_join_articles_tag_model->get_list_tag($id,'');
            }
            
            #list event of this article
            $art_list_event = $this->news_articles_event_model->get_event_by_article($id);
            $this->data["art_list_event"] = $art_list_event;

            $list_news = $this->news_articles_join_category_view_model->get_news_by_category_ndt($cat_id,1,"b.create_date_int DESC",0,8);
            $this->data['list_news'] = $list_news;

            $list_docnhieu = $this->news_articles_view_model->get_list_art('',21,12);
            $this->data['list_docnhieu'] = $list_docnhieu;
            
            $news_relationship = $this->news_articles_relationship_model->get_news_relationship_by_id($object_art->get('id'),'');
            $this->data['news_relationship'] = $news_relationship;
            
            #link news
            $this->data['link_news'] = $this->linkHelper->link_to_news($slug,$id);
            $this->data['site'] = "detail";

            $this->template->assign('data',$this->data);
            if($flag!=0){
                $this->template->display('view/index.tpl');            
            }
            else $this->NotFound();              
        }

        public function destroyed(){               
        } 
        public function NotFound()
        {
            header("HTTP/1.0 404 Not Found");
            $this->template->assign('data',$this->data);
            $this->template->display('notfound/index.tpl');                 
        }
    }
?>
