<?php
    // Get latest member
    $latest_mem_query = mysqli_query($mysqli, "SELECT `username` FROM `users` WHERE id = (SELECT MAX(id) FROM `users`)");
    $latest_mem_row = mysqli_fetch_row($latest_mem_query);
    $latest_mem = $latest_mem_row[0];
    
    // Get list of invites
    $invite_list = mysqli_query($mysqli, "SELECT * FROM `invites` ORDER BY `uid` ASC");

    // Get List of users
    $user_list = mysqli_query($mysqli, "SELECT * FROM `users` ORDER BY `id` ASC");

    // Get num of users
    $user_num_query = mysqli_query($mysqli, "SELECT count(1) FROM `users`");
    $user_num_row = mysqli_fetch_row($user_num_query);
    $user_num = $user_num_row[0];

    // Get num of banned users
    $banned_user_num_query = mysqli_query($mysqli, "SELECT count(1) FROM `users` WHERE `banned` = 1");
    $banned_user_num_row = mysqli_fetch_row($banned_user_num_query);
    $banned_user_num = $banned_user_num_row[0];

    // Get num of not banned users
    $nbanned_user_num_query = mysqli_query($mysqli, "SELECT count(1) FROM `users` WHERE `banned` = 0");
    $nbanned_user_num_row = mysqli_fetch_row($nbanned_user_num_query);
    $nbanned_user_num = $nbanned_user_num_row[0];

    // Get num of active users
    $active_user_num_query = mysqli_query($mysqli, "SELECT count(1) FROM `users` WHERE `active` = 1");
    $active_user_num_row = mysqli_fetch_row($active_user_num_query);
    $active_user_num = $active_user_num_row[0];

    // Get all shoutbox messages
    $message_list = mysqli_query($mysqli, "SELECT * FROM shoutbox ORDER BY id DESC LIMIT 20");

    // Fetch data from services
    $service_query = mysqli_query($mysqli, "SELECT * FROM service");
    $service = mysqli_fetch_array($service_query);
?>