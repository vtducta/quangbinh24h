<?php
class NewsArticlesHitWeekBean extends Bean {

   public $properties;

    public function __construct() {
        $this->properties = array(
            "id" =>Bean::TYPE_INTEGER,
            "title" =>Bean::TYPE_STRING,
            "intro_text" =>Bean::TYPE_STRING,
            "status" =>Bean::TYPE_INTEGER,
            "public" =>Bean::TYPE_INTEGER,
            "create_date_int" =>Bean::TYPE_INTEGER,
            "meta_slug" =>Bean::TYPE_STRING,
            "upload_url" =>Bean::TYPE_STRING,
            "content_type" => Bean::TYPE_STRING,
            "total_hit" => Bean::TYPE_INTEGER
        );
        $this->instantiate(get_class());
    }
}
?>