<?php
/**
 * Action-handling screen that changes the collection content.  When done, goes back to champion screen.
 */

include '_login.php';
include '_connect.php';

$action = $_GET['action'];
$skin_id = $_GET['skin_id'];
$champion_id = $_GET['id'];
$ownership_status = $_GET['ownership_status'];

if ($action == 'Add to Collection' || $action == 'Add to Wish List') {
    if ($ownership_status == 'wished') {
        $sql = <<<SQL
UPDATE user_skin_collection
SET ownership_status = 'collected'
WHERE user_id='$user_id' AND skin_id='$skin_id'
SQL;
    }
    else {
        $new_status = 'notOwned';
        if ($action == 'Add to Collection') { $new_status = 'collected';}
        else if ($action == 'Add to Wish List') { $new_status = 'wished';}

        $sql = <<<SQL
INSERT INTO user_skin_collection (user_id, skin_id, ownership_status, date_created)
VALUES ($user_id, $skin_id, '$new_status', now())
SQL;
    }
}
else if ($action == 'Remove from Collection' || $action == 'Remove from Wish List') {
    $sql = <<<SQL
DELETE FROM user_skin_collection
WHERE user_id='$user_id' AND skin_id='$skin_id'
SQL;
}

if (!$result = mysqli_query($db_connection, $sql)) {
    var_dump($sql);
    die('There was an error running the query [' . mysqli_error($db_connection) . ']');
}

include '_disconnect.php';

header("Location: show_champion.php?id=$champion_id&skin_id=$skin_id");