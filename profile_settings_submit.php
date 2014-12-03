<?php
require('_connect.php');
require('_login.php');
require('_paths.php');

/**
 * Created by PhpStorm.
 * User: Brandon
 * Date: 12/2/2014
 * Time: 3:57 PM
 */
$old_avatar_img_url = $_POST['old_avatar_img'];

move_uploaded_file($_FILES['avatar_img']['tmp_name'],
    "$user_avatar_img_path/{$_FILES['avatar_img']['name']}");
//unlink("$user_avatar_img_path/$old_avatar_img_url"); //TODO: make this smarter to only remove unused profile images

$visibility = $_POST['visibility'];
$avatar_img = $_FILES['avatar_img']['name'];

if ($avatar_img != null && $avatar_img != "") {
    $sql = <<<SQL
update users set avatar_img='$avatar_img', visibility=$visibility where id=$user_id;
SQL;
} else {
    $sql = <<<SQL
update users set visibility=$visibility where id=$user_id;
SQL;
}

if (!mysqli_query($db_connection, $sql)) {
    die('There was an error running the query [' . mysqli_error($db_connection) . ']');
}

header('Location: profile_settings_form.php');