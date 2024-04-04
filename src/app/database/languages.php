<?php

/**
 * Gets all language names from the database
 * @param mysqli $connection connection to the database
 * @return array language names
 */
function get_all_languages(mysqli $connection): array
{
    $languages_arr = array();

    $sql = "SELECT language_name FROM languages";
    $result = $connection->query($sql);

    while ($row = $result->fetch_assoc()) {
        $languages_arr[] = $row["language_name"];
    }

    return $languages_arr;
}