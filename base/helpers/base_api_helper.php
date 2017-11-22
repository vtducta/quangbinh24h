<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
 
 class BaseApiHelper extends Helper{
     public function __construct(){
         parent::__construct();
     }
 }

 
class OutPutVideo extends Authenticate{
    //put your code here
    public function __construct($config = array()) {
        if (!session_id()) {
            session_start();
          }
        parent::__construct($config);
    }

    public static function truncate($string, $limit = 100, $mode = 'char', $suffix = '...') {
        if (strlen($string) > $limit) {
            $string = htmlspecialchars_decode($string);
            $string = wordwrap($string, $limit);
            $string = substr($string, 0, strpos($string, "\n"));
            $string .= $suffix;
        }

        return $string;
    }
} 
/**
 * Description of Authenticate
 *
 * @author xaumarket
 */
class AuthException extends Exception {

    /**
     * The result from the API server that represents the exception information.
     */
    protected $result;

    /**
     * Make a new API Exception with the given result.
     *
     * @param $result
     *   The result from the API server.
     */
    public function __construct($result) {
        $this->result = $result;

        $code = isset($result['code']) ? $result['code'] : 404;

        if (isset($result['error'])) {
            // OAuth 2.0 Draft 10 style
            $message = $result['error']['message'];
        } elseif (isset($result['message'])) {
            // cURL style
            $message = $result['message'];
        } else {
            $message = 'Unknown Error. Check getResult()';
        }

        parent::__construct($message, $code);
    }

    /**
     * Return the associated result object returned by the API server.
     *
     * @returns
     *   The result from the API server.
     */
    public function getResult() {
        return $this->result;
    }

    /**
     * Returns the associated type for the error. This will default to
     * 'Exception' when a type is not available.
     *
     * @return
     *   The type for the error.
     */
    public function getType() {
        if (isset($this->result['error'])) {
            $message = $this->result['error'];
            if (is_string($message)) {
                // OAuth 2.0 Draft 10 style
                return $message;
            }
        }
        return 'Exception';
    }

    /**
     * To make debugging easier.
     *
     * @returns
     *   The string representation of the error.
     */
    public function __toString() {
        $str = $this->getType() . ': ';
        if ($this->code != 0) {
            $str .= $this->code . ': ';
        }
        return $str . $this->message;
    }

}


class Authenticate {

    //put your code here

    protected $apiId;
    protected $apiSec;
    protected $user;    
    protected $accessToken = null;
    public static $DOMAIN_MAP = array('www' => 'http://apiv2.meme.vn/');
    public static $CURL_OPTS = array(
      CURLOPT_CONNECTTIMEOUT => 100,
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_TIMEOUT        => 60,
      CURLOPT_USERAGENT      => 'meme-1.1.0',
    );
    
    protected static $keys =  array('token', 'user_id');
    
    public function __construct($config) {
        // set config
        $this->setApiId($config['apiId']);
        $this->setApiSec($config['apiSec']);
    }

    public function setApiId($apiId) {
        $this->apiId = $apiId;
        return $this;
    }

    public function getApiId() {
        return $this->apiId;
    }

    public function setApiSec($apiSec) {
        $this->apiSec = $apiSec;
        return $this;
    }

    public function getApiSec() {
        return $this->apiSec;
    }

    public function setUser($user) {
        $this->user = $user;
        return $this;
    }

    public function getUser() {
        return $this->user;
    }

    public function setAccessToken($accessToken) {
        $this->accessToken = $accessToken;
        return $this;
    }
    
    public function getAccessToken() {
        if($this->accessToken !== null)
        {
            return $this->accessToken;
        }

        $this->accessToken = $this->getPersistentData('token');
        return $this->accessToken;
    }

    public function setPersistentData($key, $value)
    {
        $_SESSION['meme_' . $key] = $value;
    }
    
    public function getPersistentData($key)
    {
        return isset($_SESSION['meme_' . $key]) ? $_SESSION['meme_' . $key] : '';
    }
    
    protected function clearAllPersistentData()
    {
        foreach(self::$keys as $k)
        {
            unset($_SESSION['meme_' . $k]);
        }
    }

