<?php
class AdvertiseBean extends Bean {

    public $properties;

    public function __construct() {
        $this->properties = array(
            "advertise_id" =>Bean::TYPE_INTEGER,
            "user_id" =>Bean::TYPE_INTEGER,
            "category_id" =>Bean::TYPE_INTEGER,
            "category_ids" =>Bean::TYPE_STRING,
            "advertise_title" =>Bean::TYPE_STRING,
            "advertise_order" =>Bean::TYPE_INTEGER,
            "advertise_position" =>Bean::TYPE_STRING,
            "advertise_embed" =>Bean::TYPE_STRING,
            "advertise_active" =>Bean::TYPE_INTEGER,
            "advertise_published_date" =>Bean::TYPE_INTEGER,
            "advertise_width" =>Bean::TYPE_INTEGER,
            "advertise_height" =>Bean::TYPE_INTEGER,
            "type" =>Bean::TYPE_STRING,
            "module" =>Bean::TYPE_STRING
        );
        $this->instantiate(get_class());
    }
}
?>