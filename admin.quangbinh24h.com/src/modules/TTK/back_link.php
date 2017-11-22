<?php  
    class BackLink extends Module implements IModule {  
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
        * @var BackLinkModel
        */
        private $back_link_model; 
        
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
            $this->back_link_model = Loader::load_model("back_link");
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
            
            if(!$this->premission_model->check_permission($user_id,4))
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
                $this->template->display("back_link/add.tpl");  
                die();
            }
            
            #data
            $error = "";
            $name = isset($this->input['name']) ? $this->input['name'] : ""; 
            $link = isset($this->input['link']) ? $this->input['link'] : ""; 
            $slug_name  = $this->templateHelper->build_slug($name);
            
            if($name=="")
                $error .= "Chưa nhập từ khóa<br>";
            
            if(!preg_match('|^http(s)?://[a-z0-9-]+(.[a-z0-9-]+)*(:[0-9]+)?(/.*)?$|i',$link))
                $error .= "Url không đúng định dạng<br>";
            
            #check existed
            if($this->back_link_model->get_once("slug_name='$slug_name'"))
                $error .= "Từ khóa này đã tồn tại";
                
            if(!$error){      
                $word_count = strlen($name);
                #add db
                $back_link_bean = $this->back_link_model->create_bean();
                $back_link_bean->set("name",$name);
                $back_link_bean->set("slug_name",$slug_name);
                $back_link_bean->set("link",$link);
                $back_link_bean->set("word_count",$word_count);
                $back_link_bean->set("status",1);
                
                $this->back_link_model->insert($back_link_bean);
                $_SESSION['msg'] = "Đã thêm từ khóa thành công";    
            }else
                $_SESSION['error'] = $error;
                
            $this->data["post"] = $_POST;
            $this->template->assign('data',$this->data);
            $this->template->display("back_link/add.tpl");  
        }
        
        private function edit(){
            $id = isset($this->input['id']) ? $this->input['id'] : 0;     
            $back_link = $this->back_link_model->get_once("id={$id}");
            if(!$back_link){
                Application::redirect($this->linkHelper->link_back_link("manage"));
                die();
            }
            $back_link = $back_link->to_array();
                
            if(!$_POST){
                 $this->data["back_link"] = $back_link;
                $this->template->assign('data',$this->data);
                $this->template->display("back_link/edit.tpl");  
                die();
            }
            
            #data
            $error = "";
            $name = isset($this->input['name']) ? $this->input['name'] : ""; 
            $link = isset($this->input['link']) ? $this->input['link'] : ""; 
            $status = isset($this->input['status']) ? $this->input['status'] : "";
            $slug_name  = $this->templateHelper->build_slug($name);
            
            if($name=="")
                $error .= "Chưa nhập từ khóa<br>";
            
            if(!preg_match('|^http(s)?://[a-z0-9-]+(.[a-z0-9-]+)*(:[0-9]+)?(/.*)?$|i',$link))
                $error .= "Url không đúng định dạng<br>";
            
            #check existed
            $check  = $this->back_link_model->get_once("slug_name='$slug_name'");
            if($check && $check->id!=$id)
                $error .= "Từ khóa này đã tồn tại";
                
            if(!$error){      
                $word_count = strlen($name);
                #add db
                $back_link_bean = $this->back_link_model->create_bean();
                $back_link_bean->set("name",$name);
                $back_link_bean->set("slug_name",$slug_name);
                $back_link_bean->set("link",$link);
                $back_link_bean->set("word_count",$word_count);
                $back_link_bean->set("status",$status);
                
                $this->back_link_model->update($back_link_bean,"id=$id");
                $_SESSION['msg'] = "Đã sửa từ khóa thành công";    
            }else
                $_SESSION['error'] = $error;
                
            $this->data["post"] = $_POST;
            $back_link["name"] = stripcslashes($name);
            $back_link["link"] = stripslashes($link);
            $back_link["status"] = $status;
            
            $this->data["back_link"] = $back_link;
            $this->template->assign('data',$this->data);
            $this->template->display("back_link/edit.tpl");   
        }
        
        private function delete(){
            $id = isset($this->input['id']) ? $this->input['id'] : 0; 
            if(!$id)
                $id = -1 ;
                
            #add db
            $back_link_bean = $this->back_link_model->create_bean();
            $back_link_bean->set("status",2);
            $this->back_link_model->update($back_link_bean,"id='$id'");
            
            Application::redirect($_SERVER["HTTP_REFERER"]);
        }
        
        private function manage(){
            $keyword = isset($this->input['name']) ? $this->input['name'] : ""; 
            $page    = isset($this->input['page']) ? $this->input['page'] : ""; 
            $status    = isset($this->input['status']) ? $this->input['status'] : 1;
            
            $condition = "";
            if($status){
                $condition .= "`status`={$status} ";
            }
            
            if($keyword){
                $keyword = stripcslashes($keyword);
                $_keyword = $this->templateHelper->build_slug($keyword);
                $condition .= "and `slug_name` like '%{$_keyword}%'";
            }
            
            $num = 15;
            $total = $this->back_link_model->get_total($condition);
            $total_page = ceil($total/$num);
            
            if($page<=0 || $page>$total_page){
                $page = 1;
            }
            
            $limit = $num;
            $offset = ($page-1)*$num;
            
            $list_back_link = $this->back_link_model->get_list($condition,"`name` asc",$offset,$limit);
            
            $this->data["list_back_link"] = $list_back_link;
            
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
            $this->template->display("back_link/manage.tpl");          
            
        }
        
        public function destroyed() {               
            $this->session->rm_session("msg");
            $this->session->rm_session("error");
            $this->session->rm_session("info");
        }          
    }
?>