<?php include '_connect.php'; ?>
<?php include '_login.php'; ?>

<?php
/**
 * Created by PhpStorm.
 * User: Brandon
 * Date: 12/14/2014
 * Time: 11:44 PM
 */

$action = $_GET['action'];
$friend_id = $_GET['friend_id'];

if ($action == 'accept') {
    $sql = <<<SQL
INSERT INTO user_friend (user_id, friend_id, date_created)
VALUES ('$user_id', '$friend_id', now());
SQL;

    if (!$result = mysqli_query($db_connection, $sql)) {
        die('There was an error running the query [' . mysqli_error($db_connection) . ']');
    }

    $sql = <<<SQL
INSERT INTO user_friend (user_id, friend_id, date_created)
VALUES ('$friend_id', '$user_id', now());
SQL;

    if (!$result = mysqli_query($db_connection, $sql)) {
        die('There was an error running the query [' . mysqli_error($db_connection) . ']');
    }

    $sql = <<<SQL
UPDATE user_friend_request SET status_id=2, last_updated = now()
WHERE user_id = $friend_id and friend_id=$user_id
SQL;

    if (!$result = mysqli_query($db_connection, $sql)) {
        die('There was an error running the query [' . mysqli_error($db_connection) . ']');
    }

} else if ($action == 'ignore') {
    $sql = <<<SQL
UPDATE user_friend_request
SET status_id=3, last_updated=now()
WHERE user_id=$friend_id AND friend_id=$user_id
SQL;

    if (!$friend_request_result = mysqli_query($db_connection, $sql)) {
        die('There was an error running the query [' . mysqli_error($db_connection) . ']');
    }
}

header('Location: profile_list_requests.php');
?>