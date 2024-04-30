<head>
    <?php require_once "../templates/header.php";
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
require_once "../database/messages.php";

try {
    $db_con = connect();
    $connections = get_connections($db_con, $_SESSION["user_id"]);
} catch (Exception $e) {
    echo $e;
}
?>

<div class="container-fluid h-100 g-0" style="background-color: #99a1ff">
    <div class="row h-100 d-flex flex-column flex-md-row g-0">
        <div class="col-md-1 d-flex flex-md-column overflow-auto" id="connections-box">
            <input type="text" class="form-control rounded-pill my-3 py-2 d-md-inline d-none"
                   id="search" placeholder="Search..." style="background-color: #c6c7ff">
            <?php
            foreach ($connections as $connection) {
                echo "
                <a class='connection d-flex flex-column align-items-center justify-content-center my-md-3 mx-3 mx-md-0'
                data-first-name='$connection[first_name]'
                data-surname='$connection[surname]'
                data-connection-id='$connection[connection_id]'
                data-user_id='$connection[user_id]'
                data-profile-pic='$connection[profile_pic]'>
                    <img src='$connection[profile_pic]' class='h-75 w-75'>
                    <span class='fs-5 d-none d-md-inline'>$connection[first_name]</span>
                </a>
                ";
            }
            ?>
        </div>
        <div class="col d-flex flex-column h-100">
            <p class="text-center align-content-center display-4" id="connection-name"></p>
            <div class="container-fluid flex-grow-1 d-flex flex-column overflow-auto" id="messages-box" style="background-color: #c6c7ff">
            </div>
            <form class="d-flex" id="send-message-form">
                <input type="text" class="form-control" id="send-message-text" placeholder="Send a message..." disabled>
                <button class="btn" type="submit" id="send-message-button" disabled>Send</button>
            </form>
        </div>
    </div>
</div>

<?php
require_once "../templates/footer.php";
?>

</body>

<script>
    const user_id = <?php echo json_encode($_SESSION["user_id"]);?>;
    const user_profile_pic = <?php echo json_encode($_SESSION["profile_pic"]);?>;
    let cur_connection_id, other_user_pfp;
</script>

<script src="connections.js"></script>