<?php

function get_all_interests(mysqli $db_con): array
{
    $interests_arr = array();
    $stmt = $db_con->prepare("SELECT * FROM interests");
    $stmt->bind_result($interest_id, $interest_name);
    $stmt->execute();

    while ($stmt->fetch()) {
        $interests_arr[$interest_id] = $interest_name;
    }
    return $interests_arr;
}

?>