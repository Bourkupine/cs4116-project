<?php

/**
 * Inserts a user with user_type user into the DB
 * @param mysqli $db_con database connection
 * @param string $email user's email
 * @param string $password user's hashed password
 * @return bool true if insert is successful
 */
function create_user(mysqli $db_con, string $email, string $password): bool
{
    $stmt = $db_con->prepare("INSERT INTO users (email, password, account_type)
VALUES (?, ?, 'user')");
    $stmt->bind_param("ss", $email, $password);
    return $stmt->execute();
}

/**
 * Gets a user_id from the users table associated with a given email and password.
 * Returns null if invalid user credentials were given.
 * @param mysqli $db_con connection to the database
 * @param string $email user email
 * @param string $password user password
 * @return int|null user_id if user credentials exist, otherwise null
 */
function get_user_id(mysqli $db_con, string $email, string $password): ?int {
    $stmt = $db_con->prepare("SELECT user_id from users WHERE email = ? AND password = ?");
    $stmt->bind_param("ss", $email, $password);
    $stmt->bind_result($id);
    $stmt->execute();
    $stmt->fetch();
    return $id;
}

/**
 * Gets an array of user details from the profiles table using a given user_id
 * @param mysqli $db_con Database connection
 * @param int $user_id The users id
 * @return array An associative array of all the users details
 */
function get_profile_details(mysqli $db_con, int $user_id): array {
    $stmt = $db_con->prepare("SELECT * FROM profiles WHERE user_id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    return ($stmt->get_result()->fetch_assoc());
}

/**
 * Deletes the user associated with the id in the database
 * @param mysqli $db_con database connection
 * @param int $user_id user's id
 * @return bool true if delete is successful
 */
function delete_user_by_user_id(mysqli $db_con, int $user_id): bool
{
    $stmt = $db_con->prepare("DELETE FROM users WHERE user_id = ?");
    $stmt->bind_param("s", $user_id);
    return $stmt->execute();
}

/**
 * Gets a user's password hash from the users table using a given email
 * @param mysqli $db_con database connection
 * @param string $email user's email
 * @return string the user's password hash
 */
function get_password_by_email(mysqli $db_con, string $email): string {
    $stmt = $db_con->prepare("SELECT password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->bind_result($password);
    $stmt->execute();
    $stmt->fetch();
    return $password;
}

/**
 * Checks if a user exists by the given email
 * @param mysqli $db_con database connection
 * @param string $email user's email
 * @return bool true if the account exists
 */
function check_user_exists_by_email(mysqli $db_con, string $email): bool {
    $stmt = $db_con->prepare("SELECT email FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->bind_result($result);
    $stmt->execute();
    $stmt->fetch();
    return boolval($result);
}