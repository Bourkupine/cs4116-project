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
            <div class="row align-items-center">
                <div class="col-2 pics">
                    <img class="img-fluid" src="../../assets/ll-logo.png" alt="...">
                </div>
                <div class="col-6 card-body">
                    <p class="card-text my-0"><b>User ID</b>: 12345</p>
                    <p class="card-text my-0"><b>Reason</b>: Sent me nudes piahsgdjkhasd asdhibgasd jhibasdh hbasdhbasdhb jhbasdhb hkbasdkh baskhdbaskhdb khasbd khasbd khasbd khabsd khbaskdh band i am going to the polic</p>
                    <p class="card-text m-0"><b>Reported by</b>: 127683</p>
                </div>
                <div class="col-2 d-inline-flex flex-column">
                    <a href="#" class="btn bg-danger ll-button my-2 me-4" role="button">Ban</a>
                    <a href="#" class="btn bg-success ll-button my-2 me-4" role="button">Ignore</a>
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
