<?php
define('ga_email','hoang.bui@netlink.vn');
define('ga_password','buihoang!@#');

require 'gapi.class.php';
$ga = new gapi(ga_email,ga_password);

$ga->requestAccountData();

foreach($ga->getResults() as $result)
{
  echo $result . ' (' . $result->getProfileId() . ")<br />";
}