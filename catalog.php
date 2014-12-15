<?php $active = "catalog"; ?>
<?php include '_header.php'; ?>
<?php include '_connect.php'; ?>

<link rel="stylesheet" href="css/dark_styles.css"/>

<!--
 Show the icons for a filtered set of champions.
 -->

<?php
if (array_key_exists('catalog_search_type', $_GET))
    $catalog_search_type = $_GET['catalog_search_type'];
else
    $catalog_search_type = "all";

if (array_key_exists('id', $_GET))
    $id = $_GET['id'];
else
    $id = $user_id;

// Check if we are viewing our own catalog or another
$my_catalog = ($id == $user_id) ? true : false;

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

if ($catalog_search_type == "myList")
    $sql = <<<SQL
SELECT c.id as id, c.name as name, c.title as title, c.icon_img_url as icon_img_url, r.name as role
FROM champions c
LEFT JOIN champion_roles r ON c.role_id = r.id
LEFT JOIN user_champion uc ON uc.champion_id = c.id
WHERE uc.user_id = $id
SQL;
else if ($catalog_search_type == "myCollection")
    $sql = <<<SQL
SELECT c.id as id, c.name as name, c.title as title, c.icon_img_url as icon_img_url, r.name as role
FROM champions c
LEFT JOIN champion_roles r ON c.role_id = r.id
LEFT JOIN skins s ON s.champion_id = c.id
LEFT JOIN user_skin_collection usc ON usc.skin_id = s.id
WHERE usc.user_id = $id and usc.ownership_status = 'collected'
SQL;
else if ($catalog_search_type == "myWishList")
    $sql = <<<SQL
SELECT c.id as id, c.name as name, c.title as title, c.icon_img_url as icon_img_url, r.name as role
FROM champions c
LEFT JOIN champion_roles r ON c.role_id = r.id
LEFT JOIN skins s ON s.champion_id = c.id
LEFT JOIN user_skin_collection usc ON usc.skin_id = s.id
WHERE usc.user_id = $id and usc.ownership_status = 'wished'
SQL;
else // all
    $sql = <<<SQL
SELECT c.id as id, c.name as name, c.title as title, c.icon_img_url as icon_img_url, r.name as role
FROM champions c
LEFT JOIN champion_roles r ON c.role_id = r.id
SQL;

if (!$champions_result = mysqli_query($db_connection, $sql)) {
    die('There was an error running the query [' . mysqli_error($db_connection) . ']');
}

$sql = <<<SQL
    SELECT champion_id, count(user_id) as user_count
    FROM user_champion
    JOIN champions ON champion_id = champions.id
    GROUP BY champion_id
    ORDER BY COUNT(user_id) DESC
SQL;

if (!$trending_champions_result = mysqli_query($db_connection, $sql)) {
    die('There was an error running the query [' . mysqli_error($db_connection) . ']');
}

$champion_user_counts = array();

while ($row = $trending_champions_result->fetch_assoc()) {
    $champion_id = $row['champion_id'];
    $user_count = $row['user_count'];

    $champion_user_counts[$champion_id] = $user_count;
}
?>

<?php if ($my_catalog) { ?>
    <?php if ($b_user_logged_in) { ?>
        <div class="row">
            <h2>Your Collection</h2>
        </div>
    <?php } ?>
<?php } ?>
<?php if (!$my_catalog) { ?>
    <div class="row">
        <h2>Viewing <?php echo $user['user_name']; ?>'s Collection</h2>
    </div>
<?php } ?>
<div class="catalog-heading">
    <input id="id" type="hidden" value="<?php echo $id ?>"/>
    <div class="title-header">
        <select id="catalog_search_type">
            <option <?php echo ($catalog_search_type == "all") ? "selected" : "" ?> value="all">All</option>
            <?php if ($b_user_logged_in) { ?>
                <option <?php echo ($catalog_search_type == "myList") ? "selected" : "" ?> value="myList">Favorite Champions</option>
                <option <?php echo ($catalog_search_type == "myCollection") ? "selected" : "" ?> value="myCollection">Skin Collection
                </option>
                <option <?php echo ($catalog_search_type == "myWishList") ? "selected" : "" ?> value="myWishList">Wish List
                </option>
            <?php } ?>
        </select>
    </div>
    <div class="catalog-list">
        <table>
            <?php
            while ($row = $champions_result->fetch_assoc()) {
                $champion_id = $row['id'];
                echo '<div class="col-md-2 champion-icon">';
                echo '<figure>';
                echo '<div style="width: 120px">';
                echo '<a href="show_champion.php?id=' . $champion_id . '">';
                echo '<img src="' . $row['icon_img_url'] . '" style="align-content: center">';
                echo '</a>';
                echo '<figcaption style="align-content: center">';
                echo '<a href="show_champion.php?id=' . $champion_id . '">';
                echo $row['name'];
                echo '</a>';
                echo '</figcaption>';
                echo '</div>';
                echo '</figure>';
                echo '<div class="tongue-content">';
                echo $row['role'] . '<br/><br/>' . $row['title'];
                if (array_key_exists($champion_id, $champion_user_counts)) {
                    echo '<br/>' . $champion_user_counts[$champion_id] . ' favorites';
                }
                echo '</div>';
                echo '</div>';
            }
            ?>
        </table>
    </div>
</div>

<script type="text/javascript" src="js/jquery.tongue.min.js"></script>

<script>
    $(document).ready(function () {
        $('#catalog_search_type').change(
            function () {
                catalog_search_type = $('#catalog_search_type').val();
                console.log(catalog_search_type);
                window.location.href = ('catalog.php?id=' + $('#id').val() + '&catalog_search_type=' + catalog_search_type);
            });
        $('.champion-icon').tongue({position: 'top', start_speed: 500, end_speed: 300});
    });
</script>

<?php include '_disconnect.php'; ?>
<?php include '_footer.php'; ?>
