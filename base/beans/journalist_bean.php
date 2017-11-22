<?php
class JournalistBean extends Bean {

    public $properties;

    public function __construct() {
        $this->properties = array(
            "id" =>Bean::TYPE_INTEGER,
            "full_name" =>Bean::TYPE_STRING,
            "pen_name" =>Bean::TYPE_STRING,
            "email" =>Bean::TYPE_STRING,
            "facebook" =>Bean::TYPE_STRING,
            "facebook_link" =>Bean::TYPE_STRING,
            "gplus" =>Bean::TYPE_STRING,
            "gplus_link" =>Bean::TYPE_STRING,
            "birthday" =>Bean::TYPE_STRING,
            "avatar" =>Bean::TYPE_STRING,
            "biography" =>Bean::TYPE_STRING,
            "rate" =>Bean::TYPE_INTEGER,
            "total_article" =>Bean::TYPE_INTEGER,
            "create_time" =>Bean::TYPE_INTEGER,
            "update_time" =>Bean::TYPE_INTEGER
        );
        $this->instantiate(get_class());
    }
}
?>