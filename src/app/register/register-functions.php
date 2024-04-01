<?php
require '../database/user.php';
require '../database/profile.php';

/**
 * Checks if the passwords are identical
 * @param $pass1 string password
 * @param $pass2 string re-entered password
 * @return bool
 */
function validate_password(string $pass1, string $pass2): bool {
    return strcasecmp($pass1, $pass2) == 0;
}

/**
 * Checks if the array exists within the _POST array and has at least one element
 * @param $arr_index string key of the array of languages
 * @return bool
 */
function validate_lang_arr(string $arr_index): bool {
    return isset($_POST[$arr_index]) && sizeof($_POST[$arr_index]) > 0;
}

function create_account(): void {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password_confirm = $_POST['password_confirm'];
    $gender = $_POST['gender'];
    $preference = $_POST['preference'];
    $country = $_POST['country'];
    $region = $_POST['region'];
    $fluent_languages = $_POST['fluent_languages'];
    $learning_languages = $_POST['learning_languages'];

    $hashed_password = password_hash($password, 'PASSWORD_DEFAULT');
    if (create_user($email, $hashed_password)) {
        $user = get_user_by_email($email);
//        $profile = new profile($user->getUserId(), $firstname, $lastname, $)
//      need to do: age in UI, exceptions, maybe use connect in here
      } else {

    }
}
?>
