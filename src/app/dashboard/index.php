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
//$relevant_user_id = get_relevant_user($db_con);
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
  <div class="row pt-1 pt-sm-5 pb-2">
    <div class="col-6 col-sm-4 p-3 d-flex flex-column justify-content-between order-1">
      <div class="d-flex flex-column">
        <span class="name"><i><?php echo $_SESSION["first_name"] . " " . $_SESSION["surname"]; ?></i></span>
        <span class="info"><?php echo "@" . $_SESSION["country"] . ", " . $_SESSION["region"]; ?></span>
        <span class="info"><?php echo $_SESSION["age"] . ", " . $_SESSION["sex"]; ?></span>
      </div>
    </div>

    <div class="col-12 col-sm-4 d-flex flex-column justify-content-evenly order-3 order-sm-2">
      <div class="pfp">
        <img class="img-fluid" src="<?= $profile_picture_path ?>" alt="profile picture">
      </div>
      <div class="d-flex justify-content-between pt-5">
        <div class="language-box">
          <span><b>Speaks</b></span>
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
        </div>
        <div class="language-box">
          <span><b>Practising</b></span>
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
      </div>
    </div>

    <div class="col-6 col-sm-4 p-3 d-flex flex-column align-items-center order-2 order-sm-3">
        <?php
        if ($user_interest_ids) {
            foreach ($user_interest_ids as $interest_id) {
                echo "<div class=\"interest w-50 p-1 mt-1\">" . get_interest_name_by_interest_id($db_con, $interest_id) . "</div>";
            }
        }
        ?>
    </div>
  </div>

  <div class="d-flex justify-content-between">
    <button type="submit" class="heart-button">
      <img class="img-fluid" src="../../assets/no.png" alt="No">
    </button>

    <button type="submit" class="heart-button">
      <img class="img-fluid" src="../../assets/yes.png" alt="Yes">
    </button>
  </div>

  <script
    src="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.js"
    crossorigin="anonymous"
  ></script>

    <?php require_once "../templates/footer.php"; ?>
</body>