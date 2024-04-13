<?php

function get_reports(mysqli $db_con): array
{
    $sql = "SELECT report_id, reporter_id, reportee_id, reason FROM reports WHERE resolved = 0";

    $stmt = $db_con->prepare($sql);
    $stmt->bind_result($report_id, $reporter_id, $reportee_id, $reason);
    $stmt->execute();
    $result = $stmt->get_result();

    $reports_arr = array();

    while ($report = $result->fetch_assoc()) {
        $reports_arr[] = $report;
    }

    return $reports_arr;
}

function get_users_report_info(mysqli $db_con, int $user_id): array {

    $sql = "SELECT first_name, surname, profile_pic FROM profiles where user_id = ?";

    $stmt = $db_con->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->bind_result($first_name, $surname, $profile_pic);
    $stmt->execute();
    $result = $stmt->get_result();

    //run check for pfp and use default if none exists
    $user_info = array($result['first_name'], $result['surname'], $result['profile_pic']);

    return $user_info;
}

function ban_user(mysqli $db_con, int $user_id): void {
    //replace resolved
    //create ban
}

function ignore_user(mysqli $db_con, int $user_id): void {
    //replace resolved
}