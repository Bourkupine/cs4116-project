<?php
require_once "../database/database_connect.php";
require_once "../database/user_interests.php";
require_once "../database/user_languages.php";
require_once "../database/users.php";
require_once "../database/profiles.php";
require_once "../database/interests.php";
require_once "../database/languages.php";
require_once "../templates/header.php";

try {
    $db_con = connect();
} catch (Exception $e) {
    $code = $e->getCode();
    $message = $e->getMessage();
    $file = $e->getFile();
    $line = $e->getLine();
    echo "<script> console.log(\"Exception thrown in $file on line $line: [Code $code] $message\"); </script>";
}
$relevant_user_id = get_relevant_user($db_con);
$profile_picture_path = get_profile_picture_by_user_id($db_con, $_SESSION["user_id"]);
if (!$profile_picture_path) {
    $profile_picture_path = "../../assets/pfp-placeholder.png";
}
$user_interest_ids = get_user_interests_by_user_id($db_con, $_SESSION["user_id"]);
$user_language_ids = get_user_languages_by_user_id($db_con, $_SESSION["user_id"]);
$language_ids = get_all_languages($db_con);
?>

<head>
    <?php require_once "../templates/header.php"; ?>

    <?php
    if (!isset($_SESSION["logged-in"])) {
        header("Location: ../home");
    } ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.css">
    <link rel="stylesheet" href="dashboard.css">
    <title>Love Languages - Dashboard</title>

</head>

<body>
<?php require_once "../navbar/navbar.php"; ?>
<div class="container">
    <div class="row">
        <div class="col-md-4 p-3 d-flex d-md-block">
            <div class="col-6 col-md-12 d-flex flex-column ">
                <span class="name"><i><?php echo $_SESSION["first_name"] . " " . $_SESSION["surname"]; ?></i></span>
                <span class="info"><?php echo $_SESSION["country"] . ", " . $_SESSION["region"]; ?></span>
                <span class="info"><?php echo $_SESSION["age"] . ", " . $_SESSION["sex"]; ?></span>
            </div
        </div>
        <button type="submit" class="edit-button-no" >
        <img class="img-fluid" src="../../assets/no.png" alt="No">
        </button>
    </div>
    <div class="col-md-4 p-3 d-flex d-md-block">
        <div class="col-6 col-md-12 d-flex flex-column ">
            <img class="img-fluid" src="<?= $profile_picture_path ?>" alt="profile picture">
        </div>

        <span><b>Known Languages:</b></span>
        <ul>
            <?php
            if ($user_language_ids) {
                foreach ($user_language_ids as $language_id => $status) {
                    if (strcmp("speaks", $status) == 0) {
                        echo "<li>" . $language_ids[$language_id] . "</li>";
                    }
                }
            }
            ?>
        </ul>
        <span><b>Learning Languages:</b></span>
        <ul>
            <?php
            if ($user_language_ids) {
                foreach ($user_language_ids as $language_id => $status) {
                    if (strcmp("learning", $status) == 0) {
                        echo "<li>" . $language_ids[$language_id] . "</li>";
                    }
                }
            }
            ?>
        </ul>
    </div>
    <div class="col-md-4 p-3 d-flex d-md-block">
        <div class="col-6 col-md-12 d-flex flex-column ">
            <span><b>Interests:</b></span>
            <ul>
                <?php
                if ($user_interest_ids) {
                    foreach ($user_interest_ids as $interest_id) {
                        echo "<li>" . get_interest_name_by_interest_id($db_con, $interest_id) . "</li>";
                    }
                }
                ?>
            </ul>
        </div>
        <button type="submit" class="edit-button-yes" >
        <img class="img-fluid" src="../../assets/yes.png" alt="Yes">
        </button>
    </div>
    <script
            src="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.js"
            crossorigin="anonymous"
    ></script>

    <?php require_once "../templates/footer.php"; ?>
</body>