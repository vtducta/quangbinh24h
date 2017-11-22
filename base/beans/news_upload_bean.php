<?php
class NewsUploadBean extends Bean {

    public $properties;

    public function __construct() {
        $this->properties = array(
            "id" =>Bean::TYPE_INTEGER,
            "title" =>Bean::TYPE_STRING,
            "img_host" =>Bean::TYPE_INTEGER,
            "upload_author" =>Bean::TYPE_INTEGER,
            "description" =>Bean::TYPE_STRING,
            "upload_url" =>Bean::TYPE_STRING,
            "real_url" =>Bean::TYPE_STRING,
            "create_date" =>Bean::TYPE_STRING,
            "create_date_int" =>Bean::TYPE_INTEGER,
            "modified_date" =>Bean::TYPE_STRING,
            "modified_date_int" =>Bean::TYPE_INTEGER,
            "status" =>Bean::TYPE_INTEGER,
            "upload_type" =>Bean::TYPE_STRING,
            "hit_view" =>Bean::TYPE_INTEGER
        );
        $this->instantiate(get_class());
    }
}
?>