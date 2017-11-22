<?php
class NewsEventBean extends Bean {

    public $properties;

    public function __construct() {
        $this->properties = array(
            "id" =>Bean::TYPE_INTEGER,
            "title" =>Bean::TYPE_STRING,
            "status" =>Bean::TYPE_INTEGER,
            "ordering" =>Bean::TYPE_INTEGER,
            "num_article" =>Bean::TYPE_INTEGER,
            "create_date" =>Bean::TYPE_STRING,
            "create_date_int" =>Bean::TYPE_INTEGER,
            "description" =>Bean::TYPE_STRING,
            "category_id" =>Bean::TYPE_INTEGER,
            "meta_slug" =>Bean::TYPE_STRING,
            "meta_title" =>Bean::TYPE_STRING,
            "meta_description" =>Bean::TYPE_STRING,
            "meta_keywork" =>Bean::TYPE_STRING,
            "feature_home" =>Bean::TYPE_INTEGER,
            "feature_category" =>Bean::TYPE_INTEGER,
        );
        $this->instantiate(get_class());
    }
}
?>