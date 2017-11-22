<?php
/**    
 * Email : kph.acc@gmail.com
 * Yahoo : kph_kph@yahoo.com
 * Phone : +84902245620
 * 
 * i try to modify base exception class with some new feathers 
 * like display, trace, and work with debug_mode ( on or off)                                           
 *
 * @author         $Author: kenchan ak binhlt $
 * @copyright    (c) kenchan
 * @package        K-CMS
 * @since        Tue. 06th April 2010  
 *
 */ 

abstract class ErrorHandler
{ 
    /**
    * Encapsulates set_error_handler() 
    *
    * @static
    * @access       public      
    * @return       void
    */
    public static function Initialize()
    {
        set_error_handler(array("ErrorHandler", "HandleError"));
        set_exception_handler(array("ErrorHandler", "HandleException"));
    }
            
    /**
    * Handler php Exception
    *
    * @static
    * @access       public    
    * @param        Exception   exception throw   
    * @return       void
    */             
    public static function HandleException(Exception $ex) {      
        $out  = "<html><head><title>K-CMS - Exception</title>";
        $out .= "<style>P,BODY{ font-family:arial,sans-serif; font-size:11px; }</style></head><body>";
        $out .= "<br><br><blockquote><b>There appears to be an error with the K-CMS system</b><br>";
        $out .= "You can try to refresh the page by clicking <a href='javascript:window.location=window.location;'>here</a>, if this does not fix";         
        $out .= "the error, you can contact the coder by clicking <a href='mailto:kph.acc@gmail.com?subject=K-CMS error'>here</a>"; 
        $out .= "<br /><br /><br /><b>Error Code : {$ex->getCode()}</b><br /><br />";
        $out .= "<b>Error Message : {$ex->getMessage()} </b><br /><br />";
        $out .= "<b>Error Traces : </b><br />";                              
        $out .= "<form><textarea cols='80' rows='20'>{$ex->getTraceAsString()}</textarea></form>";       
        $out .= " <br>I apologise for any inconvenience</blockquote></body></html>"; 
        
        if(!CFG_DEBUG)
        {
            error_log($out);
        }
        else{
            print $out;
        }
        
        
        
    }

    /**
    * Handler php Error
    *
    * @static
    * @access       public    
    * @param        int         exception code     
    * @param        string      exception message            
    * @param        string      file path
    * @param        int         error line         
    * @exception    Exceptionx 
    * @return       void
    */
    public static function HandleError($errno, $errstr, $errfile, $errline)  
    {                            
        switch ($errno) 
        {
            case E_NOTICE:  
            case E_USER_NOTICE:    
                //throw new Exception($errstr, 1024); 
                break;
            case E_WARNING:
            case E_USER_WARNING:    
                //throw new Exception($errstr, 1025); 
                break;
            case E_ERROR:
            case E_USER_ERROR:   
                throw new Exception($errstr, 1027);
                break;
            default:                
                throw new Exception($errstr, 1026); 
                break;
        }      
    }       
} 
?>