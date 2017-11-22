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
	require_once('simple_html_dom.php');
	
	$mysqli = new mysqli("localhost", "danang24h17", "rH0vCCFUHCkN1CpvLhGh", "danang24h17");
	$mysqli->set_charset("utf8");
	#
    $domain = 'http://danang24h.vn';
    if(!$_GET['url']) die('Empty!');
    if(!$_GET['page']) $url_cat = $_GET['url'].'/';
    else $url_cat = $_GET['url'].'/page-'.$_GET['page'].'/';
    
    $category_id = '';
    if(isset($_GET['category_id'])) $category_id = $_GET['category_id'];
    
	$html = get_html($url_cat);
    $count = 0;
    foreach($html->find('.cate_content article') as $one) {
        $url = $one->find('a',0)->href;

        if(substr($url,0,1)=='/') $url = $domain.$url;
        $query = 'INSERT INTO news_bot(url,category_id) VALUES("'.$url.'","'.$category_id.'")';
        $result = $mysqli->query($query);
        echo 'Insert successfully: '.$url.'<br>';
        $count++;
    }
    if($count<2) die('Complete!');
	$url_redirect = 'http://danang24h.vn/bot/get_url.php?category_id='.$category_id.'&url='.$_GET['url'].'&page='.($_GET['page']+1);
	echo '<meta http-equiv="Refresh" content="0; url='.$url_redirect.'">';
	die();
?>