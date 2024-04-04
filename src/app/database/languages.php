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