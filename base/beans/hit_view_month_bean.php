<?php
class HitViewMonthBean extends Bean {

    public $properties;

    public function __construct() {
        $this->properties = array(
            "id" =>Bean::TYPE_INTEGER,
            "m_time" =>Bean::TYPE_INTEGER,
            "news_id" =>Bean::TYPE_INTEGER,
            "total_hit" =>Bean::TYPE_INTEGER
        );
        $this->instantiate(get_class());
    }
}
?>