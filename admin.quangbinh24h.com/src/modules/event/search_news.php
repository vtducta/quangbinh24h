<?php
  class SearchNews extends Module implements IModule {  
      /**
      * sphin helper
      * 
      * @var SphinxHelper
      */
      private $sphinx_helper;
      /**
      * news articles view model
      * 
      * @var NewsArticlesViewModel
      */
      private $news_articles_view_model;      
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
          $this->sphinx_helper = Loader::load_helper("sphinx_helper");
          $this->news_articles_view_model = Loader::load_model("news_articles_view");
          $this->news_event_model = Loader::load_model("news_event");
          $this->news_event_articles_model = Loader::load_model("news_event_articles");
          $this->tm_users_model = Loader::load_model("tm_users");
            $user_id = $this->session->get_session("userid");   
            if(!$user_id || !is_integer($user_id)){            
                Application::redirect($this->linkHelper->linkhome("Login"));
            }else{
                $user_info = $this->tm_users_model->get_list("user_id = '{$user_id}' AND user_deleted=1","",0,1); 
                if(!$user_info) 
                    Application::redirect($this->linkHelper->linkhome("Login"));
                
            }
      }                         
  
      public function run() {          
        $keyword = isset($this->input['keyword']) ? $this->input['keyword'] : '';       
        $keyword = stripslashes($keyword);
        $current_page = isset($this->input['page']) ? $this->input['page'] : 1;
        $event_id = isset($this->input['event_id']) ? $this->input['event_id'] : 0;
        if(!$event_id)
            die("not event !");
        
        $event = $this->news_event_model->get_once("id={$event_id}");
      //  var_dump($event);
        if(!$event || $event->get("status")==3)
            die("not event !");    
                
        $total      = 100;
        $num        =   15;
        $page_show  =   10;        
        $total_page = ceil($total/$num);
        $paging     =   Application::paging($current_page,$total_page,$page_show);  
        $offset     =   ($current_page-1)*$num;
        $limit      =   $num;                        
        $list_key_search = $this->sphinx_helper->get_search_art($keyword,$limit,$offset);           
        $list_news = array();
        foreach($list_key_search as $key=>$value){ 
            $a = $this->news_articles_view_model->admin_get_news_by_mysql("id ={$key}","",0,1);
            if($a && $a[0]["public"]==1 && $a[0]["timer"]==0){
                $check = $this->news_event_articles_model->get_once("a.id = {$a[0]["id"]} AND a.public = 1 AND a.timer = 0 AND e.event_id = {$event_id}");    
                if(!$check)
                    $list_news[] = $a[0];
            }
            
        } 
        $this->data['list_news'] = $list_news;
        $this->data['paging'] = array(
                    'page' => $paging,
                    'current' => $current_page,
                    'total' => $total_page
        );  
        $this->data["event"] = $event; 
        $this->data['keyword']     = $keyword;
        $this->template->assign('data',$this->data);
        $this->template->display("event/search_news.tpl");
      }
  
      public function destroyed() {               
          $this->session->rm_session("msg");
          $this->session->rm_session("error");
          $this->session->rm_session("info");
      }          
  }
?>
