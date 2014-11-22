<?php
/**
 * Created by PhpStorm.
 * User: Brandon
 * Date: 11/19/2014
 * Time: 4:38 PM
 */
require('_connect.php');

$models = $_POST['model'];
$numberOfModels = count($models);

//Connect to database

for ($i=0; $i<$numberOfModels; $i++ ) {
    //Generate the delete SQL statement using the model_id
    $sql = 'delete from champions where model_id=' . $models[$i];
    echo $sql;

    //Execute sql statement
    if (!$result = mysqli_query($db_connection, $sql)) {
        die('There was an error running the query [' . mysqli_error($db_connection) . ']');
    }
}

//Send to model.html using require
require('champion_list.html');