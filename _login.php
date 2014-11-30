<?php
session_start();

if (array_key_exists('user_id', $_SESSION)) {
    $user_id = $_SESSION['user_id'];
    $user_name = $_SESSION['user_name'];
    $b_user_logged_in = 1;
    $b_user_is_admin = $_SESSION['is_admin'];
} else {
    $b_user_logged_in = 0;
    $b_user_is_admin = 0;
}