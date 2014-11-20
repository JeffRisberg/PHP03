<?php
/**
 * Created by PhpStorm.
 * User: Brandon
 * Date: 11/19/2014
 * Time: 4:38 PM
 */

$name = $_POST['name'];

$sql = 'insert into model (make_id,model_name) values (1,"' .
    $name . '")';

//Mysqli code to connect to database and execute the query

//Send the user back to model.html
require('model.html');