    public function auth()
    {
        // check user
        $token = $this->getPersistentData('token');
        $expire = $this->getPersistentData('expire');
        if(!empty($token) && strtotime($expire) >= time()){
            return true;
        }

        $result = $this->_oauthRequest(
            $this->buidlUrl('www',
                'user/authenticate'),
            array('client_id' => $this->getApiId(),
                'client_secret' => $this->getApiSec()
            ));

        if(isset($result->token)){
            $this->setPersistentData('token', $result->token);
            $this->setPersistentData('expire', $result->expire);
            $this->setAccessToken($result->token);
            return true;
        }

        return $result;
    }

    public function api($path, $params = array()){
        $token = $this->getAccessToken();
        $url = $this->buidlUrl('www', $path, array_merge($params,array('token' => $token)));

        return $this->make_request($url);
    }
    
    protected function buidlUrl($name, $path = '', $params = array())
    {
        $url = self::$DOMAIN_MAP[$name];
        if ($path) {
          if ($path[0] === '/') {
            $path = substr($path, 1);
          }
          $url .= $path;
        }
        if ($params) {
          $url .= '?' . http_build_query($params, null, '&');
        }
//echo $url;
        return $url;
    }

    
    protected function _oauthRequest($url, $params = array())
    {
//        if(!isset($params['token'])){
//            $params['token'] = $this->getAccessToken();
//        }
     
        foreach ($params as $key => $value) {
            if (!is_string($value)) {
              $params[$key] = json_encode($value);
            }
        }

        return $this->make_request($url, $params);
    }

    protected function make_request($url, $params = array()) {
        
          $ch = curl_init();
        
          $sign = $this->stringify($params, $url);
          $signature = md5($this->HMAC('sha1', $sign, $this->getApiSec()));

          $headers = array(
              'Content-Type:application/x-www-form-urlencoded',
              'Authorization:signature=' . $signature
          );

          $opts = self::$CURL_OPTS;
          $opts[CURLOPT_POSTFIELDS] = http_build_query($params, null, '&');
          $opts[CURLOPT_URL] = $url;

          // disable the 'Expect: 100-continue' behaviour. This causes CURL to wait
          // for 2 seconds if the server does not support this header.
          curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

          curl_setopt_array($ch, $opts);
          $result = curl_exec($ch);

          // With dual stacked DNS responses, it's possible for a server to
          // have IPv6 enabled but not have IPv6 connectivity.  If this is
          // the case, curl will try IPv4 first and if that fails, then it will
          // fall back to IPv6 and the error EHOSTUNREACH is returned by the
          // operating system.
          if ($result === false && empty($opts[CURLOPT_IPRESOLVE])) {
              $matches = array();
              $regex = '/Failed to connect to ([^:].*): Network is unreachable/';
              if (preg_match($regex, curl_error($ch), $matches)) {
                if (strlen(@inet_pton($matches[1])) === 16) {
                  self::errorLog('Invalid IPv6 configuration on server, '.
                                 'Please disable or get native IPv6 on your server.');
                  self::$CURL_OPTS[CURLOPT_IPRESOLVE] = CURL_IPRESOLVE_V4;
                  curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
                  $result = curl_exec($ch);
                }
              }
          }
          //$info = curl_getinfo($ch); 
          //var_dump($result); die();
          
          if ($result === false) {
            $e = new AuthException(array(
              'error_code' => curl_errno($ch),
              'error' => array(
              'message' => curl_error($ch),
              'type' => 'CurlException',
              ),
            ));
            curl_close($ch);
            throw $e;
          }
          curl_close($ch);
          
          return json_decode($result);
    }

    protected function HMAC($function, $data, $key) {
        switch ($function) {
            case 'sha1':
                $pack = 'H40';
                break;
            default:
                return '';
        }
        if (strlen($key) > 64)
            $key = pack($pack, $function($key));
        if (strlen($key) < 64)
            $key = str_pad($key, 64, "\0");
        return(pack($pack, $function((str_repeat("\x5c", 64) ^ $key) . pack($pack, $function((str_repeat("\x36", 64) ^ $key) . $data)))));
    }

    protected function stringify($values, $url) {
        $first = (strcspn($url, '?') == strlen($url));
        foreach ($values as $parameter => $value) {
            $url .= ($first ? '?' : '&') . $parameter . '=' . $this->Encode($value);
            $first = false;
        }
        return $url;
    }

    protected function Encode($value) {
        return(is_array($value) ? $this->EncodeArray($value) : str_replace('%7E', '~', str_replace('+', ' ', rawurlencode($value))));
    }

    protected function EncodeArray($array) {
        foreach ($array as $key => $value)
            $array[$key] = $this->Encode($value);
        return $array;
    }

}

?>
