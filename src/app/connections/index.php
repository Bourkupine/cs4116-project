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
require_once "../database/messages.php";
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
                    <a class=\"list-group-item list-group-item-action connection\" style='background-color: #99A1FF' data-connectionID=$connection[connection_id]>
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
            <div class="container-fluid h-100 messages-container" style="background-color: #C6C7FF">
                <div class="row text-center">
                </div>
                <div class="row overflow-y-auto">
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
        crossorigin="anonymous">
</script>

<script>
    $(document).ready(function () {
        $(".connection").click(function () {
            let user_id = <?php echo json_encode($_SESSION["user_id"]);?>;
            let user_pfp = <?php echo json_encode($_SESSION["profile_pic"]);?>;
            let other_pfp = $(this).find("img").attr("src");
            let message_container_html = `
                <div class="row text-center">
                    <h1 class="connection-name display-5" style="background-color: #99a1ff">${$(this).find("span").text()}</h1>
                </div>
                <div class="row">
                    <div class="col overflow-y-auto">
            `
            $.post("connection_click.php", {
                connection_id: $(this).attr("data-connectionID")
            },
            function (data) {
                console.log(data);
                for (const message of data) {
                    let pfp = user_pfp;
                    if (message["sender_id"] === user_id) {
                        message_container_html += `<div class="row flex-row-reverse text-end">`;
                    } else {
                        message_container_html += `<div class="row text-start">`
                        pfp = other_pfp;
                    }
                    message_container_html += `
                            <div class="col-2">
                                <div class="row">
                                    <img src="${pfp}" class="img-fluid profile-picture">
                                </div>
                                <div class="row">
                                    <span>${message["date"]}</span>
                                </div>
                            </div>
                            <div class="col-6">
                                <p class="text-box rounded-pill p-4">${message["message"]}</p>
                            </div>
                        </div>
                    `
                }
                message_container_html += `
                    </div>
                </div>
                `
                $(".messages-container").html(message_container_html);
            }, "json");
        });
    });
</script>

<?php
require_once "../templates/footer.php";
?>
</body>