<?php $active = "catalog"; ?>
<?php include '_header.php'; ?>
<?php include '_connect.php'; ?>

<link rel="stylesheet" href="css/dark_styles.css"/>

<!--
 Drill down page for a specific champion. Will show the artwork for them along with all the skin variations.
 Buttons to favorite the champion, and to add/wish for the specified skin.
-->

<?php
$champion_id = $_GET['id'];
if (array_key_exists('skin_id', $_GET))
    $skin_id = $_GET['skin_id'];
else
    $skin_id = 1; // should query for default

//Query champion information
$sql = <<<SQL
SELECT * FROM champions
WHERE id=$champion_id
SQL;

if (!$champion_info_result = mysqli_query($db_connection, $sql)) {
    die('There was an error running the query [' . mysqli_error($db_connection) . ']');
}
$champion_info = $champion_info_result->fetch_assoc();

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
$skin_ownership_status = 'notOwned';

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

    $skin_ownership_status = 'notOwned';
    if ($collection_result->num_rows > 0) {
        $row = $collection_result->fetch_assoc();
        $skin_ownership_status = $row['ownership_status'];
    }
}
?>

<style>
    .container2 {
        height: 637px;
    }

    .champion-name {
        color: #e3e3e3;
    }

    .champion-title {
        color: #269abc;
    }

    .ui-container {
        margin-left: 50px;
        padding-top: 20px;
    }
</style>

<div id="background_container" class="container2"
     style="background-image: url('img/skins/<?php echo $skin_id; ?>-1080px.jpg')">
    <div class="ui-container">
        <div>
            <h1 class="champion-name"><?php echo $champion_info['name']; ?></h1>
            <h4 class="champion-title"><?php echo $champion_info['title']; ?></h4>
        </div>
        <div style="margin-top: 20px">
            <?php if ($b_user_logged_in) { ?>
                <?php if (!$b_champion_favorited)
                    echo "<a class='btn btn-success' href='champion_favorite_addremove.php?action=add&champion_id=$champion_id&skin_id=$skin_id'>Add Favorite Champion</a>";
                else
                    echo "<a class='btn btn-danger' href='champion_favorite_addremove.php?action=remove&champion_id=$champion_id&skin_id=$skin_id'>Remove Favorite Champion</a>";
                ?>
            <?php } ?>
        </div>

        <form id="show_champion_form" action="skin_collection_addremove.php" method="get">
            <input id="id" name="id" type="hidden" value="<?php echo $champion_id ?>"/>
            <input id="skin_status" name="ownership_status" type="hidden" value=""/>

            <div style="margin-top: 100px">
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
            <div style="margin-top: 15px">
                <input type="submit" id="addCollectButton" name="action" class='btn btn-success' style="display:none" value="Add to Collection"/>
                <input type="submit" id="removeCollectButton" name="action" class='btn btn-danger' style="display:none" value="Remove from Wish List"/>
            </div>
            <div style="margin-top: 15px">
                <input type="submit" id="addWishButton" name="action" class='btn btn-success' style="display:none" value="Add to Wish List"/>
                <input type="submit" id="removeWishButton" name="action" class='btn btn-danger' style="display:none" value="Remove from Wish List"/>
            </div>
        </form>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('#skin_select').change(function () {
            $.post("show_champion_ajax.php", { champion_id: $('#id').val(), skin_id: $('#skin_select').val() })
                .done(function (data) {
                    // Change the image
                    $('#background_container').css('background-image', 'url(' + data.image_url + ')');

                    // Update hidden form fields
                    $('#skin_status').val(data.ownership_status);

                    // Change the visibility of the buttons
                    if (data.ownership_status == 'notOwned') { // no record of skin, allow buy and wish
                        $('#addCollectButton').show();
                        $('#removeCollectButton').hide();
                        $('#addWishButton').show();
                        $('#removeWishButton').hide();
                    }
                    if (data.ownership_status == 'collected') { // we own the skin, only allow removal
                        $('#addCollectButton').hide();
                        $('#removeCollectButton').show();
                        $('#addWishButton').hide();
                        $('#removeWishButton').hide();
                    }
                    if (data.ownership_status == 'wished') { // skin on wishlist, remove from wish and update record
                        $('#addCollectButton').show();
                        $('#removeCollectButton').hide();
                        $('#addWishButton').hide();
                        $('#removeWishButton').show();
                    }
                    else {
                        // error, invalid return result for ownership_status
                    }
                });
        });
    });
</script>

<?php include '_footer.php'; ?>
