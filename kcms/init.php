<?php
/**
 * Email : binhlt@netlink.vn
 * Yahoo : kph_kph@yahoo.com
 * Skype : kw_kenchan
 * Facebook : facebook.com/kenny.netlink
 * Phone : +84902245620
 * 
 * Init define value , load base package                                          
 *
 * @author         $Author: kenchan ak binhlt $
 * @copyright    (c) kenchan
 * @package        K-CMS
 * @since        Tue. 06th April 2010  
 *
 */

if (!defined('DS')){
    define('DS' , DIRECTORY_SEPARATOR );
}
if(!isset($app['src'])) {
    system_error('Cannot install, Please re-check $app config');
}
if(!file_exists(__DIR__ . DS . '..'. DS . $app['src'] . DS . 'init.php')){
    system_error('Cannot install, Please re-check "' . $app['src'] . DS . 'init.php' . '" file'); 
}    

isset($app['timezone']) ? date_default_timezone_set($app['timezone']) : date_default_timezone_set('Asia/Bangkok');

if(isset($app['release']) && $app['release']){
   ini_set("display_errors",0); 
   define('CFG_DEBUG',0);
}else{
    ini_set("display_errors",1);
    define('CFG_DEBUG',1);
}
function system_error($msg){print($msg);exit();}

//-----------------------------------------
// define path of framework
//-----------------------------------------

// dir
define('PATH_ROOT', __DIR__ . DS );
define('PATH_CORE', PATH_ROOT . 'core' . DS );
define('PATH_SERVICES', PATH_ROOT . 'services' . DS );
define('PATH_LIBRARIES', PATH_ROOT . 'libraries' . DS );
define('PATH_CONFIGS', PATH_ROOT . 'configs' . DS );

// dir core
define('PATH_HELPER', PATH_CORE . 'helper' . DS );
define('PATH_INTERFACE', PATH_CORE . 'interface' . DS ); 
define('PATH_MVC', PATH_CORE . 'mvc' . DS );
define('PATH_KERNEL', PATH_CORE . 'kernel' . DS );

// app
define('PATH_APP_INIT',  PATH_ROOT . '..'. DS . $app['src'] . DS . 'init.php' );

// base
define('PATH_BASE_LOADER', PATH_KERNEL . 'loader.php');
define('PATH_BASE_EXCEPTION', PATH_KERNEL . 'exception.php');
define('PATH_BASE_APPLICATION', PATH_KERNEL . 'application.php');

// mvc
define('PATH_BASE_ABEAN', PATH_MVC . 'ABean.php');   
define('PATH_BASE_AMODEL', PATH_MVC . 'AModel.php');
define('PATH_BASE_AMODULE', PATH_MVC . 'AModule.php');

// interface
define('PATH_BASE_IDATABASE', PATH_INTERFACE . 'IDatabase.php');  
define('PATH_BASE_IMODULE', PATH_INTERFACE . 'IModule.php');
define('PATH_BASE_IEMAIL', PATH_INTERFACE . 'IEmail.php');
define('PATH_BASE_IMODELEVENT', PATH_INTERFACE . 'IModelEvent.php');
define('PATH_BASE_IIMAGE', PATH_INTERFACE . 'IImage.php');



// helper
define('PATH_BASE_AHELPER', PATH_HELPER . 'AHelper.php');
define('PATH_BASE_ALINKHELPER', PATH_HELPER . 'ALinkHelper.php');
define('PATH_BASE_ATEMPLATEHELPER', PATH_HELPER . 'ATemplateHelper.php');

// base helper
define('PATH_BASE_UPLOADHELPER', PATH_HELPER . 'uploadHelper.php');
define('PATH_BASE_EMAILHELPER', PATH_HELPER . 'emailHelper.php');
define('PATH_BASE_FACEBOOKHELPER', PATH_HELPER . 'facebookHelper.php');
define('PATH_BASE_FTPHELPER', PATH_HELPER . 'ftpHelper.php');
define('PATH_BASE_IMAGEHELPER', PATH_HELPER . 'imageHelper.php');
define('PATH_BASE_CAPTCHAHELPER', PATH_HELPER . 'captchaHelper.php');



// service
define('PATH_SERVICES_CONFIG', PATH_SERVICES . 'config.php');
define('PATH_SERVICES_INPUT', PATH_SERVICES . 'input.php');
define('PATH_SERVICES_DATABASE', PATH_SERVICES . 'database.php');
define('PATH_SERVICES_MEMCACHED', PATH_SERVICES . 'memcached.php');
define('PATH_SERVICES_COUCHBASE', PATH_SERVICES . 'couchbase.php');
define('PATH_SERVICES_SESSION', PATH_SERVICES . 'session.php');
define('PATH_SERVICES_TEMPLATE', PATH_SERVICES . 'template.php');

// libraries
define('PATH_LIBRARIES_READER', PATH_LIBRARIES . 'reader.php');
define('PATH_LIBRARIES_CLEANER', PATH_LIBRARIES . 'cleaner.php');
define('PATH_LIBRARIES_DATABASE', PATH_LIBRARIES . 'database.php');
define('PATH_LIBRARIES_DATABASE_DIR', PATH_LIBRARIES . 'dbdriver' . DS);
define('PATH_LIBRARIES_SESSIONDB', PATH_LIBRARIES . 'sessiondb.php');
define('PATH_LIBRARIES_SMARTY', PATH_LIBRARIES . 'smarty' . DS . 'SmartyBC.class.php');

//-----------------------------------------
// loader follow that , do not modify
//-----------------------------------------

require( PATH_APP_INIT );
require( PATH_BASE_LOADER );
require( PATH_BASE_EXCEPTION );  
require( PATH_BASE_APPLICATION );
ErrorHandler::Initialize(); 
Application::Initialize();     
Application::Router();  
register_shutdown_function(array("Application","Shutdown"));  
?>