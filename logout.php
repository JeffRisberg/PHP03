<?php
session_start();
unset($_SESSION['user_id']);
unset($_SESSION['user_name']);
$b_user_logged_in = 0;
$user_name = NULL;

header('Location: index.php');