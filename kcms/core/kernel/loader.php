<?php
/**
 * Email : kph.acc@gmail.com
 * Yahoo : kph_kph@yahoo.com
 * Phone : +84902245620
 * 
 * using require_one,include_one function may slow down, this's another way.                                         
 *
 * @author         $Author: kenchan ak binhlt $
 * @copyright    (c) kenchan
 * @package        K-CMS
 * @since        Tue. 06th April 2010  
 *
 */  

class Loader
{
    /**
    * storage path
    *
    * @staticvar
    * @access       public
    * @var          array
    */
    public static $paths = array();
    
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
    *  replace include_once function
    *
    * @static
    * @access       public
    * @param        string      path of file
    * @return       void
    */
    public static function import($path_file){
        if(!isset(self::$paths[$path_file])){
            include($path_file);
            self::$paths[$path_file] = true;
        }
    }
        
    /**
    *  replace require_once function
    *
    * @static
    * @access       public
    * @param        string      path of file
    * @return       void
    */
    public static function load($path_file){
        if(!isset(self::$paths[$path_file])){
            require($path_file);    
            self::$paths[$path_file] = true;
        }
    }
       
    /**
    *  get all loaded path
    *
    * @static
    * @access       public         
    * @return       array       Array of loaded path
    */
    public static function getPaths(){
        return self::$paths;
    }
    
    /**
    * Load model from file name
    * 
    * @param mixed $model
    */
    public static function load_model($name) {
        if(!defined('PATH_APP_BASE_MODEL')) system_error('Missing defination PATH_APP_BASE_MODEL in init.php');
        if(!defined('PATH_APP_BASE_BEAN')) system_error('Missing defination PATH_APP_BASE_BEAN in init.php');
                                                               
        Loader::load(PATH_APP_BASE_MODEL . $name . '_model.php' );
        Loader::load(PATH_APP_BASE_BEAN . $name . '_bean.php' );  
                
        $temp = explode("_", $name);
        $classname = "";
        foreach($temp as $t) {
            $classname .= ucfirst($t);
        }
        $temp = null;
        $classname .= 'Model';
        $obj = new $classname(null);  
        return $obj;
    }
    
    /**
    * Load helper by file name
    * 
    * @param String $helper
    */
    public static function load_helper($helper){
        if(!defined('PATH_APP_BASE_HELPER')) system_error('Missing defination PATH_APP_BASE_HELPER in init.php');  
        Loader::load( PATH_APP_BASE_HELPER . $helper . '.php' );
        $temp = explode('_', $helper);
        $classname = "";
        foreach($temp as $t) {
            $classname .= ucfirst($t);
        }
        return new $classname();
    }
    
    /**
    * get system helper
    * 
    * upload
    * email
    * facebook
    * ftp
    * image
    * captcha
    * 
    * @param string $helper
    */
    public static function load_base_helper($helper)
    {
        $base_helper = array(
            'upload'      => array(
                'path'      => PATH_BASE_UPLOADHELPER,
                'class'     => 'uploadHelper',
            ),
            'email'     => array(
                'path'      => PATH_BASE_EMAILHELPER,
                'class'     => 'emailHelper',
            ),          
            'facebook'      => array(
                'path'      => PATH_BASE_FACEBOOKHELPER,
                'class'     => 'facebookHelper',
            ),
            'ftp'      => array(
                'path'      => PATH_BASE_FTPHELPER,
                'class'     => 'ftpHelper',
            ),
            'image'      => array(
                'path'      => PATH_BASE_IMAGEHELPER,
                'class'     => 'imageHelper',
            ),
            'captcha'      => array(
                'path'      => PATH_BASE_CAPTCHAHELPER,
                'class'     => 'captchaHelper',
            ),
            
        );
        
        if(isset($base_helper[$helper]))
        {
            Loader::load($base_helper[$helper]['path']);
            $class = $base_helper[$helper]['class'];
            return new $class();
        }   
        else return null;
    }
}
?>