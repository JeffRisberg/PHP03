<?php
/**
 * Action-handling screen that changes the user_champion content.  When done, goes back to champion screen.
 */

include '_login.php';
include '_connect.php';

$action = $_GET['action'];
$champion_id = $_GET['champion_id'];

if ($action == "add") {
    $sql = <<<SQL
INSERT INTO user_champion (user_id, champion_id, date_created)
VALUES ($user_id, $champion_id, now())
SQL;
} else if ($action == "remove") {
    $sql = <<<SQL
DELETE FROM user_champion
WHERE user_id='$user_id' AND champion_id='$champion_id'
SQL;
}

if (!$result = mysqli_query($db_connection, $sql)) {
    die('There was an error running the query [' . mysqli_error($db_connection) . ']');
}

header('Location: champion.php?id=' . $champion_id);