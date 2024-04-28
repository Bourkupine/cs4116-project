<?php
require "../database/database_connect.php";
require "../database/user_ratings.php";
require "../database/connections.php";

session_start();

try {
    $db_con = connect();
} catch (Exception $e) {
    echo $e;
    exit();
}

function can_create_connection(mysqli $db_con, int $rating_user_id, int $rated_user_id): bool
{
    $ratings_rating = get_rating_of_user($db_con, $rating_user_id, $rated_user_id);
    $rateds_rating = get_rating_of_user($db_con, $rated_user_id, $rating_user_id);
    if ($ratings_rating && $rateds_rating) {
        return (strcasecmp($ratings_rating, "like") == 0) && (strcasecmp($rateds_rating, "like") == 0);
    }
    return false;
}

if (create_rating($db_con, $_POST["rating_user_id"], $_POST["rated_user_id"], $_POST["rating"])) {
    if (can_create_connection($db_con, $_POST["rating_user_id"], $_POST["rated_user_id"])) {
        create_connection($db_con, $_POST["rating_user_id"], $_POST["rated_user_id"]);
    }
    header("Location: ./");
}
$db_con->close();
die;
