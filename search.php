<?php $active = "trending"; ?>

<?php include '_header.php'; ?>
<?php include '_connect.php'; ?>
<?php include '_paths.php'; ?>

<link rel="stylesheet" href="css/dark_styles.css"/>

<!--
  finds things
  -->

<?php
if ($search_type == "Champions") {
    $sql = <<<SQL
    SELECT id, name, icon_img_url
    FROM champions
    WHERE name LIKE '%$search_str%'
    LIMIT 10
SQL;

    if (!$champion_search_result = mysqli_query($db_connection, $sql)) {
        die('There was an error running the query [' . mysqli_error($db_connection) . ']');
    }
    ?>

    <h3>Champion Search Results:</h3>

    <table>
        <?php
        while ($row = $champion_search_result->fetch_assoc()) {
            echo '<tr class="champion-result">';
            echo '<td style="padding: 10px">';
            echo '<a href="show_champion.php?id=' . $row['id'] . '">';
            echo $row['name'];
            echo '</a>';
            echo '</td>';
            echo '<td style="padding: 10px">';
            echo '<a href="show_champion.php?id=' . $row['id'] . '">';
            echo '<img height="40" src="' . $row['icon_img_url'] . '"/>';
            echo '</a>';
            echo '</td>';
            echo '</tr>';
        }?>
    </table>
<?php } ?>

<?php
if ($search_type == "Players") {
    $sql = <<<SQL
    SELECT id, user_name, avatar_img
    FROM users
    WHERE user_name LIKE '%$search_str%' and visibility != 2
    LIMIT 10
SQL;

    if (!$player_search_result = mysqli_query($db_connection, $sql)) {
        die('There was an error running the query [' . mysqli_error($db_connection) . ']');
    }
    ?>

    <h3>Player Search Results:</h3>

    <table>
        <?php
        while ($row = $player_search_result->fetch_assoc()) {
            echo '<tr class="player-result">';
            echo '<td style="padding: 10px">';
            echo '<a href="profile.php?id=' . $row['id'] . '">';
            echo $row['user_name'];
            echo '</a>';
            echo '</td>';
            echo '<td style="padding: 10px">';
            echo '<a href="profile.php?id=' . $row['id'] . '">';
            if ($row['avatar_img'] != null && $row['avatar_img'] != "")
                echo "<img src='$user_avatar_img_path/{$row['avatar_img']}' height=40/>";
            else
                echo "<img src='$user_avatar_default_img_path' height=40>";
            echo '</a>';
            echo '</td>';
            echo '</tr>';
        }?>
    </table>
<?php } ?>

<?php include '_footer.php'; ?>
