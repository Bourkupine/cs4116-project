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

?>