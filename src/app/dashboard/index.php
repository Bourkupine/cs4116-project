<head>
    <?php require_once "../templates/header.php"; ?>
    <?php
    if (!isset($_SESSION["logged-in"])) {
        header("Location: ../home");
    } ?>
  <title>Love Languages - Dashboard</title>
</head>

<body>
<?php require_once "../navbar/navbar.php"; ?>

<h1 class="slogan-text">COMING SOON!</h1>

<?php require_once "../templates/footer.php"; ?>
</body>