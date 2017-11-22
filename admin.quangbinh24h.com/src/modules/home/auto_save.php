<?php
    class AutoSave extends Module implements IModule {  
    /**
    * news articles view model
    * 
    * @var NewsArticlesViewModel
    */
    private $news_articles_view_model;  
    /**
    * news categpory model
    * 
    * @var NewsCategoryModel
    */
    private $news_category_model;
    /**
    * permission  model
    * 
    * @var PermissionModel
    */
    private $premission_model;
    /**
      * news articles join category view model
      * 
      * @var NewsArticlesJoinCategoryViewModel
      */
      private $news_articles_join_category_view_model;    
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
        $this->news_articles_view_model= Loader::load_model("news_articles_view");                             
        $this->news_articles_category_view_model= Loader::load_model("news_articles_category_view");
        $this->news_category_model = Loader::load_model("news_category");
        $this->news_articles_join_category_view_model = Loader::load_model("news_articles_join_category_view");
        $this->premission_model = Loader::load_model("permission");
        $this->auto_save_model = Loader::load_model("auto_save");
    }                         

    public function run() { 
        $user_id = $this->session->get_session("userid");
        $title=$_GET['title'];
        $intro_text=$_GET['short_desc'];
        $content_text=$_GET['content'];
        
        $auto_save = $this->auto_save_model->get_once("user_id = {$user_id}");
        if(!empty($auto_save))
        {
            $bean = $this->auto_save_model->create_bean();
            $bean->set("title",$title);
            $bean->set("intro_text",$intro_text);
            $bean->set("content_text",$content_text);
                    
            $this->auto_save_model->update($bean,"user_id = {$user_id}");
        }else{
            $bean = $this->auto_save_model->create_bean();
            $bean->set("user_id",$user_id);
            $bean->set("title",$title);
            $bean->set("intro_text",$intro_text);
            $bean->set("content_text",$content_text);
             
            $this->auto_save_model->insert($bean);
        }
    }

        public function destroyed() {
            $this->session->rm_session("msg");
            $this->session->rm_session("error");
            $this->session->rm_session("info");
        }          
    }
?>
