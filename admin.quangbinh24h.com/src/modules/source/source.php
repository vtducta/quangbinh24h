<?php  
    class Source extends Module implements IModule {  
        /**
        * tm groups cat model
        * 
        * @var TmGroupsCatModel
        */
        private $tm_groups_cat_model;
        
        /**
        * news category model
        * 
        * @var NewsCategoryModel
        */
        private $news_category_model;  
        /**
        * news event model
        * 
        * @var NewsEventModel
        */
        private $news_event_model; 
        
        /**
        * back link model
        * 
        * @var NewsArticesSourceModel
        */
        private $news_articles_source_model; 
        
        /**
        * permission  model
        * 
        * @var PermissionModel
        */
        private $premission_model;        
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
            $this->news_category_model = Loader::load_model("news_category");
            $this->news_articles_source_model = Loader::load_model("news_articles_source");
            $this->news_event_model = Loader::load_model("news_event");   
            $this->premission_model = Loader::load_model("permission");
            $this->tm_users_model =  Loader::load_model("tm_users");
            $_list_user = $this->tm_users_model->get_list("user_deleted=1","",0,"");
            $user_id = $this->session->get_session("userid");
            $this->data["user_id_login"] = $user_id;
            $this->data['list_user_']=  $_list_user;     
            $this->tm_users_model = Loader::load_model("tm_users");
            $user_id = $this->session->get_session("userid");   
            if(!$user_id || !is_integer($user_id)){            
                Application::redirect($this->linkHelper->linkhome("Login"));
            }else{
                $user_info = $this->tm_users_model->get_list("user_id = '{$user_id}' AND user_deleted=1","",0,1); 
                if(!$user_info) 
                    Application::redirect($this->linkHelper->linkhome("Login"));
                
            }
            
            if(!$this->premission_model->check_permission($user_id,4) && !$this->premission_model->check_permission($user_id,1) && !$this->premission_model->check_permission($user_id,2))
            {
                die('no permission');
            }                             
        }                         

        public function run() {  
            $action = isset($this->input['action']) ? $this->input['action'] : "";          
            switch($action){
                case "add" :
                    $this->add();
                    break;
                case "edit" : 
                    $this->edit();
                    break;
                case "delete" : 
                    $this->delete();
                    break;
                case "manage" : 
                    $this->manage();
                    break;     
            } 
        }

        private function add(){
            if(!$_POST){
                $this->template->assign('data',$this->data);
                $this->template->display("source/add.tpl");  
                die();
            }
            
            #data
            $error = "";
            $name = trim(isset($this->input['name']) ? $this->input['name'] : ""); 
            $description = isset($this->input['description']) ? $this->input['description'] : ""; 
          //  $slug_name  = $this->templateHelper->build_slug($name);
            
            if($name=="")
                $error .= "Chưa nhập nguồn bài viết<br>";
        
            #check existed
            if($this->news_articles_source_model->get_once("name='$name'"))
                $error .= "nguồn bài viết này đã tồn tại";
                
            if(!$error){      
                $word_count = strlen($name);
                #add db
                $source_bean = $this->news_articles_source_model->create_bean();
                $source_bean->set("name",$name);
                $source_bean->set("slug_name",$slug_name);
                $source_bean->set("description",$description);
                $source_bean->set("word_count",$word_count);
                $source_bean->set("status",1);
                
                $this->news_articles_source_model->insert($source_bean);
                $_SESSION['msg'] = "Đã thêm nguồn bài viết thành công";    
            }else
                $_SESSION['error'] = $error;
                
            $this->data["post"] = $_POST;
            $this->template->assign('data',$this->data);
            $this->template->display("source/add.tpl");  
        }
        
        private function edit(){
            $id = isset($this->input['id']) ? $this->input['id'] : 0;     
            $source = $this->news_articles_source_model->get_once("id={$id}");
            if(!$source){
                Application::redirect($this->linkHelper->link_source("manage"));
                die();
            }
            $source = $source->to_array();
            if(!$_POST){
                 $this->data["source"] = $source;
                $this->template->assign('data',$this->data);
                $this->template->display("source/edit.tpl");  
                die();
            }
            
            #data
            $error = "";
            $name = isset($this->input['name']) ? $this->input['name'] : ""; 
            $description= isset($this->input['description']) ? $this->input['description'] : ""; 
            $status = isset($this->input['status']) ? $this->input['status'] : "";
            $slug_name  = $this->templateHelper->build_slug($name);
            
            if($name=="")
                $error .= "Chưa nhập nguồn bài viết<br>";
            
            #check existed
            $check  = $this->news_articles_source_model->get_once("name='$name'");
            if($check && $check->id!=$id)
                $error .= "nguồn bài viết này đã tồn tại";
                
            if(!$error){      
             //   $word_count = strlen($name);
                #add db
                $source_bean = $this->news_articles_source_model->create_bean();
                $source_bean->set("name",$name);
                $source_bean->set("description",$description);
                $source_bean->set("status",$status);
                
                $this->news_articles_source_model->update($source_bean,"id=$id");
                $_SESSION['msg'] = "Đã sửa nguồn bài viết thành công";    
            }else
                $_SESSION['error'] = $error;
                
            $this->data["post"] = $_POST;
            $source["name"] = stripcslashes($name);
            $source["description"] = stripslashes($description);
            $source["status"] = $status;
            
            $this->data["source"] = $source;
            $this->template->assign('data',$this->data);
            $this->template->display("source/edit.tpl");   
        }
        
        private function delete(){
            $id = isset($this->input['id']) ? $this->input['id'] : 0; 
            if(!$id && !is_numeric($id))
                $id = -1 ;
                
            #add db
            $source_bean = $this->news_articles_source_model->create_bean();
            $source_bean->set("status",2);
            $this->news_articles_source_model->update($source_bean,"id='$id'");
            
            Application::redirect($_SERVER["HTTP_REFERER"]);
        }
        
        private function manage(){
            $keyword = isset($this->input['name']) ? $this->input['name'] : ""; 
            $page    = isset($this->input['page']) ? $this->input['page'] : ""; 
            $status  = isset($this->input['status']) ? $this->input['status'] : 1;
            
            $condition = "";
            if($status){
                $condition .= "`status`={$status} ";
            }
            
            if($keyword){
                $keyword = stripcslashes($keyword);
                $_keyword = $this->templateHelper->build_slug($keyword);
                $condition .= "and `name` like '%{$_keyword}%'";
            }
            
            $num = 15;
            $total = $this->news_articles_source_model->get_total($condition);
            $total_page = ceil($total/$num);
            
            if($page<=0 || $page>$total_page){
                $page = 1;
            }
            
            $limit = $num;
            $offset = ($page-1)*$num;
            
            $list_source = $this->news_articles_source_model->get_list($condition,"`id` desc",$offset,$limit);
            
            $this->data["list_source"] = $list_source;
            
            $paging  = Application::paging($page,$total_page,5);
            
            $page = array(
                "current_page" => $page,
                "page"       => $paging,
                "total"        => $total,
                "total_page"   => $total_page,
            );
            $this->data["paging"] = $page;
            
            $this->data["search_data"] = $_GET;
            $this->template->assign('data',$this->data);
            $this->template->display("source/manage.tpl");          
            
        }
        
        public function destroyed() {               
            $this->session->rm_session("msg");
            $this->session->rm_session("error");
            $this->session->rm_session("info");
        }          
    }
?>