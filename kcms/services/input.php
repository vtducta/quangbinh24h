<?php
/**    
 * Email : kph.acc@gmail.com
 * Yahoo : kph_kph@yahoo.com
 * Phone : +84902245620
 * 
 * Input filter, clean request, override value of request method                                           
 *
 * @author         $Author: kenchan ak binhlt $
 * @copyright    (c) kenchan
 * @package        K-CMS
 * @since        Tue. 06th April 2010  
 *
 */  
 
class InputService
{     
    /**
    * handler object 
    *
    * @access       private
    * @var          requestCleaner
    */  
    private $handler = null;
    
    /**
    * clean value
    *
    * @access       public
    * @var          array
    */
    public $input = array();           
    public $cookie = array();         
    public $header = array();
    
    /**
    * dirty value
    *
    * @access       public
    * @var          array
    */
    public $dirty = array();
    
    /**
    * unknown value
    *
    * @access       public
    * @var          array
    */
    public $unknown = array();
    
    /**
    * Constructor
    *
    * @access       public        
    * @return       void
    */
    public function __construct()
    {  
        /* load config */
        $cfg = Application::$config['security'];     
                                                                                   
        $blankCfg = isset($cfg['Blank']) ? $cfg['Blank'] : array();
        $invalidCfg = isset($cfg['Invalid']) ? $cfg['Blank'] : array();
        $modeCfg = isset($cfg['Mode']) ? $cfg['Mode'] : array();
        $getCfg = isset($cfg['Secure']['GET']) ? $cfg['Secure']['GET'] : array();
        $postCfg = isset($cfg['Secure']['POST']) ? $cfg['Secure']['POST'] : array();
        $bothCfg = isset($cfg['Secure']['BOTH']) ? $cfg['Secure']['BOTH'] : array(); 
        
        if(!count($blankCfg) || !count($invalidCfg) || !count($modeCfg) || !count($getCfg) || !count($postCfg) || !count($bothCfg)) system_error("Config invalid, Please Check struct and data of security.conf ");
        
        /* load handler object */
        Loader::load( PATH_LIBRARIES_CLEANER );
        $this->handler = new requestCleaner();     
        
        try
        {
            /* config value invalid */
            $this->handler->setInvalidBool($invalidCfg['Bool']);
            $this->handler->setInvalidInt($invalidCfg['Int']) ;
            $this->handler->setInvalidFloat($invalidCfg['Float']);
            
            /* config value default */
            $this->handler->setBlankBool($blankCfg['Bool']);
            $this->handler->setBlankInt($blankCfg['Int']);
            $this->handler->setBlankFloat($blankCfg['Float']);
            $this->handler->setBlankString($blankCfg['String']);   
                  
            /* config mode */
            $this->handler->setEscapeStrings($modeCfg['EscapeStrings']); 
            $this->handler->setOverwriteGET($modeCfg['OverwriteGET']); 
            $this->handler->setOverwritePOST($modeCfg['OverwritePOST']); 
            $this->handler->setOverwriteREQUEST($modeCfg['OverwriteREQUEST']); 
            $this->handler->setCreateMissing($modeCfg['CreateMissing']); 
            
            /* clean */
            $this->handler->CleanRequest($getCfg,$postCfg,$bothCfg);   
        }    
        catch(Exception $ex)
        {
            throw new Exception($ex->getMessage(),258);
        }    
        
        /* return */
        $this->input = $this->handler->clean;
        $this->dirty = $this->handler->dirty;
        $this->unknown = $this->handler->unknown;                
        $this->cookie = $this->get_all_cookies();
    }
    
    public function get_all_cookies()
    {
        $cookies = isset($_COOKIE) ? $_COOKIE : array();
        if(count($cookies))
        {
            foreach($cookies as &$cookie)
            {
                if(is_string($cookie))  
                    $cookie = stripslashes( $cookie );   
            }
        }
        return $cookies;     
    }        
}  
?>