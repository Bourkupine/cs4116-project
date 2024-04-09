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
    $stmt->bind_param("s", $user_id);
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
    $stmt->bind_param("si", $firstname,$user_id);
    return $stmt->execute();
}

function update_surname_by_user_id(mysqli $db_con, int $user_id, string $surname): bool
{

    $stmt = $db_con->prepare("UPDATE profiles
                                    SET surname=?
                                    WHERE user_id = ?");
    $stmt->bind_param("si", $surname,$user_id);
    return $stmt->execute();
}

function update_country_by_user_id(mysqli $db_con, int $user_id, string $country): bool
{

    $stmt = $db_con->prepare("UPDATE profiles
                                    SET country=?
                                    WHERE user_id = ?");
    $stmt->bind_param("si", $country,$user_id);
    return $stmt->execute();
}

function update_region_by_user_id(mysqli $db_con, int $user_id, string $region): bool
{

    $stmt = $db_con->prepare("UPDATE profiles
                                    SET region=?
                                    WHERE user_id = ?");
    $stmt->bind_param("si", $region,$user_id);
    return $stmt->execute();
}

function update_age_by_user_id(mysqli $db_con, int $user_id, int $age): bool
{

    $stmt = $db_con->prepare("UPDATE profiles
                                    SET age=?
                                    WHERE user_id = ?");
    $stmt->bind_param("ii", $age,$user_id);
    return $stmt->execute();
}

function update_gender_by_user_id(mysqli $db_con, int $user_id, string $gender): bool
{

    $stmt = $db_con->prepare("UPDATE profiles
                                    SET gender=?
                                    WHERE user_id = ?");
    $stmt->bind_param("si", $age,$user_id);
    return $stmt->execute();
}

function update_preference_by_user_id(mysqli $db_con, int $user_id, int $preference): bool
{

    $stmt = $db_con->prepare("UPDATE profiles
                                    SET preference=?
                                    WHERE user_id = ?");
    $stmt->bind_param("ii", $age,$user_id);
    return $stmt->execute();
}




