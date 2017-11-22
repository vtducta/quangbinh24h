<?php
    class LoginAction extends Module implements IModule {  

        private $tm_users_model;
        private $tm_user_permissions_model;
        private $tm_group_user_model;
        private $tm_groups_cat_model;
        private $sms_helper;

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
            $this->sms_helper = Loader::load_helper("sms_helper");

            define('AKEY',"obbsiYJD33H5TM74rv16n1BstdRG7MMDHtbAf4yq");

            /*
            * IKEY, SKEY, and HOST should come from the Duo Security admin dashboard
            * on the integrations page.
            */
            define('IKEY',"DIQMUSXIJEL6553QPQFS");
            define('SKEY',"m3jbIzA7Sl5iTCu1ArRBY7QyPtRSJgq6RVFTN1SO");
            define('HOST',"api-8d6bcfcf.duosecurity.com");


        }                         

        public function get_ip() {

            /*if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
            {
              $ip=$_SERVER['HTTP_CLIENT_IP'];
            }
            elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
            {
              $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
            }
            else
            {
              $ip=$_SERVER['REMOTE_ADDR'];
            }
            return $ip;*/
            
            
            
            //Just get the headers if we can or else use the SERVER global
            if ( function_exists( 'apache_request_headers' ) ) {

                $headers = apache_request_headers();

            } else {

                $headers = $_SERVER;

            }

            //Get the forwarded IP if it exists
            if ( array_key_exists( 'X-Forwarded-For', $headers ) && filter_var( $headers['X-Forwarded-For'], FILTER_VALIDATE_IP, FILTER_FLAG_IPV4 ) ) {

                $the_ip = $headers['X-Forwarded-For'];

            } elseif ( array_key_exists( 'HTTP_X_FORWARDED_FOR', $headers ) && filter_var( $headers['HTTP_X_FORWARDED_FOR'], FILTER_VALIDATE_IP, FILTER_FLAG_IPV4 )
            ) {

                $the_ip = $headers['HTTP_X_FORWARDED_FOR'];

            } else {
                
                $the_ip = filter_var( $_SERVER['REMOTE_ADDR'], FILTER_VALIDATE_IP, FILTER_FLAG_IPV4 );

            }

            return $the_ip;

        }
        
        public function get_ip1() {

            if (isset($_SERVER)) {

                if (isset($_SERVER["HTTP_X_FORWARDED_FOR"]))
                    return $_SERVER["HTTP_X_FORWARDED_FOR"];

                if (isset($_SERVER["HTTP_CLIENT_IP"]))
                    return $_SERVER["HTTP_CLIENT_IP"];

                return $_SERVER["REMOTE_ADDR"];
            }

            if (getenv('HTTP_X_FORWARDED_FOR'))
                return getenv('HTTP_X_FORWARDED_FOR');

            if (getenv('HTTP_CLIENT_IP'))
                return getenv('HTTP_CLIENT_IP');

            return getenv('REMOTE_ADDR');

        }
        
        public function run() {
            
            $ip = $this->get_ip();
            
            /*$client  = @$_SERVER['HTTP_CLIENT_IP'];
            $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
            $remote  = $_SERVER['REMOTE_ADDR'];

            if(filter_var($client, FILTER_VALIDATE_IP)){
                $ip = $client;
            }elseif(filter_var($forward, FILTER_VALIDATE_IP)){
                $ip = $forward;
            }else{
                $ip = $remote;
            } */
            
            $hour = date('H'); 
            $min = date('i');
            
            //echo $ip; 
            //die();
            
            
            /*if($hour < 8 && $hour > 18)
            {
                $check_ip = array(
                '14.177.212.87',
                '14.162.46.86',
                '113.20.116.19',
                '27.66.134.162'
                );
            } */
                
            if($hour < 8 || $hour > 19){
                $check_ip = array(
                '14.181.25.11',      //anh Xuan Hong
                '113.185.22.4',     //anh Tiến 113.185.26.183
                '113.185.26.183',     //anh Tiến 113.185.26.183
                '14.162.186.40',    //chị My
                '125.212.203.103',    //chị My
                '27.67.44.14',      //anh Quân
                '14.166.14.164',// mien trung nguyen huong
                '27.67.42.129',// anh duc
                '27.67.28.141',
                '171.253.31.2',
                '117.1.177.62',//anh quyet
                '14.163.255.161', // anh hong
                '14.177.51.123',//anh quan
                '171.253.32.249',//xuan hong
                '14.162.186.40',//chi my
                '14.188.255.254',//anh hong
                '113.186.56.201',//chi huong
                '118.71.197.46',//tran linh      
                '113.168.254.82',// nha chi huong     
                '171.255.3.126',//anh hong  
                '14.163.115.5',//chi huong mien trung
                '113.20.117.198',//anh duc doi song
                '27.71.134.11',//anh hong
                '14.188.254.1',//anh hong
                '42.113.153.129',//xuan the gioi
                  '42.113.204.17',//toan soan
                  '27.73.48.142',//anh hong
                  '123.18.155.146',//chi huong 
                  '125.212.204.33',
                
                );
            }else{
                //trong h hanh chinh
                $check_ip = array(
                '14.181.25.11',      //anh Xuan Hong 
                '113.185.22.4',     //anh Tiến 113.185.26.183
                '113.185.26.183',     //anh Tiến 113.185.26.183 
                '14.177.208.138',    //chị My
                '14.162.42.240',     //anh Quân 
                '117.0.37.225',      //tòa soạn báo giấy   ngoai gio
                '1.55.134.183',      //hương cơ quan
                '1.55.239.70',       //cơ quan báo NĐT     ngoai gio
                '42.114.217.203',       //cơ quan báo NĐT     ngoai gio
                '14.188.238.59',       //cơ quan báo NĐT     ngoai gio
                '192.168.0.108',       //cơ quan báo NĐT     ngoai gio
                "117.0.37.225",
                //'113.171.178.81',    //cơ quan báo NĐT     ngoai gio  
                //'113.168.246.119',   //cơ quan báo NĐT     ngoai gio
                '113.168.254.165',    //cơ quan báo NĐT     ngoai gio 
                '42.112.24.108',
                '125.212.203.103',   // mien trung
                '123.17.176.122',// mien trung nguyen huong
             
                '113.185.22.78',     //anh Tiến
              
                '14.177.51.123',      //anh Quân
                '14.166.14.164',// mien trung nguyen huong
                '113.20.117.203',// anh duc
                '27.67.28.141',
                '171.253.31.2',
                '27.76.235.133',//anh quyet
                '14.163.255.161', // anh hong
                '117.4.240.236',//thu thao da chieu
                '117.4.241.96',//toa soan viettel
                '14.177.59.105',//anh quan
                '171.253.32.249',//xuan hong
                '42.112.24.13',//thao da chieu
            //    '42.112.24.13',
                '14.162.186.40',//chi my
       //         '27.65.63.91',//anh hieu
                '14.188.255.254',//anh hong
                '113.186.56.201',//chi huong
                '118.71.197.46',//tran linh
                '42.113.204.17',//toa soan online
                '113.168.254.82',// nha chi huong
                '171.255.3.126',//anh hong
                '14.163.115.5',//chi huong mien trung
                '27.66.133.169',//anh hong mien trung
                '42.114.236.170',//chi duyen
                '117.1.177.62',//anh quyet
                '222.252.56.117',//anh hieu cong nghe
                '113.20.117.198',//anh duc doi song
                '27.66.155.131',//anh hong
                '27.71.134.11',//anh hong
                '14.188.254.1',//anh hong
                '42.113.204.28',//toa soan
                '42.113.153.129',//xuan the gioi
                '42.113.204.17',//toan soan
                '27.73.48.142',//anh hong
                   '123.18.155.146',//chi huong 
                   '125.212.204.33'
                );
            }
            
        
            //$check = true;
            /*if(isset($_GET['ha'])){
                $cookie_name = "cmscms";
                $cookie_value = "1";
                setcookie($cookie_name, $cookie_value, time() + (60 * 15));
            }

            if(isset($_COOKIE['cmscms'])&&($_COOKIE['cmscms']==1)){
                $check = false;
            }*/
            
            $action = isset($this->input['action']) ? $this->input['action'] : null;     
            $action1 = $action;        
            $username = isset($this->input['username']) ? $this->input['username'] : null;        
            $userpass = isset($this->input['password']) ? $this->input['password'] : "password";
            $now = time();
            $check_user = array('thegioi.quangtrung','thegioi.hongduyen','pv.hethong','admin.tammy','thoisu.thuyngan','nguyentienthanh','phanxuanhong','tranhaiquan','kinhte.viethung','congnghe.chihieu','ngohau','tranlinh','thoisu.anhduc','phapluat.tranquyet','thegioi.hoangxuan','dachieu.thuthao','mientrung.nguyenhuong','phapluat.phuongque','thanhhue','doisong.leduyen','giaitri.anhtuyet','thegioi.nguyenhuong','kinhte.kieuhuong');
            
           $username1 = strtolower($username); 
         /*   if($username1=="admin.tammy")
                die("not permission");
                                                */
            
                
            if(in_array($username1,$check_user)){
     
                 /* if(!in_array($ip,$check_ip)){
                        header('Content-Type: text/html; charset=utf-8');
                        die('<center>Tài khoản không có quyền đăng nhập ở ip : '.$ip.'</center>'); 
                    }else{
                        $action = 'step1';
                    }          */
                
                $action = 'step1';    
                     
            }
            
             $username = strval($username);
             
             $user_info = $this->tm_users_model->get_list("username ='{$username}' ","",0,1);
             $n = $this->session->get_session("count_error_login");
             if($user_info){
                $username_db = $user_info[0]->get('username');
                $userpass_db = $user_info[0]->get('password');
                $userid_db   = $user_info[0]->get('user_id');
                if( ($username === $username_db) && (md5($userpass) != $userpass_db)) {
                    $n = $this->session->get_session("count_error_login");
                    if(!$n){
                        $n=1;
                        $this->session->set_session("count_error_login",1);
                    }else{
                        $this->session->set_session("count_error_login",$n+1);
                        $n = $this->session->get_session("count_error_login");
                    }
                    if($n>4){
                        /*$bean = $this->tm_users_model->create_bean();
                        $bean->set("user_deleted",0);
                        $this->tm_users_model->update($bean,"user_id = {$userid_db}");
                        
                        header('Content-Type: text/html; charset=utf-8');
                        die("bạn đã đăng nhập sai quá 5 lần, tài khoản của bạn đã bị khóa, vui lòng liên hệ quản trị viên"); */
                    }
                }elseif( ($username === $username_db) && (md5($userpass) === $userpass_db)) {
                    $this->session->set_session("count_error_login",0);
                }   
             }
                 
             
            
            
            switch($action)
            {
                case "step1":
                    if(($username <> "") && ($userpass <> "")) {
                         Loader::load(PATH_APP_BASE_HELPER."/recaptchalib.php");
                     $privatekey = "6LcP0RUUAAAAADCZ_7ncxpyXu--HKDiuRTlYRRtv";        
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
                        $username = strval($username);
                        $user_info = $this->tm_users_model->get_list("username ='{$username}' ","",0,1);
                        if($user_info){                          
                            $username_db = $user_info[0]->get('username');
                            $userpass_db = $user_info[0]->get('password');
                            if( ($username === $username_db) && (md5($userpass) === $userpass_db)) {                                             
                                $user_permission = $this->tm_user_permissions_model->get_list("user_id={$user_info[0]->get('user_id')} AND  ({$now} >=start_time AND {$now}<=end_time)","id DESC",0,1);                                                                                  
                                if(!$user_permission)
                                {                                
                                    $group_user = $this->tm_group_user_model->get_list("user_id = {$user_info[0]->get('user_id')}","",0,1);
                                    $group_user_ = $group_user[0]->get('group_id');                                   
                                }else {
                                    $group_user_ = $user_permission[0]->get('group_user');          
                                }                              
                                $this->session->set_session('groupuser_t',$group_user_);                                
                                $this->session->set_session('userid_t',$user_info[0]->get('user_id'));
                                $this->session->set_session('msg_t',"{$user_info[0]->get('fullname')} login successful !");                                                                                          
                                $sig_request = Duo::signRequest(IKEY, SKEY, AKEY,"[ndt]". $username);

                                $this->data['sig_request'] = $sig_request;
                                $this->data['host'] = HOST;
                                $this->data['username'] = $username;
                                $this->data['password'] = $userpass;
                                $this->template->assign('data',$this->data);                               
                                $this->template->display("user/login_sms_2.tpl");
                            }else {
                                $this->session->set_session('error','Invalid username or password');
                                Application::redirect($this->linkHelper->linkhome('login'));
                            }
                        }else {
                            $this->session->set_session('error','We do not know your username');
                            Application::redirect($this->linkHelper->linkhome('Login'));                        
                        }
                    }else {
                        $this->session->set_session('error','Username or password is empty');
                        Application::redirect($this->linkHelper->linkhome('Login'));                        
                    }
                    break;
                case "step2":
                   $sig_response = isset($this->input['sig_response']) ? $this->input['sig_response'] : "";
                    $resp = Duo::verifyResponse(IKEY, SKEY, AKEY, $_POST['sig_response']);
                    if ($resp != NULL){
                        $this->session->set_session('groupuser',$this->session->get_session("groupuser_t"));                                
                        $this->session->set_session('userid',$this->session->get_session("userid_t"));
                        $this->session->set_session('msg',$this->session->get_session("msg_t"));
                        $group_user_ = $this->session->get_session("groupuser_t");
                        $this->session->rm_session("groupuser_t");
                        $this->session->rm_session("userid_t");
                        $this->session->rm_session("msg_t");
                        if($group_user_==2 || $group_user_==5)
                        {   
                            Application::redirect($this->linkHelper->linkhome('BtvHome'));    
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
                    }
                    else{
                        $this->session->set_session('error','Verify fail!');
                        Application::redirect($this->linkHelper->linkhome('Login'));
                    }
                case "login":
                               
                    if(($username <> "") && ($userpass <> "")) {  
                        $username = strval($username);
                        $user_info = $this->tm_users_model->get_list("username = '{$username}' AND user_deleted=1","",0,1);                                                                                                 
                        if($user_info){                          
                            $username_db = $user_info[0]->get('username');
                            $userpass_db = $user_info[0]->get('password');
                            $user_id_db  = $user_info[0]->get('user_id');
                            //if($user_id_db != 9602){
//                                die('<center>Bao dien tu Nguoi Dua Tin tam dung website de bao tri he thong, mong doc gia thong cam!</center>');
//                            }

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
                default :
                    break;
            }
        }  
        public function destroyed() {               
        }          
    }
?>
