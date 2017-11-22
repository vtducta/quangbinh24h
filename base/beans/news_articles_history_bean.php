<?php
class NewsArticlesHistoryBean extends Bean {

    public $properties;

    public function __construct() {
        $this->properties = array(
            "id" =>Bean::TYPE_INTEGER,
            "article_id" =>Bean::TYPE_INTEGER,
            "title" =>Bean::TYPE_STRING,
            "images" =>Bean::TYPE_INTEGER,
            "modified_by" =>Bean::TYPE_INTEGER,
            "intro_text" =>Bean::TYPE_STRING,
            "content_text" =>Bean::TYPE_STRING,
            "create_date_int" =>Bean::TYPE_INTEGER,
            "modified_date_int" =>Bean::TYPE_INTEGER,
            "meta_slug" =>Bean::TYPE_STRING,
            "meta_title" =>Bean::TYPE_STRING,
            "meta_keywork" =>Bean::TYPE_STRING,
            "meta_description" =>Bean::TYPE_STRING,
            "status" =>Bean::TYPE_INTEGER,
            "public" =>Bean::TYPE_INTEGER,
            "timer" =>Bean::TYPE_INTEGER
        );
        $this->instantiate(get_class());
    }
}
?>