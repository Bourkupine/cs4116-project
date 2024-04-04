<?php

/**
 * Inserts an array of languages into the database associated with a user_id, status, and level
**/



function add_user_languages(mysqli $db_con, int $user_id, array $language_ids, string $status, string $level): bool
{
    $query = "INSERT INTO user_languages (user_id, language_id, status, level) VALUES ";

    foreach ($language_ids as $language_id) {
        $query .= "($user_id, $language_id, $status, $level),";
    }

    $query = trim($query, ",");
    $query .= ";";

    $stmt = $db_con->prepare($query);
    return $stmt->execute();
}