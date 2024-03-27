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
  <title>Love Languages - Log In</title>
</head>

<body>
<div class="container">
  <div class="row">
    <div class="col">
      <form class="col-lg-6 col-sm-12" method="post">
        <!-- INPUT FIELDS -->
        <div class="basic-info">
          <div class="form-group m-2">
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
                <option value="" disabled selected>Preference</option>
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
              <input type="text" class="form-control" placeholder="Region">
            </div>
          </div>
          <div class="form-group ps-2 pe-2 mb-2">
            <label for="fluent-languages">I am fluent in...</label>
            <select multiple size="5"
                    class="language-select form-control"
                    id="fluent-languages">
                <?php foreach ($languages as $language) {
                    echo "<option value=\"$language\">$language</option>";
                } ?>
            </select>
          </div>
          <div class="form-group ps-2 pe-2 mb-2">
            <label for="learning-languages">I am learning...</label>
            <select multiple size="5"
                    class="language-select form-control"
                    id="learning-languages">
                <?php foreach ($languages as $language) {
                    echo "<option value=\"$language\">$language</option>";
                } ?>
            </select>
          </div>
          <div class="submit-button">
            <button type="submit" class="btn text-white">Register</button>
          </div>
        </div>
      </form>
    </div>
    <div class="col">
      <div class="logo-image">
        <
      </div>
      <div class="slogan">
        <span>LOVE SPEAKS EVERY LANGUAGE</span>
      </div>
    </div>
  </div>
</div>
</body>
</html>