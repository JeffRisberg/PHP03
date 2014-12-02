<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

include '_connect.php';

$user_name = $_REQUEST['user_name'];
$password = $_REQUEST['password'];

$sql = <<<SQL
INSERT INTO users (user_name, password, is_admin, visibility, date_created, last_updated)
VALUES ('$user_name', '$password', false, 1, now(), now());
SQL;

if (!$result = mysqli_query($db_connection, $sql)) {
    die('There was an error running the query [' . mysqli_error($db_connection) . ']');
}

if ($result) {
    // Added a new user



    header('Location: index.php');
} else {
    //$_POST['login_response'] = 'Failed to add new user \'' . $user_name . '\'';
    //header('Location: login_signup_form.php?error=2');
    //die('Failed to add new user \'' . $user_name . '\'');
}



