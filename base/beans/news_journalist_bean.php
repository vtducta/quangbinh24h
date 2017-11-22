<?php
class NewsJournalistBean extends Bean {

    public $properties;

    public function __construct() {
        $this->properties = array(
            "id" =>Bean::TYPE_INTEGER,
            "news_id" =>Bean::TYPE_INTEGER,
            "journalist_id" =>Bean::TYPE_INTEGER
        );
        $this->instantiate(get_class());
    }
}
?>