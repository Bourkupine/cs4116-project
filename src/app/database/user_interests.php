<?php

/**
 * Returns an array of interest ids associated with a given user
 * @param mysqli $db_con database connection
 * @param int $user_id user's id
 * @return array | null interest ids
 */
function get_user_interests_by_user_id(mysqli $db_con, int $user_id): ?array {
    $user_interest_ids = array();
    $stmt = $db_con->prepare("SELECT interest_id FROM user_interests WHERE user_id = ?");
    $stmt->bind_param("s", $user_id);
    $stmt->bind_result($user_interest_id);
    $stmt->execute();

    while ($stmt->fetch()) {
        $user_interest_ids[] = $user_interest_id;
    }
    return $user_interest_ids;
}

/**
 * Deletes all entries in the table with the specified id
 * @param mysqli $db_con database connection
 * @param int $user_id user's id
 * @return void
 */
function delete_all_user_interests(mysqli $db_con, int $user_id): void {
    $stmt = $db_con->prepare("DELETE FROM user_interests WHERE user_id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
}

/**
 * Inserts an entry into the user_interests table for each interest in interest_ids
 * * @param mysqli $db_con database connection
 * * @param int $user_id associated user's user_id
 * * @param array $interest_ids ids of the user's interests
 * * @return bool true if query is successful
 */
function add_user_interests(mysqli $db_con, int $user_id, array $interest_ids): bool
{
    $success = true;
    $stmt = $db_con->prepare("INSERT INTO user_interests VALUES(?, ?)");
    $stmt->bind_param("ii", $user_id, $interest_id);
    foreach ($interest_ids as $interest_id) {
        if (!$stmt->execute()) {
            $success = false;
            delete_all_user_interests($db_con, $user_id);
            break;
        }
    }
    return $success;
}