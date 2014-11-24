<?php
/**
 * Created by PhpStorm.
 * User: Brandon
 * Date: 11/19/2014
 * Time: 4:38 PM
 */
require('_connect.php');

$modelid = $_POST['modelid'];
$name = $_POST['name'];
$role = $_POST['role'];

$sql = 'update champions set name="' . $name . '", role="' . $role . '" where id=' . $modelid;

//Mysqli code to connect to database and execute the query
if (!$result = mysqli_query($db_connection, $sql)) {
    die('There was an error running the query [' . mysqli_error($db_connection) . ']');
}

//Send the user back to model.html
require('champion_list.html');