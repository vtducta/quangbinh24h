<?php    
/**    
* Email : kph.acc@gmail.com
* Yahoo : kph_kph@yahoo.com
* Phone : +84902245620
* 
* Class Session manager via database
* After instantiating the class, use sessions as you would normally                                           
*
* @author         $Author: kenchan ak binhlt $
* @copyright    (c) kenchan
* @package        K-CMS
* @since        Tue. 06th April 2010  
*
*/  

class SessionDb
{     
    /**
    * Database Hanlder
    *
    * @access       private
    * @var          IDatabaseDriver
    */
    private $db = null;

    /**
    *  Constructor
    * 
    *  Initializes the class and starts a new session
    *
    *  There is no need to call start_session() after instantiating this class
    *
    *  @access       public    
    * 
    *
    *  @param  integer     $gc_maxlifetime     (optional) the number of seconds after which data will be seen as 'garbage' and
    *                                          cleaned up on the next run of the gc (garbage collection) routine
    *
    *                                          Default is specified in php.ini file
    *
    *  @param  integer     $gc_probability     (optional) used in conjunction with gc_divisor, is used to manage probability that
    *                                          the gc routine is started. the probability is expressed by the formula
    *
    *                                          probability = $gc_probability / $gc_divisor
    *
    *                                          So if $gc_probability is 1 and $gc_divisor is 100 means that there is
    *                                          a 1% chance the the gc routine will be called on each request
    *
    *                                          Default is specified in php.ini file
    *
    *  @param  integer     $gc_divisor         (optional) used in conjunction with gc_probability, is used to manage probability
    *                                          that the gc routine is started. the probability is expressed by the formula
    *
    *                                          probability = $gc_probability / $gc_divisor
    *
    *                                          So if $gc_probability is 1 and $gc_divisor is 100 means that there is
    *                                          a 1% chance the the gc routine will be called on each request
    *
    *                                          Default is specified in php.ini file
    *
    *  @param  string      $securityCode       (optional) the value of this argument is appended to the HTTP_USER_AGENT before
    *                                          creating the md5 hash out of it. this way we'll try to prevent HTTP_USER_AGENT
    *                                          spoofing
    *
    *                                          Default is 'kCms_sEcUr1tY_c0dE'
    *
    *  @param  string      $tableName          (optional) You can change the name of that table by setting this property
    *
    *                                          Default is 'obj_session'
    *
    *  @return void    
    */
    public function __construct($gc_maxlifetime = "", $gc_probability = "", $gc_divisor = "", $securityCode = "kCms_sEcUr1tY_c0dE", $tableName = "obj_sessions")
    {     
        /* if $gc_maxlifetime is specified and is an integer number */ 
        if ($gc_maxlifetime != "" && is_integer($gc_maxlifetime)) {

            // set the new value
            @ini_set('session.gc_maxlifetime', $gc_maxlifetime);

        }

        /* if $gc_probability is specified and is an integer number */
        if ($gc_probability != "" && is_integer($gc_probability)) {

            /* set the new value */
            @ini_set('session.gc_probability', $gc_probability);

        }

        /* if $gc_divisor is specified and is an integer number */
        if ($gc_divisor != "" && is_integer($gc_divisor)) {

            /* set the new value */
            @ini_set('session.gc_divisor', $gc_divisor);

        }

        /* get session lifetime */
        $this->sessionLifetime = @ini_get("session.gc_maxlifetime");  

        /* we'll use this later on in order to try to prevent HTTP_USER_AGENT spoofing */
        $this->securityCode = $securityCode;

        $this->db = Application::getSrv('database');

        $this->tableName = $tableName;

        /* register the new handler */
        session_set_save_handler(
            array(&$this, 'open'),
            array(&$this, 'close'),
            array(&$this, 'read'),
            array(&$this, 'write'),
            array(&$this, 'destroy'),
            array(&$this, 'gc')
        );

        register_shutdown_function('session_write_close');

        /* secure */
        $sn = session_name();                                               
        if(isset($_GET[$sn])) unset($_GET[$sn]);
        if(isset($_POST[$sn])) unset($_POST[$sn]);

        /* start the session */   
        session_start();  
    }

