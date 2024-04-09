<?php
require_once "../register/gender-preference.php";
require_once "../register/countries.php";
require_once "../database/database_connect.php";
require_once "../database/interests.php";
require_once "../database/languages.php";
require_once "search_submit.php";


try {
    $connection = connect();
    $languages = get_all_languages($connection);
    $interests = get_all_interests($connection);
    disconnect($connection);
} catch (Exception $e) {
    $code = $e->getCode();
    $message = $e->getMessage();
    $file = $e->getFile();
    $line = $e->getLine();
    echo "<script> console.log(\"Exception thrown in $file on line $line: [Code $code] $message\"); </script>";
}

$submit_message = "";

if (isset($_POST['submit'])) {
    $users = search($connection);
    foreach ($users as $user) {
        echo "<li>$user[0]</li>";
    }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    require_once "../templates/header.php";
    ?>

    <!--    if (!isset($_SESSION["logged-in"])) {-->
    <!--        header("Location: ../home");-->
    <!--    }-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.css">
    <title>Love Languages - Search</title>
    <link rel="stylesheet" type="text/css" href="search.css"
</head>

<body>
<?php require_once "../navbar/navbar.php"; ?>
<h1 class="slogan-text">COMING SOON!</h1>

<div class="container-fluid">
    <div class="row">
        <div class="col-4 filters">
            <form method="post">
                <div class="row">
                    <select name="gender" class="form-control" required>
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
                <div class="row">
                    <select name="country" class="form-control col" required>
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
                            class="interest-select form-control"
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
                    <label for="learning-languages">Known Languages</label>
                    <select name="learning-languages[]" multiple
                            class="language-select form-control"
                            id="learning-languages">
                        <?php foreach ($languages as $language_id => $language) {
                            if (
                                isset($_POST["learning-languages"]) &&
                                in_array($language_id, $_POST["learning-languages"])
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
                        const learningLanguagesDropdown = new Choices("#learning-languages", {
                            removeItemButton: true
                        });
                    });
                </script>

                <div class="submit-button">
                    <button name="submit" type="submit" class="btn text-white ll-button">Register</button>
                </div>

            </form>

        </div>

        <div class="col-8 users">
            <?php
            if (isset($_POST['submit'])) {
                $users = search($connection);
                foreach ($users as $user) {
                    $id = $user[0];
                    $name = $user[1];
                    echo "<li>$id: $name</li>";
                }
            }
            ?>
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
