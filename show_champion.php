<?php $active = "catalog"; ?>
<?php
/**
 * Drill down page for a specific champion. Will show the artwork for them along with all the skin variations.
 * Buttons to favorite the champion, and to add/wish for the specified skin.
 */

include '_header.php';
include '_connect.php';
include 'css/_common_styles.php';

$champion_id = $_GET['id'];
if (array_key_exists('skin_id', $_GET))
    $skin_id = $_GET['skin_id'];
else
    $skin_id = 1; // should query for default

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
$b_champion_favorited = false;
$b_skin_collected = false;
$b_skin_wished = false;

if ($b_user_logged_in) {
    $sql = <<<SQL
SELECT * FROM user_champion
WHERE champion_id=$champion_id AND user_id=$user_id
SQL;

    if (!$champion_result = mysqli_query($db_connection, $sql)) {
        die('There was an error running the query [' . mysqli_error($db_connection) . ']');
    }

    if ($champion_result->num_rows > 0) {
        $b_champion_favorited = true;
    }

    //Check if the user already owns this skin
    $sql = <<<SQL
SELECT * FROM user_skin_collection
WHERE skin_id=$skin_id AND user_id=$user_id
SQL;

    if (!$collection_result = mysqli_query($db_connection, $sql)) {
        die('There was an error running the query [' . mysqli_error($db_connection) . ']');
    }

    if ($collection_result->num_rows > 0) {
        $b_skin_collected = true;
    }

    //Check if the user already wants this skin
    $sql = <<<SQL
SELECT * FROM user_skin_wishlist
WHERE skin_id=$skin_id AND user_id=$user_id
SQL;

    if (!$wishlist_result = mysqli_query($db_connection, $sql)) {
        die('There was an error running the query [' . mysqli_error($db_connection) . ']');
    }

    if ($wishlist_result->num_rows > 0) {
        $b_skin_wished = true;
    }
}
?>

<style>
    .container2 {
        height: 637px;
        background-image: url('http://img4.wikia.nocookie.net/__cb20120912044527/leagueoflegends/images/thumb/a/a5/Morgana_OriginalSkin.jpg/1080px-Morgana_OriginalSkin.jpg')
    }
</style>

<div class="container2">
    <form id="show_champion_form" action="show_champion.php">
        <input type="hidden" name="id" value="<?php echo $champion_id ?>"/>

        <div style="margin - top: 50px">
            <select id="skin_select" name="skin_id">
                <?php
                while ($skin_row = $skin_result->fetch_assoc()) {
                    $this_skin_id = $skin_row['id'];
                    $selected = ($this_skin_id == $skin_id ? 'selected' : '');
                    echo "<option $selected value='$this_skin_id'>{$skin_row['name']}</option>";
                }
                ?>
            </select>
        </div>
    </form>
    <div style="margin - top: 100px">
        <?php if ($b_user_logged_in) { ?>
            <?php if (!$b_champion_favorited)
                echo "<a class='btn btn-success' href='champion_favorite_addremove.php?action=add&champion_id=$champion_id'>Add Favorite Champion</a>";
            else
                echo "<a class='btn btn-danger' href='champion_favorite_addremove.php?action=remove&champion_id=$champion_id'>Remove Favorite Champion</a>";
            ?>
        <?php } ?>
    </div>
    <div style="margin - top: 15px">
        <?php if ($b_user_logged_in) { ?>
            <?php if (!$b_skin_collected)
                echo "<a class='btn btn-success' href='skin_collection_addremove.php?action=add&champion_id=$champion_id&skin_id=$skin_id''>Add to Collection</a>";
            else
                echo "<a class='btn btn-danger' href='skin_collection_addremove.php?action=remove&champion_id=$champion_id&skin_id=$skin_id'>Remove from Collection</a>";
            ?>
        <?php } ?>
    </div>
    <div style="margin - top: 15px">
        <?php if ($b_user_logged_in) { ?>
            <?php if (!$b_skin_collected) {
                if (!$b_skin_wished)
                    echo "<a class='btn btn-success' href='skin_wishlist_addremove.php?action=add&champion_id=$champion_id&skin_id=$skin_id'>Add to Wish List</a>";
                else
                    echo "<a class='btn btn-danger' href='skin_wishlist_addremove.php?action=remove&champion_id=$champion_id&skin_id=$skin_id'>Remove from Wish List</a>";
            }
            ?>
        <?php } ?>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('#skin_select').change(function () {
            $('#show_champion_form').submit();
        });
    });
</script>