<?php

require_once "../database/messages.php";
require_once "../database/database_connect.php";

try {
    $db_con = connect();
} catch (Exception $e) {
    echo $e;
}
$data = get_messages($db_con, $_POST["connection_id"]);
echo json_encode(get_messages($db_con, $_POST["connection_id"]));

