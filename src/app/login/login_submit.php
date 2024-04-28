<?php
require "../database/database_connect.php";
require "../database/users.php";
require "../database/bans.php";

session_start();

try {
    $db_con = connect();
} catch (Exception $e) {
    echo $e;
    exit();
}

$hash = get_password_by_email($db_con, $_POST["email"]);
if ($hash) {
    $match = password_verify($_POST["password"], $hash);
    $user_id = get_user_id($db_con, $_POST["email"], $hash);
}

if ($user_id && $match) {

    $_SESSION['account_type'] = get_account_type_by_user_id($db_con, $user_id);

    if (check_user_banned($db_con, $user_id)) {
        $_SESSION['banned'] = true;
        header("Location: index.php");
        $db_con->close();
        die;
    }

    $_SESSION["email"] = $_POST["email"];
    $_SESSION["password"] = $_POST["password"];
    $_SESSION["logged-in"] = true;

    if ($_SESSION['account_type'] == 'admin') {
        header("Location: ../admin");
    } else {
        $_SESSION += get_profile_details($db_con, $user_id);

        if (isset($_COOKIE["first_timer_" . $user_id])) {
            unset($_COOKIE["first_timer_" . $user_id]);
            setcookie("first_timer_" . $user_id, '', -1, '/', false);
            header("Location: ../profile");
        } else {
            header("Location: ../dashboard");
        }
} else {
    $_SESSION["login-failure"] = true;
    header("Location: index.php");
}
$db_con->close();
die;
