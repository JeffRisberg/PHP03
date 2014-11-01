<?php
/**
 * Created by PhpStorm.
 * User: Brandon
 * Date: 10/14/2014
 * Time: 10:36 PM
 */

session_start();
if (array_key_exists('user_id', $_SESSION)) {
    $user_id = $_SESSION['user_id'];
    $user_name = $_SESSION['user_name'];
    $b_user_logged_in = 1;
}
else {
    $b_user_logged_in = 0;
}