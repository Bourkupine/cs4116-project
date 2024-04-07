<?php
require_once "../register/gender-preference.php";
require_once "../database/database_connect.php";
require_once "../database/interests.php";
require_once "../database/languages.php";


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
                <select name="gender" class="form-control">
                    <option value="" disabled
                        <?php if (!isset($_POST["gender"])) {
                            echo "seleceted";
                        } ?>
                    >Gender</option>
                    <?php foreach ($preference_arr as $gender) {
                        if (
                            isset($_POST["gender"]) &&
                            strcmp($_POST["gender"], $gender) == 0
                        ) {
                            echo "<option value=\"$gender\" selected>$gender</option>";
                        } else {
                            echo "<option value=\"$gender\">$gender</option>";
                        }
                    } ?>

            </form>

        </div>

        <div class="col-8 users">


        </div>

    </div>
</div>


<?php require_once "../templates/footer.php"; ?>
</body>
</html>
