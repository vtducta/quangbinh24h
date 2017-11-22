<?php           
abstract class Bean {

    const TYPE_INTEGER = 'integer';
    const TYPE_STRING  = 'string';
    const TYPE_FLOAT   = 'float';

    const SOURCE_URL = 'url';
    const SOURCE_FILE = 'file';
    const SOURCE_XML = 'xml';
    const SOURCE_STRING = 'string';

    private $data;      
    private $bean;
    private $update;
private $insert1 ;
    
    /**
    * init bean with bean name
    * 
    * @param string $bean
    */
    public function instantiate($bean)
    {

        if(count($this->properties))
        {
            foreach($this->properties as $key => $val)
            {                                                              
                ($val == Bean::TYPE_STRING) ? $this->data[$key] = '' : ($val == Bean::TYPE_INTEGER ) ? $this->data[$key] = 0 : (Bean::TYPE_FLOAT) ? $this->data[$key] = 0.0 : $this->data[$key] = null;
            }
        }
//var_dump($this->data);
        $this->bean = $bean;
        $this->update = array();
	 $this->insert1 = array();
    }

    public function __set($key ,$value )
    { 
        $this->set($key,$value);
    }

    public function __get($key)
    {
        return $this->get($key);
    }

    /**
    * set value to key
    * 
    * @param string $key
    * @param mixed $value
    */
    public function set($key ,$value )
    {
        $this->update[$key] = 1;
	 $this->insert1[$key] = 1;
        if(!isset($this->properties[$key])) return false;                              
        $type = $this->properties[$key];               
        if (empty($value)){
            if($type == Bean::TYPE_INTEGER ) $value = 0;
            if($type == Bean::TYPE_FLOAT ) $value = 0;
            if($type == Bean::TYPE_STRING ){ ($value === 0 || $value === "0") ? $value = "0" : $value = "";} 
        }
        if($type == Bean::TYPE_INTEGER ) ( is_numeric($value)? intval($value)==$value : false ) ? $this->data[$key] = intval($value) : system_error("'{$this->bean}' cannot set '{$value}'  for property '{$key}' ( Type : {$this->properties[$key]})") ;
        if($type == Bean::TYPE_FLOAT ) is_numeric($value) ? $this->data[$key] = $value : system_error("'{$this->bean}' cannot set '{$value}'  for property '{$key}' ( Type : {$this->properties[$key]})") ;
        if($type == Bean::TYPE_STRING )  is_string($value) ?  $this->data[$key] = $value : $this->data[$key] = settype($value,Bean::TYPE_STRING);
    }

    public function get_update($key)
    {
        if(isset($this->update[$key]) && $this->update[$key] == 1) return 1;
        else return 0;
    }

public function get_insert1($key)
    {
        if(isset($this->insert1[$key]) && $this->insert1[$key] == 1) return 1;
        else return 0;
    }
    
    /**
    * get value from key
    * 
    * @param mixed $key
    * @return mixed 
    */
    public function get($key)
    {
        $result = null;
        if(!isset($this->properties[$key]))system_error("'{$key}' property of '{$this->bean}' is not define") ;
        (isset($this->data[$key])) ? $result = $this->data[$key] : $result = null;
        return $result;
    }

    /**
    * convert a bean to array
    * 
    * @return array
    */
    public function to_array()
    {
//var_dump($this->data);die();
        return $this->data;
    }

    /**
    * convert a bean to xml
    * 
    * @return xml
    */
    public function to_xml()
    {
        $xml_string = "";
        if(count($this->data))
        {
            $xml_string = "<{$this->bean}>";
            foreach($this->data as $key => $val)
            {
                $xml_string .= "<{$key}>{$val}</{$key}>";
            }
            $xml_string .= "</{$this->bean}>";                
        }                    
        return $xml_string;
    }

    /**
    * convert a bean to json
    * 
    * @return json
    */
    public function to_json()
    {
        $json_string = "";
        if(count($this->data))
        {
            $json_string = '{"'.$this->bean.'":[{';
            foreach($this->data as $key => $val)
            {
                $json_string .= '"'.$key.'":"'.$val.'",';
            }
            $json_string .= '}]}';                
        }                    
        return $json_string;          
    }

    /**
    * convert a bean to html raw
    * 
    * @return string html
    */
    public function to_html_raw()
    {
        $html = "";
        if(count($this->data))
        {
            $html = "<tr>";
            foreach($this->data as $key => $val)
            {
                $html .= "<td>".$val."</td>"; 
            }            
            $html .= "</tr>";
        }
        return $html;   
    }

    /**
    * init bean from array
    * 
    * @param array $array
    */
    public function init_from_array($array)
    {   
        foreach($array as $key => $val)
        {                                 
            $this->set($key,$val);
        }
    }
    
    /**
    * init bean from xml
    * 
    * @param xml $xml
    * @param string $from
    */
    public function init_from_xml($xml, $from = Bean::SOURCE_STRING)
    {
        if($from == Bean::SOURCE_URL || $from == Bean::SOURCE_FILE)
        {
            $xdom = @simplexml_load_file($xml);
        }
        if($from == Bean::SOURCE_STRING)
        {
            $xdom = @simplexml_load_string($xml);
        }

        foreach($xdom as $key => $val)
        {
            $this->set($key,$val);                
        } 
    }

    /**
    * init bean from json
    * 
    * @param json $json
    * @param string $from
    */
    public function init_from_json($json, $from = Bean::SOURCE_STRING)
    {
        if($from == Bean::SOURCE_STRING)
        {
            $array = @json_decode($json,true);
        }

        if($from == Bean::SOURCE_FILE || Bean::SOURCE_URL)
        {
            $js_array = @file_get_contents($json);
            $array = @json_decode($js_array,true);
        }

        if(isset($value[0]) && count($value[0])) 
        {
            foreach($value[0] as $key => $val)
            {
                $this->set($key,$val);                 
            }
        }                                      
    }
}
?>