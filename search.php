<?php $active = "trending"; ?>

<?php include '_header.php'; ?>
<?php include '_connect.php'; ?>

<link rel="stylesheet" href="css/dark_styles.css"/>

<!--
  finds things
  -->

<?php
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

<h2>Champion Search Results:</h2>

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

<?php include '_footer.php'; ?>
