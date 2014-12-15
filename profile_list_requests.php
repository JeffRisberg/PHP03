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
SELECT u.id AS user_id, u.user_name AS user_name, u.avatar_img AS avatar_img
FROM user_friend_request ufr
LEFT JOIN users u ON ufr.user_id = u.id
WHERE friend_id=$user_id AND status_id=1
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
        echo $row['user_name'];
        echo '</a>';
        echo '</td>';
        echo '<td style="padding: 10px">';
        echo '<a href="profile.php?id=' . $row['user_id'] . '">';
        if ($row['avatar_img'] != null && $row['avatar_img'] != "")
            echo "<img src='$user_avatar_img_path/{$row['avatar_img']}' height=40/>";
        else
            echo "<img src='$user_avatar_default_img_path' height=40>";
        echo '</a>';
        echo '</td>';
        echo '<td>';
        echo '<a class="btn btn-success" href="profile_friend_request_process.php?action=accept&friend_id='
            . $row['user_id'] . '">Accept</a>';
        echo '</td>';
        echo '<td>';
        echo '<a class="btn btn-danger" href="profile_friend_request_process.php?action=ignore&friend_id='
            . $row['user_id'] . '">Ignore</a>';
        echo '</td>';
        echo '</tr>';
    }?>
</table>