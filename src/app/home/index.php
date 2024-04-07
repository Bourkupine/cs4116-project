<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    require_once("../templates/header.php");
    ?>
    <?php
    if (isset($_SESSION["logged-in"])) {
        header("Location: ../dashboard");
    } ?>
    <title>Love Languages - Home</title>
    <link rel="stylesheet" type="text/css" href="home.css">
</head>

<body>

<?php
require_once("../navbar/navbar.php");
?>

<div class="container">
    <div class="pt-3 row">
        <div class="col-12">
            <h1 class="title slogan-text">The Dating Website for Language Lovers</h1>
        </div>
    </div>
    <div class="buttons pt-4 row">
        <a href="../register/" class="btn ll-button" role="button">Sign Up</a>
        <a href="../login/" class="btn ll-button" role="button">Log In</a>
    </div>

</div>
<?php
require_once("../templates/footer.php");
?>
</body>

</html>