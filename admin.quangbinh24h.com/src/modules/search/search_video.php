<?php
  class SearchVideo extends Module implements IModule {
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
          $this->sphinx_helper1 = Loader::load_helper("sphinx_helper1");
          $this->news_articles_view_model = Loader::load_model("news_articles_view");
          $this->news_category_model =  Loader::load_model("news_category");
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
        $list_category = $this->news_category_model->build_child_category_sql();
        $this->data["list_category"] = $list_category;
        $keyword = isset($this->input['keyword']) ? $this->input['keyword'] : '';
        $keyword = stripslashes($keyword);
        $select_cat = isset($this->input['select_cat']) ? $this->input['select_cat'] : 0;
        $this->data["keyword"] = $keyword;
        $this->data["select_cat"] = $select_cat;

        $list_video_category = $this->news_category_model->get_list_category_mysql("status=1 and home_display=0 and (parent_id=219 || parent_id=230)","",0,"");
        $tmp = array();
        $tmp[] = 219;
        $tmp[] = 230;
        if(!$select_cat || $select_cat==219 || $select_cat==230)
            foreach($list_video_category as $cate){
                if($select_cat==219 || $select_cat==230){
                    if($cate->get("parent_id")==$select_cat)
                        $tmp[] = $cate->get("id");
                }else
                    $tmp[] = $cate->get("id");
            }
        else
            $tmp[] = $select_cat;

      //  var_dump($tmp);

        $list_key_search = $this->sphinx_helper1->get_search_art($keyword,10,0,$tmp);
        $list_news = array();
        foreach($list_key_search as $key=>$value){
            $a = $this->news_articles_view_model->admin_get_news_by_mysql_vd("id ={$key}","",0,1);
            if($a && isset($a[0]) && $a[0]["content"])
                $list_news[] = $a[0];
        }
      //  var_dump($list_news);
        $this->data['list_news'] = $list_news;


        $this->template->assign('data',$this->data);
        $this->template->display("search/search_video.tpl");
      }

      public function destroyed() {
          $this->session->rm_session("msg");
          $this->session->rm_session("error");
          $this->session->rm_session("info");
      }
  }
?>
