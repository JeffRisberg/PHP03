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

<header>
    <div style="float:right"><img src="img/php03_logo.png"/></div>
    <div style="font-weight: bold; font-size: 19px; padding: 5px">Welcome to the Skin Shop!</div>

    <table style="background-color: #cccccc; padding: 5px">
        <tr>
            <td style="padding: 5px"><a href="index.php">Home</a></td>
            <td style="padding: 5px"><a href="skins.php">Skins</a></td>
            <?php
            if ($b_user_logged_in == 1) {
                echo '<td style=/"padding: 5px/">Welcome back ' . $user_name . '</td>';
                echo '<td style="padding: 5px"><a href="logout.php">Log Out</a></td>';
            } else {
                echo '<td style="padding: 5px"><a href="login_form.php">Login</a></td>';
            }
            ?>
        </tr>
    </table>
</header>

<div class="container">