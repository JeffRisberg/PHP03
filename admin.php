<?php $active = "admin"; ?>
<?php include '_header.php'; ?>
<?php include '_connect.php'; ?>

<div style="font-size: 25px; font-weight: bold; padding: 10px">
    Main Admin Screen
</div>

<div>
    <a class="btn btn-primary" href="admin_champion_list.php">Administrate Champions</a>
    <a class="btn btn-primary" href="admin_skin_list.php">Administrate Skins</a>
    <a class="btn btn-primary" href="admin_user_list.php">Administrate Users</a>
</div>

<div style="height: 200px"></div>

<?php include '_disconnect.php'; ?>
<?php include '_footer.php'; ?>
