<?php

require_once "../database/database_connect.php";
require_once "resolve_report.php";
require_once "../database/profiles.php";
require_once "../database/bans.php";

try {
    $connection = connect();
} catch (Exception $e) {
    $code = $e->getCode();
    $message = $e->getMessage();
    $file = $e->getFile();
    $line = $e->getLine();
    echo "<script> console.log(\"Exception thrown in $file on line $line: [Code $code] $message\"); </script>";
}

if (isset($_POST["sign-out"])) {
    session_start();
    session_unset();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    require_once("../templates/header.php");

    if (!isset($_SESSION["logged-in"]) || $_SESSION['account_type'] != 'admin') {
        header("Location: ../home");
    }
    ?>

    <title>Love Languages - Admin</title>
    <link rel="stylesheet" type="text/css" href="admin.css">
</head>

<body>

<?php
require_once("../navbar/navbar.php");

if (isset($_POST['ignore'])) {
    resolve_report($connection, $_POST['report_id'], false);
} else if (isset($_POST['ban'])) {

    resolve_report($connection, $_POST['reportee_id'], true);

    $date = new DateTime();
    $date->modify($_POST['time']);

    ban_user($connection, $_POST['reportee_id'], $date->format('Y-m-d H:i:s'), $_POST['reason']);
}

$report_list = get_reports($connection);

?>

<div class="container-fluid">
    <div class="row heading">
        <div class="col-8 align-content-center">
            <h2>Admin Tools</h2>
        </div>
        <div class="col-4 align-content-center">
            <form method="post">
                <button class="signout-btn btn btn-danger float-end w-100" name="sign-out" type="submit">
                    Logout
                </button>
            </form>
        </div>
    </div>
    <div class="list-group">
        <?php

        foreach ($report_list as $report) {

            $report_id = $report['report_id'];
            $reporter_id = $report['reporter_id'];
            $reportee_id = $report['reportee_id'];
            $pfp = get_profile_picture_by_user_id($connection, $reportee_id);
            if (!$pfp) { $pfp = "../../assets/pfp-placeholder.png"; }
            $name_arr = get_name_by_user_id($connection, $reportee_id);
            $reason = $report['reason'];

            echo
            "
                <div class=\"card m-3 bg-danger-subtle\">
            <form method=\"post\">
                <div class=\"row align-items-center\">
                    <div class=\"col-3 pics\">
                        <img class=\"img-fluid\" src=$pfp alt=\"Profile Picture\">
                    </div>
                    <div class=\"col-9\">
                        <div class=\"row\">
                            <div class=\"col\">
                                <div class=\"input-box mb-2\">
                                    <span class=\"prefix\"><b>Report ID:</b> $report_id</span>
                                    <input type=\"hidden\" name=\"report_id\" value=\"$report_id\">
                                </div>
                                <div class=\"input-box mb-2\">
                                    <span class=\"prefix\"><b>Reported By:</b> $reporter_id</span>
                                    <input type=\"hidden\" name=\"reporter_id\" value=\"$reporter_id\">
                                </div>
                            </div>
                            <div class=\"col\">
                                <div class=\"input-box mb-2\">
                                    <span class=\"prefix\"><b>User ID:</b> $reportee_id</span>
                                    <input type=\"hidden\" name=\"reportee_id\" value=\"$reportee_id\">
                                </div>
                                <div class=\"input-box mb-2\">
                                    <span class=\"prefix\"><b>Name:</b> $name_arr[0] $name_arr[1]</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class=\"row mx-3\">
                    <div class=\"input-box\">
                        <span class=\"prefix\"><b>Report Reason:</b> $reason</span>
                    </div>
                </div>
                <div class=\"row mt-3\">
                    <div class=\"col ms-3\">
                        <select class=\"form-control\" id=\"time\" name=\"time\">
                            <option value='+1 day'>1 Day</option>
                            <option value='+2 days'>2 Days</option>
                            <option value='+7 days'>1 Week</option>
                            <option value='+1 month'>1 Month</option>
                            <option value='+1000 years'>Permanent</option>
                        </select>
                    </div>
                    <div class=\"col me-3\">
                        <input class=\"form-control\" type=\"text\" placeholder=\"Reason\" name=\"reason\"/>
                    </div>
                </div>
                <div class=\"row text-center\">
                    <div class=\"col-5\">
                        <button name=\"ignore\" type=\"submit\" class=\"btn buttons bg-success ll-button my-2 me-4\">Ignore
                        </button>
                    </div>
                    <div class=\"col-5\">
                        <button name=\"ban\" type=\"submit\" class=\"btn buttons bg-danger ll-button my-2 me-4\">Ban
                        </button>
                    </div>
                </div>
            </form>
        </div>
        
            ";
        }
        ?>

    </div>
</div>

<?php
require_once("../templates/footer.php");
?>
</body>

</html>
