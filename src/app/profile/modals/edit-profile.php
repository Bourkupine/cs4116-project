<?php

require_once '../register/gender-preference.php';
require_once '../register/countries.php';
require_once '../database/database_connect.php';
require_once '../database/interests.php';

/**
 * @var array $gender_arr ...
 * @var array $countries
 */
try {
    $connection = connect();
    $interests_arr = get_all_interests($connection);
} catch (Exception $e) {
    $code = $e->getCode();
    $message = $e->getMessage();
    $file = $e->getFile();
    $line = $e->getLine();
    echo "<script> console.log(\"Exception thrown in $file on line $line: [Code $code] $message\"); </script>";
}


?>

<div class="modal fade" id="edit-profile" tabindex="-1" role="dialog" aria-labelledby="modal-label" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <form method="post">
          <div class="form-group">
            <label>Change your profile picture: </label>
            <input type="file" name="file">
            <input type="submit" name="submit" value="Change picture">
          </div>

          <div class="form-group">
            <label for="firstname">Change your first name</label>
            <input name="firstname" id="firstname" type="text" class="form-control" placeholder="First Name"
                   minlength="2" maxlength="32" pattern="^[A-Za-z]+$"
                <?php if (isset($_SESSION["first_name"])) {
                    echo "value=\"" . $_SESSION["first_name"] . "\"";
                } ?>>
          </div>

          <div class="form-group">
            <label for="lastname">Change your surname</label>
            <input name="lastname" id="lastname" type="text" class="form-control" placeholder="Surname"
                   minlength="2" maxlength="32" pattern="^[A-Za-z ']+$"
                <?php if (isset($_SESSION["surname"])) {
                    echo "value=\"" . $_SESSION["surname"] . "\"";
                } ?>>
          </div>

          <div class="form-group">
            <label for="country">Change your country</label>
            <select name="country" id="country" class="form-control">
                <?php foreach ($countries as $country) {
                    if (
                        isset($_SESSION["country"]) &&
                        strcmp($_SESSION["country"], $country) == 0
                    ) {
                        echo "<option value=\"$country\" selected>$country</option>";
                    } else {
                        echo "<option value=\"$country\">$country</option>";
                    }
                } ?>
            </select>
          </div>

          <div class="form-group">
            <label for="region">Change your region</label>
            <input name="region" id="region" type="text" class="form-control" placeholder="State/County"
                   minlength="2" maxlength="32" pattern="[A-Za-z0-9,'-]+"
                <?php if (isset($_SESSION["region"])) {
                    echo "value=\"" . $_SESSION["region"] . "\"";
                } ?>>
          </div>

          <div class="upfrm">
            <!-- upload form -->
            <form method="post" enctype="multipart/form-data">
              <label>Change your age:</label>
              <div class="form-group m-2">
                <input name="age" type="number" class="form-control w-25" placeholder="Age"
                       required min="18" max="120" pattern="[0-9]{2,5}"
                    <?php if (isset($_SESSION["age"])) {
                        echo "value=\"" . $_SESSION["age"] . "\"";
                    } ?>>
              </div>
            </form>
          </div>

          <div class="upfrm">
            <!-- upload form -->
            <select name="gender" class="form-control" required>
              <option value="" disabled
                  <?php if (!isset($_POST["gender"])) {
                      echo "selected";
                  } ?>
              >Gender
              </option>
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

          <div class="upfrm">
            <label for="interests">Interests</label>
            <select name="user_interests[]" multiple
                    class="interest-select form-control"
                    id="interests">
                <?php foreach ($interests_arr as $interest_id => $interest) {
                    if (
                        isset($_SESSION["interests"]) &&
                        in_array($interest_id, $_POST["interests"])
                    ) {
                        echo "<option value=\"$interest_id\" selected>$interest</option>";
                    } else {
                        echo "<option value=\"$interest_id\">$interest</option>";
                    }
                } ?>
            </select>


            <script>
              $(document).ready(function() {
                const interestsDropdown = new Choices("#interests", {
                  removeItemButton: true
                });
              });
            </script>


            <script
              src="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.js"
              crossorigin="anonymous"
            ></script>
          </div>
        </form>
      </div>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
      <button type="button" class="btn ">Save</button>
    </div>
  </div>
</div>

