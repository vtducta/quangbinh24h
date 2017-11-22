<?php
class NewsCategoryBean extends Bean {

    public $properties;

    public function __construct() {
        $this->properties = array(
            "id" =>Bean::TYPE_INTEGER,
            "title" =>Bean::TYPE_STRING,
            "ordering" =>Bean::TYPE_INTEGER,
            "parent_id" =>Bean::TYPE_INTEGER,
            "images" =>Bean::TYPE_STRING,
            "description" =>Bean::TYPE_STRING,
            "display_style" =>Bean::TYPE_INTEGER,
            "status" =>Bean::TYPE_INTEGER,
            "meta_slug" =>Bean::TYPE_STRING,
            "meta_rss" =>Bean::TYPE_STRING,
            "meta_title" =>Bean::TYPE_STRING,
            "meta_description" =>Bean::TYPE_STRING,
            "meta_keywork" =>Bean::TYPE_STRING,
            "home_display" =>Bean::TYPE_INTEGER
        );
        $this->instantiate(get_class());
    }
}
?>