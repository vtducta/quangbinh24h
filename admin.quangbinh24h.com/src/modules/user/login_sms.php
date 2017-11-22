<?php
  class LoginSms extends Module implements IModule {  
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
      }                         
  
      public function run() {  
          $user_id = $this->session->get_session("userid");
          if($user_id)
          {
             Application::redirect($this->linkHelper->linkhome("home"));        
          }else{
              $this->template->assign('data',$this->data);
              $this->template->display("user/login_sms.tpl");
          } 
      }  
      public function destroyed() {               
      }          
  }
?>