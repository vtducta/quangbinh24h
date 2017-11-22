<?php
    class SearchJournalist extends Module implements IModule {  
        /**
        * journalist model
        * @var JournalistModel
        */
        private $journalist_model;
        
        public function __construct($param=null) {         
            $this->init(get_class($this));
            /*
            * init
            */
            $this->data = array();                              
            $this->journalist_model = Loader::load_model('journalist');
            
            $this->template->assign('link_helper',$this->linkHelper);
            $this->template->assign('template_helper',$this->templateHelper);
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
            $user_id = $this->session->get_session("userid");               

            if(!$user_id)
            {               
                die();
            }
            
            $keyword = isset($this->input['q']) ? $this->input['q'] : '';
            $num = 20;
            $journalist = $this->journalist_model->search_journalist($keyword, $num);
            $response = array();
            foreach ($journalist as $key=>$val) 
            {
                $response[$key]['id'] = $val['id'];
                $response[$key]['name'] = $val['full_name'] . "(" . $val['pen_name'] . ")";
            }
            
            echo json_encode($response);
        }

        public function destroyed() {               
            $this->session->rm_session("msg");
            $this->session->rm_session("error");
            $this->session->rm_session("info");
        }          
    }
?>
