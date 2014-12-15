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
    echo '<h2>Change a Champion</h2>';

    $sql = 'select * from champions where id=' . $id;

    $result = mysqli_query($db_connection, $sql);
    if (!$result) {
        die('Model query failed. Error is: ' . mysqli_error($db_connection));
    }

    $row = mysqli_fetch_array($result);
    $name = $row['name'];
    $role_id = $row['role_id'];
} else { // Edit
    echo '<h2>Add a New Champion</h2>';

    $name = '';
    $role_id = '';
}

$sql = 'select * from champion_roles';

$champion_roles_result = mysqli_query($db_connection, $sql);
if (!$champion_roles_result) {
    die('Query failed. Error is: ' . mysqli_error($db_connection));
}
?>

<form action="admin_champion_submit.php" method="POST">

    <table>
        <tr>
            <td>Name:</td>
            <td><input type="text" name="name" value="<?php echo $name ?>"/></td>
        </tr>

        <tr>
            <td>Role:</td>
            <td>
                <select name="role_id">
                    <?php
                    while ($row = mysqli_fetch_array($champion_roles_result)) {
                        $this_id = $row['id'];
                        $selected = ($this_id == $role_id ? "selected" : "");
                        echo "<option ${selected} value='{$row['id']}'>{$row['name']}</option>";
                    }
                    ?>
                </select>
            </td>
        </tr>
    </table>

    <?php
    if ($id != null) {
        echo '<input type="submit" name="button" value="Change Champion"/>';
        echo '<input type="hidden" name="id" value="' . $id . '"/>';
    } else {
        echo '<input type="submit" name="button" value="Add Champion"/>';
    }
    ?>
</form>

<?php include '_disconnect.php'; ?>
<?php include '_footer.php'; ?>
