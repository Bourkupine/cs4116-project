<?php

function search(mysqli $db_con): array {

    $gender = 1;
    $country = 1;
    $interests = array(1);
    $languages = array(1);

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
    if (isset($_POST['learning-languages'])) {
        $languages = array();
        foreach ($_POST['learning-languages'] as $l){
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
        p.user_id, p.first_name, p.surname, p.age, p.region
        FROM profiles p
        LEFT JOIN user_interests i ON p.user_id = i.user_id
        LEFT JOIN user_languages l ON p.user_id = l.user_id
        WHERE $gender_str
        AND $country_str
        AND $interests_str
        AND $languages_str
        ";

    $stmt = $db_con->prepare($sql);
    $stmt->bind_param($param_str, $gender, $country, ...$interests, ...$languages);
    $stmt->bind_result($user_id, $first_name, $surname, $age, $region);
    $stmt->execute();
    $result = $stmt->get_result();

    $filtered_array = array();

    $id_list = array();

    while($id = $result->fetch_assoc()) {
        if (in_array($id['user_id'], $id_list)) continue;
        $filtered_array[] = array($id['user_id'], $id['first_name'], $id['surname'], $id['age'], $id['region']);
        $id_list[] = $id['user_id'];
    }

//    echo($id);
//    echo($filtered_array);
    $result->free();

//    print_r($filtered_array);
    //problem here




    return $filtered_array;
}

function get_users_info(mysqli $db_con, int $user_id): array {

}

?>