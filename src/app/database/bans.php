<?php

function check_user_banned(mysqli $db_con, int $user_id): bool
{
    $stmt = $db_con->prepare("SELECT expiry_date FROM bans WHERE user_id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->bind_result($result);
    $stmt->execute();
    $stmt->fetch();

    if (!is_null($result)) {
        echo "result found";
        print($result);
        if ($result > date('Y-m-d H:i:s')) {
            return true;
        }
    }
    return false;
}
