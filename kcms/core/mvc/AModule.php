<?php 

abstract class Module {
    
    protected $id = null;
    
    /**
    * LinkHelper
    * 
    * @var LinkHelper
    */
    protected $linkHelper = null;
    
    /**
    * TemplateHelper
    * 
    * @var TemplateHelper
    */
    protected $templateHelper = null;
    
    /**
    * TemplateService
    * 
    * @var TemplateService
    */
    protected $template = null;
    
    /**
    * InputService
    * 
    * @var InputService
    */
    protected $input = null;
    
    /**
    * SessionService
    * 
    * @var SessionService
    */
    protected $session = null;
    
    /**
    * LanguageService
    * 
    * @var LanguageService
    */
    protected $language = null;   
    
    /**
    * init a controller 
    * 
    * @param string controller name
    */
    public function init($id) {
        
        // init variable
        $this->data = array();    
        $this->id = $id;
        $this->paging = isset(Application::$config['paging'][$this->id]) ? Application::$config['paging'][$this->id] : array();
        //
        $session_off = isset(Application::$config['session']['SessionOff']) ? Application::$config['session']['SessionOff'] : 0;
        // services
        $this->template = Application::getSrv("template");        
        $this->input = Application::getSrv("input")->input;  
        $this->cookie = Application::getSrv("input")->cookie;   
        $this->language = Application::getSrv("language");
        if (!$session_off){
            $this->session = Application::getSrv("session");
        }
        // helper
        $this->linkHelper = Loader::load_helper('link_helper');
        $this->templateHelper = Loader::load_helper('template_helper');        
        $this->template->assign('link',$this->linkHelper);
        $this->template->assign('tpl',$this->templateHelper);
        
        // language
        $lang_global = $this->language->getLang('global.ln');                        
        $this->template->assign('Lang', $lang_global);                     
    }
    
    /**
    * add language file to template
    * 
    * <code>
    * $this->addLang('home.ln');
    * </code>
    * 
    * @param string $name
    */
    public function addLang($name)
    {
        $lang_home = $this->language->getLang($name.'.ln');  
        $this->template->append('Lang',$lang_home,1);
    }
    
    /**
    * get cookie client from cookie name
    * 
    * @param string $name
    */
    public function get_cookie($name)
    {     
        return isset($this->cookie[$name]) ? $this->cookie[$name] : '';
    }
    
    /**
    * set cookie 
    * 
    * @param string $name
    * @param string $value
    * @param int $expire
    * @param string $path
    * @param string $domain
    */
    public function set_cookie($name,$value,$expire = 0,$path = '/',$domain="")
    {   
        if(trim($domain) === "") 
            setcookie($name,$value,$expire,$path);
        else
            setcookie($name,$value,$expire,$path,$domain);
    }
}
?>