<?php
include '_connect.php';

/**
 * Created by PhpStorm.
 * User: Brandon
 * Date: 12/2/2014
 * Time: 1:52 PM
 */

$user_name = $_POST['user_name'];

$sql = <<<SQL
SELECT * FROM users
WHERE user_name='$user_name'
SQL;

if (!$results = mysqli_query($db_connection, $sql)) {
    die('There was an error running the query: "' . $sql . '" [' . mysqli_error($db_connection) . ']');
}

$user_name_free = true;
if ($results->num_rows != 0) {
    $user_name_free = false;
}

include '_disconnect.php';

// Generate a response, which is a JSON string
header('Content-Type: application/json');

echo json_encode(array('user_name_free' => $user_name_free));
?>