<?php

// usctip.com/cpanel deployment credentials
//$user = "risberg_php03";
//$password = "~hrRwp{mPeNP";
//$host = "uscitp.com";
//$db_name = "risberg_php03";

// localhost testing credentials
$user = "developer";
$password = "123456";
$host = "localhost";
$db_name = "php03";

// USCITP deployment credentials
//$user = "risberg_php03";
//$password = "php03developer";
//$host = "uscitp.com";
//$db_name = "risberg_php03";

$db_connection = mysqli_connect($host, $user, $password, $db_name);
?>