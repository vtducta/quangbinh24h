<?php 
    class Tracking extends Module implements IModule {  
        /**
        * hit view day model
        * 
        * @var HitViewDayModel
        */
        private $hit_view_day_model;
        /**
        * hit view month model
        * 
        * @var HitViewMonthModel
        */
        private $hit_view_month_model;
        /**
        * hit view week model
        * 
        * @var HitViewWeekModel
        */
        private $hit_view_week_model;
        /**
        * hit view model
        * 
        * @var HitViewModel
        */
        private $hit_view_model;
        public function __construct($param=null) {         
            $this->init(get_class($this));
            /*
            * init
            */
            $this->data = array();
            $lang_global = $this->language->getLang('global.ln');                
            $this->template->assign('Lang', $lang_global);                        
            $this->hit_view_day_model = Loader::load_model("hit_view_day");
            $this->hit_view_week_model = Loader::load_model("hit_view_week");
            $this->hit_view_month_model = Loader::load_model("hit_view_month");
            $this->hit_view_model = Loader::load_model("hit_view");
        }                         

        public function run() {
            $id = isset($this->input['id']) ? $this->input['id'] : 0;                                             
            $id = intval($id);
            $ip = $this->getIP(); 
            $now = time();          
            $user_agent = $_SERVER['HTTP_USER_AGENT'];
            $h_time = mktime(date('G',$now),0,0,date('n',$now),date('j',$now),date('Y',$now));
            $d_time = mktime(0,0,0,date('n',$now),date('j',$now),date('Y',$now));
            $m_time = mktime(0,0,0,date('n',$now),0,date('Y',$now));
            $y_time = mktime(0,0,0,0,0,date('Y',$now));
            $w_time = mktime(0,0,0,date('n',$now),date('j',$now)-date('N',$now)+1,date('Y',$now));  

            $url = $_SERVER['HTTP_REFERER'];
            if(!is_numeric($id)){
             //   echo $url;
              //  die();
                header('Content-Type: image/gif');
                //echo "1";
                echo base64_decode('R0lGODlhAQABAIABAP///wAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==');  
                return; 
            }     
        
            if(isset($_COOKIE["rr_news_id_{$id}"])){
                header('Content-Type: image/gif');
                echo base64_decode('R0lGODlhAQABAIABAP///wAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==');  
                return;  
            }else{
                setcookie("rr_news_id_{$id}", 1, time()+ 60*5,"/","quangbinh24h.com");
            }       
            
            $content_hit = $this->hit_view_model->get_once("news_id={$id}");
            if($content_hit)
            {
                    $bean = $this->hit_view_model->create_bean();
                    $bean->set("time",$now);                    
                    $bean->set("hit_view",$content_hit->get('hit_view')+1);
                    $this->hit_view_model->update($bean,"news_id={$id}");
            }else{
                $bean = $this->hit_view_model->create_bean();
                $bean->set("time",$now);
                $bean->set("news_id",$id);
                $bean->set("hit_view",1);
                $this->hit_view_model->insert($bean);
            }

            $content_hit_day = $this->hit_view_day_model->check_hit_view_day($d_time,$id);   
            if($content_hit_day)
            {
                $this->hit_view_day_model->update_hit_view_day($d_time,$id,$content_hit_day->get('total_hit')+1) ;
            }else{
                $this->hit_view_day_model->insert_hit_view_day($d_time,$id,1);
            }
            
            header('Content-Type: image/gif');
            echo base64_decode('R0lGODlhAQABAIABAP///wAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==');
        }
        function getIP()
        {
            if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
            else if (isset($_SERVER['REMOTE_ADDR'])) $ip = $_SERVER['REMOTE_ADDR'];
                else $ip = "UNKNOWN";
            return $ip;
        }  
        public function destroyed() {                           
        }          
    }
?>
