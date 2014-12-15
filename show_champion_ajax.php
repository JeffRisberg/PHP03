<?php include '_connect.php'; ?>
<?php include '_login.php'; ?>

<?php
$champion_id = $_POST['champion_id'];
$skin_id = $_POST['skin_id'];

$skin_ownership_status = 'notOwned';

//Check if the user already owns this skin
$sql = <<<SQL
SELECT * FROM user_skin_collection
WHERE skin_id=$skin_id AND user_id=$user_id
SQL;

if (!$collection_result = mysqli_query($db_connection, $sql)) {
    die('There was an error running the query [' . mysqli_error($db_connection) . ']');
}

if ($collection_result->num_rows > 0) {
    $row = $collection_result->fetch_assoc();
    $skin_ownership_status = $row['ownership_status'];
}

$image_url = "img/skins/{$skin_id}-1080px.jpg";

include '_disconnect.php';

// Generate a response, which is a JSON string
header('Content-Type: application/json');

echo json_encode(array('image_url' => $image_url, 'ownership_status' => $skin_ownership_status));
?>