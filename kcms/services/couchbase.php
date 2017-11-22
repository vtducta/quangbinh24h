<?php
/**
* @author quangvu - [quang.vu@netlink.vn - quangvu@devzone.vn]
* @skype bro.lemon
* @date Jul 31, 2012
*
* This service manages couchbase objects (connections). Each couchbase connection is created only once time, then 
* will be stored in an array. You can use this service to create any couchbase object, connect to any host, everythig's ok.
* When you want to create new connection, everything you must to do is simply call a method [get_instance()], give it 
* params, that's all.
* 
* This object is implemented base on singleton pattern to keep system performance well.  
*/
class CouchbaseService { 

    /**
    * Array to store created connections.
    * When a connection is created successful, it will be stored in array(key-value).
    * They key is a string to indicate which server , and the value is the connection.
    */
    private $couchbase_list = array();

    //very importance. This is singleton instance. 
    private static $mcs = null;

    private $cfg = null;


    /**
    * In singleton pattern, no one can create new instance of this object. The only one instance of it will be created 
    * by itself. So, this construct must be private.
    */
    private function __construct() {
        if(!count(Application::$config['couchbase'])) system_error("Config invalid, Please Check struct and data of coubase.cfg"); 
        $this->cfg = Application::$config['couchbase'];
    }

    /**
    * create a singleton instance. 
    */
    public static function get_instance() {
        if(self::$mcs==null) {
            //first time creating. From now, no instance will/can be created anymore.
            self::$mcs = new CouchbaseService(); 
        }
        return self::$mcs;
    }

    public function get_couchbase($servers=null) {
        $cb = null;                
        if(count($servers)==0 || $servers==null) {
            if(isset( $this->couchbase_list['default'])) {
                $cb =  $this->couchbase_list['default'];
            }else {
                $cb =  $this->get_default_couchbase();
                $this->couchbase_list['default'] = $cb;
            }
        }else {            
            $key = "";
            foreach($servers as $value) {
                $key .= "$value#";
            }
            $key=substr($key, 0, -1);
            $keycode = md5($key);            
            if(isset( $this->couchbase_list[$keycode])) {
                $cb =  $this->couchbase_list[$keycode];
            }else {
                try {
                    $cb = new Couchbase($servers["Host"], "", "",$servers["Bucket"]);
                    $cb = $this->set_option($cb);
                    $this->couchbase_list[$keycode] = $cb;
                } catch (CouchbaseException $exp) {
                    print_r("Failed to connnect coubase server: " . $exp->getMessage());
                    die();
                }
            }
        }
        return $cb;
    }

    private function get_default_couchbase() {
        try {
            $default_server = $this->get_servers_config();
            $cb = new Couchbase($default_server["Host"], "", "",$default_server["Bucket"]);
        } catch (CouchbaseException $exp) {
            print_r("Failed to connnect couchbase server: " . $exp->getMessage());
            die();
        }
        
        return $this->set_option($cb);
    }

    private function set_option($cb) {
        return $cb;
    }

    private function get_servers_config() {
        if(!count($this->cfg['SERVERS'])) system_error("Config invalid, Missing key SERVERS of memcached.cfg"); 
        $str_servers = $this->cfg['SERVERS'];
        $server = explode('#', $str_servers);
        return array("Host" => isset($server[0]) ? $server[0] : "",
        "Username" => isset($server[1]) ? $server[1] : "",
        "Password" => isset($server[2]) ? $server[2] : "",
        "Bucket" => isset($server[3]) ? $server[3] : "",
        );
    }
}