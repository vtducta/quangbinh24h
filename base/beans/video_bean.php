<?php
class VideoBean extends Bean {

    public $properties;

    public function __construct() {
        $this->properties = array(
            "id" =>Bean::TYPE_INTEGER,
            "title" =>Bean::TYPE_STRING,
            "images" =>Bean::TYPE_INTEGER,
            "link" =>Bean::TYPE_STRING,
            "create_date_int" =>Bean::TYPE_INTEGER
        );
        $this->instantiate(get_class());
    }
}
?>