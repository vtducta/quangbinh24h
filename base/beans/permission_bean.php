<?php
class PermissionBean extends Bean {

    public $properties;

    public function __construct() {
        $this->properties = array(
            "id" =>Bean::TYPE_INTEGER,
            "userid" =>Bean::TYPE_STRING,
            "email" =>Bean::TYPE_STRING,
            "status" =>Bean::TYPE_INTEGER
        );
        $this->instantiate(get_class());
    }
}
?>