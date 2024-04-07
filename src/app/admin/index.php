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

<div class="container">
    <div class="row heading">
        <h2>Admin Dashboard</h2>
    </div>
    <div class="list-group">
        <div class="card mb-3 bg-danger-subtle">
            <form method="post" action="resolve_report.php">
                <div class="row align-items-center">
                    <div class="col-2 pics">
                        <img class="img-fluid" src="../../assets/ll-logo.png" alt="...">
                    </div>
                    <div class="col-6 card-body g-0">
                        <input readonly class="card-text form-control-plaintext my-0"><b>Report ID: </b>123</input>
                        <input readonly class="card-text form-control-plaintext my-0"><b>User ID: </b>12345</input>
                        <input readonly class="card-text form-control-plaintext my-0"><b>Reason: </b>Sent me nudes, pls ban immedientlylel</input>
                        <input readonly class="card-text form-control-plaintext my-0"><b>Reported by: </b>127683</input>
                    </div>
                </div>
                <div class="row text-center">
                    <div class="col-5"><a href="#" class="btn buttons bg-danger ll-button my-2 me-4" role="button">Ban</a></div>
                    <div class="col-5"><a href="#" class="btn buttons bg-success ll-button my-2 me-4" role="button">Ignore</a>
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
