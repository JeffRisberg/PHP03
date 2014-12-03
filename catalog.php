<?php $active = "catalog"; ?>
<?php include '_header.php'; ?>
<?php include '_connect.php'; ?>

<link rel="stylesheet" href="css/dark_styles.css"/>

<!--
 Show the icons for a filtered set of champions.
 -->

<?php
if (array_key_exists('search_type', $_GET))
    $search_type = $_GET['search_type'];
else
    $search_type = "all";

if ($search_type == "myList")
    $sql = <<<SQL
SELECT * FROM champions c
LEFT JOIN user_champion uc ON uc.champion_id = c.id
WHERE uc.user_id = $user_id
SQL;
else if ($search_type == "myCollection")
    $sql = <<<SQL
SELECT * FROM champions c
LEFT JOIN skins s ON s.champion_id = c.id
LEFT JOIN user_skin_collection usc ON usc.skin_id = s.id
WHERE usc.user_id = $user_id and usc.ownership_status = 'collected'
SQL;
else if ($search_type == "myWishList")
    $sql = <<<SQL
SELECT * FROM champions c
LEFT JOIN skins s ON s.champion_id = c.id
LEFT JOIN user_skin_collection usc ON usc.skin_id = s.id
WHERE usc.user_id = $user_id and usc.ownership_status = 'wished'
SQL;
else // all
    $sql = <<<SQL
SELECT * FROM champions c
SQL;

if (!$result = mysqli_query($db_connection, $sql)) {
    die('There was an error running the query [' . mysqli_error($db_connection) . ']');
}

$num_champions = $result->num_rows;
?>

<div class="page-body">
    <div class="title-header">
        <select>
            <option <?php echo ($search_type == "all") ? "selected" : "" ?> value="all">All</option>
            <option <?php echo ($search_type == "myList") ? "selected" : "" ?> value="myList">My List</option>
            <option <?php echo ($search_type == "myCollection") ? "selected" : "" ?> value="myCollection">My
                Collection
            </option>
            <option <?php echo ($search_type == "myWishList") ? "selected" : "" ?> value="myWishList">My Wish List
            </option>
        </select>
    </div>
    <div class="catalog-list">
        <table>
            <?php
            while ($row = $result->fetch_assoc()) {
                echo '<div class="col-md-2 champion-icon">';
                echo '<figure>';
                echo '<div style="width: 120px">';
                echo '<a href="show_champion.php?id=' . $row['id'] . '">';
                echo '<img src=' . $row['icon_img_url'] . ' href="" style="align-content: center">';
                echo '</a>';
                echo '<figcaption style="align-content: center">' . $row['name'] . '</figcaption>';
                echo '</div>';
                echo '</figure>';
                echo '</div>';
            }
            ?>
        </table>
    </div>
</div>