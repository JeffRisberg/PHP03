<?php
/**
 * Created by PhpStorm.
 * User: Brandon
 * Date: 11/19/2014
 * Time: 4:38 PM
 */

$models = $_POST['model'];
$numberOfModels = count($models);

//Connect to database

for ($i=0; $i<$numberOfModels; $i++ ) {
    //Generate the delete SQL statement using the model_id
    $sql = 'delete from model where model_id=' . $models[$i];
    echo $sql;

    //Execute sql statement
}

//Send to model.html using require