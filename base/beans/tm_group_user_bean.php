<?php
class TmGroupUserBean extends Bean {

    public $properties;

    public function __construct() {
        $this->properties = array(
            "group_user_id" =>Bean::TYPE_INTEGER,
            "group_id" =>Bean::TYPE_INTEGER,
            "user_id" =>Bean::TYPE_INTEGER
        );
        $this->instantiate(get_class());
    }
}
?>