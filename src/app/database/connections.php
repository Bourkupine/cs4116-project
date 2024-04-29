<?php

/**
 * Creates a connection between 2 users
 * @param mysqli $db_con database connection
 * @param int $user_1_id user 1
 * @param int $user_2_id user 2
 * @return bool true if successful
 */
function create_connection(mysqli $db_con, int $user_1_id, int $user_2_id): bool
{
    $stmt = $db_con->prepare("INSERT INTO connections(user_1_id, user_2_id) 
        VALUES(?, ?)");
    $stmt->bind_param("ii", $user_1_id, $user_2_id);
    return $stmt->execute();
}

function delete_connection(mysqli $db_con, int $user_1_id, int $user_2_id): bool
{
    $stmt = $db_con->prepare("DELETE FROM connections WHERE user_1_id = ? AND user_2_id = ?");
    $stmt->bind_param("ii", $user_1_id, $user_2_id);
    return $stmt->execute();
}

function does_connection_exist(mysqli $db_con, int $user_1_id, int $user_2_id): bool
{
    $sql = "SELECT COUNT(1) FROM connections WHERE user_1_id = ? AND user_2_id = ?";
    $stmt = $db_con->prepare($sql);
    $stmt->bind_param("ii", $user_1_id, $user_2_id);
    $stmt->bind_result($result);
    $stmt->execute();
    $stmt->fetch();
    return $result;
}

