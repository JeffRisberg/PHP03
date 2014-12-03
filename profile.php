<?php $active = "profile"; ?>
<?php include '_header.php'; ?>
<?php include '_connect.php'; ?>
<?php include '_paths.php'; ?>

    <link rel="stylesheet" href="css/dark_styles.css"/>

    <!--
     A profile includes user information and user's favorite champions.
     -->

<?php
if (array_key_exists('id', $_GET))
    $id = $_GET['id'];
else
    $id = $user_id;

// Check if we are viewing our own profile or another
$my_profile = ($id == $user_id) ? true : false;

$sql = <<<SQL
    SELECT *
    FROM users
    WHERE id=$id
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
   WHERE uc.user_id = $id
   ORDER BY uc.date_created
   LIMIT 5
SQL;

if (!$user_champions_result = mysqli_query($db_connection, $sql)) {
    die('There was an error running the query [' . mysqli_error($db_connection) . ']');
}

$sql = <<<SQL
   SELECT u.*
   FROM user_friend uf
   JOIN users u ON uf.friend_id = u.id
   WHERE uf.user_id = $id
   LIMIT 5
SQL;

if (!$friends_result = mysqli_query($db_connection, $sql)) {
    die('There was an error running the query [' . mysqli_error($db_connection) . ']');
}

$sql = <<<SQL
   SELECT u.*
   FROM user_friend uf
   JOIN users u ON uf.friend_id = u.id
   WHERE uf.user_id = $id
   LIMIT 5
SQL;

if (!$friends_result = mysqli_query($db_connection, $sql)) {
    die('There was an error running the query [' . mysqli_error($db_connection) . ']');
}
?>

<?php if ($user != null) { ?>
    <?php if (!$my_profile) { ?>
        <div class="row">
            <h2>Viewing <?php echo $user['user_name']; ?>'s Profile.</h2>
            <a class="btn btn-priority" href="friend_request.php">Send Friend Request</a>
        </div>
    <?php } ?>
    <div class="row page-body">
        <div class="col-md-4 basic-info">
            <div>
                <?php if ($user['avatar_img'] != null && $user['avatar_img'] != "")
                    echo "<img src='$user_avatar_img_path/{$user['avatar_img']}' height=200/>";
                else
                    echo "<img src='$user_avatar_default_img_path' height=200>";
                ?>
            </div>
            <div class="personal-info">
                <p> Name: <?php echo $user['user_name'] ?></p>

                <p>Joined: <?php echo $user['date_created'] ?></p>

                <p>Last Online: <?php echo $user['last_login'] ?></p>

                <?php if ($my_profile) { ?>
                    <p><a href="profile_settings_form.php">Settings</a></p>
                <?php } ?>
            </div>
        </div>
        <div class="col-md-5 col-md-offset-1">
            <div class="detailed-info">
                <div class="title-header">Favorite Champions</div>
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
            <div style="height: 10px;"></div>
            <?php if ($friends_result->num_rows > 0) { ?>
                <div class="detailed-info">
                    <div class="title-header">Friends</div>
                    <table>
                        <?php
                        while ($row = $friends_result->fetch_assoc()) {
                            echo '<tr>';
                            echo '<td class="favorite-champ-list-element">';
                            echo '<a href="profile.php?id=' . $row['id'] . '">' . $row['user_name'] . '</a>';
                            echo '</td>';
                            echo '</tr>';
                        } ?>
                    </table>
                </div>
            <?php } ?>
        </div>
    </div>
<?php } else { ?>
    <div class="row page-body">
        There is no user with that id.
    </div>
<?php } ?>

<?php include '_footer.php'; ?>