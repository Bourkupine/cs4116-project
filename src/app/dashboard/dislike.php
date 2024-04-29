<?php
require "../database/database_connect.php";
require "../database/user_ratings.php";

session_start();

try {
    $db_con = connect();
} catch (Exception $e) {
    echo $e;
    exit();
}

if (create_rating($db_con, $_POST["rating_user_id"], $_POST["rated_user_id"], $_POST["rating"])) {
    header("Location: ./");
}
$db_con->close();
die;
