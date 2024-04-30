<?php

function get_messages(mysqli $db_con, int $connection_id) {
    $stmt = $db_con->prepare("SELECT sender_id, date, message FROM messages WHERE connection_id = ?");
    $stmt->bind_param("i", $connection_id);
    $stmt->execute();
    return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
}

function add_message(mysqli $db_con, int $connection_id, string $text, int $sender_id) {
    $stmt = $db_con->prepare("INSERT INTO messages(connection_id, sender_id, date, message) VALUES(?, ?, now(), ?)");
    $stmt->bind_param("iis", $connection_id, $sender_id, $text);
    $stmt->execute();
}