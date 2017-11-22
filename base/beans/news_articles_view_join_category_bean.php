<?php
class NewsArticlesViewJoinCategoryBean extends Bean {

    public $properties;

    public function __construct() {
        $this->properties = array(
            "id" =>Bean::TYPE_INTEGER,
            "title" =>Bean::TYPE_STRING,
            "intro_text" =>Bean::TYPE_STRING,
            "creat_by" =>Bean::TYPE_INTEGER,
            "modified_by" =>Bean::TYPE_INTEGER,            
            "images" =>Bean::TYPE_INTEGER,
            "create_date_int" =>Bean::TYPE_INTEGER,
            "modified_date_int" =>Bean::TYPE_INTEGER,
            "status" =>Bean::TYPE_INTEGER,
            "meta_slug" =>Bean::TYPE_STRING,
            "public" =>Bean::TYPE_INTEGER,            
            "hotnews" =>Bean::TYPE_INTEGER,
            "timer" =>Bean::TYPE_INTEGER,
            "category_id" =>Bean::TYPE_INTEGER,
            "content_type" => Bean::TYPE_STRING
        );
        $this->instantiate(get_class());
    }
}
?>