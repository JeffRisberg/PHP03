<?php $active = "admin"; ?>
<?php include '_header.php'; ?>
<?php include '_connect.php'; ?>

<style>
    table tr td {
        padding: 5px;
    }
</style>

<?php
$id = null;
if (array_key_exists('id', $_GET)) $id = $_GET['id'];

if ($id != null) { // Edit
    echo '<h2>Change a User</h2>';

    $sql = 'select * from users where id=' . $id;

    $result = mysqli_query($db_connection, $sql);
    if (!$result) {
        die('Model query failed. Error is: ' . mysqli_error($db_connection));
    }

    $row = mysqli_fetch_array($result);
    $name = $row['user_name'];
    $visibility = $row['visibility'];
} else { // Edit
    echo '<h2>Add a New User</h2>';

    $name = '';
    $visibility = '';
}

$sql = 'select * from visibility_settings';

$visibility_settings_result = mysqli_query($db_connection, $sql);
if (!$visibility_settings_result) {
    die('Query failed. Error is: ' . mysqli_error($db_connection));
}
?>

<form action="admin_user_submit.php" method="POST">

    <table>
        <tr>
            <td>Name:</td>
            <td><input type="text" name="name" value="<?php echo $name ?>"/></td>
        </tr>

        <tr>
            <td>Image:</td>
            <td><input type="file" name="image" value=""/></td>
        </tr>

        <tr>
            <td>Visibility:</td>
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
    </table>

    <?php
    if ($id != null) {
        echo '<input type="submit" name="button" value="Change User"/>';
        echo '<input type="hidden" name="id" value="' . $id . '"/>';
    } else {
        echo '<input type="submit" name="button" value="Add User"/>';
    }
    ?>
</form>

<?php include '_footer.php'; ?>