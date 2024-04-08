<?php

/**
 * Returns an array of interest ids associated with a given user
 * @param mysqli $db_con database connection
 * @param int $user_id user's id
 * @return array | null interest ids
 */
function get_user_interests_by_user_id(mysqli $db_con, int $user_id): ?array {
    $stmt = $db_con->prepare("SELECT interest_id FROM user_interests WHERE user_id = ?");
    $stmt->bind_param("s", $user_id);
    $stmt->execute();
    return ($stmt->get_result()->fetch_assoc());
}