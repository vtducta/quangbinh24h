<?php
class HitViewBean extends Bean {

    public $properties;

    public function __construct() {
        $this->properties = array(
            "id" =>Bean::TYPE_INTEGER,
            "time" =>Bean::TYPE_INTEGER,
            "h_time" =>Bean::TYPE_INTEGER,
            "d_time" =>Bean::TYPE_INTEGER,
            "w_time" =>Bean::TYPE_INTEGER,
            "m_time" =>Bean::TYPE_INTEGER,
            "y_time" =>Bean::TYPE_INTEGER,
            "news_id" =>Bean::TYPE_INTEGER,
            "hit_view" =>Bean::TYPE_INTEGER,
            "IP" =>Bean::TYPE_STRING,
            "User-Agent" =>Bean::TYPE_STRING
        );
        $this->instantiate(get_class());
    }
}
?>