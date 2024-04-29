<?php
require_once "../register/gender-preference.php";
require_once "../register/countries.php";
require_once "../database/database_connect.php";
require_once "../database/interests.php";
require_once "../database/languages.php";
require_once "../database/user_ratings.php";
require_once "../database/connections.php";
require_once "search_submit.php";


try {
    $connection = connect();
    $languages = get_all_languages($connection);
    $interests = get_all_interests($connection);
} catch (Exception $e) {
    $code = $e->getCode();
    $message = $e->getMessage();
    $file = $e->getFile();
    $line = $e->getLine();
    echo "<script> console.log(\"Exception thrown in $file on line $line: [Code $code] $message\"); </script>";
}

$submit_message = "";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    require_once "../templates/header.php";
    if (!isset($_SESSION["logged-in"])) {
        header("Location: ../home");
    }
    ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.css">
    <title>Love Languages - Search</title>
    <link rel="stylesheet" type="text/css" href="search.css"
</head>

<?php
function can_create_connection(mysqli $connection, int $rating_user_id, int $rated_user_id): bool
{
    $ratings_rating = get_rating_of_user($connection, $rating_user_id, $rated_user_id);
    $rateds_rating = get_rating_of_user($connection, $rated_user_id, $rating_user_id);
    if ($ratings_rating && $rateds_rating) {
        return (strcasecmp($ratings_rating, "like") == 0) && (strcasecmp($rateds_rating, "like") == 0);
    }
    return false;
}

if (isset($_POST["match_user_btn"])) {
    if (create_rating($connection, $_SESSION["user_id"], $_POST["match_user_id"], "like")) {
        $submit_message = "Liked " . $_POST["match_user_name"] . "!";
        if (can_create_connection($connection, $_SESSION["user_id"], $_POST["match_user_id"])) {
            create_connection($connection, $_SESSION["user_id"], $_POST["match_user_id"]);
            $submit_message = "Connected with " . $_POST["match_user_name"] . "!";
        }
    }
} else if (isset($_POST["unmatch_user_btn"])) {
    if (remove_rating($connection, $_SESSION["user_id"], $_POST["match_user_id"])){
        $submit_message = "Unliked " . $_POST["match_user_name"] . "!";
        if (does_connection_exist($connection, $_SESSION["user_id"], $_POST["match_user_id"])) {
            delete_connection($connection, $_SESSION["user_id"], $_POST["match_user_id"]);
            $submit_message = "Disconnected with " . $_POST["match_user_name"] . "!";
        }
    }
}
?>

