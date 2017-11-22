<?php
/**    
 * Email : kph.acc@gmail.com
 * Yahoo : kph_kph@yahoo.com
 * Phone : +84902245620
 * 
 * Session service , start session                                            
 *
 * @author         $Author: kenchan ak binhlt $
 * @copyright    (c) kenchan
 * @package        K-CMS
 * @since        Tue. 06th April 2010  
 *
 */  
 
class SessionService
{                          
    /**
    * session struct
    *
    * @access       private
    * @var          array
    */
    private $session_storage = array();
    
    /**
    * handler object 
    *
    * @access       private
    * @var          SessionDb
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
        $cfg = Application::$config['session'];     
        
        $gc_maxlifetime = $cfg['GCMaxLifeTime'];
        $gc_probability = $cfg['GCProbability'];
        $gc_divisor  = $cfg['GCDivisor'];
        $securityCode = $cfg['SecurityCode'];
        $tableName = $cfg['TableName'];      
                
        /* load handler object */
        Loader::load( PATH_LIBRARIES_SESSIONDB );
        $this->handler = new SessionDb($gc_maxlifetime,$gc_probability,$gc_divisor,$securityCode,$tableName);   
        
        $ip = $this->getIP();               
        $url = $this->getUrl();                    
                               
        /* default session */
        $this->session_storage = array(
            'user_id'               => 0,
            'user_name'             => 'Guest',
            'user_display'           => 'Guest',
            'user_group'            =>  array(5),      
            'user_ipaddress'        => $ip,
            'user_last_action_time' => time(),
            'user_last_url'         => $url,
        );
                           
        $check_session  =   $this->get_session('user_id');
        if(is_null($check_session))
        {
            /* create new guest session */
            $this->set_session_arr($this->session_storage);
        }   
        elseif( $check_session == 0 ) 
        {
            /* update guest session */
            $this->set_session_arr($this->session_storage);
        }   
    }  
    
    /**
    * get Ip address
    *
    * @access       private   
    * @return       string
    */
    public function getIP()
    {
        if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        else if (isset($_SERVER['REMOTE_ADDR'])) $ip = $_SERVER['REMOTE_ADDR'];
        else $ip = "";
        return $ip;
    }
    
    /**
    * set session array
    *
    * @access       public
    * @param        array         
    * @return       void
    */
    public function set_session_arr($arr)
    {
        foreach( $arr as $key => $val )
        {
            $this->set_session($key,$val);
        }      
    }
    
    /**
    * get current url
    *
    * @access       public 
    * @return       string      current url
    */
    public function getUrl()
    {
        $url = "";
        return $url;
    }
    
    /**
    *  set a session value
    *
    * @access       public
    * @param        string
    * @param        mixed         
    * @return       void
    */
    public function set_session($name,$val)
    {           
        $_SESSION[$name] = $val;         
    } 
    
    /**
    * delete a session value
    *
    * @access       public
    * @param        string         
    * @return       void
    */
    public function rm_session($name)
    {
        if(isset($_SESSION[$name])) unset($_SESSION[$name]);
    }
    
    /**
    * delete session object
    *
    * @access       public   
    * @return       void
    */     
    public function destroy()
    {
        $this->handler->stop();
    }
    
    /**
    * get a session
    *
    * @access       public     
    * @param        string
    * @return       mixed
    */
    public function get_session($name)
    {
        if(isset($_SESSION[$name])) return$_SESSION[$name]; 
        else return null;
    }
}
?>