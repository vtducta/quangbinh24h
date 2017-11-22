<?php
    class SiteMapv2 extends Module implements IModule {  
        /**
        * news articles view model
        * 
        * @var NewsArticlesViewModel
        */
        private $news_articles_view_model;
        /**
        * news articles hit day model
        * 
        * @var NewsArticlesHitDayModel
        */
        private $news_articles_hit_day_model;
        /**
        * news articles hit week model
        * 
        * @var NewsArticlesHitWeekModel
        */
        private $news_articles_hit_week_model;
        /**
        * news artiles hit model
        * 
        * @var NewsArticlesHitModel
        */
        private $news_articles_hit_model;
        /**
        * news event model
        * 
        * @var NewsEventModel
        */
        private $news_event_model;
        
        /**
        * api model
        * 
        * @var ApiExModel
        */
        private $api_ex_model;
        
        /**
        * news category model
        * 
        * @var NewsCategoryModel
        */
        private $news_category_model;
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
            $this->news_articles_view_model = Loader::load_model("news_articles_view");
            $this->news_articles_hit_model = Loader::load_model("news_articles_hit");
            $this->news_articles_hit_day_model = Loader::load_model("news_articles_hit_day");
            $this->news_event_model = Loader::load_model("news_event");
            $this->news_articles_hit_week_model = Loader::load_model("news_articles_hit_week");
            $this->news_category_model = Loader::load_model("news_category");
            
            $this->news_event_articles_model = Loader::load_model("news_event_articles");
            $this->news_articles_event_model = Loader::load_model("news_articles_event");
            
            $this->news_articles_join_category_view_model = Loader::load_model("news_articles_join_category_view");
            
            $this->tv_dspl_model  = Loader::load_model("tv_dspl");
            
            
            $this->api_ex_model = Loader::load_model("api_ex");
        }  

        public function run() {   
           
            $action = isset($this->input["action"]) ? $this->input["action"] : "";
            
            $allow_action_array =array("home","category","event","month","cmonth");
            
            if(!in_array($action,$allow_action_array)){
                die("not permission");    
            }
            
            if($action=="home")
                $this->home();
            
            if($action=="category")
                $this->category();
                
            if($action=="event"){
                $this->event();
            }
            
            if($action=="month"){
                $this->month();
            }
            
            if($action="cmonth"){
                $this->current_month();
            }
        }  
        
        private function home(){
            $end_time = strtotime("2013-01-01");  
            
            $day   = date("d");
            $month = date("m");
            $year  = date("Y");
            $h = date("H");
            $p = date("i");
            $s = date("s");
            
            $current_month = strtotime("$year-$month-01");
            
            $current_date = date("Y-m-d");
            
            ob_clean();
            header("Content-type: text/xml; charset=utf-8");
            echo '<?xml version="1.0" encoding="UTF-8"?>
   <sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
<sitemap>
<loc>http://danang24h.vn/sitemaps/categories.xml</loc>
<lastmod>'.$current_date.'</lastmod>
</sitemap>';
            $run=0;                                                         
            while($current_month>=$end_time){
                $_m = date("m",$current_month);
                $_y = date("Y",$current_month);
                $m = (int)date("m",$current_month);
                $y = (int)date("Y",$current_month);
                
                if($run==0)
                    $t = $day ;
                else
                    $t = date("t",$current_month);
                echo '<sitemap>
                        <loc>http://danang24h.vn/sitemaps/news-'.$y.'-'.$m.'.xml</loc>
                        <lastmod>'.$_y.'-'.$_m.'-'.$t.'</lastmod>
                        </sitemap>';    
                
                $current_month = strtotime("-1 month",$current_month);    
                $run++;
            }
            
            echo '<sitemap>
<loc>http://danang24h.vn/sitemaps/dongsukien.xml</loc>
<lastmod>'.$current_date.'</lastmod>
</sitemap></sitemapindex>';
            die();    
        }
        
        private function category(){
            $current_day = date("c");
            $list_category = $this->news_category_model->get_list_category("status=1 AND home_display=0 and id!=230 and parent_id!=230","parent_id asc, `ordering` desc",0,300);
            ob_clean();
            header("Content-type: text/xml; charset=utf-8"); 
            echo '<urlset xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">
                <url>
                <loc>http://danang24h.vn</loc>
                <lastmod>'.$current_day.'</lastmod>
                <changefreq>always</changefreq>
                <priority>1.0</priority>
                </url>
                ';
            foreach($list_category as $category){
                
                    $link = $this->linkHelper->link_to_category($category->meta_slug,0);
                    echo '<url>
                        <loc>
                        '.$link.'
                        </loc>
                        <lastmod>'.$current_day.'</lastmod>
                        <changefreq>always</changefreq>
                        <priority>0.9</priority>
                    </url>';
               
            }
            echo '</urlset>';
            die();
        }
        
        private function event(){
            $current_day = date("c");
            $list_event = $this->news_event_model->get_active_event(300,0);
            ob_clean();
            header("Content-type: text/xml; charset=utf-8"); 
            echo '<urlset xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">
                <url>
                <loc>http://danang24h.vn</loc>
                <lastmod>'.$current_day.'</lastmod>
                <changefreq>always</changefreq>
                <priority>1.0</priority>
                </url>
                ';
            foreach($list_event as $event){
                $link = $this->linkHelper->link_to_event($event->meta_slug,$event->id,0);
                echo '<url>
                    <loc>
                    '.$link.'
                    </loc>
                    <lastmod>'.$current_day.'</lastmod>
                    <changefreq>always</changefreq>
                    <priority>0.8</priority>
                </url>';
            }
            echo '</urlset>';
            die();    
        }
        
        private function current_month(){
        
            $check_cli = (php_sapi_name() == 'cli') or defined('STDIN') ;
            if(!$check_cli)
               die("not permission");
               
            set_time_limit(0); 
            $end_time = strtotime("2013-01-01"); 
            
            $current_y = (int)date("Y");
            $current_m = (int)date("m");
            $end_y     = (int)date("Y",$end_time);
            
            $m = date("m");
            $y = date("Y");
            
            if($y > $current_y || $y < $end_y)
                die("not permission");
            
            if($m < 1 || $m > 12)
                die("not permssion");
            
            $current_day = date("c");
            
            $start_time = strtotime("$y-$m-01");
            $end_time   = strtotime("next month",$start_time);
            
            if($y==$current_y && $m==$current_m){
                $list_art = $this->news_articles_view_model->site_map_get_list_art($start_time,$end_time,500);
            }else
                $list_art = $this->news_articles_view_model->site_map_get_list_art($start_time,$end_time,500,false);
                                                                                                                          
            ob_clean();
            header("Content-type: text/xml; charset=utf-8"); 
            $result = '<urlset xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">
                <url>
                <loc>http://danang24h.vn</loc>
                <lastmod>'.$current_day.'</lastmod>
                <changefreq>always</changefreq>
                <priority>1.0</priority>
                </url>
                ';
            foreach($list_art as $art){
                $meta_slug = $this->templateHelper->remove_accent($art["meta_slug"]);
                $link = $this->linkHelper->link_to_news($meta_slug,$art["id"],0);
                if(date("m")==$m && date("Y")==$y)
                    $time = date("Y-m-d");
                else
                    $time = date("Y-m-d",$end_time-1);
                $result .= '<url>
                    <loc>
                    '.$link.'
                    </loc>
                    <lastmod>'.$time.'</lastmod>
                    <changefreq>always</changefreq>
                    <priority>0.7</priority>
                </url>';
            }
            $result .= '</urlset>';
            
            $public_path = PATH_APP_ROOT."html".DS."public/sitemaps".DS;
            if(!is_dir($public_path))
                @mkdir($public_path,0777,true);
            
     //       echo $public_path;   
            $m = (int)$m; 
            $file_name = $public_path."news-$y-$m.xml";
   //         echo $file_name;
            @file_put_contents($file_name,$result);
            echo $result;
            die();           
        }
        
        private function month(){   
            
            set_time_limit(0); 
            $end_time = strtotime("2013-01-01"); 
            
            $current_y = (int)date("Y");
            $current_m = (int)date("m");
            $end_y     = (int)date("Y",$end_time);
            
            $m = isset($this->input["m"]) ? $this->input["m"] : 0;
            $y = isset($this->input["y"]) ? $this->input["y"]  : 0;
            
            if($y > $current_y || $y < $end_y){
                die("not permission");     
            }
                
            
            if($m < 1 || $m > 12){
                die("not permssion");
            }
                
            
            $current_day = date("c");
            
            $start_time = strtotime("$y-$m-01");
            $end_time   = strtotime("next month",$start_time);
            
            if($y==$current_y && $m==$current_m){
                $list_art = $this->news_articles_view_model->site_map_get_list_art($start_time,$end_time,100);
            }else{
                $check_cli = (php_sapi_name() == 'cli') or defined('STDIN') ;
                /*if(!$check_cli){
                    echo '3';
                    die("not permission");                        
                } */
                   
               
                $list_art = $this->news_articles_view_model->site_map_get_list_art($start_time,$end_time,500);               
            }
            
            ob_clean();
            header("Content-type: text/xml; charset=utf-8"); 
            $result = '<urlset xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">
                <url>
                <loc>http://danang24h.vn</loc>
                <lastmod>'.$current_day.'</lastmod>
                <changefreq>always</changefreq>                                     
                <priority>1.0</priority>
                </url>
                ';
            foreach($list_art as $art){
                $meta_slug = $this->templateHelper->remove_accent($art["meta_slug"]);
                $link = $this->linkHelper->link_to_news($meta_slug,$art["id"],0);
                if(date("m")==$m && date("Y")==$y)
                    $time = date("Y-m-d");
                else
                    $time = date("Y-m-d",$end_time-1);
                $result .= '<url>
                    <loc>
                    '.$link.'
                    </loc>
                    <lastmod>'.$time.'</lastmod>
                    <changefreq>always</changefreq>
                    <priority>0.7</priority>
                </url>';
            }
            $result .= '</urlset>';
            
            $public_path = PATH_APP_ROOT."html".DS."public/sitemaps".DS;
            if(!is_dir($public_path))
                @mkdir($public_path,0777,true);
                
            $file_name = $public_path."news-$y-$m.xml";
            file_put_contents($file_name,$result);
            echo $result;
            die();       
        }
        
        public function destroyed() {                          
        }          
    }
?>

