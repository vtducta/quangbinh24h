<?php
    class CronJobTimer extends Module implements IModule {  

        private $news_articles_view_model;
        private $news_articles_model;

        public function __construct($param=null) {         
            $this->init(get_class($this));

            $this->data = array();
            $lang_global = $this->language->getLang('global.ln');                
            $this->template->assign('Lang', $lang_global);                        
            $this->template->assign('link_helper',$this->linkHelper);
            $this->template->assign('template_helper',$this->templateHelper);
            $this->news_articles_view_model = Loader::load_model("news_articles_view");
            $this->news_articles_model = Loader::load_model("news_articles");
            $this->news_articles_category_view_model = Loader::load_model("news_articles_category_view");
        }                         

        public function run() {   
        /*$check_cli = (php_sapi_name() == 'cli') or defined('STDIN') ;
            if(!$check_cli)
               die("not permission");*/           
            $now = time();
            $list_news_timer = $this->news_articles_view_model->get_list("timer<={$now} and timer>0","",0,2);  
            if(count($list_news_timer))
            {
                foreach($list_news_timer as $key=>$value)
                {                 
                    $bean = $this->news_articles_model->create_bean();
                    $bean->set("create_date_int",$value->get('timer'));
                    $bean->set('timer',0);
                    $this->news_articles_model->update($bean,"id={$value->get('id')}");

                    $bean_a = $this->news_articles_view_model->create_bean();
                    $bean_a->set("create_date_int",$value->get('timer'));
                    $bean_a->set('timer',0);
                    $this->news_articles_view_model->update($bean_a,"id={$value->get('id')}");
                    $this->news_articles_view_model->reset_get_art_by_id($value->get('id'));
                    
                    $this->news_articles_category_view_model->push_news_category_view($value->get('id'));    
                                                     
                }
            }else{
                print("<pre>"); 
                print_r("no news articles");     
                print("</pre>");
            }
        }

        public function destroyed() {               
            $this->session->rm_session("msg");
            $this->session->rm_session("error");
            $this->session->rm_session("info");
        }          
    }
?>
