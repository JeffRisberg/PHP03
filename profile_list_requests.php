<?php $active = "profile"; ?>

<?php include '_header.php'; ?>
<?php include '_connect.php'; ?>
<?php include '_paths.php'; ?>

<link rel="stylesheet" href="css/dark_styles.css"/>

<?php
/**
 * Created by PhpStorm.
 * User: Brandon
 * Date: 12/14/2014
 * Time: 9:36 PM
 */


$sql = <<<SQL
SELECT user_id
FROM user_friend
WHERE friend_id=$user_id AND status_id=2
LIMIT 10
SQL;

if (!$friend_request_results = mysqli_query($db_connection, $sql)) {
    die('There was an error running the query [' . mysqli_error($db_connection) . ']');
}

?>

<h3>Friend Requests:</h3>

<table>
    <?php
    while ($row = $friend_request_results->fetch_assoc()) {
        echo '<tr class="friend-request-result">';
        echo '<td style="padding: 10px">';
        echo '<a href="profile.php?id=' . $row['user_id'] . '">';
        echo 'row[name]';
        echo '</a>';
        echo '</td>';
        echo '<td style="padding: 10px">';
        echo '<a href="profile.php?id=' . $row['user_id'] . '">';
        echo '<img height="40" src="' . $row['avatar_img'] . '"/>';
        echo '</a>';
        echo '</td>';
        echo '</tr>';
    }?>
</table>