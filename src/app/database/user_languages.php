<?php

/**
 * Inserts an entry into the user_languages table for each language in language_ids
 * @param mysqli $db_con database connection
 * @param int $user_id associated user's user_id
 * @param array $language_ids ids of the user's languages
 * @param string $status learning or speaks the language
 * @param string $level level of fluency in the language
 * @return bool true if query is successful
 */
function add_user_languages(mysqli $db_con, int $user_id, array $language_ids, string $status, string $level): bool
{
    $success = true;
    $stmt = $db_con->prepare("INSERT INTO user_languages VALUES(?, ?, ?, ?)");
    $stmt->bind_param("iiss", $user_id, $language_id, $status, $level);
    foreach ($language_ids as $language_id) {
        if (!$stmt->execute()) {
            $success = false;
            delete_all_user_languages($db_con, $user_id);
            break;
        }
    }
    return $success;
}

/**
 * Deletes all entries in the table with the specified id
 * @param mysqli $db_con database connection
 * @param int $user_id user's id
 * @return void
 */
function delete_all_user_languages(mysqli $db_con, int $user_id): void {
    $stmt = $db_con->prepare("DELETE FROM user_languages WHERE user_id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
}