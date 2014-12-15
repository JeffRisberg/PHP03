<?php $active = "admin"; ?>
<?php include '_header.php'; ?>
<?php include '_connect.php'; ?>

<?php
$sql = <<<SQL
   SELECT c.id as id, c.name as name, cr.name as role_name, c.date_created as date_created
   FROM champions c
   JOIN champion_roles cr ON c.role_id = cr.id
SQL;

$result = mysqli_query($db_connection, $sql);
if (!$result) {
    die('Model query failed. Error is: ' . mysqli_error($db_connection));
}
?>

    <div class="row">
        <div class="col-md-8" style="font-weight: bold; font-size:20pt">Administrate Champions</div>
        <div class="col-md-4"><a class="btn btn-primary pull-right" href="admin_champion_form.php">Create New
                Champion</a></div>
    </div>
    <form action="admin_champion_delete.php" method="POST">
        <table class="table">
            <tr>
                <th>Select</th>
                <th>Name</th>
                <th>Role</th>
                <th>Date Created</th>
                <th>&nbsp;</th>
            </tr>
            <?php
            while ($row = mysqli_fetch_array($result)) {
                echo "<tr>";
                echo "<td width='100'><input type='checkbox' name='id[]' value='{$row['id']}'/></td>";
                echo "<td>{$row['name']}</td><td>{$row['role_name']}</td>";
                echo "<td>{$row['date_created']}</td>";
                echo "<td><a href='admin_champion_form.php?id={$row['id']}'>Edit</a></td>";
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

<?php include '_disconnect.php'; ?>
<?php include '_footer.php'; ?>