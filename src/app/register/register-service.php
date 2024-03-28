<?php
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
?>
