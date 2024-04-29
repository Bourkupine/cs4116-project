<?php

require_once "../database/user_interests.php";
require_once "../database/user_languages.php";
require_once "../database/user_ratings.php";

function search(mysqli $db_con): array {

    $gender = 1;
    $country = 1;
    $interests = array(1);
    $languages = array(1);

    $current_user = $_SESSION['user_id'];

    $language_list = get_all_languages($db_con);
    $interest_list = get_all_interests($db_con);

    $gender_str = "?";
    $country_str = "?";
    $interests_str = "?";
    $languages_str = "?";
    $param_str = "";

    if (isset($_POST['gender'])) {
        $gender = $_POST['gender'];
        $gender_str = "p.sex = ?";
        $param_str .= "s";
    } else {
        $param_str .= "i";
    }
    if (isset($_POST['country'])) {
        $country = $_POST['country'];
        $country_str = "p.country = ?";
        $param_str .= "s";
    } else {
        $param_str .= "i";
    }
    if (isset($_POST['interests'])) {
        $interests = array();
        foreach ($_POST['interests'] as $i){
            $interests[] = $i;
        }
        $interests_str = "i.interest_id IN (" . rtrim(str_repeat("?,", count($interests)), ",") . ")";
        $param_str .= str_repeat("i", count($interests));
    } else {
        $param_str .= "i";
    }
    if (isset($_POST['fluent_languages'])) {
        $languages = array();
        foreach ($_POST['fluent_languages'] as $l){
            $languages[] = $l;
        }
        $languages_str = "l.language_id IN (" . rtrim(str_repeat("?,", count($languages)), ",") . ")"
        . "AND l.status = \"speaks\"";
        $param_str .= str_repeat("i", count($languages));
    } else {
        $param_str .= "i";
    }

    $sql =
        "
        SELECT 
        p.user_id, p.first_name, p.surname, p.age, p.region, p.profile_pic, p.sex
        FROM profiles p
        LEFT JOIN user_interests i ON p.user_id = i.user_id
        LEFT JOIN user_languages l ON p.user_id = l.user_id
        WHERE $gender_str
        AND p.user_id <> $current_user
        AND $country_str
        AND $interests_str
        AND $languages_str
        ";

    $stmt = $db_con->prepare($sql);
    $stmt->bind_param($param_str, $gender, $country, ...$interests, ...$languages);
    $stmt->bind_result($user_id, $first_name, $surname, $age, $region, $profile_pic, $sex);
    $stmt->execute();
    $result = $stmt->get_result();

    $filtered_array = array();
    $id_list = array();

    while($id = $result->fetch_assoc()) {
        if (in_array($id['user_id'], $id_list)) continue;
        $users_interests = get_user_interests_by_user_id($db_con, $id['user_id']);
        $users_languages = get_user_languages_by_user_id($db_con, $id['user_id']);

        $speaks_arr = array();
        $learning_arr = array();
        $learning_ids = array();
        $interests_arr = array();

        foreach ($users_languages as $language_id => $status) {
            if ($status == "speaks") {
                $speaks_arr[] = $language_list[$language_id];
            } else {
                $learning_ids[] = $language_id;
                $learning_arr[] = $language_list[$language_id];
            }
        }
        if (isset($_POST['learning_languages'])) {
            $contains = false;
            foreach ($_POST['learning_languages'] as $l){
                if (in_array($l, $learning_ids)) {
                    $contains = true;
                    break;
                }
            }
            if (!$contains) continue;
        }

        foreach ($users_interests as $i) {
            $interests_arr[] = $interest_list[$i];
        }

        $filtered_array[] = array($id['user_id'], $id['first_name'], $id['surname'], $id['age'], $id['region'], $id['profile_pic'],
            $interests_arr, $speaks_arr, $learning_arr, $id['sex']);
        $id_list[] = $id['user_id'];
    }

    $result->free();
    return $filtered_array;
}
