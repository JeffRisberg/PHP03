<?php $active = "profile"; ?>
<?php include '_header.php'; ?>
<?php include '_connect.php'; ?>

<link rel="stylesheet" href="css/dark_styles.css"/>

<?php
/**
 * Created by PhpStorm.
 * User: Brandon
 * Date: 12/2/2014
 * Time: 2:52 PM
 */


// Display User name
// Upload avatar image
// change password
// view / change visibility

$sql = <<<SQL
    SELECT *
    FROM users
    WHERE id=$user_id
SQL;

if (!$user_result = mysqli_query($db_connection, $sql)) {
    die('There was an error running the query [' . mysqli_error($db_connection) . ']');
}
$user = null;
if ($user_result->num_rows > 0) {
    $user = $user_result->fetch_assoc();
}

$name = $user['user_name'];
$avatar_img = $user['avatar_img'];
$visibility = $user['visibility'];

// Get the list of possible visibility settings
$sql = 'select * from visibility_settings';

$visibility_settings_result = mysqli_query($db_connection, $sql);
if (!$visibility_settings_result) {
    die('Query failed. Error is: ' . mysqli_error($db_connection));
}

?>

<style>
    table tr td {
        padding: 5px;
    }
    .row-heading {
        width: 110;
    }
    .settings-header {
        font-weight: bold;
        font-size: 16px;
        margin-top: 4px;
        margin-bottom: 5px;
        border-width: 0px 0px 2px 0px;
        border-color: #bebebe;
        border-style: solid;
        color: #33B9F2;
        padding: 3px 0px;
    }
</style>

<form action="profile_settings_submit.php" method="POST" enctype="multipart/form-data">

    <table>
        <tr>
            <td colspan="2"><div class="settings-header">General Settings</div></td>
        </tr>
        <tr>
            <td class="row-heading">Username:</td>
            <td><strong><?php echo $user_name; ?></strong></td>
        </tr>

        <tr>
            <td class="row-heading">Avatar:</td>
            <td>
                <?php if ($avatar_img) echo "<img src='uploads/users/$avatar_img' height=40/>"; ?>
                <input type="file" name="avatar_img" value="" style="display: inline"/>
            </td>
        </tr>

        <tr>
            <td class="row-heading">Visibility:</td>
            <td>
                <select name="visibility">
                    <?php
                    while ($row = mysqli_fetch_array($visibility_settings_result)) {
                        $this_id = $row['id'];
                        $selected = ($this_id == $visibility ? "selected" : "");
                        echo "<option ${selected} value='{$row['id']}'>{$row['name']}</option>";
                    }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <td colspan="2">&nbsp;</td>
        </tr>
        <tr>
            <td colspan="2" align="center">
                <input type="submit" class="btn btn-primary" name="button" value="Change Settings"/>
            </td>
        </tr>
    </table>

    <br>
    <br>

    <form>
        <table>
            <tr>
                <td class="settings-header" colspan="2">
                    Change My Password
                </td>
            </tr>
            <tr>
                <td class="row-heading">
                    Current Password:
                </td>
                <td><input type="text"></textarea></td>
            </tr>
            <tr>
                <td class="row-heading">
                    New Password:
                </td>
                <td><input type="text"></textarea></td>
            </tr>
            <tr>
                <td class="row-heading">
                    Re-enter New Password:
                </td>
                <td><input type="text"></textarea></td>
            </tr>
            <tr>
                <td colspan="2">&nbsp;</td>
            </tr>
            <tr>
                <td colspan="2" align="center">
                    <input type="submit" class="btn btn-primary" name="submitPW" value="Change Password">
                </td>
            </tr>
        </table>
    </form>
</form>