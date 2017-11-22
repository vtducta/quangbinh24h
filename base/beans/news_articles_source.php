<?php
class NewsArticlesSourceBean extends Bean {

    public $properties;

    public function __construct() {
        $this->properties = array(
            "id" =>Bean::TYPE_INTEGER,
            "name" =>Bean::TYPE_STRING,
            "description" =>Bean::TYPE_STRING,
        );
        $this->instantiate(get_class());
    }
}
?>