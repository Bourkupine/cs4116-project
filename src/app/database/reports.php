<?php

function get_reports(mysqli $db_con): array {
    $reports_arr = array();
    $stmt = $db_con->prepare("SELECT report_id, reporter_id, reportee_id, reason FROM reports WHERE resolved=0");
    $stmt->bind_result($report_id, $reporter_id, $reportee_id, $reason);
    $stmt->execute();

    while ($stmt->fetch()) {
        $report_info = array($report_id, $reporter_id, $reportee_id, $reason);
        $reports_arr[] = $report_info;
    }
    return $reports_arr;
}

/**
 * Creates an unresolved report for a user by another user with a reason
 * @param mysqli $db_con database connection
 * @param int $reporter_id reporter's id
 * @param int $reportee_id reportee's id
 * @param string $reason reason for the report
 * @return bool true if successful
 */
function create_report(mysqli $db_con, int $reporter_id, int $reportee_id, string $reason): bool
{
    $stmt = $db_con->prepare("INSERT INTO reports (reporter_id, reportee_id, reason, resolved)
VALUES (?, ?, ?, 0)");
    $stmt->bind_param("iis", $reporter_id, $reportee_id, $reason);
    return $stmt->execute();
}