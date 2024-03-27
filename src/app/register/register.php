<?php
$root = realpath($_SERVER["DOCUMENT_ROOT"]);
require "../../resources/gender-preference.php";
require "../../resources/countries.php";
require "../../resources/languages.php";

$fluent_selected = [];
$learning_selected = [];
?>

<!doctype html>
<html lang="en">
<head>
  <link rel="stylesheet" href="\cs4116-project\src\app\styles.css" />
  <link rel="stylesheet" href="\cs4116-project\src\app\register\register.css" />
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
    rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
    crossorigin="anonymous"
  />
  <script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"
  ></script>
  <script
    src="https://kit.fontawesome.com/3af37769b5.js"
    crossorigin="anonymous"
  ></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.css">
  <script src="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.js"></script>
  <title>Love Languages - Register</title>
</head>

<body>
<div class="container">
  <div class="row">
    <div class="col">
      <form method="post">
        <!-- INPUT FIELDS -->
        <div class="basic-info">
          <div class="form-group m-2 mt-4">
            <input type="text" class="form-control" placeholder="First Name">
          </div>
          <div class="form-group m-2">
            <input type="text" class="form-control" placeholder="Last Name">
          </div>
          <div class="form-group m-2">
            <input type="email" class="form-control" aria-describedby="emailHelp" placeholder="Email">
          </div>
          <div class="form-group m-2">
            <input type="password" class="form-control" placeholder="Password">
          </div>
          <div class="form-group m-2">
            <input type="password" class="form-control" placeholder="Confirm Password">
          </div>

          <div class="gender-preference row ps-2 pe-2 mb-2">
            <div class="col">
              <select class="form-control">
                <option value="" disabled selected>Gender</option>
                  <?php foreach ($gender_arr as $gender) {
                      echo "<option value=\"$gender\">$gender</option>";
                  } ?>
              </select>
            </div>
            <div class="col">
              <select class="form-control col">
                <option value="" disabled selected>I am looking for...</option>
                  <?php foreach ($preference_arr as $pref) {
                      echo "<option value=\"$pref\">$pref</option>";
                  } ?>
              </select>
            </div>
          </div>

          <div class="location-region row ps-2 pe-2 mb-2">
            <div class="form-group col">
              <select class="form-control col">
                <option value="" disabled selected>Country</option>
                  <?php foreach ($countries as $country) {
                      echo "<option value=\"$country\">$country</option>";
                  } ?>
              </select>
            </div>
            <div class="form-group col">
              <input type="text" class="form-control" placeholder="State/County">
            </div>
          </div>
          <div class="form-group ps-2 pe-2 mb-2">
            <label for="fluent-languages">I am fluent in...</label>
            <select multiple
                    class="language-select form-control"
                    id="fluent-languages">
                <?php foreach ($languages as $language) {
                    echo "<option value=\"$language\">$language</option>";
                } ?>
            </select>
          </div>
          <div class="form-group ps-2 pe-2 mb-2">
            <label for="learning-languages">I am learning...</label>
            <select multiple
                    class="language-select form-control"
                    id="learning-languages">
                <?php foreach ($languages as $language) {
                    echo "<option value=\"$language\">$language</option>";
                } ?>
            </select>
          </div>

          <script>
            $(document).ready(function(){
              var learningLanguagesDropdown = new Choices('#learning-languages', {
                removeItemButton: true,
              });
              var fluentLanguagesDropdown = new Choices('#fluent-languages', {
                removeItemButton: true,
              });
            });
          </script>

          <div class="submit-button">
            <button type="submit" class="btn text-white">Register</button>
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
</body>
</html>