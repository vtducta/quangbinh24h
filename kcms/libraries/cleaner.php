<?php     
/**    
 * Email : kph.acc@gmail.com
 * Yahoo : kph_kph@yahoo.com
 * Phone : +84902245620
 * 
 * Request cleanner                                           
 *
 * @author         $Author: kenchan ak binhlt $
 * @copyright    (c) kenchan
 * @package        K-CMS
 * @since        Tue. 06th April 2010  
 *
 */  
 

define('RC_STRINGS_NONE', 0);
define('RC_STRINGS_SIMPLE', 1);
define('RC_STRINGS_MYSQL', 2);
define('RC_STRINGS_HTML', 3);

class requestCleaner 
{      
    public $dirty = array();
    public $clean = array();
    public $unknown = array();
    public $defaults = array(
        'blankBool' => false,
        'invalidBool' => false,  // ie non-numeric
        'blankInt' => 0,
        'invalidInt' => 0,
        'blankFloat' => 0.0,
        'invalidFloat' => 0.0,
        'blankString' => '',
        'blankArray' => array());
        
    public $config = array(
      'escapeStrings' => RC_STRINGS_SIMPLE,
        'removeUnknown' => true,
        'overwriteGET' => true,
        'overwritePOST' => true,
        'overwriteREQUEST' => true,
        'createMissing' => true
        ); //GET POST REQUEST
        
    public function isUnknown() {
        if(count($this->unknown)>0) return true;
        else return false;
    }
    
    public function setInvalidBool($var) {
        $this->defaults['invalidBool']=$var;
        return true;
    }
    public function setInvalidInt($var) {
        $this->defaults['invalidInt']=$var;
        return true;
    }
    public function setInvalidFloat($var) {
        $this->defaults['invalidFloat']=$var;
        return true;
    }
    public function setBlankBool($var) {
        $this->defaults['blankBool']=$var;
        return true;
    }
    public function setBlankInt($var) {
        $this->defaults['blankInt']=$var;
        return true;
    }
    public function setBlankFloat($var) {
        $this->defaults['blankFloat']=$var;
        return true;
    }
    public function setBlankString($var) {
        $this->defaults['blankString']=$var;
        return true;
    }
    public function setBlankArray($var) {
        $this->defaults['blankArray']=$var;
        return true;
    }

    public function getInvalidBool() {
        return $this->defaults['invalidBool'];
    }
    public function getInvalidInt() {
        return $this->defaults['invalidInt'];
    }
    public function getInvalidFloat() {
        return $this->defaults['invalidFloat'];
    }
    public function getBlankBool() {
        return $this->defaults['blankBool'];
    }
    public function getBlankInt() {
        return $this->defaults['blankInt'];
    }
    public function getBlankFloat() {
        return $this->defaults['blankFloat'];
    }
    public function getBlankString() {
        return $this->defaults['blankString'];
    }
    public function getBlankArray() {
        return $this->defaults['blankArray'];
    }
        
    public function setEscapeStrings($var) {
        $this->config['escapeStrings']=$var;
        return true;
    }
    public function setRemoveUnknown($var) {
        if($var) $this->config['removeUnknown']=true;
        else $this->config['removeUnknown']=false;
        return true;
    }
    public function setOverwriteGET($var) {
        if($var) $this->config['overwriteGET']=true;
        else $this->config['overwriteGET']=false;
        return true;
    }
    public function setOverwritePOST($var) {
        if($var) $this->config['overwritePOST']=true;
        else $this->config['overwritePOST']=false;
        return true;
    }
    public function setOverwriteREQUEST($var) {
        if($var) $this->config['overwriteREQUEST']=true;
        else $this->config['overwriteREQUEST']=false;
        return true;
    }
    public function setCreateMissing($var) { 
        if($var) $this->config['createMissing']=true;
        else $this->config['createMissing']=false;
        return true;
    }

    public function getEscapeStrings() {
        return $this->config['escapeStrings'];
    }
    public function getRemoveUnknown() {
        return $this->config['removeUnknown'];
    }
    public function getOverwriteGET() {
        return $this->config['overwriteGET'];
    }
    public function getOverwritePOST() {
        return $this->config['overwritePOST'];
    }
    public function getOverwriteREQUEST() {
        return $this->config['overwriteREQUEST'];
    }
    public function getCreateMissing() {
        return $this->config['createMissing'];
    }
    
