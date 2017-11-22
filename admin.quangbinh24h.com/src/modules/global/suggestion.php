<?php
    class Suggestion extends Module implements IModule {  
        private $sphinx_helper;
        private $news_articles_view_model;
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
            $this->sphinx_helper = Loader::load_helper("sphinx_helper");
            $this->news_articles_view_model = Loader::load_model("news_articles_view");
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
            $q = isset($this->input['q']) ? $this->input['q'] : '';
            //$list_key = $this->sphinx_helper->get_search_art_relation($q,30,0);
            $keyword = $this->templateHelper->build_slug($q);
            $list_key = $this->news_articles_view_model->get_arr_id_by_keyword($keyword);
            $list_content = array();
            $array = array();
            if(count($list_key))
            {            
                foreach($list_key as $key=>$value){           
                    //$list_content[$key]= $this->news_articles_view_model->get_list("id={$key}");                        
                    $list_content[$value]= $this->news_articles_view_model->get_list("id={$value}");                        
                }               
            }
            $i=0;
            foreach($list_content as $key=>$value)
            {   
                $array[$i] = array(
                    'id' => $value[0]->get('id'),
                    'name' => $value[0]->get('title')
                );  
                $i++;
            } 
            $json_response = json_encode($array);           
            print($json_response);    
        }

        public function destroyed() {               
        }          
    }
?>
