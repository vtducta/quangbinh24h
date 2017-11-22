<?php
class UsersBean extends Bean {

    public $properties;

    public function __construct() {
        $this->properties = array(
            "id" =>Bean::TYPE_INTEGER,
            "username" =>Bean::TYPE_STRING,
            "password" =>Bean::TYPE_STRING,
            "fullname" =>Bean::TYPE_STRING,
            "pseudonym" =>Bean::TYPE_STRING,
            "age" =>Bean::TYPE_INTEGER,
            "sex" =>Bean::TYPE_INTEGER,
            "address" =>Bean::TYPE_STRING,
            "tel" =>Bean::TYPE_STRING,
            "phone" =>Bean::TYPE_STRING,
            "email" =>Bean::TYPE_STRING,
            "position" =>Bean::TYPE_STRING,
            "comment" =>Bean::TYPE_STRING,
            "avata" =>Bean::TYPE_STRING,
            "reason" =>Bean::TYPE_STRING,
            "user_deleted" =>Bean::TYPE_INTEGER
        );
        $this->instantiate(get_class());
    }
}
?>