<?php
require('_connect.php');

$id = null;
if (array_key_exists('id', $_POST)) $id = $_POST['id'];

$name = $_POST['name'];
$role_id = $_POST['role_id'];

if ($id != null) {
    $sql = <<<SQL
update champions set name='$name', role_id=$role_id where id=$id;
SQL;
} else {
    $sql = <<<SQL
insert into champions(name, role_id, date_created, last_updated)
values('$name', $role_id, now(), now());
SQL;
}

if (!mysqli_query($db_connection, $sql)) {
    die('There was an error running the query [' . mysqli_error($db_connection) . ']');
}

header('Location: admin_champion_list.php');