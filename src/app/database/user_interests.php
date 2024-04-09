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

function update_user_interests_by_id(mysqli $dbcon, int $user_id, array $user_interests): ?array
{

    $current_user_interests[]=get_user_interests_by_user_id($dbcon,$user_id);
    for ($i = 0; $i < sizeof($current_user_interests); $i++) {
        if($current_user_interests[$i] != $user_interests[$i]){
            $current_user_interests[$i] = $user_interests[$i];
        }
 }
    $stmt = $dbcon->prepare("UPDATE user_interests SET interest_id WHERE user_id =?");
    $stmt->bind_param("i", $interest_id);
    $stmt->bind_result($user_interest_id);
    $stmt->execute();
}