<?php
class NewsArticlesCategoryViewBean extends Bean {

    public $properties;

    public function __construct() {
        $this->properties = array(
            "id" =>Bean::TYPE_INTEGER,
            "articles_id" =>Bean::TYPE_INTEGER,
            "category_id" =>Bean::TYPE_INTEGER,
            "parent_id" =>Bean::TYPE_INTEGER,
            "status" =>Bean::TYPE_INTEGER,
            "create_date_int" =>Bean::TYPE_INTEGER
        );
        $this->instantiate(get_class());
    }
}
?>