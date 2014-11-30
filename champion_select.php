<?php
/**
 * Created by PhpStorm.
 * User: Brandon
 * Date: 11/19/2014
 * Time: 4:39 PM
 */
require('_connect.php');

$button = $_POST['button'];
$modelname = '';
$type = '';
$action = '';

if ($button == 'Change') {
    //Display the add title
    echo '<h2>Select a Champion to Change</h2>';
    $type = 'radio';
    $action = 'champion_addchange.php';
} else {
    //Display the change title
    echo '<h2>Select Champions to Delete</h2>';
    $type = 'checkbox';
    $action = 'champion_delete.php';
}

$sql = <<<SQL
   SELECT c.id as id, c.name as name, cr.name as role_name
   FROM champions c
   JOIN champion_roles cr ON c.role_id = cr.id
SQL;

$result = mysqli_query($db_connection, $sql);
if (!$result) {
    die('Model query failed. Error is: ' . mysqli_error($db));
}
?>
<html>
<body>
<?php
echo '<form method="POST" action="' . $action . '">';

while ($row = mysqli_fetch_array($result)) {
    echo '<p><input name="model[]" type="' . $type . '" value="' .
        $row['id'] . '"/>' . $row['name'] . ' : ' . $row['role_name'] . '</p>';
}

if ($button == 'Delete') {
    echo '<input type="submit" name="button" value="Delete Champions"/>';
} else {
    echo '<input type="submit" name="button" value="Select Champion"/>';
}
?>
</form>
</body>
</html>