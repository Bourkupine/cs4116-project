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

/**
 * Creates a rating
 * @param mysqli $db_con database connection
 * @param int $rating_user_id rating user id
 * @param int $rated_user_id rated user id
 * @param string $rating like or dislike
 * @return bool true if successful
 */
function create_rating(mysqli $db_con, int $rating_user_id, int $rated_user_id, string $rating): bool
{
    $stmt = $db_con->prepare("INSERT INTO user_ratings(rating_user_id, rated_user_id, rating) 
        VALUES(?, ?, ?)");
    $stmt->bind_param("iis", $rating_user_id, $rated_user_id, $rating);
    try {
        return $stmt->execute();
    } catch (Exception $e) {
        return false;
    }
}

/**
 * Gets a user's rating of another user if it exists
 * @param mysqli $db_con database connection
 * @param int $rating_user_id rating user
 * @param int $rated_user_id rated user
 * @return string | null rating or null if no rating exists
 */
function get_rating_of_user(mysqli $db_con, int $rating_user_id, int $rated_user_id): ?string
{
    $stmt = $db_con->prepare("SELECT rating FROM user_ratings WHERE rating_user_id = ? AND rated_user_id = ?");
    $stmt->bind_param("ii", $rating_user_id, $rated_user_id);
    $stmt->bind_result($rating);
    $stmt->execute();
    $stmt->fetch();
    return $rating;
}

function remove_rating(mysqli $db_con, int $rating_user_id, int $rated_user_id): bool
{
    $stmt = $db_con->prepare("DELETE FROM user_ratings WHERE rating_user_id = ? AND rated_user_id = ?");
    $stmt->bind_param("ii", $rating_user_id, $rated_user_id);
    return $stmt->execute();
}