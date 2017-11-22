<?php
class NewsArticlesJoinCategoryViewBean extends Bean {

    public $properties;

    public function __construct() {
        $this->properties = array(
            "id" =>Bean::TYPE_INTEGER,
            "title" =>Bean::TYPE_STRING,
            "intro_text" =>Bean::TYPE_STRING,
            "content_text" =>Bean::TYPE_STRING,
            "source_id" =>Bean::TYPE_INTEGER,
            "category_id" =>Bean::TYPE_INTEGER,
            "tag_detail" =>Bean::TYPE_INTEGER,
            "creat_by" =>Bean::TYPE_INTEGER,
            "modified_by" =>Bean::TYPE_INTEGER,
            "rate_article" =>Bean::TYPE_INTEGER,
            "images" =>Bean::TYPE_INTEGER,
            "version" =>Bean::TYPE_INTEGER,
            "hit_view" =>Bean::TYPE_INTEGER,
            "creat_date" =>Bean::TYPE_STRING,
            "create_date_int" =>Bean::TYPE_INTEGER,
            "modified_date" =>Bean::TYPE_STRING,
            "modified_date_int" =>Bean::TYPE_INTEGER,
            "allow_comment" =>Bean::TYPE_INTEGER,
            "status" =>Bean::TYPE_INTEGER,
            "meta_slug" =>Bean::TYPE_STRING,
            "meta_title" =>Bean::TYPE_STRING,
            "meta_keywork" =>Bean::TYPE_STRING,
            "meta_description" =>Bean::TYPE_STRING,
            "is_tm" =>Bean::TYPE_INTEGER,
            "head_line" =>Bean::TYPE_INTEGER,
            "forcus" =>Bean::TYPE_INTEGER,
            "hotnews" =>Bean::TYPE_INTEGER,
            "draft" =>Bean::TYPE_INTEGER,
            "public" =>Bean::TYPE_INTEGER,
            "reason" =>Bean::TYPE_STRING,
            "timer" =>Bean::TYPE_INTEGER,
            "category_id" =>Bean::TYPE_INTEGER,
            "parent_id" =>Bean::TYPE_INTEGER,
            "upload_url" =>Bean::TYPE_STRING,
            "content_type" =>Bean::TYPE_STRING,
            "cmtnd" =>Bean::TYPE_STRING 
        );
        $this->instantiate(get_class());
    }
}
?>