<?php
$_POST['act'] = "LoginAction";
$_POST['action'] = "step2";
$app['root']        = '/www/kcms/init.php';
$app['src']         = '/danang24h-apps/admin.danang24h.com/';
$app['timezone']    = 'Asia/Bangkok';
$app['release']     = 0;
require($app['root']);  
?>
