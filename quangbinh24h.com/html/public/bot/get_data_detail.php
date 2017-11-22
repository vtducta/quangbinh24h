<?php
    function get_html($url) {
        $ch = curl_init();
        $timeout = 5;
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.0)");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,false);
        curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        $data = curl_exec($ch);
        $data = str_get_html($data);
        curl_close($ch);
        return $data;
    }
    function toSlug($doc) {
        $str = addslashes(html_entity_decode(trim($doc)));
        $str = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/", 'a', $str);
        $str = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", 'e', $str);
        $str = preg_replace("/(ì|í|ị|ỉ|ĩ)/", 'i', $str);
        $str = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/", 'o', $str);
        $str = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/", 'u', $str);
        $str = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", 'y', $str);
        $str = preg_replace("/(đ)/", 'd', $str);
        $str = preg_replace("/(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)/", 'A', $str);
        $str = preg_replace("/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/", 'E', $str);
        $str = preg_replace("/(Ì|Í|Ị|Ỉ|Ĩ)/", 'I', $str);
        $str = preg_replace("/(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/", 'O', $str);
        $str = preg_replace("/(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/", 'U', $str);
        $str = preg_replace("/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/", 'Y', $str);
        $str = preg_replace("/(Đ)/", 'D', $str);
        $str = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $str);
        $str = preg_replace("/( )/", '-', $str);
        $str = preg_replace("/(--)/", '-', $str);
        $str = preg_replace("/(--)/", '-', $str);
        $str = str_replace("/", "-", $str);
        $str = str_replace("\\", "-", $str);
        $str = str_replace("+", "", $str);
        $str = strtolower($str);
        $str = stripslashes($str);
        return $str;
    }
    $mysqli = new mysqli("localhost", "danang24h17", "rH0vCCFUHCkN1CpvLhGh", "danang24h17");
    //$mysqli->set_charset("utf8");
    /*Get url from db - START*/
    $query = 'SELECT * FROM news_bot WHERE status=0 ORDER BY id LIMIT 1';
    $result = $mysqli->query($query);
    $row = $result->fetch_assoc();
    if($row) {
        $bot_id = $row['id'];
        $url = $row['url'];
        $category_id = $row['category_id'];
        echo 'bot_id: '.$bot_id.'<br>';
        echo 'url: '.$url.'<br>';
    } else {
        echo 'Completed!';
        die();
    }
    /*Get url from db - END*/
    
    /*Get data from url - BEGIN*/
    require_once('simple_html_dom.php');
    $html = get_html($url);
    #
    $title = $html->find('h1[itemprop="name"]',0)->plaintext;
    $intro = $html->find('p[itemprop="description"]',0)->plaintext;
    $content = $html->find('div[itemprop="articleBody"]',0)->innertext;
    if($html->find('meta[property="og:image"]',0)) $image = $html->find('meta[property="og:image"]',0)->getAttribute('content');
    else $image = '';
    $date = $html->find('time',0)->plaintext;
    $date = explode('-',$date);
    $date = trim($date[1]);
    $date = explode(' ',$date);
    $arr_date = explode('/',$date[0]);
    $datetime = $arr_date[2].'-'.$arr_date[1].'-'.$arr_date[0].' '.$date[1].':00';
    /*Get data from url - END*/
    if($title && $intro && $content){
        $slug = toSlug($title);
        /*Handle Image - BEGIN*/
        $query_image = 'INSERT INTO news_upload(upload_url,create_date_int) VALUES("'.$image.'","'.strtotime($datetime).'")';
        $mysqli->query($query_image);
        
        $query_image_id = 'SELECT max(id) as intMax FROM news_upload';
        $result = $mysqli->query($query_image_id);
        $row = $result->fetch_assoc();
        $image_id = $row['intMax'];
        echo 'image_id: '.$image_id.'<br>';
        /*Handle Image - END*/
        
        /*Handle News - BEGIN*/
        $query_insert_news = 'INSERT INTO news_articles (title, intro_text, content_text, category_id, content_type, creat_by, modified_by, images, create_date_int, modified_date_int, status, meta_slug, public) VALUES("'.addslashes($title).'","'.addslashes($intro).'","'.addslashes($content).'","'.$category_id.'","article","1","1","'.$image_id.'","'.strtotime($datetime).'","0","3","'.$slug.'","1")';
        $mysqli->query($query_insert_news);
        
        $query_news_id = 'SELECT max(id) as intMax FROM news_articles';
        $result = $mysqli->query($query_news_id);
        $row = $result->fetch_assoc();
        $news_id = $row['intMax'];
        echo 'news_id: '.$news_id.'<br>';
        
        $query_insert_news_view = 'INSERT INTO news_articles_view (id, title, intro_text, content_text, category_id, content_type, creat_by, modified_by, images, create_date_int, modified_date_int, status, meta_slug, public) VALUES("'.$news_id.'","'.addslashes($title).'","'.addslashes($intro).'","'.addslashes($content).'","'.$category_id.'","article","476","476","'.$image_id.'","'.strtotime($datetime).'","0","3","'.$slug.'","1")';
        $mysqli->query($query_insert_news_view);
        
        $query_insert_news_category = 'INSERT INTO news_articles_category(category_id,articles_id) VALUES("'.$category_id.'","'.$news_id.'")';
        $mysqli->query($query_insert_news_category);
        
        $query_news_category_id = 'SELECT max(id) as intMax FROM news_articles_category';
        $result = $mysqli->query($query_news_category_id);
        $row = $result->fetch_assoc();
        $news_category_id = $row['intMax'];
        echo 'news_category_id: '.$news_category_id.'<br>';
        
        $query_insert_news_category_view = 'INSERT INTO news_articles_category_view(id,articles_id,category_id,parent_id,status,create_date_int) VALUES("'.$news_category_id.'","'.$news_id.'","'.$category_id.'","0","1","'.strtotime($datetime).'")';
        $mysqli->query($query_insert_news_category_view);
        /*Handle News - END*/
    }
    /*Update status for url - START*/
    $query = 'UPDATE news_bot SET status=1 WHERE id='.$bot_id;
    $mysqli->query($query);
    /*Update status for url - END*/
    echo 'Insert successfully';
    echo '<meta http-equiv="refresh" content="0">';
    die();
?>