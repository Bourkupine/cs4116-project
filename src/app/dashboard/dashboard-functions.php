<?php

require_once "../database/user_ratings.php";
require_once "../database/profiles.php";
require_once "../database/user_interests.php";
require_once "../database/user_languages.php";
require_once "../database/users.php";

function get_eligible_user_ids(mysqli $db_con, string $user_preference): array
{
    $eligible_users = array();
    if (strcasecmp($user_preference, "both") == 0) {
        $user_preference = 1;
    }

    $stmt = $db_con->prepare("SELECT user_id FROM profiles WHERE sex = ?");
    $stmt->bind_param("s", $user_preference);
    $stmt->bind_result($eligible_user_id);
    $stmt->execute();

    while ($stmt->fetch()) {
        $eligible_users[] = $eligible_user_id;
    }
    return $eligible_users;
}

function trim_eligible_users(mysqli $db_con, int $user_id, array $eligible_users, string $user_sex): array
{
    $rated_user_ids = get_rated_users_by_user_id($db_con, $user_id);
    foreach ($eligible_users as $key => $eligible_user_id) {
        $eligible_user_preference = get_preference_by_user_id($db_con, $eligible_user_id);
        if (in_array($eligible_user_id, $rated_user_ids) || $eligible_user_id == $user_id) {
            unset($eligible_users[$key]);
        } else if (strcasecmp($eligible_user_preference, $user_sex) != 0
            && strcasecmp($eligible_user_preference, "both") != 0) {
            unset($eligible_users[$key]);
        }
    }
    return $eligible_users;
}

function get_best_user_id(mysqli $db_con, int $user_id, array $user_interest_ids, array $user_language_ids, string $user_country, array $eligible_users): int
{
    $scored_users = array();
    foreach ($eligible_users as $e_user_id) {
        $score = 0;
        $e_user_country = get_country_by_user_id($db_con, $e_user_id);
        $e_user_interest_ids = get_user_interests_by_user_id($db_con, $e_user_id);
        $e_user_language_ids = get_user_languages_by_user_id($db_con, $e_user_id);

        if (strcasecmp($user_country, $e_user_country) == 0) {
            $score += 3;
        }
        foreach ($user_interest_ids as $user_interest_id) {
            if (in_array($user_interest_id, $e_user_interest_ids)) {
                $score++;
            }
        }
        foreach ($user_language_ids as $user_language_id => $user_language_status) {
            if (isset($e_user_language_ids[$user_language_id])) {
                if (strcasecmp($e_user_language_ids[$user_language_id], $user_language_status) != 0) {
                    $score += 2;
                } else {
                    $score = +1;
                }
            }
        }

        $scored_users[$e_user_id] = $score;
    }
    return array_search(max($scored_users), $scored_users);
}

function get_user_info($db_con, $user_id): array
{
    $user_info = array();
    $profile_details = get_profile_details($db_con, $user_id);

    $user_info["first_name"] = $profile_details["first_name"];
    $user_info["surname"] = $profile_details["surname"];
    $user_info["country"] = $profile_details["country"];
    $user_info["region"] = $profile_details["region"];
    $user_info["age"] = $profile_details["age"];
    $user_info["sex"] = $profile_details["sex"];
    $user_info["profile_pic"] = $profile_details["profile_pic"];
    $user_info["bio"] = $profile_details["bio"];
    $user_info["user_languages"] = get_user_languages_by_user_id($db_con, $user_id);
    $user_info["user_interests"] = get_user_interests_by_user_id($db_con, $user_id);

    return $user_info;
}