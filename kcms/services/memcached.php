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
class MemcachedService { 

    /**
    * Array to store created connections.
    * When a connection is created successful, it will be stored in array(key-value).
    * They key is a string to indicate which server , and the value is the connection.
    */
    private $memcached_list = array();

    //Not importance, just for internal log test.
    private $memcached_call_log = array();    

    //very importance. This is singleton instance. 
    private static $mcs = null;

    private $cfg = null;


    /**
    * In singleton pattern, no one can create new instance of this object. The only one instance of it will be created 
    * by itself. So, this construct must be private.
    */
    private function __construct() {
        if(!count(Application::$config['memcached'])) system_error("Config invalid, Please Check struct and data of memcached.cfg"); 
        $this->cfg = Application::$config['memcached'];
    }

    /**
    * create a singleton instance. 
    */
    public static function get_instance() {
        if(self::$mcs==null) {
            //first time creating. From now, no instance will/can be created anymore.
            self::$mcs = new MemcachedService(); 
        }
        return self::$mcs;
    }

    public function get_memcached($servers=null) {
        $memcached = null;                
        if(count($servers)==0 || $servers==null) {
            if(isset( $this->memcached_list['default'])) {
                $memcached =  $this->memcached_list['default'];
                $this->set_log ('default', ( $this->memcached_call_log['default']) + 1);
            }else {
                $memcached =  $this->get_default_memcached();
                $this->memcached_list['default'] = $memcached;
                $this->set_log ('default', 0);
            }
        }else {            
            $key = "";
            foreach($servers as $server) {
                foreach($server as $skey => $value) {
                    $key .= "$value#";
                }
            }
            $key=substr($key, 0, -1);
            $keycode = md5($key);            
            if(isset( $this->memcached_list[$keycode])) {
                $memcached =  $this->memcached_list[$keycode];
                $this->set_log ($key, ( $this->memcached_call_log[$key]) + 1);
            }else {
                $memcached = new Memcached();
                $memcached->addServers($servers);
                $this->memcached_list[$keycode] = $memcached;
                $this->set_log ($key, 0);
            }
        }
        return $memcached;
    }

    public function force_new_memcached($params) {
        $this->force_remove_instance($params);
        return  $this->get_instance($params);
    }

    public function force_remove_memcached($params) {
        if($params==null || count($params)==0) {
            echo "param is not valid!";
        }else {
            $key = "";
            foreach($params as $skey => $value) {
                $key .= "$skey#$value&";
            }
        }
        $this->memcached_list[md5($key)]=null;
        unset( $this->memcached_list[md5($key)]);
    }

    private function get_default_memcached() {
        $memcached = new Memcached();
        $memcached->addServers($this->get_servers_config());
        $this->set_option($memcached);
        return $memcached;
    }

    private function set_log($key, $value) {
        $this->memcached_call_log[$key] = $value;
    }

    public function get_log($key) {
        return  $this->memcached_call_log[$key];
    }

    
    private function set_option(&$memcached) {
        if(isset($this->cfg['OPTIONS']['OPT_LIBKETAMA_COMPATIBLE'])){
            $memcached->setOption(Memcached::OPT_LIBKETAMA_COMPATIBLE,(boolean)$this->cfg['OPTIONS']['OPT_LIBKETAMA_COMPATIBLE']);
        }
        if(isset($this->cfg['OPTIONS']['OPT_DISTRIBUTION']))             
            $memcached->setOption(Memcached::OPT_DISTRIBUTION, $this->cfg['OPTIONS']['OPT_DISTRIBUTION']);
        if(isset($this->cfg['OPTIONS']['OPT_NO_BLOCK']))    
            $memcached->setOption(Memcached::OPT_NO_BLOCK, $this->cfg['OPTIONS']['OPT_NO_BLOCK']);
        if(isset($this->cfg['OPTIONS']['OPT_CONNECT_TIMEOUT']))                                                            
            $memcached->setOption(Memcached::OPT_CONNECT_TIMEOUT, $this->cfg['OPTIONS']['OPT_CONNECT_TIMEOUT']);
        if(isset($this->cfg['OPTIONS']['OPT_RETRY_TIMEOUT']))
            $memcached->setOption(Memcached::OPT_RETRY_TIMEOUT, $this->cfg['OPTIONS']['OPT_RETRY_TIMEOUT']);
        if(isset($this->cfg['OPTIONS']['OPT_SEND_TIMEOUT']))                
            $memcached->setOption(Memcached::OPT_SEND_TIMEOUT, $this->cfg['OPTIONS']['OPT_SEND_TIMEOUT']);
        if(isset($this->cfg['OPTIONS']['OPT_RECV_TIMEOUT']))
            $memcached->setOption(Memcached::OPT_RECV_TIMEOUT, $this->cfg['OPTIONS']['OPT_RECV_TIMEOUT']);
        if(isset($this->cfg['OPTIONS']['OPT_POLL_TIMEOUT']))
            $memcached->setOption(Memcached::OPT_POLL_TIMEOUT, $this->cfg['OPTIONS']['OPT_POLL_TIMEOUT']);
        if(isset($this->cfg['OPTIONS']['OPT_SERVER_FAILURE_LIMIT']))
            $memcached->setOption(Memcached::OPT_SERVER_FAILURE_LIMIT, $this->cfg['OPTIONS']['OPT_SERVER_FAILURE_LIMIT']);
        if(isset($this->cfg['OPTIONS']['OPT_COMPRESSION']))
            $memcached->setOption(Memcached::OPT_COMPRESSION, $this->cfg['OPTIONS']['OPT_COMPRESSION']);
        if(isset($this->cfg['OPTIONS']['OPT_TCP_NODELAY']))
            $memcached->setOption(Memcached::OPT_TCP_NODELAY, $this->cfg['OPTIONS']['OPT_TCP_NODELAY']);
    }

    private function get_servers_config() {
        if(!count($this->cfg['SERVERS'])) system_error("Config invalid, Missing key SERVERS of memcached.cfg"); 
        $str_servers = $this->cfg['SERVERS'];
        $servers = array();
        $count = 0;
        $temp_arr = explode('&', $str_servers);
        foreach($temp_arr as $item) {
            $server = explode('#', $item);
            $servers[$count] = $server;
            $count++;
        }
        return $servers;
    }
}