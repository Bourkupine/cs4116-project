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
    $stmt = $db_con->prepare("INSERT INTO profiles(user_id, first_name, surname, age, sex, preference, country, region) 
        VALUES(?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ississss", $user_id, $first_name, $surname, $age, $sex, $preference, $country, $region);
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
    $stmt->bind_param("i", $user_id);
    return $stmt->execute();
}

/**
 * Gets the path to the profile picture associated with the given user id
 * @param mysqli $db_con database connection
 * @param int $user_id user's id
 * @return string | null filepath of the profile picture if one exists
 */
function get_profile_picture_by_user_id(mysqli $db_con, int $user_id): ?string
{
    $stmt = $db_con->prepare("SELECT profile_pic FROM profiles WHERE user_id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->bind_result($profile_pic_path);
    $stmt->execute();
    $stmt->fetch();
    return $profile_pic_path;
}

/**
 * Updates the profile picture path associated with the given user id
 * @param mysqli $db_con database connection
 * @param int $user_id user's id
 * @param string $pfp_path path to the profile picture
 * @return bool true if successful
 */
function update_profile_picture_by_user_id(mysqli $db_con, int $user_id, string $pfp_path): bool
{
    $stmt = $db_con->prepare("UPDATE profiles SET profile_pic = ? WHERE user_id = ?");
    $stmt->bind_param("si", $pfp_path, $user_id);
    return $stmt->execute();
}

/**
 * Updates First name associated with a given user_id
 * @param mysqli $db_con database connection
 * @param int $user_id user
 * @param string $firstname firstname
 * @return bool
 */
function update_first_name_by_user_id(mysqli $db_con, int $user_id, string $firstname): bool
{

    $stmt = $db_con->prepare("UPDATE profiles
                                    SET first_name=?
                                    WHERE user_id = ?");
    $stmt->bind_param("si", $firstname, $user_id);
    return $stmt->execute();
}

/**
 * Updates surname associated with a given user_id
 * @param mysqli $db_con database connection
 * @param int $user_id user's id
 * @param string $surname new surname
 * @return bool true if successful
 */
function update_surname_by_user_id(mysqli $db_con, int $user_id, string $surname): bool
{

    $stmt = $db_con->prepare("UPDATE profiles
                                    SET surname=?
                                    WHERE user_id = ?");
    $stmt->bind_param("si", $surname, $user_id);
    return $stmt->execute();
}

/**
 * Updates country associated with a given user_id
 * @param mysqli $db_con database connection
 * @param int $user_id user's id
 * @param string $country new country
 * @return bool true if successful
 */
function update_country_by_user_id(mysqli $db_con, int $user_id, string $country): bool
{

    $stmt = $db_con->prepare("UPDATE profiles
                                    SET country=?
                                    WHERE user_id = ?");
    $stmt->bind_param("si", $country, $user_id);
    return $stmt->execute();
}

/**
 * Updates region associated with a given user id
 * @param mysqli $db_con database connection
 * @param int $user_id user's id
 * @param string $region new region
 * @return bool true if successful
 */
function update_region_by_user_id(mysqli $db_con, int $user_id, string $region): bool
{

    $stmt = $db_con->prepare("UPDATE profiles
                                    SET region=?
                                    WHERE user_id = ?");
    $stmt->bind_param("si", $region, $user_id);
    return $stmt->execute();
}

/**
 * Updates age associated with a given user id
 * @param mysqli $db_con database connection
 * @param int $user_id user's id
 * @param int $age new age
 * @return bool true if successful
 */
function update_age_by_user_id(mysqli $db_con, int $user_id, int $age): bool
{

    $stmt = $db_con->prepare("UPDATE profiles
                                    SET age=?
                                    WHERE user_id = ?");
    $stmt->bind_param("ii", $age, $user_id);
    return $stmt->execute();
}

/**
 * Updates sex associated with a given user id
 * @param mysqli $db_con database connection
 * @param int $user_id user's id
 * @param string $gender new sex
 * @return bool true if successful
 */
function update_gender_by_user_id(mysqli $db_con, int $user_id, string $gender): bool
{

    $stmt = $db_con->prepare("UPDATE profiles
                                    SET sex=?
                                    WHERE user_id = ?");
    $stmt->bind_param("si", $gender, $user_id);
    return $stmt->execute();
}

/**
 * Updates preference associated with a given user id
 * @param mysqli $db_con database connection
 * @param int $user_id user's id
 * @param string $preference new preference
 * @return bool true if successful
 */
function update_preference_by_user_id(mysqli $db_con, int $user_id, string $preference): bool
{

    $stmt = $db_con->prepare("UPDATE profiles
                                    SET preference=?
                                    WHERE user_id = ?");
    $stmt->bind_param("si", $preference, $user_id);
    return $stmt->execute();
}

/**
 * Updates bio associated with a given user id
 * @param mysqli $db_con database connection
 * @param int $user_id user's id
 * @param string $bio new bio
 * @return bool true if successful
 */
function update_bio_by_user_id(mysqli $db_con, int $user_id, string $bio): bool
{
    $stmt = $db_con->prepare("UPDATE profiles SET bio = ? WHERE user_id = ?");
    $stmt->bind_param("si", $bio, $user_id);
    return $stmt->execute();
}

function get_name_by_user_id(mysqli $db_con, int $user_id): array
{
    $stmt = $db_con->prepare("SELECT first_name, surname FROM profiles WHERE user_id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->bind_result($first_name, $surname);
    $stmt->execute();
    $stmt->fetch();
    return [$first_name, $surname];

}