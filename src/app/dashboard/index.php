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

<?php
require_once "../database/database_connect.php";
require_once "../database/user_interests.php";
require_once "../database/user_languages.php";
require_once "../database/users.php";
require_once "../database/profiles.php";
require_once "../database/interests.php";
require_once "../database/languages.php";
require_once "dashboard-functions.php";

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
$language_ids = get_all_languages($db_con);

$eligible_users = get_eligible_user_ids($db_con, $_SESSION["preference"]);
$eligible_users = trim_eligible_users($db_con, $_SESSION["user_id"], $eligible_users, $_SESSION["sex"]);
$best_user_id = get_best_user_id($db_con, $_SESSION["user_id"], $user_interest_ids, $user_language_ids, $_SESSION["country"], $eligible_users);
if ($best_user_id) {
  $best_user_info = get_user_info($db_con, $best_user_id);
}

$profile_picture_path = $best_user_info["profile_pic"];
if (!$profile_picture_path) {
    $profile_picture_path = "../../assets/pfp-placeholder.png";
}
?>

<body>
<?php require_once "../navbar/navbar.php"; ?>

<?php if (!$best_user_id) {
  echo "<p class='slogan-text no-matches'>No matches available at the moment, please try again later!</p> ";
} else {
?>

<div class="container-fluid ps-sm-5 pe-sm-5">
  <div class="row pt-1 pt-sm-5 pb-2">
    <div class="col-8 col-sm-4 p-3 p-sm-0 d-flex flex-column justify-content-between order-1">
      <div class="d-flex flex-column">
        <span class="name"><i><?php echo $best_user_info["first_name"] . " " . $best_user_info["surname"]; ?></i></span>
        <span class="info"><?php echo "@" . $best_user_info["country"] . ", " . $best_user_info["region"]; ?></span>
        <span class="info"><?php echo $best_user_info["age"] . ", " . $best_user_info["sex"]; ?></span>
        <span class="bio"><?php echo $best_user_info["bio"]; ?></span>
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
              if ($best_user_info["user_languages"]) {
                  foreach ($best_user_info["user_languages"] as $language_id => $status) {
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
              if ($best_user_info["user_languages"]) {
                  foreach ($best_user_info["user_languages"] as $language_id => $status) {
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

    <div class="col-4 col-sm-4 p-3 p-sm-0 d-flex flex-column align-items-center order-2 order-sm-3">
        <?php
        if ($best_user_info["user_interests"]) {
            foreach ($best_user_info["user_interests"] as $interest_id) {
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

  <?php
  }
  ?>

  <script
    src="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.js"
    crossorigin="anonymous"
  ></script>

    <?php require_once "../templates/footer.php"; ?>
</body>