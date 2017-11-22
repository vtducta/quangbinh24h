<?php
    class Box_news extends Module implements IModule {  

    private $news_articles_view_model; 
    private $news_category_model;
    private $premission_model;
    private $news_articles_feature_data_model;
    private $news_articles_join_category_view_model;    
    
    public function __construct($param=null) {         
        $this->init(get_class($this));

        $this->data = array();
        $lang_global = $this->language->getLang('global.ln');                
        $this->template->assign('Lang', $lang_global);                        
        $this->template->assign('link_helper',$this->linkHelper);
        $this->template->assign('template_helper',$this->templateHelper);
        $this->news_articles_feature_data_model = Loader::load_model("news_articles_feature_data");
        $this->premission_model = Loader::load_model("permission");
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
          Application::redirect($this->linkHelper->linkhome("login"));
        }
        if(!$this->premission_model->check_permission($user_id,array(1,4)))
        {
               die('no permission');
        }
        
        $action = isset($this->input['action']) ? $this->input['action'] : "";
        $action = stripslashes($action);
        switch($action)                                          
        {   
            case 'show_popup':
                $this->show_popup(); 
                break;
            case 'set_pos':
                $this->set_position(); 
                break;
            case 'delete_pos':
                $this->delete_position(); 
                break;
        }
          
    }
    
    private function set_position(){
        $news_id = isset($this->input['news_id']) ? $this->input['news_id'] : 0;           
        $news_id = intval($news_id);
        
        $feature_id = isset($this->input['feature_id']) ? $this->input['feature_id'] : 0;           
        $feature_id = intval($feature_id);
        
        if(!$news_id || !$feature_id)                                        
            die("not permisson");
            
        $user_id = $this->session->get_session("userid");
        $this->news_articles_feature_data_model->delete("feature_id ={$feature_id} AND news_id = {$news_id}");
        $this->news_articles_feature_data_model->insert_feature($feature_id,$news_id);                       
        //$this->news_home_log_model->insert_home_log($user_id,$news_id,$feature_id,'add');
        echo '<button data-toggle="modal" type="button" class="btn btn-mini" style="width: 100px; font-size: 15px; font-weight: bold; height: 38px; border: 1px solid;" onclick="set_news_hot('.$feature_id.','.$news_id.',\'delete_pos\')" >Hạ xuống</button>';
        return;
    }
    private function delete_position(){
        $news_id = isset($this->input['news_id']) ? $this->input['news_id'] : 0;           
        $news_id = intval($news_id);
        
        $feature_id = isset($this->input['feature_id']) ? $this->input['feature_id'] : 0;           
        $feature_id = intval($feature_id);
        
        if(!$news_id || !$feature_id) die("not permisson");
            
        $user_id = $this->session->get_session("userid");
        $this->news_articles_feature_data_model->delete("feature_id ={$feature_id} AND news_id = {$news_id}");
        echo '<button data-toggle="modal" type="button" class="btn btn-info btn-large" style="width: 100px; font-size: 15px; font-weight: bold;" onclick="set_news_hot('.$feature_id.','.$news_id.',\'set_pos\')">Set vị trí</button>';
        return;
    }
    
    private function show_popup(){
        $id = isset($this->input['news_id']) ? $this->input['news_id'] : 0;           
        $id = intval($id);
        if(!$id)
            die();
        $this->data["news_id"] = $id;
        $this->data["list_box"] = array(
            array(
                "id"    => 1,
                "name"  => "Tin hot",
                "type"  => "Trang chủ"
            ),
            array(
                "id"    => 2,
                "name"  => "Tin nổi bật",
                "type"  => "Trang chủ"
            ),
            array(
                "id"    => 3,
                "name"  => "Tin mới nhất",
                "type"  => "Trang chủ"
            ),
            array(
                "id"    => 4,
                "name"  => "Tin hot",
                "type"  => "Chuyên mục"
            ),
        );

        $list_box_art = $this->news_articles_feature_data_model->get_list("news_id=$id","",0,100);
        $tmp = array();
        foreach($list_box_art as $box_art){
            $tmp[]  = $box_art->get("feature_id");
        }
        $this->data["list_box_art"] = $tmp;
        $this->template->assign('data',$this->data);
        $this->template->display("box/show_popup.tpl");
    }

     public function destroyed() {               
        return;
      }  
}
