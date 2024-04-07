<?php
if (isset($_POST["submit"])) {
  session_start();
  session_unset();
}
?>

<head>
    <?php require_once "../templates/header.php"; ?>
    <?php
    if (!isset($_SESSION["logged-in"])) {
        header("Location: ../home");
    } ?>
    <title>Love Languages - Profile</title>
</head>

<body>
<?php require_once "../navbar/navbar.php"; ?>

<h1 class="slogan-text">COMING SOON!</h1>
<form method="post" class="ms-5">
  <button name="submit" type="submit" class="btn btn-danger">Log out</button>
</form>

<?php require_once "../templates/footer.php"; ?>
</body>