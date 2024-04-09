<?php

/**
 * Gets the interest name associated with a given interest id
 * @param mysqli $db_con database connection
 * @param int $interest_id interest id
 * @return string interest name
 */
function get_interest_name_by_interest_id(mysqli $db_con, int $interest_id): string {
    $stmt = $db_con->prepare("SELECT interest_name FROM interests WHERE interest_id = ?");
    $stmt->bind_param("i", $interest_id);
    $stmt->bind_result($interest_name);
    $stmt->execute();
    $stmt->fetch();
    return $interest_name;
}