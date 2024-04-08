<?php
if (isset($_POST["sign-out"])) {
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
  <link rel="stylesheet" href="profile.css">
  <title>Love Languages - Profile</title>
</head>

<?php
require "../database/database_connect.php";
require "../database/user_interests.php";
require "../database/user_languages.php";
require "../database/interests.php";
require "../database/languages.php";

try {
    $db_con = connect();
} catch (Exception $e) {
    $code = $e->getCode();
    $message = $e->getMessage();
    $file = $e->getFile();
    $line = $e->getLine();
    echo "<script> console.log(\"Exception thrown in $file on line $line: [Code $code] $message\"); </script>";
}
$user_interest_ids = get_user_interests_by_user_id($db_con, $_SESSION["user_id"]);
$user_language_ids = get_user_languages_by_user_id($db_con, $_SESSION["user_id"]);
?>

<body>
<?php require_once "../navbar/navbar.php"; ?>

<div class="container-fluid">
  <div class="row">
    <div class="col-md-4 p-3 d-flex d-md-block">
      <div class="col-6 col-md-12 d-flex flex-column align-items-center">
        <img class="img-fluid pfp" src="../../assets/ll-logo-gradient.png" alt="profile picture">
        <span class="name"><i><?php echo $_SESSION["first_name"] . " " . $_SESSION["surname"]; ?></i></span>
        <span class="info"><?php echo $_SESSION["country"] . ", " . $_SESSION["region"]; ?></span>
        <span class="info"><?php echo $_SESSION["age"] . ", " . $_SESSION["sex"]; ?></span>
      </div>
      <div class="col-6 col-md-12 mt-md-3">
        <div class="ms-5 text">
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
        <button class="edit-button text float-end pe-4">
          <i class="fa-regular fa-pen-to-square"></i>
          Edit Profile
        </button>
      </div>
    </div>

    <div class="col-md-8 pt-3">
      <div class="text-box text text-white p-3 mb-3">
        <span><b>Bio:</b></span>
        <p>
            <?php echo $_SESSION["bio"] ?>
        </p>
      </div>
      <div class="text-box text text-white p-3 mb-3">
        <span><b>Known Languages:</b></span>
        <ul>
            <?php
            if ($user_language_ids) {
                foreach ($user_language_ids as $language_id => $status) {
                    if (strcmp("speaks", $status) == 0) {
                        echo "<li>" . get_language_name_by_language_id($db_con, $language_id) . "</li>";
                    }
                }
            }
            ?>
        </ul>
        <div class="d-flex justify-content-center">
          <button class="edit-button text-white text">
            <i class="fa-regular fa-pen-to-square"></i>
            Edit
          </button>
        </div>
      </div>
      <div class="text-box text text-white p-3 mb-3">
        <span><b>Learning Languages:</b></span>
        <ul>
            <?php
            if ($user_language_ids) {
                foreach ($user_language_ids as $language_id => $status) {
                    if (strcmp("learning", $status) == 0) {
                        echo "<li>" . get_language_name_by_language_id($db_con, $language_id) . "</li>";
                    }
                }
            }
            ?>
        </ul>
        <div class="d-flex justify-content-center">
          <button class="edit-button text-white text">
            <i class="fa-regular fa-pen-to-square"></i>
            Edit
          </button>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="d-flex justify-content-evenly justify-content-md-end mb-3">
      <form method="post">
        <button class="footer-btn text btn btn-danger me-3" name="sign-out" type="submit">
          Sign out
        </button>
      </form>
      <form method="post">
        <button class="footer-btn text btn btn-outline-danger me-3">
          Delete Account
        </button>
      </form>
    </div>
  </div>
</div>

<?php require_once "../templates/footer.php"; ?>
</body>