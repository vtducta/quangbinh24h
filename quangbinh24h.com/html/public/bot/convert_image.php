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
    $mysqli = new mysqli("localhost", "danang24h17", "ZOopVw63ZuUpiQtcUzvX", "danang24h17");
    //$mysqli->set_charset("utf8");
    
    echo '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />';
    
    $query = 'SELECT id,content_text FROM news_articles_view WHERE id>=61500 AND topic=0 ORDER BY id LIMIT 1';
    //$query = 'SELECT id,content_text FROM news_articles_view WHERE id=2060 ORDER BY id LIMIT 1';
    $result = $mysqli->query($query);
    $row = $result->fetch_assoc();
    if(!$row) die('Complete');
    $content = $row['content_text'];
    //echo $content;die();
    if(strpos($content,'<p style="text-align: right;"><strong>Nguồn tin:</strong> Báo Giáo dục Việt Nam</p>') !== false || strpos($content,'<p style="text-align: right;"><strong>Nguồn tin:</strong> Báo Giáo dục</p>') !== false){
        $query = 'DELETE FROM news_articles_view WHERE id='.$row['id'];
        $mysqli->query($query);
        
        $query = 'DELETE FROM news_articles WHERE id='.$row['id'];
        $mysqli->query($query);
        
        $query = 'DELETE FROM news_articles_category WHERE articles_id='.$row['id'];
        $mysqli->query($query);
        
        $query = 'DELETE FROM news_articles_category_view WHERE articles_id='.$row['id'];
        $mysqli->query($query);
    }
    //$query = 'UPDATE news_articles_view SET content_text="'.addslashes($content).'",topic=1 WHERE id='.$row['id'];
    $query = 'UPDATE news_articles_view SET topic=1 WHERE id='.$row['id'];
    $mysqli->query($query);
    
    echo 'Updated: '.$row['id'];
    echo '<meta http-equiv="refresh" content="0">';
    die();
?>