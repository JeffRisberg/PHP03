<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

include '_connect.php';

$user_name = $_REQUEST['user_name'];
$password = $_REQUEST['password'];
$fallback_url = $_REQUEST['fallback_url'];

$new_password = password_hash($new_password, PASSWORD_DEFAULT);

$sql = <<<SQL
INSERT INTO users (user_name, password, is_admin, visibility, date_created, last_updated)
VALUES ('$user_name', '$password', false, 1, now(), now());
SQL;

if (!$result = mysqli_query($db_connection, $sql)) {
    die('There was an error running the query [' . mysqli_error($db_connection) . ']');
}

if ($result) {
    // Added a new user

    // Login as that user (copy past from login_submit.php. Should find a way to simplify these use cases.
    $sql = <<<SQL
SELECT *
FROM users
WHERE user_name='$user_name'
SQL;

    if (!$result = mysqli_query($db_connection, $sql)) {
        die('There was an error running the query [' . mysqli_error($db_connection) . ']');
    }

    if ($result->num_rows != 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            session_start();
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['user_name'] = $row['user_name'];
            $_SESSION['is_admin'] = $row['is_admin'];

            $sql = 'UPDATE users SET last_login = now() WHERE id=' . $row['id'];
            $stmt = mysqli_prepare($db_connection, $sql);
            var_dump(mysqli_stmt_execute($stmt));
        }
    }
    else {
        // no user found
        header('Location: ' . $fallback_url . '?error=1');
    }

    header('Location: index.php'); // TODO: set this to the user settings page.
} else {
    //$_POST['login_response'] = 'Failed to add new user \'' . $user_name . '\'';
    //header('Location: login_signup_form.php?error=2');
    //die('Failed to add new user \'' . $user_name . '\'');
}



