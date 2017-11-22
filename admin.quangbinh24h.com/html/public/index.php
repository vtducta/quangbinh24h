<?php    

$app['root']        = '/home/app/kcms/init.php';
$app['src']         = '/quangbinh24h-apps/admin.quangbinh24h.com';
$app['timezone']    = 'Asia/Bangkok';
$app['release']     = 0;
require($app['root']); 
function getIP()
{
    if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else if (isset($_SERVER['REMOTE_ADDR'])) $ip = $_SERVER['REMOTE_ADDR'];
    else $ip = "UNKNOWN";
    return $ip;
} 

?>
