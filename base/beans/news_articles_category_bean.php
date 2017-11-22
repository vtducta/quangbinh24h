<?php
class NewsArticlesCategoryBean extends Bean {

    public $properties;

    public function __construct() {
        $this->properties = array(
            "id" =>Bean::TYPE_INTEGER,
            "category_id" =>Bean::TYPE_INTEGER,
            "articles_id" =>Bean::TYPE_INTEGER,
            "create_date_int" =>Bean::TYPE_INTEGER,
            "creat_time" =>Bean::TYPE_STRING
        );
        $this->instantiate(get_class());
    }
}
?>