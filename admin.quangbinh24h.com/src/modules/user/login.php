<?php
  class Login extends Module implements IModule {  
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
          $this->tm_users_model = Loader::load_model("tm_users"); 
      }                         
  
      public function run() {
          $user_id = $this->session->get_session("userid");
          if($user_id && is_integer($user_id))
          {  
             $user_info = $this->tm_users_model->get_list("user_id = '{$user_id}' AND user_deleted=1","",0,1); 
             if(!$user_info) 
                die("tài khoản không tồn tại , hoặc bị khóa !");
                                                                                                                
             Application::redirect($this->linkHelper->linkhome("home"));        
          }else{
              $ip = $this->get_ip();
              $this->data['ip'] = $ip." - ".date("d/m/Y H:i"); 
              
              $this->template->assign('data',$this->data);
              $this->template->display("user/login.tpl");
              
          }
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
        
      public function destroyed() {               
      }          
  }
?>
