<?php 
    abstract class Model {  
        /**
        * Db class
        * 
        * @var IDatabaseDriver
        */
        protected $db;

        /**
        * memcached
        * 
        * @var Memcached
        */
        protected $memcached;

        protected $memcached_status = "";

        protected $key = "";

        /**
        * Couchbase
        * 
        * @var Couchbase
        */
        protected $cb;

        abstract protected function do_insert($data);
        abstract protected function do_update($data,$condition);
        abstract protected function do_delete($condition);      
        abstract protected function do_select($condition,$order,$offset,$limit); 

        /**
        * construct a model
        * 
        */
        public function __construct($server = null)
        {
            $this->db = Application::getSrv('database');
            $unicode = isset(Application::$config['database']['Options']['Unicode']) ? Application::$config['database']['Options']['Unicode'] : 0;
            if ($unicode){
                $this->db->query("set names utf8 collate utf8_unicode_ci");
            }
            $this->init_memcached($server);
            $couchbase_enable = isset(Application::$config['couchbase']['STATUS']) ? Application::$config['couchbase']['STATUS'] : "OFF";
            if ($couchbase_enable == "ON"){
                $this->init_couchbase($server);
            }
        }

        /**
        * init couchbase
        * 
        * @param array("Host","Username","Password","Bucket") $server
        */
        public function init_couchbase($server = null){
            $couchbase_service = Application::getSrv("couchbase");
            $this->cb = $couchbase_service->get_couchbase($server); 
        }

        /**
        * init memcached bucket or server
        * 
        * @param array(array('server',port),array('server',port),array('server',port)) $server
        */
        public function init_memcached($server){
            $memcached_service = Application::getSrv("memcached_service");
            $this->init_memcached_option();
            $this->memcached = $memcached_service->get_memcached($server);
        }

        public function init_memcached_option(){
            if(!count(Application::$config['memcached'])) system_error("Config invalid, Please Check struct and data of memcached.cfg");
            $cfg = Application::$config['memcached'];
            if (!isset($cfg['STATUS'])){
                system_error("Config invalid, Please Check struct and data of memcached.cfg");
            }
            $this->memcached_status = strtolower($cfg['STATUS']);
            if (isset($cfg['KEY'])){
                $this->key = $cfg['KEY'];
            }
            else{
                $this->key = "";
            }
        }

        /**
        * create a bean of model
        * 
        * @return Bean $bean
        */
        public function create_bean()
        {                         
            $called_class = get_class($this);            
            if($called_class === get_class()) system_error("Model cannot create bean"); 
            $bean_name = $this->gennerate_bean_name($called_class);
            if(!class_exists($bean_name)) system_error("class {$bean_name} is not defined");
            if(!is_subclass_of($bean_name,'Bean')) system_error("class {$bean_name} is not subclass of Bean");
            return new $bean_name();
        }

        /**
        * check bean is compare with model
        * 
        * @exception bean is not accept on this model
        */
        private function check_bean(Bean $bean)
        {       
            $class_bean = get_class($bean);
            $called_class = get_class($this);
            if($this->gennerate_bean_name($called_class) !== $class_bean)  system_error("class {$class_bean} is not accept on this model ({$called_class})");                                
        }

        /**
        * a rule to create bean name from model
        * 
        * @return string bean name
        */
        private function gennerate_bean_name($class_model) 
        {                     
            $regex = "/([A-Za-z0-9]+)Model/i"; 
            @preg_match_all($regex,$class_model,$matches);        
            if(isset($matches[1][0]) && trim(isset($matches[1][0])) !== '') $bean_name = "{$matches[1][0]}Bean";
            else system_error("Model Name is not accepted. it's must contain 'Model' in last string");
            return $bean_name;                           
        }                  

        /**
        * insert a bean
        * 
        * @param Bean $bean
        */
        public function insert(Bean $bean)
        { 
            $this->check_bean($bean);
            $data = $bean->to_array();

foreach($bean->properties as $key => $val )
            {
                if($bean->get_insert1($key)) continue;
                unset($data[$key]);
            } 
            if(method_exists($this,'before_insert')) $this->before_insert($data);
            try
            {
                $inserted = $this->do_insert($data);    
            }
            catch(Exception $ex)
            {
                if(method_exists($this,'on_insert_failure')) $this->on_insert_failure($data,$ex);
            }                            
            if(method_exists($this,'on_insert_success')) $this->on_insert_success($data); 
            if(method_exists($this,'after_insert')) $this->after_insert($data); 
            return $inserted;
        }            

        /**
        * update a bean with condition
        * condition struct ('key')
        * <code>
        * array(
        *   'keyname'   => value,
        *   'keyname2'  => value
        * )
        * </code>
        * 
        * @param Bean $bean
        * @param array $condition
        */
        public function update(Bean $bean,$condition)
        {     
            $this->check_bean($bean);  
            $data = $bean->to_array();

            foreach($bean->properties as $key => $val )
            {
                if($bean->get_update($key)) continue;
                unset($data[$key]);
            } 

            if(method_exists($this,'before_update')) $this->before_update($data,$condition);
            try
            {
                $updated = $this->do_update($data,$condition);
            }
            catch(Exception $ex)
            {
                if(method_exists($this,'on_update_failure')) $this->on_update_failure($data,$condition,$ex);
            }                            
            if(method_exists($this,'on_update_success')) $this->on_update_success($data,$condition); 
            if(method_exists($this,'after_update')) $this->after_update($data,$condition);
            return $updated;
        }

        /**
        * delete 
        * condition struct ('key')
        * <code>
        * array(
        *   'keyname'   => value,
        *   'keyname2'  => value
        * )
        * </code>
        * 
        * @param array $condition
        */
        public function delete($condition)
        {                                       
            if(method_exists($this,'before_delete')) $this->before_delete($condition);
            try
            {
                $deleted = $this->do_delete($condition);
            }
            catch(Exception $ex)
            {
                if(method_exists($this,'on_delete_failure')) $this->on_delete_failure($condition,$ex);
            }                            
            if(method_exists($this,'on_delete_success')) $this->on_delete_success($condition); 
            if(method_exists($this,'after_delete')) $this->after_delete($condition);
            return $deleted;                     
        }    

        /**
        * get a bean
        * 
        * condition struct ('key')
        * <code>
        * array(
        *   'keyname'   => value,
        *   'keyname2'  => value
        * )
        * </code>
        * 
        * @param array $condition
        * @return Bean
        */
        public function get_once($condition)
        {
            $bean = $this->create_bean();        
            $data = $this->do_select($condition,'',0,1);           
            $data = $this->_stripslashes($data);
            foreach($data as $key => $val)
            {
                if(isset($data[$key])){                 
                    $bean->init_from_array($val);
                    return $bean; 
                }         
            }
            return null;
        }

        /**
        * get a list of bean
        * 
        * condition struct ('key')
        * <code>
        * array(
        *   'keyname'   => value,
        *   'keyname2'  => value
        * )
        * </code>
        * 
        * @param array $condition
        * @param string $order
        * @param int $offset
        * @param int $limit
        * @return array of Bean
        */
        public function get_list($condition,$order,$offset,$limit)
        {   
            $data = $this->do_select($condition,$order,$offset,$limit);    
            $data = $this->_stripslashes($data);
            $data_bean = array();
            foreach($data as $key => $val)
            {
                if(isset($data[$key])){
                    $bean = $this->create_bean();
                    $bean->init_from_array($val); 
                    $data_bean[] = $bean; 
                }         
            }
            return $data_bean;
        }    

        private function _stripslash($string){
            $pattern = "/\\\/";
            return preg_replace($pattern,"",$string);
        }

        private function _stripslashes($arr){
            if (is_string($arr)){
                return $this->_stripslash($arr);
            }
            elseif (is_array($arr)){
                foreach($arr as $k=>$v){
                    $arr[$k] = $this->_stripslashes($v);
                }
                return $arr;
            }
            else{
                return $arr;
            }
        }


        /**
        * set value store on memcached with key
        * 
        * @param mixed $key
        * @param mixed : array,json object $value
        * @param mixed $expire
        * @return bool
        */
        public function mem_set($key,$value,$expire){
            if ($this->memcached_status == "off"){
                return true;
            }
            $time_out = time() + $expire;
            return $this->memcached->set($this->key . $key,$value,$time_out);
        }

        /**
        * get value from memcached with key
        * 
        * @param mixed $key
        */
        public function mem_get($key){
            if ($this->memcached_status == "off"){
                return false;
            }
            return $this->memcached->get($this->key . $key);
        }

        public function mem_get_result_msg(){
            return $this->memcached->getResultMessage();
        }

        /**
        * create couchbase view
        * 
        * @param String $view_name
        * @param String $design_doc
        * @param JavascriptFunction $func
        * @return true/false
        */
        protected function cb_create_view($view_name,$design_doc,$func){
            // Create document containing the map function
            $ddoc = json_encode('{"views":{"' . $view_name .
            '":{"map":"' . $func . '"}}}');

            $_ddoc = $this->cb->getDesignDoc($design_doc);
            if ($_ddoc){
                system_error("View exists");
            }
            // Create the design document on the server
            try {
                $ret = $this->cb->setDesignDoc($design_doc, json_decode($ddoc));
            }
            catch (CouchbaseException $exp) {
                print "Failed to create view: " . $exp->getMessage();
                exit();
            }
            if ($ret) {
                return true;
            } else {
                return false;
            }
        }

        /**
        * update couchbase view
        * 
        * @param String $view_name
        * @param String $design_doc
        * @param JavasriptFunction $func
        * @return true/false
        */
        protected function cb_update_view($view_name,$design_doc,$func){
            // Create document containing the map function
            $ddoc = json_encode('{"views":{"' . $view_name .
            '":{"map":"' . $func . '"}}}');

            $_ddoc = $this->cb->getDesignDoc($design_doc);
            if ($_ddoc){
                //Delete the design document:
                $ret = $this->cb->deleteDesignDoc($design_doc);
                if ($ret) {
                    // Create the design document on the server
                    try {
                        $ret = $this->cb->setDesignDoc($design_doc, json_decode($ddoc));
                    }
                    catch (CouchbaseException $exp) {
                        print "Failed to create view: " . $exp->getMessage();
                        exit();
                    }
                    if ($ret) {
                        return true;
                    } else {
                        return false;
                    }
                } else {
                    print "Failed to update view: " . $this->cb->getResultMessage() . PHP_EOL;
                    exit();
                }
            }
            else{
                // Create the design document on the server
                try {
                    $ret = $this->cb->setDesignDoc($design_doc, json_decode($ddoc));
                }
                catch (CouchbaseException $exp) {
                    print "Failed to create view: " . $exp->getMessage();
                    exit();
                }
                if ($ret) {
                    return true;
                } else {
                    return false;
                }
            }
        }

        /**
        * delete couchbase view
        * 
        * @param String $design_doc
        * @return true/false
        */
        protected function cb_delete_view($design_doc){
            // Delete the design document:
            $ret = $this->cb->deleteDesignDoc($design_doc);
            if ($ret) {
                return true;
            } else {
                return false;
            }
        }
    }   
?>