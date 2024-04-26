<?php

require_once "../database/database_connect.php";
require_once "../database/users.php";
require_once "list_users.php";

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

<?php
require_once "modals/delete-user.php";
require_once "modals/edit-user.php";
require_once "modals/ban-user.php";
require_once "modals/unban-user.php";
?>

<body>

<?php
require_once("../navbar/navbar.php");

if (isset($_POST['delete-btn'])) {
    delete_user_by_user_id($connection, intval($_POST['user-id']));
}


?>

<script>
    function getDeleteUserInfo(user_id) {
        $.ajax({
            type: "POST",
            url: 'modal_backend.php',
            data: {
                'id': user_id,
                'action': 'delete-user',
            },
            success: function (response) {
                $('.delete-modal').html(response);
            }
        });
    }

    function getBanUserInfo(user_id) {
        $.ajax({
            type: "POST",
            url: 'modal_backend.php',
            data: {
                'id': user_id,
                'action': 'ban-user',
            },
            success: function (response) {
                $('.ban-modal').html(response);
            }
        });
    }
    function getUnbanUserInfo(user_id) {
        console.log(user_id);
        $.ajax({
            type: "POST",
            url: 'modal_backend.php',
            data: {
                'id': user_id,
                'action': 'unban-user',
            },
            success: function (response) {
                $('.unban-modal').html(response);
            }
        });
    }
    function getEditUserInfo(user_id) {
        $.ajax({
            type: "POST",
            url: 'modal_backend.php',
            data: {
                'id': user_id,
                'action': 'edit-user',
            },
            success: function (response) {
                $('.edit-modal').html(response);
            }
        });
    }

</script>

<div class="container-fluid">
    <!-- Admin Header -->
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
    <!-- Search Box -->
    <div class="row">
        <form method="post">
            <div class="input-group">
                <div class="input-group-text">
                    <input class="form-check-input mt-0" type="checkbox" value="" id="search-banned"
                           name="search-banned" aria-label="checkbox">
                    <label class="form-check-label ms-1" for="search-banned">Banned Users</label>
                </div>
                <input type="text" class="form-control" placeholder="Name" id="search-box" aria-label="search"
                       name="search-box">
                <button class="btn" type="submit" name="search-button" id="search-button">Search</button>
            </div>
        </form>
    </div>
    <!-- User List -->
    <div class="row">
        <table class="table table-striped">
            <?php
            if (isset($_POST['search-button'])) {
            $users = get_user_list($connection);
            $banned_users = get_banned_users($connection);

            if (isset($_POST['search-banned'])) {
                $overlap = array();
                foreach ($users as $subarray) {
                    if (in_array($subarray[0], $banned_users)) {
                        $overlap[] = $subarray;
                    }
                }
                $users = $overlap;
            }

            if ($_POST['search-box'] != "") {
                $name_filter = array();
                foreach ($users as $user) {
                    $full_name = $user[1] . $user[2];
                    if (str_contains(str_replace(' ', '', strtolower($full_name)),
                            strtolower(str_replace(' ', '', $_POST['search-box'])))) {
                        $name_filter[] = $user;
                    }
                }
                $users = $name_filter;
            }

                echo "
                    <thead>
                        <tr>
                            <th scope=\"col\">ID #</th>
                            <th scope=\"col\">First</th>
                            <th scope=\"col\">Last</th>
                            <th scope='col'>Action</th>
                        </tr>
                    </thead>
                ";
                echo "<tbody>";

                foreach ($users as $user_info) {
                    $tr = in_array($user_info[0], $banned_users) ? "tr class='table-danger'" : "tr";
                    $ban_button = in_array($user_info[0], $banned_users) ?
                        "<button type='button' class=\"dropdown-item\" data-bs-toggle=\"modal\"
                            data-bs-target=\"#unban-user\" onclick=\"getUnbanUserInfo('$user_info[0]')\">Unban User</button>" :
                        "<button type='button' class=\"dropdown-item\" data-bs-toggle=\"modal\"
                            data-bs-target=\"#ban-user\" onclick=\"getBanUserInfo('$user_info[0]')\">Ban User</button>";
                    echo
                    "
                        <$tr>
                            <th scope='row'>$user_info[0]</th>
                            <td>$user_info[1]</td>
                            <td>$user_info[2]</td>
                            
                            <td>
                                <div class='dropdown'>
                                    <button class='ban-btn btn btn-secondary dropdown-toggle' type='button' data-bs-toggle='dropdown' aria-expanded='false'>
                                    Actions
                                    </button>
                                    <ul class='dropdown-menu'>
                                        <input type='hidden' value='$user_info[0]'>
                                        <li><button type='button' class='dropdown-item' data-bs-toggle='modal' 
                                        data-bs-target='#edit-user' onclick=\"getEditUserInfo('$user_info[0]')\">Edit User</button></li>
                                        <li>$ban_button</li>
                                        <li><button type='button' class='dropdown-item' data-bs-toggle='modal' 
                                        data-bs-target='#delete-user' onclick=\"getDeleteUserInfo('$user_info[0]')\">Delete Account</button></li>
                                    </ul>
                                </div>
                            </td>
                            
                        </tr>
                    ";
                }
                echo "</tbody>";
            }
            ?>
        </table>

    </div>
</div>

<?php
require_once("../templates/footer.php");
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</body>
</html>


