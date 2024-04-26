<?php

function check_user_banned(mysqli $db_con, int $user_id): bool
{
    $stmt = $db_con->prepare("SELECT expiry_date FROM bans WHERE user_id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->bind_result($result);
    $stmt->execute();
    $stmt->fetch();

    if (!is_null($result)) {
        if ($result > date('Y-m-d H:i:s')) {
            return true;
        }
    }
    return false;
}

function ban_user(mysqli $db_con, int $user_id, string $time, string $reason): void
{
    resolve_report($db_con, $user_id, true);

    $sql = "INSERT INTO bans VALUES (?, ?, ?)";
    $stmt = $db_con->prepare($sql);
    $stmt->bind_param("iss", $user_id, $time, $reason);
    $stmt->execute();

}

function unban_user(mysqli $db_con, int $user_id): void
{
    $stmt = $db_con->prepare("DELETE FROM bans WHERE user_id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
}
