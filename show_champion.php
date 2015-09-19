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
$skin_ownership_status = 'notOwned';

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

<div id="background_container" class="container2">
    <div class="ui-container">
        <div>
            <h1 class="champion-name"><?php echo $champion_info['name']; ?></h1>
            <h4 class="champion-title"><?php echo $champion_info['title']; ?></h4>
        </div>
        <?php if ($b_user_logged_in) { ?>
            <div style="margin-top: 20px">
                <form id="favorite_champion_form" action="champion_favorite_addremove.php"method="get">
                    <input id="id" name="id" type="hidden" value="<?php echo $champion_id ?>"/>
                    <input id="fav_champion_skin_id" name="skin_id" type="hidden" value=""/>
                    <input id="favorite_champion_form_action" type="hidden" name="action" value=""/>

                    <input type="submit" id="addFavoriteChampion" class='btn btn-success' style="display:none" value="Add Favorite Champion"/>
                    <input type="submit" id="removeFavoriteChampion" class='btn btn-danger' style="display:none" value="Remove Favorite Champion"/>
                </form>
            </div>
        <?php } ?>

        <form id="show_champion_form" action="skin_collection_addremove.php" method="get">
            <input id="id" name="id" type="hidden" value="<?php echo $champion_id ?>"/>
            <input id="skin_status" name="ownership_status" type="hidden" value=""/>

            <div style="margin-top: 100px">
                <select id="skin_select" name="skin_id">
                    <?php
                    while ($skin_row = $skin_result->fetch_assoc()) {
                        $this_skin_id = $skin_row['id'];

                        // set the default skin if one was not specified
                        if (!$skin_id && $skin_row['is_default']) { $skin_id = $this_skin_id;}

                        $selected = ($this_skin_id == $skin_id ? 'selected' : '');
                        echo "<option $selected value='$this_skin_id'>{$skin_row['name']} - \${$skin_row['cost']}</option>";
                    }
                    ?>
                </select>
            </div>
            <?php if ($b_user_logged_in) { ?>
                <div style="margin-top: 15px">
                    <input type="submit" id="addCollectButton" name="action" class='btn btn-success' style="display:none" value="Add to Collection"/>
                    <input type="submit" id="removeCollectButton" name="action" class='btn btn-danger' style="display:none" value="Remove from Wish List"/>
                </div>
                <div style="margin-top: 15px">
                    <input type="submit" id="addWishButton" name="action" class='btn btn-success' style="display:none" value="Add to Wish List"/>
                    <input type="submit" id="removeWishButton" name="action" class='btn btn-danger' style="display:none" value="Remove from Wish List"/>
                </div>
            <?php } ?>
        </form>
    </div>
</div>

<script>
    function selectSkinAjax() {
        console.log('selectSkinAjax called.')
        $.post("show_champion_ajax.php", { champion_id: $('#id').val(), skin_id: $('#skin_select').val() })
        .done(function (data) {
            // Change the image
            $('#background_container').css('background-image', 'url(' + data.image_url + ')');

            // Update hidden form fields
            $('#skin_status').val(data.ownership_status);
            $('#fav_champion_skin_id').val($('#skin_select').val());

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
    }

    function init_favorite_champion_ajax () {
        $.post("champion_favorite_ajax.php", { champion_id: $('#id').val()})
            .done(function (data) {
                // Change visibility of favorite champion buttons
                if (data.champion_favorited) {
                    $('#favorite_champion_form_action').val('remove');
                    $('#addFavoriteChampion').hide();
                    $('#removeFavoriteChampion').show();
                }
                else if (!data.champion_favorited) {
                    $('#favorite_champion_form_action').val('add');
                    $('#addFavoriteChampion').show();
                    $('#removeFavoriteChampion').hide();
                }
            });
    }

    $(document).ready(function () {
        // Initialize
        init_favorite_champion_ajax();
        selectSkinAjax();

        $('#skin_select').change(selectSkinAjax);
    });
</script>

<?php include '_disconnect.php'; ?>
<?php include '_footer.php'; ?>
