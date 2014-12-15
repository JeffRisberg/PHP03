<?php include '_connect.php'; ?>
<?php include '_login.php'; ?>

<?php
/**
 * Created by PhpStorm.
 * User: Brandon
 * Date: 12/14/2014
 * Time: 10:58 PM
 */

if (array_key_exists('friend_id', $_GET))
    $friend_id = $_GET['friend_id'];
else
    die();

$sql = <<<SQL
INSERT INTO user_friend_request (user_id, friend_id, status_id, date_created, last_updated)
VALUES ($user_id, $friend_id, 1, now(), now())
SQL;

if (!$friend_request_result = mysqli_query($db_connection, $sql)) {
    die('There was an error running the query [' . mysqli_error($db_connection) . ']');
}

header('Location: profile.php?id=' . $friend_id);