<?php
    class Upload extends Module implements IModule {  
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
       $day = intval(date('d'));
        $month = intval(date('m'));
        $year = intval(date('Y'));
   //     $media_folder = $year . "/" . $month . "/" . $day ;                           
        $this->upload          = Loader::load_base_helper('upload');
        $this->upload->set_upload_form_field("upload");
        $media_folder = $year . "/" . $month . "/" . $day."/".$user_id ;                                                         
        $image_data = @getimagesize($_FILES['fileUpload']['tmp_name']);     
        
        if(!is_dir(Application::$config['global']['Server']['upload_path'] . DS . $media_folder.DS)){
            @mkdir(Application::$config['global']['Server']['upload_path'] . DS . $media_folder.DS,0777,true); 
            
        }
        
     //   var_dump($image_data);              
        if(!$image_data)                    
        {
            $data = array(
            'msg' => 'false',
            'msgbox' => 'File upload không hợp lệ !' 
            );
            echo json_encode($data);
            exit();
        }
        
        if(!isset($image_data[0]) || $image_data[0]<450)                    
        {
            $data = array(
            'msg' => 'false',
            'msgbox' => 'Ảnh đại diện phải lớn hơn 450px' 
            );
            echo json_encode($data);
            exit();
        }
        
        $_file_name =  $_FILES['fileUpload']['name'];
        $ext        = pathinfo($_FILES['fileUpload']['name'], PATHINFO_EXTENSION);
        $_file_name = str_replace(".".$ext,"",$_file_name);
        if(!$_FILES['fileUpload']['name']) 
            $last_name =  "image-thumb-ndt" . time();     
        else
            $last_name = $this->templateHelper->build_slug($_file_name)."-".time(); 
            
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
    public function upload_image($url,$file_name){ 

        $content = null;
        $flag = 1;
        try{
            $content = @file_get_contents($url);
        }
        catch (Exception $e){
            $flag = 2;
        }
        if ($content){                
            $day = date('d');
            $month = date('m');
            $year = date('Y');                
            $media_folder = $year . "/" . $month . "/" . $day;                    
            $dir_path = Application::$config['global']['Server']['upload_path']."/".$media_folder;                                  
            if(!is_dir($dir_path)) $create_dir_flag = @mkdir($dir_path,0777,true);
            else $create_dir_flag = true;   
                try{
                    $create_file_flag = file_put_contents($dir_path.'/'.$file_name,$content);
                    

                }catch(Exception $e){
                 echo $e->getMessage();
                }

                if($create_dir_flag && $create_file_flag)
                {
                    $flag =1;           
                }
                else{
                    $flag = 2; 
                }

            }
            else{
                $flag = 2;
            }                            
            return $flag;
        }

        public function destroyed() {               
        }          
    }
?>
