<?php include '_connect.php'; ?>
<?php include '_login.php'; ?>

<?php
$champion_id = $_POST['champion_id'];
$skin_id = $_POST['skin_id'];

$b_skin_collected = false;
$b_skin_wished = false;

//Check if the user already owns this skin
$sql = <<<SQL
SELECT * FROM user_skin_collection
WHERE skin_id=$skin_id AND user_id=$user_id
SQL;

if (!$collection_result = mysqli_query($db_connection, $sql)) {
    die('There was an error running the query [' . mysqli_error($db_connection) . ']');
}

if ($collection_result->num_rows > 0) {
    $b_skin_collected = true;
}

//Check if the user already wants this skin
$sql = <<<SQL
SELECT * FROM user_skin_wishlist
WHERE skin_id=$skin_id AND user_id=$user_id
SQL;

if (!$wishlist_result = mysqli_query($db_connection, $sql)) {
    die('There was an error running the query [' . mysqli_error($db_connection) . ']');
}

if ($wishlist_result->num_rows > 0) {
    $b_skin_wished = true;
}

$image_url = "img/skins/{$skin_id}-1080px.jpg";

// Generate a response, which is a JSON string
header('Content-Type: application/json');

echo json_encode(array('image_url' => $image_url, 'collected' => $b_skin_collected, 'wished' => $b_skin_wished));
?>