<?php
require('_connect.php');

$id = null;
if (array_key_exists('id', $_POST)) $id = $_POST['id'];

move_uploaded_file($_FILES['avatar_img']['tmp_name'],
    "uploads/users/{$_FILES['avatar_img']['name']}");

$name = $_POST['name'];
$visibility = $_POST['visibility'];
$avatar_img = $_FILES['avatar_img']['name'];

if ($id != null) {
    if ($avatar_img != null && $avatar_img != "") {
        $sql = <<<SQL
update users set user_name='$name', avatar_img='$avatar_img', visibility=$visibility where id=$id;
SQL;
    } else {
        $sql = <<<SQL
update users set user_name='$name', visibility=$visibility where id=$id;
SQL;
    }
} else {
    if ($avatar_img != null && $avatar_img != "") {
        $sql = <<<SQL
insert into users(user_name, avatar_img, visibility, date_created, last_updated)
values('$name', '$avatar_img', $visibility, now(), now());
SQL;
    } else {
        $sql = <<<SQL
insert into users(user_name, avatar_img, visibility, date_created, last_updated)
values('$name', null, $visibility, now(), now());
SQL;
    }
}

if (!mysqli_query($db_connection, $sql)) {
    die('There was an error running the query [' . mysqli_error($db_connection) . ']');
}

header('Location: admin_user_list.php');