<?php
class NewsArticlesEventBean extends Bean {

    public $properties;

    public function __construct() {
        $this->properties = array(
            "id" =>Bean::TYPE_INTEGER,
            "event_id" =>Bean::TYPE_INTEGER,
            "articles_id" =>Bean::TYPE_INTEGER
        );
        $this->instantiate(get_class());
    }
}
?>