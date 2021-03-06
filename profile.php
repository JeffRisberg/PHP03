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

$sql = <<<SQL
   SELECT u.*, ufr.date_created
   FROM user_friend_request ufr
   JOIN users u ON ufr.friend_id = u.id
   WHERE ufr.user_id = $id AND ufr.status_id = 1
   LIMIT 5
SQL;

if (!$friends_pending_result = mysqli_query($db_connection, $sql)) {
    die('There was an error running the query [' . mysqli_error($db_connection) . ']');
}

// Check friend request status
$b_friend_requested = false;
$b_friended = false;
$sql = <<<SQL
   SELECT *
   FROM user_friend uf
   WHERE uf.user_id = $user_id AND uf.friend_id = $id
SQL;

if (!$friend_status_result = mysqli_query($db_connection, $sql)) {
    die('There was an error running the query [' . mysqli_error($db_connection) . ']');
}
else {
    if ($friend_status_result->num_rows != 0) {
        $b_friended = true;
    }
}

$sql = <<<SQL
   SELECT *
   FROM user_friend_request ufr
   WHERE ufr.user_id = $user_id AND ufr.friend_id = $id
SQL;

if (!$friend_status_result = mysqli_query($db_connection, $sql)) {
    die('There was an error running the query [' . mysqli_error($db_connection) . ']');
}
else {
    if ($friend_status_result->num_rows != 0) {
        $row = $friend_status_result->fetch_assoc();
        if ($row['status_id'] == 1 || $row['status_id'] == 3) {
            $b_friend_requested = true;
        }
    }
}

?>

<?php if ($user != null) { ?>
    <?php if ($my_profile) { ?>
        <div class="row">
            <h2>Your Profile</h2>
        </div>
    <?php } ?>
    <?php if (!$my_profile) { ?>
        <div class="row">
            <h2>Viewing <?php echo $user['user_name']; ?>'s Profile</h2>
        </div>
    <?php } ?>
    <div class="row page-body">
        <div class="col-md-4 basic-info profile-leftcell">
            <div>
                <?php if ($user['avatar_img'] != null && $user['avatar_img'] != "")
                    echo "<img src='$user_avatar_img_path/{$user['avatar_img']}' height=200/>";
                else
                    echo "<img src='$user_avatar_default_img_path' height=200>";
                ?>
            </div>
            <div class="personal-info">
                <p>User Name: <?php echo $user['user_name'] ?></p>

                <p>Name: <?php echo $user['name'] ?></p>

                <p>Joined: <?php echo $user['date_created'] ?></p>

                <p>Last Online: <?php echo $user['last_login'] ?></p>

                <p><a href="catalog.php?id=<?php echo $id ?>&catalog_search_type=myCollection">Skin Collection</a></p>

                <p><a href="catalog.php?id=<?php echo $id ?>&catalog_search_type=myWishList">Wish List</a></p>

                <?php if ($my_profile) { ?>
                    <p><a href="profile_list_requests.php">Friend Requests Received</a></p>
                    <p><a href="profile_settings_form.php">Settings</a></p>
                <?php } ?>

                <?php if (!$my_profile) { ?>
                    <?php if ($b_friended) { ?>
                        <p><a href="">Remove Friend</a></p> <!-- TODO: Implement removal of friends -->
                    <?php }
                    else { ?>
                        <?php if (!$b_friend_requested) { ?>
                            <p><a href="profile_friend_request_addcancel.php?action=add&friend_id=<?php echo $id; ?>">Send Friend Request</a></p>
                        <?php }
                        else { ?>
                            <p><a href="profile_friend_request_addcancel.php?action=cancel&friend_id=<?php echo $id; ?>">Cancel Friend Request</a></p>
                        <?php } ?>
                    <?php } ?>
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
            <div style="height: 10px;"></div>
            <?php if ($friends_pending_result->num_rows > 0) { ?>
                <div class="detailed-info">
                    <div class="title-header">Friend Requests Made</div>
                    <table>
                        <?php
                        while ($row = $friends_pending_result->fetch_assoc()) {
                            echo '<tr>';
                            echo '<td class="favorite-champ-list-element">';
                            echo '<a href="profile.php?id=' . $row['id'] . '">' . $row['user_name'] . '</a>';
                            echo ' <span style="font-size: 14px">on ' . date("F j, Y", strtotime($row['date_created'])) . '</span>';
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

<?php include '_disconnect.php'; ?>
<?php include '_footer.php'; ?>