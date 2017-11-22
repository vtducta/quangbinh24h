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
 
//-----------------------------------------
// define global value
//-----------------------------------------

// root
define('PATH_APP_ROOT', __DIR__ . DS );
define('PATH_APP_BASE', __DIR__ . DS . '..' . DS . 'base' . DS );

// config
define('PATH_APP_CONFIGS', PATH_APP_ROOT . 'src' . DS . 'configs' . DS );
define('PATH_APP_LANGS', PATH_APP_ROOT . 'src' . DS . 'langs' . DS );
define('PATH_APP_TEMPLATE', PATH_APP_ROOT . 'html' . DS . 'templates' . DS);
define('PATH_APP_TEMPLATE_CACHE', PATH_APP_ROOT . 'cache' . DS . 'templates' . DS);
define('PATH_APP_SQLERROR', PATH_APP_ROOT . 'cache' . DS . 'sqlerror' . DS);
define('PATH_APP_MODULE', PATH_APP_ROOT . 'src' . DS . 'modules' . DS);      

// base
define('PATH_APP_BASE_MODEL', PATH_APP_BASE . 'models' . DS);
define('PATH_APP_BASE_HELPER', PATH_APP_BASE . 'helpers' . DS);
define('PATH_APP_BASE_BEAN', PATH_APP_BASE . 'beans' . DS);
?>