<?php
class NewsArticlesJoinArticlesTagBean  extends Bean {

   public $properties;

    public function __construct() {
        $this->properties = array(
            "id" =>Bean::TYPE_INTEGER,
            "title" =>Bean::TYPE_STRING,
            "intro_text" =>Bean::TYPE_STRING,
            "status" =>Bean::TYPE_INTEGER,
            "create_date_int" =>Bean::TYPE_INTEGER,
            "meta_slug" =>Bean::TYPE_STRING,
            "tag_id" =>Bean::TYPE_INTEGER,
            "upload_url" =>Bean::TYPE_STRING,
            "content_type" =>Bean::TYPE_STRING
            
        );
        $this->instantiate(get_class());
    }
}
?>