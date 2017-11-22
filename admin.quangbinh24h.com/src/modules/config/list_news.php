<?php
  class ListNews extends Module implements IModule {  
      /**
      * news articles view model
      * 
      * @var NewsArticlesViewModel
      */
      private $news_articles_view_model;
      /**
      * news articles join category view model
      * 
      * @var NewsArticlesjoinCategoryViewModel
      */
      private $news_articles_join_category_view_model;
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
          $this->news_category_model = Loader::load_model("news_category");
          $this->news_articles_view_model = Loader::load_model("news_articles_view");
          $this->news_articles_join_category_view_model = Loader::load_model("news_articles_join_category_view");
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
        $id = isset($this->input['id']) ? $this->input['id'] : 0;  
        $id = intval($id);
        $current_page = isset($this->input['page']) ? $this->input['page'] : 1;
        $current_page = intval($current_page);
        $num        =   10;
        $page_show  =   7;
        $total= 200;      
        $total_page = ceil($total/$num);
        $paging     =   Application::paging($current_page,$total_page,$page_show);  
        $offset     =   ($current_page-1)*$num;
        $limit      =   $num;        
        $category = $this->news_category_model->get_list("id = {$id}","id DESC",0,1);
        if(isset($category[0]))
        {
            $this->data['category'] = $category[0]->get('title');
        }else{
            $this->data['category'] = "Trang chủ";
        }
        if($id)
        {             
            $list_news = $this->news_articles_join_category_view_model->admin_get_news_by_category_sql("a.status=3 AND a.public=1 AND a.timer =0 AND (b.category_id={$id} OR b.parent_id ={$id})","a.create_date_int DESC,a.id DESC",$offset,$limit);                           
        }else{              
            $list_news = $this->news_articles_view_model->admin_get_news_by_mysql("status=3 AND public=1 AND timer=0","create_date_int DESC,id DESC",$offset,$limit);              
        }
        $this->data['list_news'] = $list_news;        
        $this->data['paging'] = array(
                    'page' => $paging,
                    'current' => $current_page,
                    'total' => $total_page
        );                   
        $this->template->assign('data',$this->data);          
        $this->template->display("manager/list_news.tpl");
      }
  
      public function destroyed() {               
          $this->session->rm_session("msg");
          $this->session->rm_session("error");
          $this->session->rm_session("info");
      }          
  }
?>
