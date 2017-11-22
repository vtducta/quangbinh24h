<?php
/**    
 * Email : kph.acc@gmail.com
 * Yahoo : kph_kph@yahoo.com
 * Phone : +84902245620
 * 
 * Config reader service, read yaml format                                           
 *
 * @author         $Author: kenchan ak binhlt $
 * @copyright    (c) kenchan
 * @package        K-CMS
 * @since        Tue. 06th April 2010  
 *
 */  
 
class ConfigService
{       
    /**
    * handler object 
    *
    * @access       private
    * @var          Configuration
    */  
    private $handler = null;
    
    /**
    * language
    *
    * @access       public
    * @var          string
    */
    public $lang = "";
    
    /**
    * Constructor
    *
    * @access       public        
    * @return       void
    */
    public function __construct()
    {
        /* load handler object */
        Loader::load(PATH_LIBRARIES_READER);
        $this->handler = new Configuration();   
        
        $this->lang = "vn";
    }
    
    /**
    * Get config from file ( YAML format)
    *
    * @access       public
    * @param        string      file path         
    * @return       void
    */
    public function getFile($file)                       
    {               
        if(!defined('PATH_APP_CONFIGS')) system_error('Missing defination PATH_APP_CONFIGS of init.php');
        return $this->handler->YAMLLoad( PATH_APP_CONFIGS . $file);     
    }
    
    /**
    * Get config from file ( YAML format)
    *
    * @access       public
    * @param        string      file path         
    * @return       void
    */
    public function getGFile($file)                       
    {               
        return $this->handler->YAMLLoad( PATH_CONFIGS . $file);     
    }
    
    /**
    * Get language from file ( YAML format)
    *
    * @access       public
    * @param        string      file path   
    * @return       void
    */
    public function getLang($file)
    {                                        
        if(!defined('PATH_APP_LANGS')) system_error('Missing defination PATH_APP_LANGS of init.php');
        return $this->handler->YAMLLoad( PATH_APP_LANGS . $file);
    }
    
}  
?>