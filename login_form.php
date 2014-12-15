<?php $active = "login_form"; ?>
<?php include '_header.php'; ?>
<?php include '_connect.php'; ?>

<h3>Please Login:</h3>

<form action="login_submit.php">
    <input type="hidden" name="fallback_url" value="login_form.php"/>

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
        echo 'Unknown error.<br/><br/>';
    }
}
?>

<?php include '_disconnect.php'; ?>
<?php include '_footer.php'; ?>
