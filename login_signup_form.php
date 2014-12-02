<?php $active = "signup_form"; ?>
<?php include '_header.php'; ?>
<?php include '_connect.php'; ?>

<h3>Please desired Username and Password:</h3>

<form action="login_signup_submit.php">
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
            <td>Repeat Password:</td>
            <td><input type="password" name="repeat_password"/></td>
        </tr>
        <tr>
            <td></td>
            <td><input type="submit"/></td>
        </tr>
    </table>
</form>

<?php
/*if (array_key_exists('error', $_GET)) {
    if ($_GET['error'] == 1) {
        echo 'Incorrect password for user.<br><br>';
    } else if ($_GET['error'] == 2) {
        echo 'No user found for user name.<br><br>';
    } else {
        echo 'Unknown error.<br><br>';
    }
}*/
?>

<?php include '_footer.php'; ?>
