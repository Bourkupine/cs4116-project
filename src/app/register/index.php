<?php
/**
 * @var array $gender_arr
 * @var array $preference_arr
 * @var array $countries
 */

require 'gender-preference.php';
require 'countries.php';
require "register-functions.php";
require '../database/database-connect.php';
require '../database/languages.php';

try {
    $connection = connect();
    $languages = get_all_languages($connection);
} catch (Exception $e) {
    $code = $e->getCode();
    $message = $e->getMessage();
    $file = $e->getFile();
    $line = $e->getLine();
    echo "<script> console.log(\"Exception thrown in $file on line $line: [Code $code] $message\"); </script>";
}

$submit_message = "";
$redirect_to_login = "";
if (isset($_POST["submit"])) {
    if (!validate_password($_POST["password"], $_POST["password_confirm"])) {
        $submit_message =
            "<small class=\"text-muted\">Passwords do not match</small>";
    } elseif (!isset($_POST['fluent_languages'])) {
        $submit_message =
            "<small class=\"text-muted\">Please select at least one fluent language</small>";
    } elseif (!isset($_POST['learning_languages'])) {
        $submit_message =
            "<small class=\"text-muted\">Please select at least one learning language</small>";
    } else {
      if (create_account($connection,
                         $_POST['firstname'],
                         $_POST['lastname'],
                         $_POST['email'],
                         $_POST['password'],
                         $_POST['gender'],
                         $_POST['preference'],
                         $_POST['country'],
                         $_POST['region'],
                         $_POST['age'],
                         $_POST['fluent_languages'],
                         $_POST['learning_languages'])) {
        $submit_message =
            "<small class=\"text-muted\">Account registered successfully!</small>";
        header("refresh: 1; url=../login");
      } else {
        $submit_message =
            "<small class=\"text-muted\">Failed to register account, please try again</small>";
      }
    }
}

disconnect($connection);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
    rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
    crossorigin="anonymous"
  />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.css">
  <link rel="stylesheet" href="../styles.css" />
  <link rel="stylesheet" href="register.css" />

  <meta name="viewport" content="width=device-width, initial-scale=1"/>
  <title>Love Languages - Register</title>
</head>

<body>
<?php include "../navbar/navbar.php"; ?>
<div class="container">
  <div class="row">
    <div class="col">
      <form method="post">

        <div class="basic-info">
          <div class="form-group m-2 mt-4">
            <input name="firstname" type="text" class="form-control" placeholder="First Name"
                   required minlength="2" maxlength="32" pattern="^[A-Za-z]+$"
                <?php if (isset($_POST["firstname"])) {
                    echo "value=\"" . $_POST["firstname"] . "\"";
                } ?>>
          </div>
          <div class="form-group m-2">
            <input name="lastname" type="text" class="form-control" placeholder="Last Name"
                   required minlength="2" maxlength="32" pattern="^[A-Za-z ']+$"
                <?php if (isset($_POST["lastname"])) {
                    echo "value=\"" . $_POST["lastname"] . "\"";
                } ?>>
          </div>
          <div class="form-group m-2">
            <input name="email" type="email" class="form-control" placeholder="Email"
                   required maxlength="64" pattern="^[\w\.-]+@([\w-]+\.)+[\w-]{2,5}$"
                <?php if (isset($_POST["email"])) {
                    echo "value=\"" . $_POST["email"] . "\"";
                } ?>>
          </div>
          <div class="form-group m-2">
            <input name="password" type="password" class="form-control" placeholder="Password" aria-describedby="passwordHelp"
                   required minlength="8" maxlength="32" pattern="(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}"
                <?php if (isset($_POST["password"])) {
                    echo "value=\"" . $_POST["password"] . "\"";
                } ?>>
            <small id="passwordHelp" class="form-text text-muted">
              Passwords need 8 or more characters with a number, uppercase, and lowercase character
            </small>
          </div>
          <div class="form-group m-2">
            <input name="password_confirm" type="password" class="form-control" placeholder="Confirm Password"
                   required minlength="8" maxlength="32" pattern="(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}"
                <?php if (isset($_POST["password_confirm"])) {
                    echo "value=\"" . $_POST["password_confirm"] . "\"";
                } ?>>
          </div>

          <div class="row ps-2 pe-2 mb-2">
            <div class="col">
              <select name="gender" class="form-control" required>
                <option value="" disabled
                    <?php if (!isset($_POST["gender"])) {
                        echo "selected";
                    } ?>
                >Gender</option>
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
            <div class="col">
              <select name="preference" class="form-control col" required>
                <option value="" disabled
                    <?php if (!isset($_POST["preference"])) {
                        echo "selected";
                    } ?>
                >I am looking for...</option>
                  <?php foreach ($preference_arr as $pref) {
                      if (
                          isset($_POST["preference"]) &&
                          strcmp($_POST["preference"], $pref) == 0
                      ) {
                          echo "<option value=\"$pref\" selected>$pref</option>";
                      } else {
                          echo "<option value=\"$pref\">$pref</option>";
                      }
                  } ?>
              </select>
            </div>
          </div>

          <div class="row ps-2 pe-2 mb-2">
            <div class="form-group col">
              <select name="country" class="form-control col" required>
                <option value="" disabled
                    <?php if (!isset($_POST["country"])) {
                        echo "selected";
                    } ?>
                >Country</option>
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
            <div class="form-group col">
              <input name="region" type="text" class="form-control" placeholder="State/County" required
                     minlength="2" maxlength="32" pattern="[A-Za-z0-9,'-]+"
                  <?php if (isset($_POST["region"])) {
                      echo "value=\"" . $_POST["region"] . "\"";
                  } ?>>
            </div>
          </div>

          <div class="form-group m-2">
            <input name="age" type="number" class="form-control w-25" placeholder="Age"
                   required min="18" max="120" pattern="[0-9]{2,5}"
                <?php if (isset($_POST["age"])) {
                    echo "value=\"" . $_POST["age"] . "\"";
                } ?>>
          </div>

          <div class="form-group ps-2 pe-2 mb-2">
            <label for="fluent-languages">I am fluent in...</label>
            <select name="fluent_languages[]" multiple
                    class="language-select form-control"
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
            <label for="learning-languages">I am learning...</label>
            <select name="learning_languages[]" multiple
                    class="language-select form-control"
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
            $(document).ready(function() {
              const learningLanguagesDropdown = new Choices("#learning-languages", {
                removeItemButton: true
              });
              const fluentLanguagesDropdown = new Choices("#fluent-languages", {
                removeItemButton: true
              });
            });
          </script>

          <div class="submit-button">
            <button name="submit" type="submit" class="btn text-white ll-button">Register</button>
              <?php echo $submit_message; ?>
          </div>

        </div>
      </form>
    </div>

    <div class="col d-none d-lg-block">
      <div class="logo-image pt-3 pb-4">
        <img src="../../assets/ll-logo-gradient.png" alt="logo">
      </div>
      <div class="slogan slogan-text pt-2">
        <span>LOVE SPEAKS EVERY LANGUAGE</span>
      </div>
    </div>

  </div>
</div>

<script
  src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
  integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
  crossorigin="anonymous"
></script>
<script
  src="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.js"
  crossorigin="anonymous"
></script>
<script
  src="https://kit.fontawesome.com/3af37769b5.js"
  crossorigin="anonymous"
></script>
</body>
</html>