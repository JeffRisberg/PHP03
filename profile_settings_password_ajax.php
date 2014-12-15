<?php
include '_connect.php';

$user_id = $_POST['user_id'];
$password = $_POST['password'];

$sql = <<<SQL
SELECT * FROM users
WHERE id='$user_id'
SQL;

if (!$results = mysqli_query($db_connection, $sql)) {
    die('There was an error running the query: "' . $sql . '" [' . mysqli_error($db_connection) . ']');
}

$password_match = false;
if ($results->num_rows != 0) {
    $user = $results->fetch_assoc();
    if (password_verify($password, $user['password'])) {
        $password_match = true;
    }
}

include '_disconnect.php';

// Generate a response, which is a JSON string
header('Content-Type: application/json');

echo json_encode(array('password_match' => $password_match));
?>