<?php
include '_connect.php';
include '_login.php';

/**
 * Created by PhpStorm.
 * User: Brandon
 * Date: 12/14/2014
 * Time: 10:58 PM
 */

if (array_key_exists('friend_id', $_GET))
    $friend_id = $_GET['friend_id'];
else
    die("No friend ID given");

$action = $_GET['action'];

if ($action == 'add') {
    $sql = <<<SQL
INSERT INTO user_friend_request (user_id, friend_id, status_id, date_created, last_updated)
VALUES ($user_id, $friend_id, 1, now(), now())
SQL;

    if (!$friend_request_result = mysqli_query($db_connection, $sql)) {
        die('There was an error running the query [' . mysqli_error($db_connection) . ']');
    }
}
else if ($action == 'cancel') {
    $sql = <<<SQL
DELETE FROM user_friend_request
WHERE user_id = $user_id AND friend_id = $friend_id
SQL;

    if (!$friend_request_result = mysqli_query($db_connection, $sql)) {
        die('There was an error running the query [' . mysqli_error($db_connection) . ']');
    }
}

include '_disconnect.php';

header('Location: profile.php?id=' . $friend_id);