<?php
require "../database/users.php";
require "../database/profiles.php";
require "../database/user_languages.php";

/**
 * Checks if the passwords are identical
 * @param $pass1 string password
 * @param $pass2 string re-entered password
 * @return bool
 */
function validate_password(string $pass1, string $pass2): bool
{
    return strcasecmp($pass1, $pass2) == 0;
}

/**
 * Checks if the array exists within the _POST array and has at least one element
 * @param $arr_index string key of the array of languages
 * @return bool
 */
function validate_lang_arr(string $arr_index): bool
{
    return isset($_POST[$arr_index]) && sizeof($_POST[$arr_index]) > 0;
}

function create_account(): bool
{
    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $gender = $_POST["gender"];
    $preference = $_POST["preference"];
    $country = $_POST["country"];
    $region = $_POST["region"];
    $age = $_POST["age"];
    $fluent_languages = $_POST["fluent_languages"];
    $learning_languages = $_POST["learning_languages"];

    $db_con = new mysqli();

    try {
        $db_con = connect();
    } catch (Exception $e) {
        $code = $e->getCode();
        $message = $e->getMessage();
        $file = $e->getFile();
        $line = $e->getLine();
        echo "<script> console.log(\"Exception thrown in $file on line $line: [Code $code] $message\") </script>";
    }

    if (create_user($db_con, $email, $hashed_password)) {
        $user_id = get_user_id($db_con, $email, $hashed_password);
        if (create_profile($db_con,
            $user_id,
            $firstname,
            $lastname,
            $age,
            $gender,
            $preference,
            $country,
            $region)) {
            if (add_user_languages($db_con, $user_id, $fluent_languages, 'speaks', 'fluent') &&
                add_user_languages($db_con, $user_id, $learning_languages, 'learning', 'none')) {
                disconnect($db_con);
                return true;
            } else {
                delete_user_profile($db_con, $user_id);
                delete_user_by_user_id($db_con, $user_id);
            }
        } else {
            delete_user_by_user_id($db_con, $user_id);
        }
    }
    disconnect($db_con);
    return false;
}

function delete_user_profile($db_con, $user_id) {
    delete_user_by_user_id($db_con, $user_id);
    delete_profile_by_user_id($db_con, $user_id);
}