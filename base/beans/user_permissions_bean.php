<?php
class UserPermissionsBean extends Bean {

    public $properties;

    public function __construct() {
        $this->properties = array(
            "id" =>Bean::TYPE_INTEGER,
            "user_id" =>Bean::TYPE_INTEGER,
            "user_create" =>Bean::TYPE_INTEGER,
            "start_time" =>Bean::TYPE_INTEGER,
            "end_time" =>Bean::TYPE_INTEGER,
            "group_user" =>Bean::TYPE_INTEGER,
            "status" =>Bean::TYPE_INTEGER
        );
        $this->instantiate(get_class());
    }
}
?>