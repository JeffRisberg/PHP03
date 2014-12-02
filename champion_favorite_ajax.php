<?php include '_connect.php'; ?>
<?php include '_login.php'; ?>

<?php
$champion_id = $_POST['champion_id'];

//Check if the user has already favorited this champion
$b_champion_favorited = false;

$sql = <<<SQL
SELECT * FROM user_champion
WHERE champion_id=$champion_id AND user_id=$user_id
SQL;

if (!$champion_result = mysqli_query($db_connection, $sql)) {
    die('There was an error running the query [' . mysqli_error($db_connection) . ']');
}

if ($champion_result->num_rows > 0) {
    $b_champion_favorited = true;
}

// Generate a response, which is a JSON string
header('Content-Type: application/json');

echo json_encode(array('champion_favorited' => $b_champion_favorited));
?>