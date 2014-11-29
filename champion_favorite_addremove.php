<?php
/**
 * Created by PhpStorm.
 * User: Brandon
 * Date: 11/29/2014
 * Time: 2:32 PM
 */

include '_login.php';
include '_connect.php';

$action = $_GET['action'];
$champion_id = $_GET['champion'];

if ($action == "add") {
    $sql = <<<SQL
INSERT INTO user_champion (user_id, champion_id, date_created, last_updated)
VALUES ($user_id, $champion_id, now(), now())
SQL;
}
else if ($action == "remove") {
    $sql = <<<SQL
REMOVE FROM user_champion
WHERE user_id=$user_id AND champion_id=$champion_id
SQL;
}

if (!$result = mysqli_query($db_connection, $sql)) {
    die('There was an error running the query [' . mysqli_error($db_connection) . ']');
}

header('Location: champion.php?=' . $champion_id);