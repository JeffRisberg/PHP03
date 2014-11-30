<?php $active = "admin"; ?>
<?php include '_header.php'; ?>
<?php include '_connect.php'; ?>

<?php
$sql = <<<SQL
   SELECT u.id as id, u.user_name as name, vs.name as visibility, u.date_created as date_created
   FROM users u
   JOIN visibility_settings vs ON u.visibility = vs.id
SQL;

$result = mysqli_query($db_connection, $sql);
if (!$result) {
    die('Model query failed. Error is: ' . mysqli_error($db_connection));
}
?>

    <div class="row">
        <div class="col-md-8" style="font-weight: bold; font-size:20pt">Administrate Users</div>
        <div class="col-md-4"><a class="btn btn-primary pull-right" href="admin_user_form.php">Create New
                User</a></div>
    </div>
    <form action="admin_user_delete.php" method="POST">
        <table class="table">
            <tr>
                <th>Select</th>
                <th>Name</th>
                <th>Visibility</th>
                <th>Date Created</th>
                <th>&nbsp;</th>
            </tr>
            <?php
            while ($row = mysqli_fetch_array($result)) {
                echo "<tr>";
                echo "<td width='100'><input type='checkbox' name='id[]' value='{$row['id']}'/></td>";
                echo "<td>{$row['name']}</td><td>{$row['visibility']}</td>";
                echo "<td>{$row['date_created']}</td>";
                echo "<td><a href='admin_user_form.php?id={$row['id']}'>Edit</a></td>";
                echo "</tr>";
            }
            ?>
            <tr>
                <td><input type="submit" value="Delete Selected"/></td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
        </table>
    </form>

<?php include '_footer.php'; ?>