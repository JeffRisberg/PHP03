<?php $active = "admin"; ?>
<?php include '_header.php'; ?>
<?php include '_connect.php'; ?>

<?php
$id = null;
if (array_key_exists('id', $_GET)) $id = $_GET['id'];

if ($id != null) { // Edit
    echo '<h2>Change a Champion</h2>';

    $sql = 'select * from champions where id=' . $id;

    $result = mysqli_query($db_connection, $sql);
    if (!$result) {
        die('Model query failed. Error is: ' . mysqli_error($db));
    }

    $row = mysqli_fetch_array($result);
    $name = $row['name'];
    $role_id = $row['role_id'];
} else { // Edit
    echo '<h2>Add a New Champion</h2>';

    $name = '';
    $role_id = '';
}
?>

<form action="admin_champion_submit.php" method="POST">

    <p>Name: <input type="text" name="name" value="<?php echo $name ?>"/></p>

    <p>RoleId: <input type="text" name="role_id" value="<?php echo $role_id ?>"/></p>

    <?php
    if ($id != null) {
        echo '<input type="submit" name="button" value="Change Champion"/>';
        echo '<input type="hidden" name="id" value="' . $id . '"/>';
    } else {
        echo '<input type="submit" name="button" value="Add Champion"/>';
    }
    ?>
</form>

<?php include '_footer.php'; ?>
