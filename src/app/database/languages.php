<?php

/**
 * Gets all language names from the database
 * @param mysqli $db_con connection to the database
 * @return array language names
 */
function get_all_languages(mysqli $db_con): array
{
    $languages_arr = array();
    $stmt = $db_con->prepare("SELECT * FROM languages");
    $stmt->bind_result($language_id, $language_name);
    $stmt->execute();

    while ($stmt->fetch()) {
        $languages_arr[$language_id] = $language_name;
    }
    return $languages_arr;
}

/**
 * Gets the language name associated with the given language id
 * @param mysqli $db_con database connection
 * @param int $language_id language id
 * @return string language name
 */
function get_language_name_by_language_id(mysqli $db_con, int $language_id): string {
    $stmt = $db_con->prepare("SELECT language_name FROM languages WHERE language_id = ?");
    $stmt->bind_param("i", $language_id);
    $stmt->bind_result($language_name);
    $stmt->execute();
    $stmt->fetch();
    return $language_name;
}