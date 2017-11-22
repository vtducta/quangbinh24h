<?php
/**    
 * Email : kph.acc@gmail.com
 * Yahoo : kph_kph@yahoo.com
 * Phone : +84902245620
 * 
 * Database manager class                                        
 *
 * @author         $Author: kenchan ak binhlt $
 * @copyright    (c) kenchan
 * @package        K-CMS
 * @since        Tue. 06th April 2010  
 *
 */  
 
class DatabaseService
{     
    /**
    * handler object 
    *
    * @access       private
    * @var          DBConnection
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
        $cfg = Application::$config['database']; 
        
        if(!count($cfg)) system_error("Config invalid, Please Check struct and data of database.conf ");
        
        $driver = isset($cfg['Connection']['Driver']) ? $cfg['Connection']['Driver'] : '';
        $host = isset($cfg['Connection']['Host']) ? $cfg['Connection']['Host'] : '';
        $username = isset($cfg['Connection']['Username'])? $cfg['Connection']['Username'] : '';
        $password = isset($cfg['Connection']['Password']) ? $cfg['Connection']['Password'] : '';
        $database = isset($cfg['Connection']['Database']) ? $cfg['Connection']['Database'] : '';
        
        if($driver == '' || $host == '' || $username == '' || $username == '' || $password == '' || $database == '') system_error("Config invalid, Please Check struct and data of database.conf ");   
        
        $port = isset($cfg['Options']['Port']) ? $cfg['Options']['Port'] : '3306';
        $socket = isset($cfg['Options']['Socket']) ? $cfg['Options']['Socket'] : null;
//echo $cfg['Connection']['Socket'];
        $charset = isset($cfg['Options']['Charset']) ? $cfg['Options']['Charset'] : null;
        $force_new = @isset($cfg['Options']['ForceNew']) ? $cfg['Options']['ForceNew'] : 0;    
        $persistent = isset($cfg['Options']['Persistent']) ? $cfg['Options']['Persistent'] : 0;
        $log_enable = isset($cfg['Options']['LogEnable']) ? $cfg['Options']['LogEnable'] : 0;
        $log_path = isset($cfg['Options']['LogPath']) ? $cfg['Options']['LogPath'] : "";
        $session_table = isset(Application::$config['session']['TableName']) ? trim(Application::$config['session']['TableName']) : "";
        
        /* load handler object */
        Loader::load( PATH_LIBRARIES_DATABASE );        
        $this->handler = Database::GetConnect($driver);   
        
        $this->handler->obj['sql_database']            = $database;
        $this->handler->obj['sql_user']                = $username;
        $this->handler->obj['sql_port']                = $port;
        $this->handler->obj['sql_socket']              = $socket;
        $this->handler->obj['sql_pass']                = $password;
        $this->handler->obj['sql_host']                = $host;
        $this->handler->obj['sql_charset']              = $charset;
        
        $this->handler->obj['force_new_connection']    =  ( $force_new ) ? 1 : 0;
        $this->handler->obj['persistent']                = ( $persistent ) ? 1 : 0;
        $this->handler->obj['use_shutdown']            = 0;
        
        $this->handler->obj['error_log']                = PATH_APP_SQLERROR . '/sql_error_'.date('m_d_y').'.cgi';
        $this->handler->obj['use_error_log']            = CFG_DEBUG ? 0 : 1;                 
        $this->handler->obj['log_enable']               = $log_enable;
        $this->handler->obj['session_table']            = $session_table;
        
        if ($log_enable){
            if (is_writeable($log_path)) $this->handler->obj['log_path'] = $log_path;
            else system_error("{$log_path} not writeable");
        }
             
        if ( CFG_DEBUG ) 
        {
            $this->handler->return_die = true;
        }                      
        $this->handler->connect();         
        $this->handler->return_die = false;                            
    }    
    
    public function getInstance()
    {   
        return $this->handler;
    }    
}  
?>