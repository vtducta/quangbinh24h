<?php
class NewsHomeLogBean extends Bean {

    public $properties;

    public function __construct() {
        $this->properties = array(
            "id" =>Bean::TYPE_INTEGER,
            "user_id" =>Bean::TYPE_INTEGER,
            "news_id" =>Bean::TYPE_INTEGER,
            "postion" =>Bean::TYPE_INTEGER,
            "action" =>Bean::TYPE_STRING,
            "create_time" =>Bean::TYPE_INTEGER
        );
        $this->instantiate(get_class());
    }
}
?>