<?php
require('_connect.php');

$ids = $_POST['id'];
$numberOfIds = count($ids);

for ($i = 0; $i < $numberOfIds; $i++) {
    $sql = 'delete from champions where id=' . $ids[$i];

    if (!mysqli_query($db_connection, $sql)) {
        die('There was an error running the query [' . mysqli_error($db_connection) . ']');
    }
}

include '_disconnect.php';

header('Location: admin_champion_list.php');