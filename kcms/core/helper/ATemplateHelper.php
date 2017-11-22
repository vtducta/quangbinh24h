<?php
abstract class ATemplateHelper extends Helper           
{
    /**
    * const character set
    */
    const CHARSET = 'UTF-8';
    
    /**
    * constructor
    * 
    */
    public function __construct()
    {
        parent::__construct();
    }
    
    /**
    * remove accent
    * 
    * @param string $str
    * @return string
    */
    public function remove_accent($str)
    {
        $a = array("à","á","ạ","ả","ã","â","ầ","ấ","ậ","ẩ","ẫ","ă","ằ","ắ","ặ","ẳ","ẵ","è","é","ẹ","ẻ","ẽ","ê","ề","ế","ệ","ể","ễ","ì","í","ị","ỉ","ĩ","ò","ó","ọ","ỏ","õ","ô","ồ","ố","ộ","ổ","ỗ","ơ","ờ","ớ","ợ","ở","ỡ","ù","ú","ụ","ủ","ũ","ư","ừ","ứ","ự","ử","ữ","ỳ","ý","ỵ","ỷ","ỹ",".","..","...","....","đ",",","'","*","(",")","À","Á","Ạ","Ả","Ã","Â","Ầ","Ấ","Ậ","Ẩ","Ẫ","Ă","Ằ","Ắ","Ặ","Ẳ","Ẵ","È","É","Ẹ","Ẻ","Ẽ","Ê","Ề","Ế","Ệ","Ể","Ễ","Ì","Í","Ị","Ỉ","Ĩ","Ò","Ó","Ọ","Ỏ","Õ","Ô","Ồ","Ố","Ộ","Ổ","Ỗ","Ơ","Ờ","Ớ","Ợ","Ở","Ỡ","Ù","Ú","Ụ","Ủ","Ũ","Ư","Ừ","Ứ","Ự","Ử","Ữ","Ỳ","Ý","Ỵ","Ỷ","Ỹ","Đ"," ","`","~","!","@","#","$","%","^","&","*","(",")","_","+","=","{","}","[","]",":",";","'","<",">","?",",","/","|","\\","\"","\xC2\xAB","\xC2\xBB","\xE2\x80\x98","\xE2\x80\x99","\xE2\x80\x9A","\xE2\x80\x9B","\xE2\x80\x9C","\xE2\x80\x9D","\xE2\x80\x9E","\xE2\x80\x9F","\xE2\x80\xB9","\xE2\x80\xBA",chr(130),chr(132),chr(133),chr(145),chr(146),chr(147),chr(148));                    
        $b = array("a","a","a","a","a","a","a","a","a","a","a","a","a","a","a","a","a","e","e","e","e","e","e","e","e","e","e","e","i","i","i","i","i","o","o","o","o","o","o","o","o","o","o","o","o","o","o","o","o","o","u","u","u","u","u","u","u","u","u","u","u","y","y","y","y","y","","","","","d","","","","","","A","A","A","A","A","A","A","A","A","A","A","A","A","A","A","A","A","E","E","E","E","E","E","E","E","E","E","E","I","I","I","I","I","O","O","O","O","O","O","O","O","O","O","O","O","O","O","O","O","O","U","U","U","U","U","U","U","U","U","U","U","Y","Y","Y","Y","Y","D"," ","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","");
        return trim(str_replace($a, $b, $str));
    }

    /**
    * build slugname for url
    * 
    * @param string $str
    * @return string
    */
    public function build_slug($str)
    {
        return strtolower(preg_replace(array('/[^a-zA-Z0-9 -]/', '/[ -]+/', '/^-|-$/','/[ ]+/'),array('', '-', '','-'), $this->remove_accent($str)));
    }

    /**
    * remove html 
    * 
    * @param string $str
    * @param string $allow_tags
    * @return string
    */
    public function remove_html($str,$allow_tags='')
    {
        return strip_tags($str,$allow_tags);
    }

    /**
    * encode html special character
    * 
    * @param string $str
    * @return string
    */
    public function html_specialchars($str)
    {
        return htmlspecialchars($str);
    }

    /**
    * truncate string
    * 
    * @param string $string
    * @param int $length
    * @param string $etc
    * @param bool $mb
    * @return string
    */
    public function truncate_char($string,$length,$etc="...",$mb=true)
    {
        $string = $this->remove_html($string);
        if ($length == 0)
            return '';
        if($mb) 
        {
            if (mb_strlen($string, ATemplateHelper::CHARSET  ) > $length) {
                $length -= min($length, mb_strlen($etc, ATemplateHelper::CHARSET ));
                $string = preg_replace('/\s+?(\S+)?$/u',  '', mb_substr($string, 0, $length + 1, ATemplateHelper::CHARSET));                  
            }
            return $string;
        }   
        else
        {
            if (isset($string[$length])) {
                $length -= min($length, strlen($etc));  
                $string = preg_replace('/\s+?(\S+)?$/', '', substr($string, 0, $length + 1));                  
            }
            return $string;
        }        
    }         
    /**
    * validate email
    * 
    * @param String $email
    * @returns true/flase
    */
    public function validate_email($email){
        return preg_match('/^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/',$email);
    }
}  
?>