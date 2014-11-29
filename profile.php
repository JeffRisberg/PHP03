<?php $active = "profile"; ?>
<?php include '_header.php'; ?>
<?php include 'css/_common_styles.php'; ?>

<div class="row page-body">
    <div class="col-md-4 basic-info">
        <div>
            <img src="http://cdn.myanimelist.net/images/userimages/1422487.jpg">
        </div>
        <div class="personal-info">
            <ul>
                <li>Name: <?php echo $user_name ?></li>
                <li>Joined: 11/28/2014</li>
                <li>Last Online: 11/28/2014</li>
                <li><a href="settings.php">Settings</a></li>
            </ul>
        </div>
    </div>
    <div class="col-md-5 col-md-offset-1 detailed-info">
        <h2 class="title-header">Favorite Champions</h2>
        <table>
            <tr>
                <td class="favorite-champ-list-header">#1</td>
                <td class="favorite-champ-list-element">Morgana</td>
            </tr>
            <tr>
                <td class="favorite-champ-list-header">#2</td>
                <td class="favorite-champ-list-element">Varus</td>
            </tr>
            <tr>
                <td class="favorite-champ-list-header">#3</td>
                <td class="favorite-champ-list-element">Swain</td>
            </tr>
            <tr>
                <td class="favorite-champ-list-header">#4</td>
                <td class="favorite-champ-list-element">Jarvan</td>
            </tr>
            <tr>
                <td class="favorite-champ-list-header">#5</td>
                <td class="favorite-champ-list-element">Vi</td>
            </tr>
        </table>
    </div>
</div>