<?php

require_once "../database/database_connect.php";
require_once "../database/profiles.php";
require_once "modal_body.php";

try {
    $connection = connect();
} catch (Exception $e) {
    $code = $e->getCode();
    $message = $e->getMessage();
    $file = $e->getFile();
    $line = $e->getLine();
    echo "<script> console.log(\"Exception thrown in $file on line $line: [Code $code] $message\"); </script>";
}

if (isset($_POST['action'])) {
    $action = $_POST['action'];
}

switch ($action) {
    case 'delete-user':
        $user_name = get_name_by_user_id($connection, intval($_POST['id']));
        $user_info = [$_POST['id'], $user_name[0], $user_name[1]];
        delete_account_body($user_info);

        exit();
}


?>
