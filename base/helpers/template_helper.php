<?php
    class TemplateHelper extends ATemplateHelper
    {    
        public function __construct()
        {
            parent::__construct();
        }
        public function conver_time_to_seconds($time){
            $time = explode(":",$time);
            $minutes = $time[0]*60;
            return $minutes+$time[1];
        }
        public function convert_time_to_string($timer) {                
            $now = time();
            $time = $now - $timer;
            if($time > 365*24*3600)
            {
                return round($time / (365 * 3600 * 24)) . " năm trước";
            }
            elseif ($time > 24 * 3600 * 30){
                return round($time / (24 * 3600 * 30)) . " tháng trước";
            }
            elseif ($time > 3600*24) {
                return round($time / (3600*24)) . " ngày trước";
            }
            elseif ($time > 3600) {
                return round($time / 3600) . " giờ trước";
            } 
            else {
                return round($time / 60) . " phút trước";
            } 
        }
        public function _checksum($key, $send_time)
        {    
            $passed = true;
            $date = new DateTime();
            $date->setTimezone(new DateTimeZone('GMT'));            
            $server_time_now = strtotime($date->format('Y-m-d H:i:s'));
            $time_span = $send_time - intval($server_time_now);
            if(($time_span / 100 / 60) > 10) {
                $passed = false;
            }
            $sum = md5($send_time . "9555661ae7e5310cd6e910a5a7d57e6c");
            if($sum != $key) {
                $passed = false;
            }
            return $passed;       
        }    
        public function displayAlert()
        {
            if(isset($_SESSION['msg'])) {             
                $data ="<div class=\"alert alert-success\">
                <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>                                
                {$_SESSION['msg']}
                </div>";
            }elseif(isset($_SESSION['error'])) {          
                $data ="
                <div class=\"alert alert-error\">
                <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
                <strong>{$_SESSION['error']}</strong>
                </div>
                ";
            }elseif(isset($_SESSION['info'])){             
                $data ="
                <div class=\"alert alert-info\">
                <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
                <strong>{$_SESSION['info']}</strong>
                </div>
                ";
            }else $data = null; 
            return $data;
        }
        public function get_thumb_image($image,$w,$h)
        {        
            if($w<=0)
            {
                $w = 200;
            }
            if($h<=0)
            {
                $h = 200;
            }
            if(!$image)
            {
                return '';
            }
            $pattern = "media.quangbinh24h.com/";        
            $replace = "media.quangbinh24h.com/thumb_x{$w}x{$h}/";        
            $link_thumb = str_replace($pattern,$replace,$image);
            return $link_thumb;
        }
        public function autofix_html($str)
        {
            $config = array(
            'indent' => TRUE,
            'output-xhtml' => FALSE,
            'wrap' => 500,
            "show-body-only" => true);            
         //   $tidy = tidy_parse_string($str,$config,'UTF8');
          //  tidy_clean_repair($tidy); 
         //   $str = $tidy->value;

            return $str;     
        }
        public function get_thumb($image,$w,$h)
        {
            $domain = Application::$config['global']['Server']['domain'];
            $pos = strpos($image, $domain.'/'); 
            $thumb_domain = Application::$config['global']['URL']['THUMB'];
            $wh_param = "";
            if ($w ==0 && $h == 0){

            }
            elseif ($w ==0){
                $wh_param = "&h={$h}";
            }
            elseif($h == 0){
                $wh_param = "&w={$w}";
            }
            else{
                $wh_param = "&w={$w}&h={$h}";
            }

            if($pos !== false)
            {
                preg_match("/^http:\/\/{$domain}\/(.*)/i",$image, $matches); 
                if(isset($matches[1]))
                {
                    $img = $matches[1];
                    $pattern = "{$thumb_domain}thumb/{$img}{$wh_param}";     
                }  
                else
                {
                    $pattern = "{$thumb_domain}thumb.php?src={$image}{$wh_param}";    
                }
            }
            else
            {   
                $pattern = "{$thumb_domain}thumb.php?src={$image}{$wh_param}";     
            }            
            return $pattern;
        }
        public function remove_accent($str)
        {
            $a = array("à","á","ạ","ả","ã","â","ầ","ấ","ậ","ẩ","ẫ","ă",
            "ằ","ắ","ặ","ẳ","ẵ","è","é","ẹ","ẻ","ẽ","ê","ề",
            "ế","ệ","ể","ễ",
            "ì","í","ị","ỉ","ĩ",
            "ò","ó","ọ","ỏ","õ","ô","ồ","ố","ộ","ổ","ỗ","ơ",
            "ờ","ớ","ợ","ở","ỡ",
            "ù","ú","ụ","ủ","ũ","ư","ừ","ứ","ự","ử","ữ",
            "ỳ","ý","ỵ","ỷ","ỹ",".","..","...","....",
            "đ",",","'","*","(",")",
            "À","Á","Ạ","Ả","Ã","Â","Ầ","Ấ","Ậ","Ẩ","Ẫ","Ă",
            "Ằ","Ắ","Ặ","Ẳ","Ẵ",
            "È","É","Ẹ","Ẻ","Ẽ","Ê","Ề","Ế","Ệ","Ể","Ễ",
            "Ì","Í","Ị","Ỉ","Ĩ",
            "Ò","Ó","Ọ","Ỏ","Õ","Ô","Ồ","Ố","Ộ","Ổ","Ỗ","Ơ","Ờ","Ớ","Ợ","Ở","Ỡ",
            "Ù","Ú","Ụ","Ủ","Ũ","Ư","Ừ","Ứ","Ự","Ử","Ữ",
            "Ỳ","Ý","Ỵ","Ỷ","Ỹ",
            "Đ",
            " ","`","~","!","@","#","$","%","^","&","*","(",")","_","+","=",
            "{","}","[","]",":",";","'","<",">","?",",","/","|","\\","\"",
            "\xC2\xAB","\xC2\xBB","\xE2\x80\x98","\xE2\x80\x99","\xE2\x80\x9A","\xE2\x80\x9B","\xE2\x80\x9C","\xE2\x80\x9D","\xE2\x80\x9E","\xE2\x80\x9F","\xE2\x80\xB9","\xE2\x80\xBA",
            chr(130),chr(132),chr(133),chr(145),chr(146),chr(147),chr(148)
            );
            $b = array("a","a","a","a","a","a","a","a","a","a","a",
            "a","a","a","a","a","a",
            "e","e","e","e","e","e","e","e","e","e","e",
            "i","i","i","i","i",
            "o","o","o","o","o","o","o","o","o","o","o","o",
            "o","o","o","o","o",
            "u","u","u","u","u","u","u","u","u","u","u",
            "y","y","y","y","y","","","","",
            "d","","","","","",
            "A","A","A","A","A","A","A","A","A","A","A","A",
            "A","A","A","A","A",
            "E","E","E","E","E","E","E","E","E","E","E",
            "I","I","I","I","I",
            "O","O","O","O","O","O","O","O","O","O","O","O","O","O","O","O","O",
            "U","U","U","U","U","U","U","U","U","U","U",
            "Y","Y","Y","Y","Y",
            "D",
            " ","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","",
            "","","","","","","","","","","","",
            "","","","","","",""
            );
            return str_replace($a, $b, $str);
        } 

        public function xss_clean($data)
        {
            // Fix &entity\n;
            $data = str_replace(array('&amp;','&lt;','&gt;'), array('&amp;amp;','&amp;lt;','&amp;gt;'), $data);
            $data = preg_replace('/(&#*\w+)[\x00-\x20]+;/u', '$1;', $data);
            $data = preg_replace('/(&#x*[0-9A-F]+);*/iu', '$1;', $data);
            $data = html_entity_decode($data, ENT_COMPAT, 'UTF-8');

            // Remove any attribute starting with "on" or xmlns
            $data = preg_replace('#(<.+?[\x00-\x20\"\'])(?:on|xmlns)[^>]*+>#iu', '$1>', $data);

            // Remove javascript: and vbscript: protocols
            $data = preg_replace('#([a-z]*)[\x00-\x20]*=[\x00-\x20]*([`\'"]*)[\x00-\x20]*j[\x00-\x20]*a[\x00-\x20]*v[\x00-\x20]*a[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iu', '$1=$2nojavascript...', $data);
            $data = preg_replace('#([a-z]*)[\x00-\x20]*=([\'"]*)[\x00-\x20]*v[\x00-\x20]*b[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iu', '$1=$2novbscript...', $data);
            $data = preg_replace('#([a-z]*)[\x00-\x20]*=([\'"]*)[\x00-\x20]*-moz-binding[\x00-\x20]*:#u', '$1=$2nomozbinding...', $data);

            // Only works in IE: <span style="width: expression(alert('Ping!'));"></span>
            $data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?expression[\x00-\x20]*\([^>]*+>#i', '$1>', $data);
            $data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?behaviour[\x00-\x20]*\([^>]*+>#i', '$1>', $data);
            $data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:*[^>]*+>#iu', '$1>', $data);

            // Remove namespaced elements (we do not need them)
            $data = preg_replace('#</*\w+:\w[^>]*+>#i', '', $data);

            do
            {
                // Remove really unwanted tags
                $old_data = $data;
                $data = preg_replace('#</*(?:applet|b(?:ase|gsound|link)|embed|frame(?:set)?|i(?:frame|layer)|l(?:ayer|ink)|meta|object|tyle)|title|xml)[^>]*+>#i', '', $data);
            }
            while ($old_data !== $data);

            // we are done...
            return $data;
        }
        public function stripslashes_deep($value)
        {
            if (is_array($value)) {
                $value = array_map(array($this, 'stripslashes_deep'), $value);
            }
            else {
                $string = implode("",explode("\\",$value));
                $value = stripslashes(trim($string));
            }

            return $value;
        }
    }

?>
