<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="css/styles.css"/>
    <link rel="stylesheet" href="css/bootstrap.min.css"/>
    <link rel="stylesheet" href="css/bootstrap-theme.min.css"/>

    <script src="js/jquery-1.11.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</head>
<body>

<?php include '_login.php'; ?>

<!-- Fixed navbar -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                    aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">The Skin Shop</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li <?php if ($active == 'index') echo 'class="active"' ?>><a href="index.php">Home</a></li>
                <li <?php if ($active == 'trending') echo 'class="active"' ?>><a href="trending.php">Trending</a></li>
                <li <?php if ($active == 'catalog') echo 'class="active"' ?>><a href="catalog.php">Catalog</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <?php if ($b_user_logged_in) { ?>
                    <li <?php if ($active == 'profile') echo 'class="active"' ?>>
                        <a href="profile.php">Profile</a>
                    </li>
                    <li><a href="logout.php">Logout</a></li>
                <?php } else { ?>
                    <li <?php if ($active == 'login_form') echo 'class="active"' ?>>
                        <a href="login_form.php">Login</a>
                    </li>
                <?php } ?>
            </ul>
        </div>
        <!--/.nav-collapse -->
    </div>
</nav>

<div class="container" style="margin-top: 60px">