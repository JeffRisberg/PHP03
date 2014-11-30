<?php
require('_connect.php');

$ids = $_POST['id'];
$numberOfIds = count($ids);

for ($i = 0; $i < $numberOfIds; $i++) {
    $sql = 'delete from users where id=' . $ids[$i];

    if (!mysqli_query($db_connection, $sql)) {
        die('There was an error running the query [' . mysqli_error($db_connection) . ']');
    }
}

header('Location: admin_user_list.php');