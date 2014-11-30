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
$role_id = $_POST['role_id'];

$sql = <<<SQL
update champions set name='$name', role_id='$role_id' where id=$modelid;
SQL;

//Mysqli code to connect to database and execute the query
if (!$result = mysqli_query($db_connection, $sql)) {
    die('There was an error running the query [' . mysqli_error($db_connection) . ']');
}

//Send the user back to model.html
require('champion_list.html');