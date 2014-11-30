<?php $active = "profile"; ?>
<?php include '_header.php'; ?>
<?php include '_connect.php'; ?>
<?php include 'css/_common_styles.php'; ?>

<?php
$sql = <<<SQL
    SELECT *
    FROM users
    WHERE id=$user_id
SQL;

if (!$user_result = mysqli_query($db_connection, $sql)) {
    die('There was an error running the query [' . mysqli_error($db_connection) . ']');
}
$user = null;
if ($user_result->num_rows > 0) {
    $user = $user_result->fetch_assoc();
}

$sql = <<<SQL
   SELECT c.id as champion_id, c.name as champion_name
   FROM user_champion uc
   JOIN champions c ON uc.champion_id = c.id
   WHERE uc.user_id = $user_id
   ORDER BY uc.date_created
SQL;

if (!$user_champions_result = mysqli_query($db_connection, $sql)) {
    die('There was an error running the query [' . mysqli_error($db_connection) . ']');
}
?>

<?php if ($user != null) { ?>
    <div class="row page-body">
        <div class="col-md-4 basic-info">
            <div>
                <img src="http://cdn.myanimelist.net/images/userimages/1422487.jpg">
            </div>
            <div class="personal-info">
                <p>Name: <?php echo $user_name ?></p>

                <p>Joined: <?php echo $user['date_created'] ?></p>

                <p>Last Online: <?php echo $user['last_login'] ?></p>

                <p><a href="settings.php">Settings</a></p>
            </div>
        </div>
        <div class="col-md-5 col-md-offset-1 detailed-info">
            <h2 class="title-header">Favorite Champions</h2>
            <table>
                <?php $index = 1;
                while ($row = $user_champions_result->fetch_assoc()) {
                    echo '<tr>';
                    echo '<td class="favorite-champ-list-header">#' . $index . '</td>';
                    echo '<td class="favorite-champ-list-element">';
                    echo '<a href="show_champion.php?id=' . $row['champion_id'] . '">' . $row['champion_name'] . '</a>';
                    echo '</td>';
                    echo '</tr>';
                    $index = $index + 1;
                } ?>
            </table>
        </div>
    </div>
<?php } else { ?>
    <div class="row page-body">
        There is no user with that id.
    </div>
<?php } ?>

<?php include '_footer.php'; ?>