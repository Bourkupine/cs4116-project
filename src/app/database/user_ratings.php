<?php
/**
 * Returns an array of user ids a given user has rated
 * @param mysqli $db_con database connection
 * @param int $user_id rating user's id
 * @return array array of rated user ids
 */

function get_rated_users_by_user_id(mysqli $db_con, int $user_id): array
{
    $rated_users_arr = array();
    $stmt = $db_con->prepare("SELECT rated_user_id FROM user_ratings WHERE rating_user_id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->bind_result($rated_user_id);
    $stmt->execute();

    while ($stmt->fetch()) {
        $rated_users_arr[] = $rated_user_id;
    }
    return $rated_users_arr;
}