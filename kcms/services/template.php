<?php
/**    
 * Email : kph.acc@gmail.com
 * Yahoo : kph_kph@yahoo.com
 * Phone : +84902245620
 * 
 * Template service , using smarty
 *
 * @author         $Author: kenchan ak binhlt $
 * @copyright    (c) kenchan
 * @package        K-CMS
 * @since        Tue. 06th April 2010  
 *
 */  
 
class TemplateService
{     
    /**
    * handler object 
    *
    * @access       private
    * @var          Smarty
    */  
    private $handler = null;      
  
    /**
    * Constructor
    *
    * @access       public        
    * @return       void
    */
    public function __construct()
    {       
        /* load config */
        $cfg = Application::$config['template'];
        
        if(!count($cfg)) system_error("Config invalid, Please Check struct and data of template.cfg");       
        
                
        /* load handler object */
        Loader::load( PATH_LIBRARIES_SMARTY );
        $this->handler = new Smarty();
        
        if(!defined('PATH_APP_TEMPLATE')) system_error("Missing defination PATH_APP_TEMPLATE in init.php");
        if(!defined('PATH_APP_TEMPLATE_CACHE')) system_error("Missing defination PATH_APP_TEMPLATE_CACHE in init.php");
        
        try
        {        
            $this->handler->force_compile = $cfg['Mode']['ForceCompile'];
            $this->handler->debugging = $cfg['Mode']['Debugging'];
            $this->handler->caching = $cfg['Mode']['Caching'];
            $this->handler->cache_lifetime = $cfg['Mode']['CacheTime'];

            $this->handler->setTemplateDir(PATH_APP_TEMPLATE);
            $this->handler->setCompileDir(PATH_APP_TEMPLATE_CACHE . $cfg['Dir']['Compile']);
            $this->handler->setCacheDir(PATH_APP_TEMPLATE_CACHE . $cfg['Dir']['Cache']);
            $this->handler->setConfigDir(PATH_APP_TEMPLATE_CACHE . $cfg['Dir']['Config']);
        }
        catch(Exception $ex)
        {  
            throw new Exception($ex->getMessage(),3563);
        }
                                              
       
        /* load global config */
        $cfg_g = Application::$config['global'];        
        
        
        if(!count($cfg_g)) system_error("Config invalid, Please Check struct and data of global.cfg");    
        if(!count($cfg_g['URL'])) system_error("Config invalid, Missing URL key of global.cfg");    
        if(!count($cfg_g['Meta'])) system_error("Config invalid, Missing Meta key of global.cfg");    
        /* assign global data */
        $this->handler->assignGlobal('GUrl',$cfg_g['URL']);   
        $this->handler->assignGlobal('GMeta',$cfg_g['Meta']);     
    }
    
    /**
    * assign a variable to template
    *
    * @access       public  
    * @param        mixed      the template variable name(s)  
    * @param        mixed       the value to assign     
    * @param        boolean     if true any output of this variable will be not cached
    * @param        define      the scope variable will have ( local, parent or root)
    * @return       void
    */                   
    public function assign($template,$value,$nocache = false, $scope = 0)
    {   
        $this->handler->assign($template,$value,$nocache,$scope);
    }
    
    /**
    * append a variable to template
    *
    * @access       public  
    * @param        mixed      the template variable name(s)  
    * @param        mixed       the value to assign     
    * @param        boolean     if true any output of this variable will be not cached
    * @param        boolean     merge ?
    * @param        define      the scope variable will have ( local, parent or root)
    * @return       void
    */                   
    public function append($template,$value,$merge = false,$nocache = false, $scope = 0)
    {   
        $this->handler->append($template,$value, $merge, $nocache, $scope);
    }
    
    /**
    * assign a variable to template by reference 
    *
    * @access       public  
    * @param        mixed      the template variable name(s)  
    * @param        mixed       the referenced value to assign 
    * @param        boolean     if true any output of this variable will be not cached
    * @param        define      the scope variable will have ( local, parent or root)
    * @return       void
    */                   
    public function assignRef($template,&$value,$nocache = false, $scope = 0)
    {   
        $this->handler->assignByRef($template,$value,$nocache,$scope);
    }
   
    /**
    * clear the given assigned template variable , if template variable is empty
    * it will clear all assigned variable
    *
    * @access       public
    * @param        string      the template variable(s) to clear            
    * @return       void
    */
    public function clearAssign($template = '')
    {
        if(trim($template) !== '') $this->handler->clearAssign($template);
        else $this->handler->clearAllAssign();
    }    
    /**
    * displays a Smarty template
    * 
    * @access       public
    * @param        string      the resource handle of the template file  or template object
    * @param        mixed       cache id to be used with this template
    * @param        mixed       compile id to be used with this template
    * @param        object      next higher level of Smarty variables
    * @return       void
    */
    public function display($template, $cache_id = null, $compile_id = null, $parent = null)
    { 
          $this->handler->display($template,$cache_id,$compile_id,$parent);
    }
    
    /**
    * displays a Smarty template with jsonn encode
    * 
    * @access       public
    * @param        string      the resource handle of the template file  or template object
    * @param        mixed       cache id to be used with this template
    * @param        mixed       compile id to be used with this template
    * @param        object      next higher level of Smarty variables
    * @return       void
    */
    public function display_ajax($template, $cache_id = null, $compile_id = null, $parent = null)
    { 
        echo json_encode($this->handler->fetch($template,$cache_id,$compile_id,$parent)); 
    }
    
    /**
    * fetch a Smarty template
    * 
    * @access       public
    * @param        string      the resource handle of the template file  or template object
    * @param        mixed       cache id to be used with this template
    * @param        mixed       compile id to be used with this template
    * @param        object      next higher level of Smarty variables
    * @return       string      template html
    */
    public function fetch($template, $cache_id = null, $compile_id = null, $parent = null)
    { 
          return $this->handler->fetch($template,$cache_id,$compile_id,$parent);
    } 

    /**
    * test if cache i valid
    * 
    * @access       public
    * @param        string      the resource handle of the template file or template object
    * @param        mixed       cache id to be used with this template
    * @param        mixed       compile id to be used with this template
    * @return       boolean     cache status
    */
    public function isCached($template, $cache_id = null, $compile_id = null)
    {
         return $this->handler->isCached($template,$cache_id,$compile_id);
    } 
    
    /**
    * enable debugging
    * 
    * @param boolean $bool
    */
    public function set_debug($bool)
    {
        if($bool)
        {
            $this->handler->debugging = true;
        }
        else
        {
            $this->handler->debugging = false;
        }
        
    }
    /**
    * Escaping Smarty Parsing
    * 
    * @param String $left
    * @param String $right
    */
    public function set_left_right_delimiter($left,$right){
        $this->handler->right_delimiter = $right;
        $this->handler->left_delimiter = $left;
    }
}  
?>