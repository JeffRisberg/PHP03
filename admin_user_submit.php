<?php
require('_connect.php');
require('_paths.php');

$id = null;
if (array_key_exists('id', $_POST)) $id = $_POST['id'];

move_uploaded_file($_FILES['avatar_img']['tmp_name'],
    "$user_avatar_img_path/{$_FILES['avatar_img']['name']}");
//unlink($user_avatar_img_path/$_POST['old_avatar_img']);

$user_name = $_POST['user_name'];
$name = $_POST['name'];
$visibility = $_POST['visibility'];
$avatar_img = $_FILES['avatar_img']['name'];

if ($id != null) {
    if ($avatar_img != null && $avatar_img != "") {
        $sql = <<<SQL
update users set user_name='$user_name', name='$name', avatar_img='$avatar_img', visibility=$visibility where id=$id;
SQL;
    } else {
        $sql = <<<SQL
update users set user_name='$user_name', name='$name', visibility=$visibility where id=$id;
SQL;
    }
} else {
    if ($avatar_img != null && $avatar_img != "") {
        $sql = <<<SQL
insert into users(user_name, name, avatar_img, visibility, date_created, last_updated)
values('$user_name', '$name', '$avatar_img', $visibility, now(), now());
SQL;
    } else {
        $sql = <<<SQL
insert into users(user_name, name, avatar_img, visibility, date_created, last_updated)
values('$user_name', '$name', null, $visibility, now(), now());
SQL;
    }
}

if (!mysqli_query($db_connection, $sql)) {
    die('There was an error running the query [' . mysqli_error($db_connection) . ']');
}

include '_disconnect.php';

header('Location: admin_user_list.php');