    /**
    * Deletes all data related to the session 
    *
    * @access       public       
    * @return       void
    */
    public function stop()
    {

        $this->regenerate_id();

        session_unset();

        session_destroy();

    }        

    /**
    *  Regenerates the session id.
    *
    *  <b>Call this method whenever you do a privilege change!</b>
    *
    * @access       public      
    * @return       void
    */
    public function regenerate_id()
    {

        /* saves the old session's id */
        $oldSessionID = session_id();

        /* regenerates the id
        this function will create a new session, with a new id and containing the data from the old session
        but will not delete the old session  */
        session_regenerate_id();

        /* because the session_regenerate_id() function does not delete the old session,
        we have to delete it manually */
        $this->destroy($oldSessionID);   
    }                        

    /**
    * Custom open() function
    *
    * @access       public   
    * @param        string
    * @param        string         
    * @return       bool
    */
    public function open($save_path, $session_name)
    {         
        return true;
    }

    /**
    * Custom close() function
    *
    * @access       public   
    * @return       bool
    */
    public function close()
    {      
        return true;
    }

    /**
    * Custom read() function
    *
    * @access       public   
    * @param        string
    * @return       mixed
    */
    public function read($session_id)
    {                  
        /* reads session data associated with the session id
        but only
        - if the HTTP_USER_AGENT is the same as the one who had previously written to this session AND
        - if session has not expired*/
        $user_agent = isset($_SERVER["HTTP_USER_AGENT"]) ? $_SERVER["HTTP_USER_AGENT"] : 'default agent'; 
        $hash_user_agent = md5($this->securityCode . $user_agent);
        $now = time();      

        $this->db->build(array( 
            'select'    => 'session_data',
            'from'      => $this->tableName,
            'where'     => "session_id = '{$session_id}' and session_user_agent = '{$hash_user_agent}' and session_expire > {$now}",
            'limit'     => array(0,1)
        ));
        $this->db->execute();
        while($row = $this->db->fetch())
        {    
            if(isset($row["session_data"])) return $row['session_data'];
        }      
        /* if there was an error return an empty string - this HAS to be an empty string*/
        return "";

    }

    /**
    * Custom write() function
    *
    * @access       public   
    * @param        string
    * @param        mixed
    * @return       mixed
    */
    public function write($session_id, $session_data)
    {                       
        $user_agent = isset($_SERVER["HTTP_USER_AGENT"]) ? $_SERVER["HTTP_USER_AGENT"] : 'default agent'; 
        $hash_user_agent = md5($this->securityCode . $user_agent);
        $expire = time()+$this->sessionLifetime;
        
        $this->db->replace($this->tableName,array(
            "session_id"            =>  $session_id,
            "session_user_agent"    =>  $hash_user_agent,
            "session_data"          =>  $session_data,
            "session_expire"        =>  $expire
        ));
        
        if($this->db->getAffectedRows() > 1) return true;
        else return false; 
    }

    /**
    * Custom destroy() function
    *
    * @access       public   
    * @param        string    
    * @return       bool
    */
    public function destroy($session_id)
    {                                                                                                                                      
        /* deletes the current session id from the database */
        $this->db->delete($this->tableName,"session_id = '{$session_id}'");

        /* if anything happened  */
        if($this->db->getAffectedRows()) return true;
        else return false;        
    }

    /**
    * Custom gc() function (garbage collector)                  
    *
    * @access       public   
    * @param        int    
    * @return       void
    */
    public function gc($maxlifetime)
    {              
        $time =  time() - $maxlifetime;
        /* it deletes expired sessions from database*/
        $this->db->delete($this->tableName,"session_expire < {$time}");        
    }            
}
?>