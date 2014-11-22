<?php
/**
 * Created by PhpStorm.
 * User: Brandon
 * Date: 11/19/2014
 * Time: 4:38 PM
 */
require('_connect.php');

$name = $_POST['name'];
$role = $_POST['role'];

$sql = 'insert into champions (name, role, date_created, last_updated)
values ("' . $name . '", "' . $role . '", now(), now());';

//Mysqli code to connect to database and execute the query
if (!$result = mysqli_query($db_connection, $sql)) {
    die('There was an error running the query [' . mysqli_error($db_connection) . ']');
}

//Send the user back to model.html
require('champion_list.html');