<?php

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