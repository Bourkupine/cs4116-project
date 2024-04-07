<?php

function get_all_interests(mysqli $connection): array
{
    $interests_arr = array();

    $sql = "SELECT * FROM interests";
    $result = $connection->query($sql);

    while ($row = $result->fetch_assoc()) {
        $interests_arr[$row["interest_id"]] = $row["interest_name"];
    }

    return $interests_arr;
}

?>