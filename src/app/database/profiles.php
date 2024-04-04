<?php

/**
 * Inserts a new profile into the database with an empty bio and profile pic
 * @param mysqli $db_con database connection
 * @param int $user_id profile's id
 * @param string $first_name profile's first name
 * @param string $surname profile's surname
 * @param int $age profile's age
 * @param string $sex profile's sex
 * @param string $preference profile's preference
 * @param string $country profile's country
 * @param string $region profile's region
 * @return bool true if successful
 */
function create_profile(mysqli $db_con, int $user_id, string $first_name, string $surname, int $age, string $sex, string $preference, string $country, string $region): bool
{
    $stmt = $db_con->prepare("INSERT INTO profiles VALUES('$user_id', '$first_name', '$surname', '$age', '$sex', '$preference', '', '', '$country', '$region')");
    return $stmt->execute();
}

/**
 * Deletes the profile associated with the id in the database
 * @param mysqli $db_con database connection
 * @param int $user_id profile's id
 * @return bool true if delete is successful
 */
function delete_profile_by_user_id(mysqli $db_con, int $user_id): bool
{
    $stmt = $db_con->prepare("DELETE FROM profiles WHERE user_id = ?");
    $stmt->bind_param("s", $user_id);
    return $stmt->execute();
}