<?php
    class UserAction extends Module implements IModule {  

        private $tm_users_model;
        private $tm_user_permissions_model;
        private $tm_group_user_model;
        private $tm_groups_cat_model;
        private $news_articles_model;
        private $news_articles_view_model;
        public function __construct($param=null) {         
            $this->init(get_class($this));

            $this->data = array();
            $lang_global = $this->language->getLang('global.ln');                
            $this->template->assign('Lang', $lang_global);                        
            $this->template->assign('link_helper',$this->linkHelper);
            $this->template->assign('template_helper',$this->templateHelper);
            $this->tm_users_model = Loader::load_model("tm_users");          
            $this->tm_user_permissions_model = Loader::load_model("tm_user_permissions");
            $this->tm_group_user_model = Loader::load_model("tm_group_user");
            $this->tm_groups_cat_model = Loader::load_model("tm_groups_cat");
            $this->news_articles_model = Loader::load_model("news_articles");
            $this->news_articles_view_model = Loader::load_model("news_articles_view");
            $this->premission_model = Loader::load_model("permission");
            $this->tm_users_model = Loader::load_model("tm_users");
            $user_id = $this->session->get_session("userid");   
        }                         

        public function run() {            
            $action = isset($this->input['action']) ? $this->input['action'] : null;             
            $username = isset($this->input['username']) ? $this->input['username'] : null;        
            $username = stripslashes($username);
            $userpass = isset($this->input['password']) ? $this->input['password'] : "password";        
            $fullname = isset($this->input['user_fullname']) ? $this->input['user_fullname'] : null;        
            $phone = isset($this->input['user_phone']) ? $this->input['user_phone'] : null;
            $sex = isset($this->input['sex']) ? $this->input['sex'] : "";
            $address = isset($this->input['user_address']) ? $this->input['user_address'] : null;
            $provinde = isset($this->input['user_provinde']) ? $this->input['user_provinde'] : null;        
            $email = isset($this->input['email']) ? $this->input['email'] : null;        
            $current_pass = isset($this->input['current_pass']) ? $this->input['current_pass'] : null;        
            $pass_new = isset($this->input['pass_new']) ? $this->input['pass_new'] : null;
            $re_pass_new = isset($this->input['re_pass_new']) ? $this->input['re_pass_new'] : null;
            $user_birthdayYear = isset($this->input['user_birthdayYear']) ? $this->input['user_birthdayYear'] : null;
            $user_birthdayDay = isset($this->input['user_birthdayDay']) ? $this->input['user_birthdayDay'] : null;
            $user_birthdayMonth = isset($this->input['user_birthdayMonth']) ? $this->input['user_birthdayMonth'] : null;
            $user_cmnd = isset($this->input['user_CMND']) ? $this->input['user_CMND'] : null;
            $user_status = isset($this->input['status']) ? $this->input['status'] : null;
            $groupname = isset ($this->input['groupname']) ? $this->input['groupname'] : null;           
            $news_cat = isset($this->input['news_cat']) ? $this->input['news_cat'] : null;                
            $start_time = isset($this->input['start_time']) ? $this->input['start_time'] : null;
            $end_time = isset($this->input['end_time']) ? $this->input['end_time'] : null;   

            $allow_public = isset($this->input['allow_public']) ? $this->input['allow_public'] : 0;                 

            $id = isset($this->input['id']) ? $this->input['id'] : 0;

            $url = isset($this->input['url']) ? $this->input['url'] : $this->linkHelper->linkhome("Royalties");
            $review = isset($this->input['review']) ? $this->input['review'] : array();            
            $salary = isset($this->input['salary']) ? $this->input['salary'] : array();
            $listuser = isset($this->input['listuser']) ? $this->input['listuser'] : array();
            $category = isset($this->input['category_news']) ? $this->input['category_news'] : array();
            $error = isset($this->input['error']) ? $this->input['error'] : array();

            $id_user =$this->session->get_session('userid');
            $now = time();
            switch($action)
            {
                case "login":
                    Loader::load(PATH_APP_BASE_HELPER."/recaptchalib.php");
                    $privatekey = "6LcsDQgUAAAAAPEaoo7e6GXQtqoGHeJ2KwVh6y5Z";        
                    if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
                    else if (isset($_SERVER['REMOTE_ADDR'])) $ip = $_SERVER['REMOTE_ADDR'];
                        else $ip = "UNKNOWN"; 

                    $error = 1;              
                    # was there a reCAPTCHA response?
                    if (isset($_POST["g-recaptcha-response"])) {
                        $reCaptcha = new ReCaptcha($privatekey);
                        $response = $reCaptcha->verifyResponse(
                            $ip,
                            $_POST["g-recaptcha-response"]
                        );
                        if ($response != null && $response->success) {
                            $error = 0;
                        }
                    }
                    if($error){
                        $this->session->set_session('error','Bạn chưa nhập captcha hoặc nhập sai');
                        Application::redirect($this->linkHelper->linkhome('login'));       
                    }

                    if (!preg_match("/^([a-zA-Z0-9_ \.-]+)$/i",$username)){    
                        $this->session->set_session('error','Bad request');
                        Application::redirect($this->linkHelper->linkhome('login'));
                    }

                    if(($username <> "") && ($userpass <> "")) {  
                        $username = strval($username);
                        $user_info = $this->tm_users_model->get_list("username = '{$username}' AND user_deleted=1","",0,1);
                        
                        if($user_info){                          
                            $username_db = $user_info[0]->get('username');
                            $userpass_db = $user_info[0]->get('password');
                            $user_id_db  = $user_info[0]->get('user_id');
                            if(md5($userpass) === $userpass_db) {                                             
                                $user_permission = $this->tm_user_permissions_model->get_list("user_id={$user_info[0]->get('user_id')} AND  ({$now} >=start_time AND {$now}<=end_time)","id DESC",0,1);                                                                                  
                                if(!$user_permission)
                                {                                
                                    $group_user = $this->tm_group_user_model->get_list("user_id = {$user_info[0]->get('user_id')}","",0,1);
                                    $group_user_ = $group_user[0]->get('group_id');                                   
                                }else {
                                    $group_user_ = $user_permission[0]->get('group_user');          
                                }                              
                                $this->session->set_session('groupuser',$group_user_);                                
                                $this->session->set_session('userid',$user_info[0]->get('user_id'));
                                $this->session->set_session('msg',"Welcome {$user_info[0]->get('fullname')} !");                                                                                          
                                if($group_user_==2 || $group_user_==5)
                                {   
                                    Application::redirect($this->linkHelper->linkhome('BtvNewsPublic'));    
                                }
                                if($group_user_==1)
                                {
                                    Application::redirect($this->linkHelper->linkhome('AdminHome'));    
                                }  
                                if($group_user_==3)
                                {
                                    Application::redirect($this->linkHelper->linkhome('HomeReporter'));    
                                } 
                                if($group_user_==4)
                                {                              
                                    Application::redirect($this->linkHelper->linkhome('AcpHome'));
                                }           
                            }else {
                                $this->session->set_session('error','Sai password');
                                Application::redirect($this->linkHelper->linkhome('login'));
                            }
                        }else {

                            $n = $this->session->get_session("count_error_login");
                            if(!$n){
                                $n=1;
                                $this->session->set_session("count_error_login",1);
                            }else
                                $this->session->set_session("count_error_login",$n+1);

                            //  $n = $this->session->get_session("count_error_login");
                            if($n>10){
                                header('Content-Type: text/html; charset=utf-8');
                                die("bạn đã đăng nhập sai quá 10 lần, tài khoản của bạn đã bị khóa, vui lòng liên hệ quản trị viên");   
                            }

                            $this->session->set_session('error','Tài khoản không tồn tại '.$n);
                            Application::redirect($this->linkHelper->linkhome('login'));                        
                        }
                    }else {
                        $this->session->set_session('error','Username or password is empty');
                        Application::redirect($this->linkHelper->linkhome('login'));                        
                    }
                    break;
                case "updatepass": 
                    $user_id = $this->session->get_session("userid");

                    if(!$user_id || !is_integer($user_id)){            
                        Application::redirect($this->linkHelper->linkhome("Login"));
                    }else{
                        $user_info = $this->tm_users_model->get_list("user_id = '{$user_id}' AND user_deleted=1","",0,1); 
                        if(!$user_info) 
                            Application::redirect($this->linkHelper->linkhome("Login"));
                    }

                    $id = intval($id);   
                    $check_ = 0;  
                    if(!$id){
                        $id = $user_id;
                        $check_ = 1;
                    }else{
                        if(!$this->premission_model->check_permission($user_id,4))
                        {
                            die('no permission');
                        }          
                    }

                    $user = $this->tm_users_model->get_once("user_id ={$id}");     
                    if(!$user or !$pass_new or strlen($pass_new) <6) 
                    {
                        $this->session->set_session("error","Mật khẩu tối thiểu 6 ký tự !");
                        Application::redirect($this->linkHelper->linkhome("home"));
                    }                        
                    if(isset($pass_new) && isset($id))
                    {
                        $bean = $this->tm_users_model->create_bean();
                        $bean->set("password",md5(trim($pass_new)));
                        $this->tm_users_model->update($bean,"user_id ={$id}");

                        $this->session->set_session("msg","Cập nhật mật khẩu thành công !");
                        if($check_)
                            Application::redirect($this->linkHelper->linkhome("Logout"));

                        Application::redirect($this->linkHelper->linkhome("home"));
                    }else{
                        $this->session->set_session("error","Cập nhật mật khẩu không thành công");
                        Application::redirect($this->linkHelper->linkhome("home"));
                    }
                    break;
                case "deleteUser" :
                    $user_id = $this->session->get_session("userid");
                    if(!$user_id)
                    {
                        Application::redirect($this->linkHelper->linkhome("Login"));
                    }

                    if(!$this->premission_model->check_permission($user_id,4))
                    {
                        die('no permission');
                    }
                    if(intval($id))   
                    {
                        $bean = $this->tm_users_model->create_bean();
                        $bean->set("user_deleted",0);
                        $this->tm_users_model->update($bean,"user_id={$id}");
                        $this->session->set_session("msg","Xóa thành công user id : {$id}");                             
                    }else{
                        $this->session->set_session("error","Xóa không thành công user id : {$id}");                             
                    }
                    Application::redirect($this->linkHelper->linkhome("ListUser"));    
                    break;
                case "adduser":     
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
                    if($username)              
                    {   
                        $bean = $this->tm_users_model->create_bean();                
                        if($groupname !=4)
                        {
                            $sum = 0;
                            foreach($news_cat as $value)
                            {
                                $sum = $sum+$value;
                            }
                            if($sum==0)
                            {
                                $this->session->set_session("error","Chọn category cho user từ thư ký tòa soạn trở xuống !");
                                Application::redirect($this->linkHelper->linkhome("AddUser"));     
                            } 
                        }
                        $bean->set("username",$username);
                        $bean->set("password",md5($userpass));
                        $bean->set("email",$email);
                        $bean->set("fullname",$fullname);
                        $bean->set("address",$address);
                        $bean->set("phone",$phone);
                        $bean->set("user_deleted",1);
                        $id_user = $this->tm_users_model->insert($bean);

                        $bean_tm_grop = $this->tm_group_user_model->create_bean();
                        $bean_tm_grop->set("user_id",$id_user);
                        $bean_tm_grop->set("group_id",$groupname);
                        $this->tm_group_user_model->insert($bean_tm_grop);    


                        if($groupname!=4)
                        {
                            if($news_cat)
                            {
                                foreach($news_cat as $key=>$val)
                                {
                                    if($val)
                                    {
                                        $this->tm_groups_cat_model->insert_cat($id_user,$val);    
                                    }                                
                                }
                            }
                        }  
                        $this->session->set_session("msg","Thêm thành viên thành công!");
                        Application::redirect($this->linkHelper->linkhome("home"));
                    }else{
                        $this->session->set_session("error","add user no success");
                        Application::redirect($this->linkHelper->linkhome("home"));
                    }
                    break;
                case "edituser":
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
                    if($username && $id)              
                    {
                        $bean = $this->tm_users_model->create_bean();                
                        $bean->set("email",$email);
                        $bean->set("fullname",$fullname);
                        $bean->set("address",$address);
                        $bean->set("phone",$phone);                    
                        if($groupname==1)
                        {
                            $bean->set("allow_public",$allow_public);                    
                        }
                        $this->tm_users_model->update($bean,"user_id = {$id}");                    
                        $this->tm_group_user_model->delete("user_id= {$id}");
                        $bean_tm_grop = $this->tm_group_user_model->create_bean();
                        $bean_tm_grop->set("user_id",$id);
                        $bean_tm_grop->set("group_id",$groupname);                  
                        $this->tm_group_user_model->insert($bean_tm_grop);                     
                        if($groupname!=4)
                        {
                            if($news_cat)
                            {
                                $this->tm_groups_cat_model->delete("user_id ={$id}");
                                foreach($news_cat as $key=>$val)
                                {
                                    $this->tm_groups_cat_model->insert_cat($id,$val);
                                }
                            }
                        }  
                        $this->session->set_session("msg","update user success !");
                        Application::redirect($this->linkHelper->linkhome("ListUser"));
                    }else{
                        $this->session->set_session("error","update user no success");
                        Application::redirect($this->linkHelper->linkhome("ListUser"));
                    }
                    break;
                case "addpermission" : 
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
                    $start_time = strtolower($start_time);
                    $end_time = strtolower($end_time);
                    $start_time_int = strtotime($start_time);
                    $end_time_int = strtotime($end_time);                                  
                    if($end_time < $start_time)
                    {
                        $this->session->set_session("error","Ủy quyền không thành công vì thời gian sau nhỏ hơn thời gian trước");
                        Application::redirect($this->linkHelper->linkhome("home"));    
                    }
                    Application::redirect($this->linkHelper->linkhome("home"));                     
                    break;
            }        
        }  
        public function destroyed() {               
        }          
    }
?>
