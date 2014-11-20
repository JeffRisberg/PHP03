<?php
/**
 * Created by PhpStorm.
 * User: Brandon
 * Date: 11/19/2014
 * Time: 4:39 PM
 */

$button = $_POST['Button'];
$modelname = '';
$type = '';
$action = '';

if ( $button == 'Change' ) {
    //Display the add title
    echo '<h2>Select a Model to Change</h2>';
    $type='radio';
    $action='addchangemodel.php';
} else {
    //Display the change title
    echo '<h2>Select Models to Delete</h2>';
    $type = 'checkbox';
    $action = 'deletemodel.php';
}
$db = mysqli_connect( 'uscitp.com', '?', '?', 'mike_car');

if ( mysqli_connect_errno() != 0 ) {
    //There was an error connecting to the database
    die("Error connecting to the database. The error is: " . mysqli_connect_error());
}

//Create the SQL INSERT statement
$sql = 'select * from model';

$result = mysqli_query( $db, $sql );
if ( !$result ) {
    die( 'Model query failed. Error is: ' . mysqli_error($db) );
}
?>
<html>
<body>
<?php
echo '<form method="POST" action="' . $action . '">';

while ( $row = mysqli_fetch_array( $result) ) {
    echo '<p><input name="model[]" type="' . $type . '" value="'.
        $row['model_id'] . '"/>' . $row['model_name'] . '</p>';
}

if ( $button == 'Delete' ) {
    echo '<input type="submit" name="Button" value="Delete Models"/>';
} else {
    echo '<input type="submit" name="Button" value="Select Model"/>';
}
?>
</form>
</body>
</html>