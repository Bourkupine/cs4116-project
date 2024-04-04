<?php

/**
 * Inserts an array of languages into the database associated with a user_id, status, and level
 * @param mysqli $db_con database connection
 * @param int $user_id associated user's user_id
 * @param array $language_ids ids of the user's languages
 * @param string $status learning or speaks the language
 * @param string $level level of fluency in the language
 * @return bool true if query is successful
 */
function add_user_languages(mysqli $db_con, int $user_id, array $language_ids, string $status, string $level): bool
{
    $data = array();
    foreach ($language_ids as $language_id) {
        $data[] = $user_id;
        $data[] = $language_id;
        $data[] = $status;
        $data[] = $level;
    }

    $values = str_repeat('(?, ?, ?, ?),', count($language_ids));
    $values = trim($values, ",");
    $values .= ";";
    $stmt = $db_con->prepare("INSERT INTO user_languages (user_id, language_id, status, level) VALUES $values");
    $types = str_repeat('iiss', count($language_ids));
    $stmt->bind_param($types, ...$data);

    return $stmt->execute();
}