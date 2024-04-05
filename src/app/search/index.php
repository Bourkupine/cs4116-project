<head>
    <?php require_once "../templates/header.php"; ?>
  <title>Love Languages - Search</title>
</head>

<body>
<?php require_once "../navbar/navbar.php"; ?>

<?php
if (!isset($_SESSION["logged-in"])) {
    header("Location: ../home");
} ?>
<h1 class="slogan-text">COMING SOON!</h1>

<?php require_once "../templates/footer.php"; ?>
</body>