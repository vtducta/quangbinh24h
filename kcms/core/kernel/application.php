<?php
/**    
 * Email : kph.acc@gmail.com
 * Yahoo : kph_kph@yahoo.com
 * Phone : +84902245620
 * 
 * Application class, manage static services 
 * and provide some method work with queue object                                           
 *
 * @author         $Author: kenchan ak binhlt $
 * @copyright    (c) kenchan
 * @package        K-CMS
 * @since        Tue. 06th April 2010  
 *
 */  
 
class Application
{
    /**
    * Config 
    *
    * @staticvar
    * @access       public
    * @var          array
    */
    public static $config = array();
    
    /**
    * array of static services
    *
    * @staticvar
    * @access       private
    * @var          array
    */
    private static $services = array();
    
    /**
    * array of add-on object
    *
    * @staticvar
    * @access       private
    * @var          array
    */
    private static $addon    = array();
    
    /**
    * Constructor
    *
    * @access       public        
    * @return       void
    */
    public function __construct()
    {
        /* do nothing */
    }
    
    /**
    * boot of application, start all static services 
    * and config them
    *
    * @static
    * @access       public
    * @return       void
    */
    public static function Initialize()
    {                                                     
        //-----------------------------------------
        // load config reader object
        //-----------------------------------------        
        Loader::load( PATH_SERVICES_CONFIG);
        $config = new ConfigService();
        self::setSrv($config,'config');    
        
        self::$config['system'] = self::getSrv('config')->getGFile('system.cfg');
        self::$config['global'] = self::getSrv('config')->getFile('global.cfg');
        self::$config['action'] = self::getSrv('config')->getFile('action.cfg'); 
        self::$config['database'] = self::getSrv('config')->getFile('database.cfg');
        self::$config['memcached'] = self::getSrv('config')->getFile('memcached.cfg');
        self::$config['couchbase'] = self::getSrv('config')->getFile('couchbase.cfg');
        self::$config['security'] = self::getSrv('config')->getFile('security.cfg'); 
        self::$config['session'] = self::getSrv('config')->getFile('session.cfg');  
        self::$config['template'] = self::getSrv('config')->getFile('template.cfg');        
        self::$config['seo'] = self::getSrv('config')->getFile('seo.cfg');  
        self::$config['paging'] = self::getSrv('config')->getFile('paging.cfg');   
        self::$config['mail'] = self::getSrv('config')->getFile('mail.cfg');   
        
        self::setSrv($config,'language'); 
        
        //-----------------------------------------
        // load Interface
        //-----------------------------------------         
        Loader::load( PATH_BASE_IMODULE );
        Loader::load( PATH_BASE_IDATABASE );                                               
        Loader::load( PATH_BASE_IEMAIL );
        Loader::load( PATH_BASE_IMODELEVENT ); 
        Loader::load( PATH_BASE_IIMAGE );
        
        //-----------------------------------------
        // load input filter object
        //-----------------------------------------
        Loader::load( PATH_SERVICES_INPUT);
        $input = new InputService();
        self::setSrv($input,'input');        
        
        //-----------------------------------------
        // load database manager object
        //-----------------------------------------
        Loader::load( PATH_SERVICES_DATABASE);
        $database = new DatabaseService();
        $db_instance = $database->getInstance();
        self::setSrv($db_instance,'database');    

        //-----------------------------------------
        // load memcached manager object
        //-----------------------------------------
        Loader::load(PATH_SERVICES_MEMCACHED);
        $memcached = MemcachedService::get_instance();
        self::setSrv($memcached,'memcached_service');
        
        //-----------------------------------------
        // load couchbase manager object
        //-----------------------------------------
        $couchbase_enable = isset(self::$config['couchbase']['STATUS']) ? self::$config['couchbase']['STATUS'] : "OFF";
        if ($couchbase_enable == "ON"){
            Loader::load(PATH_SERVICES_COUCHBASE);
            $couchbase = CouchbaseService::get_instance();
            self::setSrv($couchbase,'couchbase');
        }
        
        //-----------------------------------------
        // load session manager object
        //-----------------------------------------
        $session_off = isset(self::$config['session']['SessionOff']) ? self::$config['session']['SessionOff'] : 0;
        if (!$session_off){
            Loader::load( PATH_SERVICES_SESSION);
            $session  = new SessionService();
            self::setSrv($session,'session');      
        }
        
        //-----------------------------------------
        // load template manager object
        //-----------------------------------------
        Loader::load( PATH_SERVICES_TEMPLATE);  
        $template = new TemplateService();
        self::setSrv($template,'template');
                                        
        
        //-----------------------------------------
        // load MVC pattern
        //-----------------------------------------                                                    
        Loader::load(PATH_BASE_ABEAN);
        Loader::load(PATH_BASE_AMODEL);     
        Loader::load(PATH_BASE_AMODULE);            
        
        //-----------------------------------------
        // load Helper
        //----------------------------------------- 
        Loader::load(PATH_BASE_AHELPER);
        Loader::load(PATH_BASE_ALINKHELPER);
        Loader::load(PATH_BASE_ATEMPLATEHELPER);       
    }
    
