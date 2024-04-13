<?php

require_once "../database/database_connect.php";

require_once "resolve_report.php";


try {
    $connection = connect();
    $report_list = get_reports($connection);
} catch (Exception $e) {
    $code = $e->getCode();
    $message = $e->getMessage();
    $file = $e->getFile();
    $line = $e->getLine();
    echo "<script> console.log(\"Exception thrown in $file on line $line: [Code $code] $message\"); </script>";
}

print_r($report_list);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    require_once("../templates/header.php");
    ?>
    <title>Love Languages - Admin</title>
    <link rel="stylesheet" type="text/css" href="admin.css">
</head>

<body>

<?php
require_once("../navbar/navbar.php");




?>

<div class="container-fluid">
    <div class="row heading">
        <h2>Admin Dashboard</h2>
    </div>
    <div class="list-group">
        <div class="card mb-3 bg-danger-subtle">
            <form method="post" action="resolve_report.php">
                <div class="row align-items-center">
                    <div class="col-3 pics">
                        <img class="img-fluid" src="../../assets/ll-logo.png" alt="...">
                    </div>
                    <div class="col-9">
                        <div class="row">
                            <div class="col">
                                <p class="card-text">Report ID: 213</p>
                                <p class="card-text">Reason: asda asdasd asd asdd asdasd asd asd asd asd asd asd asd asd </p>
                                <p class="card-text">Reported By: 3123</p>
                            </div>
                            <div class="col">
                                <p class="card-text">User ID: 4312</p>
                                <p class="card-text">Name: Blake Ryan</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row text-center">
                    <div class="col-5">
                        <button name="ban" type="submit" class="btn buttons bg-danger ll-button my-2 me-4" role="button">Ban</button>
                    </div>
                    <div class="col-5">
                        <button name="ignore" type="submit" class="btn buttons bg-success ll-button my-2 me-4" role="button">Ignore</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
require_once("../templates/footer.php");
?>
</body>

</html>
