<?php  
  class BtvHome extends Module implements IModule {  
      /**
      * tm groups cat model
      * 
      * @var TmGroupsCatModel
      */
      private $tm_groups_cat_model;
      /**
      * news articles view join category model
      * 
      * @var NewsArticlesViewJoinCategoryModel
      */
      private $news_articles_view_join_category_model;
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
          $this->tm_groups_cat_model = Loader::load_model("tm_groups_cat");
          $this->news_articles_view_join_category_model = Loader::load_model("news_articles_view_join_category");
      }                         
  
      public function run() {  
           $user_id = $this->session->get_session("userid");                                 
           if(!$user_id)
           {               
               Application::redirect($this->linkHelper->linkhome("Login"));
           }  
           $list_cat = $this->tm_groups_cat_model->list_cat_user($user_id);          
           $current_page = isset($this->input['page']) ? $this->input['page'] : 1;
           $num        =   Application::$config['paging']['DefaultLoad']['NumberLoad'];     
           $page_show  =   Application::$config['paging']['DefaultLoad']['PageShow'];                                           
           $total= $this->news_articles_view_join_category_model->get_total_news_by_category("a.status=2 AND a.public IS NULL AND a.timer =0 AND b.category_id in({$list_cat}) ","",0,"");           
           $total_page = ceil($total/$num);
           $paging     =   Application::paging($current_page,$total_page,$page_show);  
           $offset     =   ($current_page-1)*$num;
           $limit      =   $num;
           $list_news = $this->news_articles_view_join_category_model->admin_get_news_by_category_sql("a.status=2 AND a.public IS NUll AND a.timer =0 AND b.category_id in ({$list_cat}) ","a.create_date_int DESC,a.id DESC",$offset,$limit);           
           $this->data['paging'] = array(
                    'page' => $paging,
                    'current' => $current_page,
                    'total' => $total_page
            );   
           $this->data['list_news'] = $list_news; 
           print_r("<pre>");
           print_r($this->data);     
           print_r("<br>");     
           print_r('');
           print_r("</pre>");
           exit();
           $this->template->assign('data',$this->data);
           $this->template->display("BTV/index_news_wait.tpl");            
      }
  
      public function destroyed() {               
         $this->session->rm_session("msg");
         $this->session->rm_session("error");
         $this->session->rm_session("info");
      }          
  }
?>
