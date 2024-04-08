<?php

function search(mysqli $db_con): array {

//    $user_id = $_SESSION['user_id'];
//

    $gender = strtolower($_POST['gender']);
    $country = strtolower($_POST['country']);
    $interests = $_POST['interests'];
    $languages = $_POST['learning-languages'];

    $sql = "SELECT p.user_id FROM profiles p 
    NATURAL JOIN user_interests i 
    NATURAL JOIN user_languages l
    WHERE p.sex = '$gender'
    AND p.country = '$country'
    AND i.interest_id IN (" . implode(",", $interests) .
        ") AND l.language_id IN (" . implode(",", $languages) . ")";

    echo " " . $sql;

    $users_arr = array();

    $stmt = $db_con->prepare($sql);
    $stmt->bind_result($user_id);
    $stmt->execute();
    while ($stmt->fetch()) {
        $users_arr[] = $user_id;
    }


    return $users_arr;

    //gender
    //location
    //interests
    //languages


}

?>