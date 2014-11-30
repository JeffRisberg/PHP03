<?php
require('_connect.php');

$id = null;
if (array_key_exists('id', $_POST)) $id = $_POST['id'];

$name = $_POST['name'];
$visibility = $_POST['visibility'];

if ($id != null) {
    $sql = <<<SQL
update users set user_name='$name', visibility=$visibility where id=$id;
SQL;
} else {
    $sql = <<<SQL
insert into users(user_name, visibility, date_created, last_updated)
values('$name', $visibility, now(), now());
SQL;
}

if (!mysqli_query($db_connection, $sql)) {
    die('There was an error running the query [' . mysqli_error($db_connection) . ']');
}

header('Location: admin_user_list.php');