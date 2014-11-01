<?php include '_header.php'; ?>
<?php include '_connect.php'; ?>

<h3>Please Login:</h3>

<form action="login_submit.php">
    <table>
        <tr>
            <td>Username:</td>
            <td><input type="text" name="user_name"/></td>
        </tr>
        <tr>
            <td>Password:</td>
            <td><input type="password" name="password"/></td>
        </tr>
        <tr>
            <td></td>
            <td><input type="submit"/></td>
        </tr>
    </table>
</form>

<?php
if (array_key_exists('error', $_GET)) {
    if ($_GET['error'] == 1) {
        echo 'Incorrect password for user.<br><br>';
    } else if ($_GET['error'] == 2) {
        echo 'No user found for user name.<br><br>';
    } else {
        echo 'Unknown error.<br><br>';
    }
}
?>

<?php
// Debug output to list all known users for testing purposes

$sql = <<<SQL
SELECT id, user_name, password
FROM users
SQL;

if (!$result = mysqli_query($db_connection, $sql)) {
    die('There was an error running the query [' . mysqli_error($db_connection) . ']');
}

echo 'Debug dump of all registered users:<br>';

while ($row = $result->fetch_assoc()) {
    var_dump($row);
    echo '<br>';
}
?>

<?php include '_footer.php'; ?>
