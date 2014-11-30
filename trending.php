<?php $active = "trending"; ?>
<?php include '_header.php'; ?>
<?php include '_connect.php'; ?>

<link rel="stylesheet" href="css/dark_styles.css"/>

<!--
  Shows what is hot.
  -->

<?php
$sql = <<<SQL
    SELECT champion_id, name, icon_img_url, count(user_id) as count
    FROM user_champion
    JOIN champions ON champion_id = champions.id
    GROUP BY champion_id
    ORDER BY Count(user_id) DESC
    LIMIT 10
SQL;

if (!$trending_champions_result = mysqli_query($db_connection, $sql)) {
    die('There was an error running the query [' . mysqli_error($db_connection) . ']');
}
?>

<h2>Recent trending champions:</h2>

<table>
    <?php
    while ($row = $trending_champions_result->fetch_assoc()) {
        echo '<tr class="trending-champ">';
        echo '<td style="padding: 10px">' . $row['name'] . '</td>';
        echo '<td style="padding: 10px">';
        echo '<a href="show_champion.php?id=' . $row['champion_id'] . '">';
        echo '<img height="40" src="' . $row['icon_img_url'] . '"/>';
        echo '</a>';
        echo '</td>';
        echo '<td style="padding: 10px">';
        echo 'Recent purchases: ' . $row['count'];
        echo '</td>';
        echo '</tr>';
    }?>
</table>

<?php include '_footer.php'; ?>
