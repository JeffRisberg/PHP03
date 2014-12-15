<?php
session_start();

if (array_key_exists('user_id', $_SESSION)) {
    $user_id = $_SESSION['user_id'];
    $user_name = $_SESSION['user_name'];
    $b_user_logged_in = 1;
    $b_user_is_admin = $_SESSION['is_admin'];
} else {
    $user_id = 0;
    $user_name = "";
    $b_user_logged_in = 0;
    $b_user_is_admin = 0;
}

if (array_key_exists('search_type', $_POST)) {
    $search_type = $_POST['search_type'];
    $_SESSION['search_type'] = $search_type;
}

if (array_key_exists('query', $_POST)) {
    $query = $_POST['query'];
    $_SESSION['search_str'] = $query;
}


if (array_key_exists('search_type', $_SESSION)) {
    $search_type = $_SESSION['search_type'];
} else {
    $search_type = "Champions";
}

if (array_key_exists('search_str', $_SESSION)) {
    $search_str = $_SESSION['search_str'];
} else {
    $search_str = "";
}