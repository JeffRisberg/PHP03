<?php
/**
 * Created by PhpStorm.
 * User: Brandon
 * Date: 11/28/2014
 * Time: 6:34 PM
 *
 * Drill down page for a specific champion. Will show the artwork for them along with all the skin variations.
 * Buttons to favorite the champion, and to add/wish for the specified skin.
 */

include '_header.php';
include '_connect.php';
include 'css/_common_styles.php';

$champion_id = $_GET['id'];

//Select the skins for this champion
$sql = <<<SQL
SELECT * FROM skins
WHERE champion_id=$champion_id
ORDER BY date_created
SQL;

if (!$skin_result = mysqli_query($db_connection, $sql)) {
    die('There was an error running the query [' . mysqli_error($db_connection) . ']');
}

//Check if the user has already favorited this champion
$sql = <<<SQL
SELECT * FROM user_champion
WHERE champion_id=$champion_id AND user_id=$user_id
SQL;

if (!$champion_result = mysqli_query($db_connection, $sql)) {
    die('There was an error running the query [' . mysqli_error($db_connection) . ']');
}

if ($champion_result->num_rows == 0) { $b_champion_favorited = false;} else {$b_champion_favorited = true;}

//Check if the user already owns this skin
$sql = <<<SQL
SELECT * FROM user_skin_collection
WHERE skin_id=1 AND user_id=$user_id
SQL;

if (!$collection_result = mysqli_query($db_connection, $sql)) {
    die('There was an error running the query [' . mysqli_error($db_connection) . ']');
}

if ($collection_result->num_rows == 0) { $b_skin_collected = false;} else {$b_skin_collected = true;}

//Check if the user already wants this skin
$sql = <<<SQL
SELECT * FROM user_skin_wishlist
WHERE skin_id=1 AND user_id=$user_id
SQL;

if (!$wishlist_result = mysqli_query($db_connection, $sql)) {
    die('There was an error running the query [' . mysqli_error($db_connection) . ']');
}

if ($wishlist_result->num_rows == 0) { $b_skin_wished = false;} else {$b_skin_wished = true;}

?>

<style>
    .container2 {height: 637px; background-image: url('http://img4.wikia.nocookie.net/__cb20120912044527/leagueoflegends/images/thumb/a/a5/Morgana_OriginalSkin.jpg/1080px-Morgana_OriginalSkin.jpg')}
</style>

<div class="container2">
    <div style="margin-top: 50px">
        <select name="skin_select">
            <?php
                while($skin_row = $skin_result->fetch_assoc()) {
                    echo '<option value="' . $skin_row['id'] . '">' . $skin_row['name'] . '</option>';
                }
            ?>
        </select>
    </div>
    <div style="margin-top: 100px">
        <?php if (!$b_champion_favorited)
            echo '<button name="add-fav-champ" value="add_champion">Add Favorite Champion</button>';
        else
            echo '<button name="remove-fav-champ" value="remove_champion">Remove Favorite Champion</button>';
        ?>
    </div>
    <div style="margin-top: 15px">
        <?php if (!$b_skin_collected)
            echo '<button name="add-skin-collection" value="add_collection">Add to Collection</button>';
        else
            echo '<button name="remove-skin-collection" value="remove_collection">Remove from Collection</button>';
        ?>
    </div>
    <div style="margin-top: 15px">
        <?php if (!$b_skin_wished)
            echo '<button name="add-skin-wishlist" value="add_wishlist">Add to Wish List</button>';
        else
            echo '<button name="remove-skin-wishlist" value="remove_wishlist">Remove from Wish Lit</button>';
        ?>
    </div>
</div>