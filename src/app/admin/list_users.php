<?php

function get_user_list(mysqli $db_con): array {

    $users_list = array();

    $stmt = $db_con->prepare("SELECT user_id, first_name, surname FROM profiles");
    $stmt->bind_result($user_id, $first_name, $surname);
    $stmt->execute();
    while ($stmt->fetch()) {
        $users_list[] = [$user_id, $first_name, $surname];
    }
    return $users_list;
}

function get_banned_users(mysqli $db_con): array {
    $time = date('Y-m-d H:i:s');
    $banned_users = array();

    $stmt = $db_con->prepare("SELECT user_id FROM bans WHERE expiry_date > ?");
    $stmt->bind_param("s", $time);
    $stmt->bind_result($banned_ids);
    $stmt->execute();

    while ($stmt->fetch()) {
        $banned_users[] = $banned_ids;
    }
    return $banned_users;
}
