<?php
class SearchTag extends Module implements IModule {

    private $news_tag_model;
    
    public function __construct($param=null) {         
        $this->init(get_class($this));

        $this->data = array();
        $lang_global = $this->language->getLang('global.ln');                
        $this->template->assign('Lang', $lang_global);                        
        $this->template->assign('link_helper',$this->linkHelper);
        $this->template->assign('template_helper',$this->templateHelper);
        
        $this->news_tag_model = Loader::load_model("news_tag");        
    }                        

    public function run() {  
        $q = isset($this->input['q']) ? $this->input['q'] : '24h';
        $q = trim($q);
        $q = $this->templateHelper->build_slug($q);
        
        $list_tag = $this->news_tag_model->get_list('slug_name LIKE "'.$q.'%"',"id DESC",0,7);
        
        foreach($list_tag as $value)
        {
            $array[] = array(
                "id" => $value->get('tag_name'),
                "name" => $value->get('tag_name')
            );
        }
        $json_response = json_encode($array);           
        print($json_response);
    }

    public function destroyed() {               
        $this->session->rm_session("msg");
        $this->session->rm_session("error");
        $this->session->rm_session("info");
    }          
}
?>