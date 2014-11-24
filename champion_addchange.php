<?php
/**
 * Created by PhpStorm.
 * User: Brandon
 * Date: 11/19/2014
 * Time: 4:39 PM
 */
require('_connect.php');
//require('_login.php');

$button = $_POST['button'];
$model = $_POST['model']; //Array of model_ids, only retrieves data from the change selection page

$modelid = $model[0]; //Only one model_id will exist since we use radio buttons on the change selection page
$modelname = '';
$role = '';

if ($button == 'Add') {
    //Display the add title
    echo '<h2>Add a New Champion</h2>';
} else {
    //Display the change title
    echo '<h2>Change a Champion</h2>';

    $sql = 'select * from champions where id=' . $modelid;

    $result = mysqli_query($db_connection, $sql);
    if (!$result) {
        die('Model query failed. Error is: ' . mysqli_error($db));
    }

    $row = mysqli_fetch_array($result);
    $modelname = $row['name'];
    $role = $row['role'];
}
// Top of form
if ($button == 'Add') {
    echo '<form action="champion_insert.php" method="POST">';
} else {
    echo '<form action="champion_update.php" method="POST">';
}

// Middle of form
echo '<p>Name: <input type="text" name="name" value="' . $modelname . '"/></p>';
echo '<p>Role: <input type="text" name="role" value="' . $role . '"/></p>';

// Bottom of form
if ($button == 'Add') {
    echo '<input type="submit" name="button" value="Add Champion"/>';
} else {
    echo '<input type="submit" name="button" value="Change Champion"/>';
    echo '<input type="hidden" name="modelid" value="' . $modelid . '"/>';
}

echo '</form>';


?>