    public function CleanRequest($varsGET=array(), $varsPOST=array(), $varsBOTH=array()) {
        $overwrite=false;
        
        if($this->config['overwriteGET'] || $this->config['overwritePOST'] || $this->config['overwriteREQUEST']) $overwrite = true;
     
        $dirty = array_merge($_GET,$_POST,$_REQUEST);
        $vars = array_merge($varsGET,$varsPOST,$varsBOTH);
        
        foreach($_COOKIE as $key => $value) {
            if(isset($dirty[$key])) {
                unset($dirty[$key]);
            }
        }                
        list($this->clean, $this->dirty, $this->unknown) = $this->_Cleaner($vars, $dirty);
        if($this->config['createMissing']) {
            foreach($vars as $key => $val) {
                if(!isset($this->clean[$key])) {
                    switch($val) {
                        case 'boolean':
                        case 'bool':
                            $this->clean[$key] = $this->defaults['blankBool'];
                            break;
                        case 'integer':
                        case 'int':
                            $this->clean[$key] = $this->defaults['blankInt'];
                            break;
                        case 'float':
                        case 'double':
                            $this->clean[$key] = $this->defaults['blankFloat'];
                            break;
                        case 'string':
                            $this->clean[$key] = $this->defaults['blankString'];
                            break;
                        case 'array':      
                            $this->clean[$key] = $this->defaults['blankArray'];
                            break;
                        default:
                            //Error
                            break;
                    }
                }
            }
        }
        
        if($overwrite) {
            if($_SERVER['REQUEST_METHOD'] == 'GET' && $this->config['overwriteGET']) $_GET = $this->clean;
            elseif($_SERVER['REQUEST_METHOD'] == 'POST' && $this->config['overwritePOST']) $_POST = $this->clean;
            if($this->config['overwriteREQUEST']) $_REQUEST = $this->clean;
        }                      
        return $this->clean;
    }

    public function _EscapeString($str, $method = false) {
        if(!$method) $method = $this->config['escapeStrings'];
        if($method == RC_STRINGS_SIMPLE) return addslashes((string) $str);
        elseif($method == RC_STRINGS_MYSQL) return addslashes($str);
        elseif($method == RC_STRINGS_HTML) return htmlspecialchars((string) $str, ENT_QUOTES);
        else return trim((string) $str);
    }

    public function _Cleaner($vars=array(), $dirty = array()) {     
        //Declare Variables
        $clean = array();
        $unknown = array();
        $sw = '';
        $var = false;
        $star = false;
        $result = false;
        
        if(!is_array($dirty)) return false;
        
        foreach($dirty as $key => $val) {        
            $star = false;
            if(isset($vars[$key])) $var = $vars[$key];
            elseif(isset($vars['*'])) {   
                $var = $vars['*'];
                $star = true;     
            } else $var = false;
            
            if($var !== false) { // Process Known Dirty var          
                if(is_array($var)) $sw= 'array';
                else $sw = $var;
                
                switch($sw) {
                    case 'boolean':
                    case 'bool':
                        if(is_string($val)) {
                            if($val === '') {  // Set to default blank boolean value
                                $clean[$key] = $this->defaults['blankBool'];
                            } else {
                                if(strval($val) == strval((int)($val)) || strval($val) == strval((float)($val))) {
                                    $clean[$key] = (bool) $val;
                                } else {
                                    $clean[$key] = $this->defaults['invalidBool'];
                                }
                            }
                        } else {
                            $clean[$key] = (bool) $val;
                        }

                        break;
                    case 'integer':
                    case 'int':
                        if(is_string($val)) {
                            if($val === '') { 
                                $clean[$key] = $this->defaults['blankInt'];
                            } else {
                                if(strval($val) == strval((int)($val))) {
                                    $clean[$key] = (int) $val;
                                } else {
                                    $clean[$key] = $this->defaults['invalidInt'];
                                }
                            }
                        } else {
                            $clean[$key] = (int) $val;
                        }
                        break;
                    case 'float':
                    case 'double':
                        if(is_string($val)) {
                            if($val === '') { 
                                $clean[$key] = $this->defaults['blankFloat'];
                            } else {
                                if(strval($val) == strval((float)($val))) {
                                    $clean[$key] = (float) $val;
                                } else {
                                    $clean[$key] = $this->defaults['invalidFloat'];
                                }
                            }
                        } else {
                            $clean[$key] = (float) $val;
                        }
                        break;
                    case 'string':
                        if($val === '') { 
                            $clean[$key] = $this->defaults['blankString'];
                        } else {
                            $clean[$key] = $this->_EscapeString($val);
                        }
                        break;
                    case 'array':      
                        if($star) {        
                            $results = $this->_Cleaner($vars['*'], $val);
                        } else {               
                            $results = $this->_Cleaner($vars[$key], $val);                             
                        }
                        
                        if($results !== false) {
                            if(!empty($results[0])) $clean[$key] = $results[0];
                            if(!empty($results[1])) $dirty[$key] = $results[1];
                            if(!empty($results[2])) $unknown[$key] = $results[2];
                        } else {
                            $unknown[$key] = $val;
                        }
                        break;
                    default:
                        //Error
                        break;
                }
            } else { // Process Unknown Dirty var
                $unknown[$key] = $val;
            }
        }
        
        if($this->config['removeUnknown']) {
            foreach($unknown as $key => $val) {
                if(isset($dirty[$key])) {
                    unset($dirty[$key]);
                }
            }
        }

        return array(0 => $clean, 1 => $dirty, 2 => $unknown);
    }
}
?>