    /**
    * start action in router table, config in action config file
    *
    * @static
    * @access       public
    * @return       void
    */
    public static function Router()
    {           
        //-----------------------------------------
        // load router table
        //-----------------------------------------    
        $router = self::$config['action'];  
        if(!count($router)) system_error("Config invalid, Please Check struct and data of action.cfg");    
                
        if(!isset($router['Default']) || !count($router['Default'])) system_error("Config invalid, Missing key Default of action.cfg");    
        if(!isset($router['Action']) || !count($router['Action'])) system_error("Config invalid, Missiong key Action of action.cfg");    
        if(!isset(Application::$config['global']['URL']['Base'])) system_error("Config invalid, Missiong key URL/Base of global.cfg");  
        if(!defined('PATH_APP_MODULE')) system_error("Mission defination PATH_APP_MODULE in init.php");    
        
        $default = $router['Default'];
        $action = $router['Action'];   
        
        //-----------------------------------------
        // routing
        //-----------------------------------------
        $cur_action = isset(self::getSrv('input')->input['act']) && (trim(self::getSrv('input')->input['act']) !== '') ? self::getSrv('input')->input['act'] : $default;                
        if(!isset($action[$cur_action])) self::redirect(Application::$config['global']['URL']['Base']);       
        $module = PATH_APP_MODULE . $action[$cur_action]['module'];
        $module_class = $action[$cur_action]['class'];
        $module_params = isset($action[$cur_action]['params']) && is_array($action[$cur_action]['params']) ?  $action[$cur_action]['params'] : array();
        
        //-----------------------------------------
        // start module
        //-----------------------------------------        
        Loader::load($module);
        
        /**
        * module handler object
        * @var          IModule
        */
        $module_handler = new $module_class($module_params);               
        $module_handler->run();
        $module_handler->destroyed();
    }
    
    /**
    * Redirect using php
    *
    * @static
    * @access       public
    * @param        string      url redirect         
    * @return       void
    */
    public static function redirect($url)
    {
        header( "Location: {$url}" ) ;
        exit();
    }   
    
    /**
    * get current page url
    *
    * @access       public 
    * @return       string          current page url
    */
    public static function pageURL() 
    {
        $pageURL = 'http://'; 
        if ($_SERVER["SERVER_PORT"] != "80") 
        {
            $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
        } else {
            $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
        }
        return $pageURL;
    }        
    
