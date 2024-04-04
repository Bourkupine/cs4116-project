<?php
require "../database/users.php";
require "../database/profiles.php";

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

function create_account(): void
{
    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $password_confirm = $_POST["password_confirm"];
    $gender = $_POST["gender"];
    $preference = $_POST["preference"];
    $country = $_POST["country"];
    $region = $_POST["region"];
    $age = $_POST["age"];
    $fluent_languages = $_POST["fluent_languages"];
    $learning_languages = $_POST["learning_languages"];

    $hashed_password = password_hash($password, "PASSWORD_DEFAULT");
    $connection = new mysqli();

    try {
        $connection = connect();
    } catch (Exception $e) {
        $code = $e->getCode();
        $message = $e->getMessage();
        $file = $e->getFile();
        $line = $e->getLine();
        echo "<script> console.log(\"Exception thrown in $file on line $line: [Code $code] $message\") </script>";
    }

    if (create_user($connection, $email, $hashed_password)) {
        $user = get_user_by_email($connection, $email);
        $profile = new profile(
            $user->getUserId(),
            $firstname,
            $lastname,
            $age,
            $gender,
            $preference,
            "",
            $country,
            $region
        );
        if (create_profile($connection, $profile)) {
            // have to add user_languages but not sure how to determine level - change UI or assume defaults?
        } else {
            delete_user_by_user_id($connection, $user->getUserId());
            disconnect($connection);
            //             return 'Error in creating profile, please try again later';
        }
    }
}
