<?php

require "../database/database_connect.php";
require "../database/messages.php";

try {
    $db_con = connect();
} catch (Exception $e) {
    echo $e;
    exit();
}

$data = json_decode(file_get_contents('php://input'), true);

add_message($db_con, $data["connection-id"], $data["message"], $data["sender-id"]);