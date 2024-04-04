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
VALUES ($email, $password, 'user')");
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
 * Deletes the user associated with the id in the database
 * @param mysqli $db_con database connection
 * @param int $user_id user's id
 * @return bool true if delete is successful
 */
function delete_user_by_user_id(mysqli $db_con, int $user_id): bool
{
    $stmt = $db_con->prepare("DELETE FROM users WHERE user_id=$user_id");
    return $stmt->execute();
}
