<?php

// usctip.com/cpanel deployment credentials
//$user = "risberg_php03";
//$password = "~hrRwp{mPeNP";
//$host = "uscitp.com";
//$db_name = "risberg_php03";

// localhost testing credentials
//$user = "developer";
//$password = "123456";
//$host = "localhost";
//$db_name = "php03";

// ANHosting credentials
$user = "therris8_php03";
$password = "N1PIwm1s1sPTDs";
$host = "localhost";
$db_name = "therris8_php03";

$db_connection = mysqli_connect($host, $user, $password, $db_name);
