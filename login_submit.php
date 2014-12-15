<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

include '_connect.php';

require_once 'passwordLib.php';

$user_name = $_REQUEST['user_name'];
$password = $_REQUEST['password'];
$fallback_url = $_REQUEST['fallback_url'];

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
        mysqli_stmt_execute($stmt);

        header('Location: index.php');
    } else {
        //$_POST['login_response'] = 'Incorrect password for user \'' . $user_name . '\'';
        include '_footer.php';

        header("Location: $fallback_url?error=1");
        //die('Incorrect password for user \'' . $user_name . '\'');
    }
} else {
    //$_POST['login_response'] = 'No user found for user name: ' . $user_name . '.';
    include '_footer.php';

    header("Location: $fallback_url?error=2");
    //die('No user found for user name: ' . $user_name . '.');
}
