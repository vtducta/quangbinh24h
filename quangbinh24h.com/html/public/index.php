<?php
if((php_sapi_name() == 'cli') or defined('STDIN')){
    parse_str(implode('&', array_slice($argv, 1)), $_GET);   
}

$app['root']        = '/home/app/kcms/init.php';
$app['src']         = '/quangbinh24h-apps/quangbinh24h.com/';
$app['timezone']    = 'Asia/Bangkok';
$app['release']     = 0;
require($app['root']); 
$time_gl = microtime(true);
/*if (getIp() == '101.99.23.251'){
print('<PRE>');
print_r(memory_get_usage());
print('</PRE>');
print_r(microtime(true) - $time_gl);
}
else{
} */   
function getIP()
{
    if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else if (isset($_SERVER['REMOTE_ADDR'])) $ip = $_SERVER['REMOTE_ADDR'];
    else $ip = "UNKNOWN";
    return $ip;
}   
?>
