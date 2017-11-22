<?php
class TmGroupsCatBean extends Bean {

    public $properties;

    public function __construct() {
        $this->properties = array(
            "id" =>Bean::TYPE_INTEGER,
            "user_id" =>Bean::TYPE_INTEGER,
            "cat_id" =>Bean::TYPE_INTEGER
        );
        $this->instantiate(get_class());
    }
}
?>