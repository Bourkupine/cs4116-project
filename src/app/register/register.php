<?php
require "../../resources/gender-preference.php";
require "../../resources/countries.php";
require "../../resources/languages.php";

$error_message = '';
if (isset($_POST['submit'])) {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password_confirm = $_POST['password_confirm'];
    $gender = $_POST['gender'];
    $preference = $_POST['preference'];
    $country = $_POST['country'];
    $region = $_POST['region'];
    $fluent_languages = $_POST['fluent_languages'];
    $learning_languages = $_POST['learning_languages'];

    if (!validate_password($password, $password_confirm)) {
      $error_message = "<small class=\"text-muted\">Passwords do not match</small>";
    }
}

function validate_password($pass1, $pass2): bool
{
    return strcasecmp($pass1, $pass2) == 0;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="stylesheet" href="../styles.css" />
  <link rel="stylesheet" href="register.css" />
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
    rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
    crossorigin="anonymous"
  />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.css">
  <script src="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.js"></script>

  <title>Love Languages - Register</title>
</head>

<body>
<div class="container mb-2">
  <div class="row">
    <div class="col">
      <form action="" method="post">

        <div class="basic-info">
          <div class="form-group m-2 mt-4">
            <input name="firstname" type="text" class="form-control" aria-describedby="" placeholder="First Name"
                   required minlength="2" maxlength="32" pattern="^[A-Za-z]+$">
          </div>
          <div class="form-group m-2">
            <input name="lastname" type="text" class="form-control" placeholder="Last Name"
                   required minlength="2" maxlength="32" pattern="^[A-Za-z]+$">
          </div>
          <div class="form-group m-2">
            <input name="email" type="email" class="form-control" placeholder="Email"
                   required maxlength="64" pattern="^[\w\.-]+@([\w-]+\.)+[\w-]{2,5}$">
          </div>
          <div class="form-group m-2">
            <input name="password" type="password" class="form-control" placeholder="Password"
                   aria-describedby="passwordHelp" required minlength="8" maxlength="32"
                   pattern="(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}">
            <small id="passwordHelp" class="form-text text-muted">
              Passwords require at least one number, uppercase character, and lowercase character
            </small>
          </div>
          <div class="form-group m-2">
            <input name="password_confirm" type="password" class="form-control" placeholder="Confirm Password"
                   required minlength="8" maxlength="32" pattern="(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}">
          </div>

          <div class="gender-preference row ps-2 pe-2 mb-2">
            <div class="col">
              <select name="gender" class="form-control" required>
                <option value="" disabled selected>Gender</option>
                  <?php foreach ($gender_arr as $gender) {
                      echo "<option value=\"$gender\">$gender</option>";
                  } ?>
              </select>
            </div>
            <div class="col">
              <select name="preference" class="form-control col" required>
                <option value="" disabled selected>I am looking for...</option>
                  <?php foreach ($preference_arr as $pref) {
                      echo "<option value=\"$pref\">$pref</option>";
                  } ?>
              </select>
            </div>
          </div>

          <div class="location-region row ps-2 pe-2 mb-2">
            <div class="form-group col">
              <select name="country" class="form-control col" required>
                <option value="" disabled selected>Country</option>
                  <?php foreach ($countries as $country) {
                      echo "<option value=\"$country\">$country</option>";
                  } ?>
              </select>
            </div>
            <div class="form-group col">
              <input name="region" type="text" class="form-control" placeholder="State/County" required
                     minlength="2" maxlength="32" pattern="[A-Za-z0-9,'-]+">
            </div>
          </div>

          <div class="form-group ps-2 pe-2 mb-2">
            <label for="fluent-languages">I am fluent in...</label>
            <select name="fluent_languages[]" multiple
                    class="language-select form-control"
                    id="fluent-languages">
                <?php foreach ($languages as $language) {
                    echo "<option value=\"$language\">$language</option>";
                } ?>
            </select>
          </div>
          <div class="form-group ps-2 pe-2 mb-2">
            <label for="learning-languages">I am learning...</label>
            <select name="learning_languages[]" multiple
                    class="language-select form-control"
                    id="learning-languages">
                <?php foreach ($languages as $language) {
                    echo "<option value=\"$language\">$language</option>";
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
            <button name="submit" type="submit" class="btn text-white">Register</button>
            <?php echo $error_message; ?>
          </div>

        </div>
      </form>
    </div>

    <div class="col d-none d-lg-block">
      <div class="logo-image pt-5 pb-5">
        <img src="../../assets/ll-logo-gradient.png" alt="logo">
      </div>
      <div class="slogan pt-3">
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
  src="https://kit.fontawesome.com/3af37769b5.js"
  crossorigin="anonymous"
></script>
</body>
</html>