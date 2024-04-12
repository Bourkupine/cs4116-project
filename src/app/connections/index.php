<head>
    <?php require_once "../templates/header.php"; ?>
    <?php
    if (!isset($_SESSION["logged-in"])) {
        header("Location: ../home");
    } ?>
    <link rel="stylesheet" href="connections.css">
    <title>Love Languages - Connections</title>
</head>

<body>
<?php
require_once "../navbar/navbar.php";
require_once "../database/database_connect.php";
require_once "../database/connections.php";
try {
    $db_con = connect();
} catch (Exception $e) {
    echo $e;
}
$connections = isset($_POST["search"]) ? get_connections($db_con, $_SESSION["user_id"], $_POST["search"]) : get_connections($db_con, $_SESSION["user_id"]);
?>

<div class="container-fluid g-0">
    <div class="row h-100 g-0">
        <div class="col-md-1" style="background-color: #99A1FF">
            <form method="post" class="my-2 mx-2 d-none d-md-flex">
                <label>
                    <input type="text" class="form-control rounded-5" style="background-color: #c6c7ff" name="search"
                           placeholder="Search...">
                </label>
            </form>
            <div class="list-group flex-md-column flex-row overflow-auto list-group-flush">
                <?php
                foreach ($connections as $connection) {
                    echo "
                    <a href=\"\" class=\"list-group-item list-group-item-action \" style='background-color: #99A1FF'>
                    <div class=\"text-center d-flex flex-column align-items-center\">
                        <img src=\"$connection[profile_pic]\" alt=\"\" class=\"profile-picture\">
                        <span class=\"fs-3\">$connection[first_name]</span>
                    </div>
                </a>
                    ";
                }
                ?>
            </div>
        </div>
        <!--        The code for loading a messaging window once one of the above generated profile links is select goes in here;-->
        <div class="col-md-11">
            <div class="container-fluid h-100" style="background-color: #C6C7FF">
                <div class="row text-center">
                    <h1 class="connection-name display-5" style="background-color: #99a1ff">Euan Bourkemeister</h1>
                </div>
                <div class="row overflow-y-auto">

                </div>
            </div>
        </div>
    </div>
</div>
<?php
require_once "../templates/footer.php";
?>
</body>