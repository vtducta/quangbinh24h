<?php
class NewsTagJoinArticlesTagBean extends Bean {

    public $properties;

    public function __construct() {
        $this->properties = array(
            "id" =>Bean::TYPE_INTEGER,
            "tag_name" =>Bean::TYPE_STRING,
            "tag_md5" =>Bean::TYPE_STRING,
            "hits" =>Bean::TYPE_INTEGER,
            "tag_name2" =>Bean::TYPE_STRING,
            "articles_id" =>Bean::TYPE_INTEGER,
            "tag_id" =>Bean::TYPE_INTEGER,
            "slug_name" =>Bean::TYPE_STRING,
            "meta_title" =>Bean::TYPE_STRING,
            "meta_keyword" =>Bean::TYPE_STRING,
            "meta_description" =>Bean::TYPE_STRING,
            "meta_description" =>Bean::TYPE_STRING,
            "status" =>Bean::TYPE_INTEGER,
        );
        $this->instantiate(get_class());
    }
}
?>