    /**
    * paging function
    *
    * @static
    * @access       public
    * @param        int         current page
    * @param        int         total page
    * @param        int         number page to show
    * @return       array       page array
    */
    public static function paging($current_page,$total_page,$page_show)
    {
        $page_data = array();
        
        if($total_page > $page_show)
        {
            for($i = 0; $i < $page_show ; $i++)
            {
            
                 if(($current_page > (round($page_show/2)))  && $current_page < ($total_page + 1 - (round($page_show/2)) ))
                 {                  
                      $page_data[] = $current_page - round($page_show/2) + $i;  
                 }
                 elseif($current_page <= (round($page_show/2)))
                 { 
                    $page_data[] = $i+1;   
                 }
                 else{
                    $page_data[] = $total_page - $page_show + $i +1;
                 }              
            }               
        }  
        else{
            for($i = 0; $i < $total_page; $i++)
            {
                $page_data[] = $i+1;
            }
        }
        return $page_data; 
    }
    /**
    * build link to action
    *
    * @static
    * @access       public
    * @param        string      action name
    * @param        array       param list 
    * @param        int(0,1)    flag external link        
    * @return       string      link
    */
    public static function buildLink($action,$param=array(),$external = 0)
    {
        if(!isset(Application::$config['seo']['SEOEnable'])) system_error("Config invalid, Missing key SEOEnable of seo.cfg"); 
        if(!isset(Application::$config['seo']['SEOMap'])) system_error("Config invalid, Missing key SEOMap of seo.cfg");   
        
        $seo = Application::$config['seo']['SEOEnable'];  
       
        if(isset(Application::$config['seo']['SEOMap'][$action]))
        {  
            if($seo) $action_map = Application::$config['seo']['SEOMap'][$action]['SEO'];   
            else $action_map = Application::$config['seo']['SEOMap'][$action]['Normal'];            
            $pattern_name = isset($param['pattern']) ? $param['pattern'] : 'default' ;                                       
            $p1 = isset($param['var']['p1']) ? $param['var']['p1'] : 0;
            $p2 = isset($param['var']['p2']) ? $param['var']['p2'] : 0;
            $p3 = isset($param['var']['p3']) ? $param['var']['p3'] : 0;
            $p4 = isset($param['var']['p4']) ? $param['var']['p4'] : 0;  
            $p5 = isset($param['var']['p5']) ? $param['var']['p5'] : 0;  
            $p6 = isset($param['var']['p6']) ? $param['var']['p6'] : 0;  
            $p7 = isset($param['var']['p7']) ? $param['var']['p7'] : 0;  
            $p8 = isset($param['var']['p8']) ? $param['var']['p8'] : 0;  
            $p9 = isset($param['var']['p9']) ? $param['var']['p9'] : 0;  
            $array_mixed = array('$1','$2','$3','$4','$5','$6','$7','$8','$9');
            $array_repace = array($p1,$p2,$p3,$p4,$p5,$p6,$p7,$p8,$p9);
            $link = str_replace($array_mixed,$array_repace,$action_map[$pattern_name]);
            if(!$external) $link = Application::$config['global']['URL']['Base'].$link ; 
        }
        else {
            $link = Application::$config['global']['URL']['Base'];
        }
        return $link;
    }
    
    /**
    * check ajax request
    *
    * @static
    * @access       public
    * @param        array         
    * @return       void
    */
    public static function isAjaxHeader()
    {
         return (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest'));
    }
    
    /**
    * set object service to queue
    *
    * @static
    * @access       private
    * @param        object      object of services
    * @param        string      service name
    * @return       void
    */
    private static function setSrv($srv,$srvName)
    {
        if(!isset(self::$services[$srvName])){
            self::$services[$srvName] = $srv;
        }
    }
    
    /**
    * remove object service from queue
    *
    * @static  
    * @access       private
    * @param        string      service name      
    * @return       void
    */
    private static function rmSrv($srvName)
    {
        if(isset(self::$services[$srvName])){
            unset(self::$services[$srvName]);
        }
    }
    
    /**
    * get object service from queue
    *
    * @static
    * @access       public
    * @param        string      service name         
    * @return       object      object service handle
    */
    public static function getSrv($srvName)
    {
        if(!isset(self::$services[$srvName])){
            system_error("Cannot find {$srvName} in memory");
        }
        return self::$services[$srvName];
    }
    
    /**
    * remove all static service in queue
    *
    * @static
    * @access       public
    * @return       void
    */
    public static function Shutdown()
    {
        /* remove services */
        self::rmSrv('input');
        self::rmSrv('config');
        
        self::$services['database']->disconnect();
        self::rmSrv('database');     
        self::rmSrv('session');
        self::rmSrv('template');
        
        /* remove addon */
        foreach(self::$addon as $key => $val)
        {
            self::$addon[$key]->destroy();
            unset(self::$addon[$key]);
        }
    }
}
?>