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
        <div class="card mb-3">
            <div class="row">
                <div class="col-1 offset-1 pics">
                    <img class="img-fluid" src="../../assets/ll-logo.png" alt="...">
                </div>
                <div class="col-4">
                    <h5 class="card-title">Name: </h5>
                    <p class="card-body">Reason: </p>
                    <p class="card-body"><small class="text-body-secondary">Reported by: </small></p>
                </div>
                <div class="col-2 buttons">
                    <a href="../register/" class="btn ll-button" role="button">Ban</a>
                    <a href="../login/" class="btn ll-button" role="button">Ignore</a>
                </div>
            </div>
        </div>
    </div>

</div>

<?php
require_once("../templates/footer.php");
?>
</body>

</html>
