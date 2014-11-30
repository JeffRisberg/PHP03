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
$skin_id = $_GET['skin_id'];
$champion_id = $_GET['champion_id'];

if ($action == "add") {
    $sql = <<<SQL
INSERT INTO user_skin_wishlist (user_id, skin_id, date_created)
VALUES ($user_id, $skin_id, now())
SQL;
}
else if ($action == "remove") {
    $sql = <<<SQL
DELETE FROM user_skin_wishlist
WHERE user_id='$user_id' AND skin_id='$skin_id'
SQL;
}

var_dump($sql);

if (!$result = mysqli_query($db_connection, $sql)) {
    die('There was an error running the query [' . mysqli_error($db_connection) . ']');
}

header('Location: champion.php?id=' . $champion_id);