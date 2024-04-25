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
 * Registers a user by inserting user, profile, and user_languages entries into the database
 * @param string $firstname first name
 * @param string $lastname surname
 * @param string $email email address
 * @param string $password password
 * @param string $gender sex
 * @param string $preference preference
 * @param string $country country of residence
 * @param string $region region/state/county
 * @param int $age age
 * @return bool true if all inserts are successful
 */
function create_account(mysqli $db_con,
                        string $firstname,
                        string $lastname,
                        string $email,
                        string $password,
                        string $gender,
                        string $preference,
                        string $country,
                        string $region,
                        int $age,
                        array $fluent_languages,
                        array $learning_languages): bool
{
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

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
                setcookie("first_timer_" . $user_id, 1, strtotime("+1 year"), "/", false);
                return true;
            } else {
                delete_user_profile($db_con, $user_id);
            }
        } else {
            delete_user_by_user_id($db_con, $user_id);
        }
    }
    return false;
}

/**
 * Deletes a user and profile entry associated with a specific user_id
 * @param $db_con mysqli database connection
 * @param $user_id int user's id
 * @return void
 */
function delete_user_profile(mysqli $db_con, int $user_id): void {
    delete_user_by_user_id($db_con, $user_id);
    delete_profile_by_user_id($db_con, $user_id);
}