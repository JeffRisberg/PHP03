<?php
require('_connect.php');
require('_login.php');

/**
 * Created by PhpStorm.
 * User: Brandon
 * Date: 12/2/2014
 * Time: 3:57 PM
 */

$new_password = $_POST['new_password'];
$user_id = $_POST['user_id'];

        $sql = <<<SQL
update users set password='$new_password' where id=$user_id;
SQL;

if (!mysqli_query($db_connection, $sql)) {
    die('There was an error running the query [' . mysqli_error($db_connection) . ']');
}

header('Location: profile_settings_form.php');