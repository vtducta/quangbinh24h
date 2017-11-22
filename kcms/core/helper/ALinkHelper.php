<?php
abstract class ALinkHelper extends Helper
{
    /**
    * constructor
    * 
    */
    public function __construct()
    {
        parent::__construct();
    }
    
    /**
    * get current url 
    * 
    * @return string $url
    */
    public function get_current_url() 
    {
        $pageURL = "http" . (($_SERVER['SERVER_PORT'] == 443) ? "s://" : "://");
        if ($_SERVER["SERVER_PORT"] != "80") 
        {
            $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
        } else {
            $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
        }
        return $pageURL;
    }    
    
    /**
    * get base url 
    * 
    * example http://k-cms.com
    *
    * @return string $url 
    */
    public function get_base_url()
    {
        if(isset(Application::$config['global']['URL']['Base'])) return Application::$config['global']['URL']['Base'];
        else return '';
    }
    
    /**
    * get js url from config
    * 
    * example http://k-cms.com/js/
    *
    * @return string $url 
    */
    public function get_js_url()
    {        
        if(isset(Application::$config['global']['URL']['Js'])) return Application::$config['global']['URL']['Js'];
        else return '';
    }
    
    /**
    * get css url from config
    * 
    * example http://k-cms.com/css/
    * 
    * @return string $url
    */
    public function get_css_url()
    {        
        if(isset(Application::$config['global']['URL']['Css'])) return Application::$config['global']['URL']['Css'];
        else return '';
    }
    
    /**
    * get upload url from config
    * 
    * example http://k-cms.com/upload/
    * 
    * @return string $url
    */
    public function get_image_url()
    {        
        if(isset(Application::$config['global']['URL']['Images'])) return Application::$config['global']['URL']['Images'];
        else return '';
    }
    
    /**
    * get upload url from config
    * 
    * example http://k-cms.com/upload/
    * 
    * @return string $url
    */
    public function get_upload_url()
    {        
        if(isset(Application::$config['global']['URL']['Upload'])) return Application::$config['global']['URL']['Upload'];
        else return '';
    }
    
    /**
    * get Thumbnail url from config
    * 
    * example http://thumb.k-cms.com/
    * 
    * @return string $url
    */
    public function get_thumb_url()
    {
        if(isset(Application::$config['global']['URL']['Thumb'])) return Application::$config['global']['URL']['Thumb'];
        else return '';   
    }
    
    /**
    * get domain from url
    * 
    * @param string $url     
    * @return string $domain
    */
    public function get_domain_from_url($url)
    {                     
        @preg_match_all('/^(https?:\/\/)?((www\.|\.))?(?=.*[\.].*)([a-zA-Z0-9\-\_\.]+)\/?(.*)$/ix', $url, $matches);
        $domain = isset($matches[4][0]) ? strtolower(trim($matches[4][0])):  '';
        return $domain;
    }
}  
?>
