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
    <div class="row h-100 g-0">
        <div class="col-md-1 overflow-auto d-flex flex-md-column connections-list align-items-center">
            <input type="text" class="form-control rounded-5 m-3 d-md-inline d-none w-75 "
                   id="search" placeholder="Search..." style="background-color: #c6c7ff">

            <?php
            foreach ($connections as $connection) {
                echo "
                    <a class='connection m-2' data-connection-id='$connection[connection_id]'>
                        <div class='text-center d-flex flex-column'>
                            <img src='$connection[profile_pic]' alt='' class='img-fluid profile-pic'>
                            <span class='fs-4'>$connection[first_name]</span>
                        </div>
                    </a>
                ";
            }
            ?>
        </div>
        <div class="col d-flex flex-column connection-box">
            <h1 class="text-center connection-name g-0" id="connection-name"></h1>
            <div class="container-fluid flex-grow-1 overflow-auto" id="messages-container"
                 style="background-color: #c6c7ff">
            </div>
            <form class="d-flex justify-content-center">
                <input type="text" class="form-control w-75 my-3 align-self-center bg-dark-subtle sticky-bottom"
                       id="message_container" placeholder="Write a message...">
                <button type="submit" class="btn bg-dark-subtle h-50 align-self-center">Send</button>
            </form>
        </div>
    </div>
</div>

<script>


    function load_connection(element, user_id, user_pfp) {
        {
            document.getElementById("connection-name").innerText = element.getElementsByTagName("span")[0].innerText
            let messages_html = ""
            fetch("connection_click.php", {
                method: "POST",
                header: {
                    "Content-Type": "application/json",
                },
                body: JSON.stringify({
                    "connection_id": element.getAttribute("data-connection-id")
                })
            }).then(async (response) => {
                return JSON.parse(await response.text())
            }).then((messages) => {
                for (const message of messages) {
                    let pfp, align
                    if (message["sender_id"] === user_id) {
                        pfp = user_pfp
                        align = "flex-row-reverse"
                    } else {
                        pfp = element.getElementsByTagName("img")[0].getAttribute("src")
                        align = "flex-row"
                    }
                    messages_html += `
                    <div class="row d-flex ${align}">
                        <div class="col-1">
                            <img src="${pfp}" alt="" class="img-fluid">
                        </div>
                        <div class="col-5 rounded-5 text-center m-4 p-3 align-content-center bg-danger-subtle">
                            <span class="fs-5 ">${message["message"]}</span>
                        </div>
                    </div>
                    `
                }
                document.getElementById("messages-container").innerHTML = messages_html
            })
        }
    }

    const user_id = <?php echo json_encode($_SESSION["user_id"]);?>;
    const user_pfp = <?php echo json_encode($_SESSION["profile_pic"])?>;
    const connection_selected_id = <?php
        if (isset($_POST["connection-selected"])) {
            echo json_encode($_POST["connection-selected"]);
        } else {
            echo 0;
        }
        ?>;

    console.log(connection_selected_id)

    if (connection_selected_id !== 0) {
        if document.getElementsByClassName().length > 0 {
        for (const connection of document.getElementsByClassName("connection")) {
            if connection.getAttribute("data-connection-id") === connection_selected_id {
                load_connection(connection, user_id, user_pfp)
            }
        }
    }

    const search = document.getElementById("search")
    search.addEventListener("input", function () {
        for (const element of document.getElementsByClassName("connection")) {
            if (element.getElementsByTagName("span")[0].innerText.toLowerCase().includes(search.value.toLowerCase())) {
                element.style.display = "inline"
            } else {
                element.style.display = "none"
            }
        }
    })

    for (const element of document.getElementsByClassName("connection")) {
        element.addEventListener("click", () => {
            load_connection(element, user_id, user_pfp)
        })
    }

    document.getElementById("messages-container").addEventListener("submit", function (e) {
        console.log(e)
    })

</script>

<?php
require_once "../templates/footer.php";
?>
</body>
