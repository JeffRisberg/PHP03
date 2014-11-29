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
include 'css/_common_styles.php';

?>

<style>
    .container2 {height: 637px; background-image: url('http://img4.wikia.nocookie.net/__cb20120912044527/leagueoflegends/images/thumb/a/a5/Morgana_OriginalSkin.jpg/1080px-Morgana_OriginalSkin.jpg')}
</style>

<div class="container2">
    <div style="margin-top: 50px">
        <select >
            <option value="default-skin">Default Skin</option>
            <option value="exiled-skin">Exiled Morgana</option>
            <option value="blademistress-skin">Blade Mistress Morgana</option>
            <option value="blackthorn-skin">Blackthorn Morgana</option>
            <option value="chef-skin">Sinful Succulence Morgana</option>
            <option value="chef-skin">Ghost Bride Morgana</option>
            <option value="chef-skin">Victorious Morgana</option>
        </select>
    </div>
    <div style="margin-top: 100px">
        <button name="add-fav-champ" value="Add to Favorite Champions">Add to Favorite Champions</button>
    </div>
    <div style="margin-top: 15px">
        <button name="add-skin-collection" value="Add to Collection">Add to Collection</button>
    </div>
    <div style="margin-top: 15px">
        <button name="add-skin-wishlist" value="Add to Wishlist">Add to Wish List</button>
    </div>
</div>