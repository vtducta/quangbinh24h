<?php
class ArticlesRelationshipBean extends Bean {

    public $properties;

    public function __construct() {
        $this->properties = array(
            "id" =>Bean::TYPE_INTEGER,
            "articles_id" =>Bean::TYPE_INTEGER,
            "articles_id_relationship" =>Bean::TYPE_INTEGER
        );
        $this->instantiate(get_class());
    }
}
?>