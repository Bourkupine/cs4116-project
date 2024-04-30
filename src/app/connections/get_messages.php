<?php

require_once "../database/messages.php";
require_once "../database/database_connect.php";

try {
    $db_con = connect();
} catch (Exception $e) {
    echo $e;
}

$data = json_decode(file_get_contents('php://input'), true);

echo json_encode(get_messages($db_con, $data["connection_id"]));


