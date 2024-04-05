<?php
require "../database/database_connect.php";
require "../database/users.php";

session_start();

try {
    $db_con = connect();
} catch (Exception $e) {
    echo $e;
    exit();
}

$user_id = get_user_id($db_con, $_POST["email"], $_POST["password"]);

if ($user_id) {
    $_SESSION["email"] = $_POST["email"];
    $_SESSION["password"] = $_POST["password"];
    $_SESSION += get_profile_details($db_con, $user_id);
    $_SESSION["logged-in"] = true;
    header("Location: ../dashboard");
} else {
    $_SESSION["login-failure"] = true;
    header("Location: index.php");
}
$db_con->close();
die;
