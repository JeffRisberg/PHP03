<?php include '_connect.php'; ?>

<?php
/**
 * Created by PhpStorm.
 * User: Brandon
 * Date: 12/2/2014
 * Time: 1:52 PM
 */

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
    if ($user['password'] == $password) { // TODO: improve authentication to be better than plain text passwords
        $password_match = true;
    }
}

// Generate a response, which is a JSON string
header('Content-Type: application/json');

echo json_encode(array('password_match' => $password_match));
?>