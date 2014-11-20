<?php
/**
 * Created by PhpStorm.
 * User: Brandon
 * Date: 11/19/2014
 * Time: 4:39 PM
 */

$button = $_POST['Button'];
$model = $_POST['model'];  //Array of model_ids, only retrieves data from the change selection page

$modelid = $model[0]; //Only one model_id will exist since we use radio buttons on the change selection page
$modelname = '';

if ( $button == 'Add' ) {
    //Display the add title
    echo '<h2>Add a New Model</h2>';
} else {
    //Display the change title
    echo '<h2>Change a Model</h2>';

    //Connect to the database and retrieve the model name
    $db = mysqli_connect( 'uscitp.com', '?', '?', 'mike_car');

    if ( mysqli_connect_errno() != 0 ) {
        //There was an error connecting to the database
        die("Error connecting to the database. The error is: " . mysqli_connect_error());
    }

    $sql = 'select * from model where model_id=' . $modelid;

    $result = mysqli_query( $db, $sql );
    if ( !$result ) {
        die( 'Model query failed. Error is: ' . mysqli_error($db) );
    }

    $row = mysqli_fetch_array( $result );
    $modelname = $row['model_name'];
}
echo '<form action="insertmodel.php" method="POST">';
echo '<p>Name: <input type="text" name="name" value="' .
    $modelname . '"/></p>';

//Add the submit button
if ( $button == 'Add' ) {
    //Display the add title
    echo '<input type="submit" name="Button" value="Add Model"/>';
} else {
    echo '<input type="submit" name="Button" value="Change Model"/>';
}

echo '</form>';


?>