<?php
    class UploadFile extends Module implements IModule {  
        /**
        * news upload model
        * 
        * @var NewsUploadModel
        */
        private $news_upload_model;
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
            $this->news_upload_model = Loader::load_model("news_upload");
        }                         

        public function run() { 
            $user_id = $this->session->get_session("userid");                                       
            $day = date('d');
            $month = date('m');
            $year = date('Y');

            /*if (!file_exists('/tailieu/')) {
                mkdir('/tailieu/', 0777, true);
            }
            if (!file_exists('/tailieu/'.$year.'/')) {
                mkdir('/tailieu/'.$year.'/', 0777, true);
            }
            if (!file_exists('/tailieu/'.$year.'/'.$month.'/')) {
                mkdir('/tailieu/'.$year.'/'.$month.'/', 0777, true);
            }
            if (!file_exists('/tailieu/'.$year.'/'.$month.'/'.$day.'/')) {
                mkdir('/tailieu/'.$year.'/'.$month.'/'.$day.'/', 0777, true);
            } */  
            
            $media_folder = 'video/'. $year . "/" . $month . "/" . $day;  
            
            $this->upload          = Loader::load_base_helper('upload');
            $this->upload->image_check = false;
            $this->upload->set_upload_form_field("upload");
            
            /*$image_data = @getimagesize($_FILES['fileUpload']['tmp_name']);
         

            if(!$image_data)                    
            {
                $data = array(
                'msg' => 'false',
                'msgbox' => 'File upload không hợp lệ !' 
                );
                echo json_encode($data);
                exit();
            }*/

            $last_name =  stripslashes($_FILES["file"]["name"]);//"media-thumb" . time();
            $this->upload->set_upload_form_field("fileUpload");                  
            $this->upload->set_output_dir(Application::$config['global']['Server']['upload_path'] . DS . $media_folder);
            $this->upload->set_output_name($last_name);                                     
            $this->upload->process();                      
            if(!($this->upload->error_no)){
                $url = Application::$config['global']['Server']['upload_link'] . DS . $media_folder . DS . $this->upload->get_file_name();
                $id_image = $this->news_upload_model->insert_link_upload($user_id,$url);
                $data = array(                         
                    'id' => $id_image,
                    'msg'           => 'ok',                                                                        
                    'file_link'     => $url,                        
                    'random_key'    => rand(5,10)
                    );
                echo json_encode($data);                           
            }else{
                switch( $this->upload->error_no )
                {
                    case 1:
                        // No upload
                        print "No upload"; exit();
                    case 2:
                        print "error"; exit();
                    case 5:
                        // Invalid file ext
                        print "Invalid File Extension"; exit();
                    case 3:
                        // Too big...
                        print "File too big"; exit();
                    case 4:
                        // Cannot move uploaded file
                        print "Move failed"; exit();
                }
            }
        }     

        public function destroyed() {               
        }          
    }
?>