<body>
<?php require_once "../navbar/navbar.php"; ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-12 col-lg-4 filters align-content-lg-center">
            <form method="post" class="mx-5 my-5">
                <div class="row my-3">
                    <input type="text" class="form-control" placeholder="Name" id="search-box" aria-label="search"
                        name="search-box">
                </div>
                <div class="row my-3">
                    <select name="gender" class="form-control">
                        <option value="" disabled
                            <?php if (!isset($_POST["gender"])) {
                                echo "selected";
                            } ?>
                        >Gender
                        </option>
                        <?php foreach ($gender_arr as $gender) {
                            if (
                                isset($_POST["gender"]) &&
                                strcmp($_POST["gender"], $gender) == 0
                            ) {
                                echo "<option value=\"$gender\" selected>$gender</option>";
                            } else {
                                echo "<option value=\"$gender\">$gender</option>";
                            }
                        } ?>
                    </select>
                </div>
                <div class="row my-3">
                    <select name="country" class="form-control">
                        <option value="" disabled
                            <?php if (!isset($_POST["country"])) {
                                echo "selected";
                            } ?>
                        >Country
                        </option>
                        <?php foreach ($countries as $country) {
                            if (
                                isset($_POST["country"]) &&
                                strcmp($_POST["country"], $country) == 0
                            ) {
                                echo "<option value=\"$country\" selected>$country</option>";
                            } else {
                                echo "<option value=\"$country\">$country</option>";
                            }
                        } ?>
                    </select>
                </div>
                <div class="form-group ps-2 pe-2 mb-2">
                    <label for="interests">Interests</label>
                    <select name="interests[]" multiple
                            class="form-control"
                            id="interests">
                        <?php foreach ($interests as $interest_id => $interest) {
                            if (
                                isset($_POST["interests"]) &&
                                in_array($interest_id, $_POST["interests"])
                            ) {
                                echo "<option value=\"$interest_id\" selected>$interest</option>";
                            } else {
                                echo "<option value=\"$interest_id\">$interest</option>";
                            }
                        } ?>
                    </select>
                </div>
                <div class="form-group ps-2 pe-2 mb-2">
                    <label for="fluent-languages">Speaks</label>
                    <select name="fluent_languages[]" multiple
                            class="form-control"
                            id="fluent-languages">
                        <?php foreach ($languages as $language_id => $language) {
                            if (
                                isset($_POST["fluent_languages"]) &&
                                in_array($language_id, $_POST["fluent_languages"])
                            ) {
                                echo "<option value=\"$language_id\" selected>$language</option>";
                            } else {
                                echo "<option value=\"$language_id\">$language</option>";
                            }
                        } ?>
                    </select>
                </div>
                <div class="form-group ps-2 pe-2 mb-2">
                    <label for="learning-languages">Learning</label>
                    <select name="learning_languages[]" multiple
                            class="form-control"
                            id="learning-languages">
                        <?php foreach ($languages as $language_id => $language) {
                            if (
                                isset($_POST["learning_languages"]) &&
                                in_array($language_id, $_POST["learning_languages"])
                            ) {
                                echo "<option value=\"$language_id\" selected>$language</option>";
                            } else {
                                echo "<option value=\"$language_id\">$language</option>";
                            }
                        } ?>
                    </select>
                </div>

                <script>
                    $(document).ready(function () {
                        const interestsDropdown = new Choices("#interests", {
                            removeItemButton: true
                        });
                        const fluentLanguagesDropdown = new Choices("#fluent-languages", {
                            removeItemButton: true
                        });
                        const learningLanguagesDropdown = new Choices("#learning-languages", {
                            removeItemButton: true
                        });
                    });
                </script>

                <div class="submit-button text-center my-4">
                    <button name="submit" type="submit" class="btn search-button text-white ll-button px-4">
                        <i class="fa-solid fa-magnifying-glass pe-3"></i>Search
                    </button>
                </div>
                <div class="d-flex justify-content-center">
                    <small class="text-success text-center"><?php echo $submit_message ?></small>
                </div>
            </form>
        </div>

        <div class="col-12 col-lg-8 users scroll">
            <div class="list-group my-2">
                <?php
                if (isset($_POST['submit'])) {

                    $users = search($connection);
                    if (isset($_POST['search-box']) && $_POST['search-box'] != "") {
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
                    $liked_users = get_rated_users_by_user_id($connection, $_SESSION['user_id']);
                    foreach ($users as $user) {

                        $interest_str = rtrim(implode(", ", $user[6]), ",");
                        $speaks_str = rtrim(implode(", ", $user[7]), ",");
                        $learning_str = rtrim(implode(", ", $user[8]), ",");
                        $user[5] ? $profile_pic_path = $user[5] : $profile_pic_path = "../../assets/pfp-placeholder.png";

                        $match_btn = in_array($user[0], $liked_users) ?
                            "<input class='w-75 p-1 p-lg-2 p-xl-3 match-button' type='submit' name='unmatch_user_btn' value='Unmatch'>" :
                            "<input class='w-75 p-1 p-lg-2 p-xl-3 match-button' type='submit' name='match_user_btn' value='Match'>";


                        echo "
                            <div class=\"card mb-2\" style=\"background-color: #C6C7FF\">
                                <div class=\"row align-items-center\">
                                    <div class=\"col-4 col-md-2\">
                                        <img class=\"pic img-fluid rounded ms-2 my-2\" src=\"$profile_pic_path\" alt=\"\">
                                    </div>
                                    <div class=\"col\">
                                        <div class=\"card-body\">
                                            <div class=\"row\">
                                                <div class=\"col-12 col-md-4\">
                                                    <h5 class=\"d-flex d-md-none card-title\">$user[1] $user[2]</h5>
                                                    <h3 class=\"d-none d-md-flex card-title\">$user[1] $user[2]</h3>
                                                    <p class=\"card-text\">$user[3], $user[9] - @$user[4]</p>
                                                    <p class=\"d-none d-md-block card-text\">$interest_str</p>
                                                </div>
                                                <div class=\"col-5 d-none d-md-inline-block\">
                                                    <h5 class=\"card-title mt-2\"><u>Languages</u></h5>
                                                    <p class=\"card-text\"><b>Speaks</b>: $speaks_str</p>
                                                    <p class=\"card-text\"><b>Learning</b>: $learning_str</p>
                                                </div>
                                                <div class=\"col d-inline-block align-content-center\">
                                                    <form method='post'>
                                                        <input type='hidden' name='match_user_id' value='$user[0]'>
                                                        <input type='hidden' name='match_user_name' value='$user[1] $user[2]'>
                                                        $match_btn
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        ";
                    }
                }
                ?>
            </div>
        </div>
    </div>

</div>
<script
        src="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.js"
        crossorigin="anonymous"
></script>
<?php require_once "../templates/footer.php"; ?>
</body>
</html>
