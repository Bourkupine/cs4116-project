<?php

require_once '../register/gender-preference.php';
require_once '../register/countries.php';
require_once '../database/database_connect.php';
require_once '../database/interests.php';

/**
 * @var array $gender_arr ...
 * @var array $countries
 * @var array $preference_arr
 *
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

$user_interests = get_user_interests_by_user_id($connection, $_SESSION["user_id"]);

if(isset($_POST["save"])){
    if(isset($_POST["first_name"])){

    }
}
?>

<div class="modal fade" id="edit-profile" tabindex="-1" role="dialog" aria-labelledby="modal-label" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <form method="post">
        <div class="modal-header d-flex justify-content-between">
          <h5 class="modal-title" id="modal-label">Edit Account Details</h5>
          <button type="button" class="btn close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

          <div class="form-group m-2">
            <label>Change your profile picture:</label>
            <input class="form-control" type="file" name="file">
          </div>

          <div class="form-group m-2">
            <label for="firstname">Change your first name:</label>
            <input name="firstname" id="firstname" type="text" class="form-control" placeholder="First Name"
                   minlength="2" maxlength="32" pattern="^[A-Za-z]+$"
                <?php if (isset($_SESSION["first_name"])) {
                    echo "value=\"" . $_SESSION["first_name"] . "\"";
                } ?>>
          </div>

          <div class="form-group m-2">
            <label for="lastname">Change your surname</label>
            <input name="lastname" id="lastname" type="text" class="form-control" placeholder="Surname"
                   minlength="2" maxlength="32" pattern="^[A-Za-z ']+$"
                <?php if (isset($_SESSION["surname"])) {
                    echo "value=\"" . $_SESSION["surname"] . "\"";
                } ?>>
          </div>

          <div class="form-group m-2">
            <label for="country">Change your country</label>
            <select name="country" id="country" class="form-control">
                <?php foreach ($countries as $country) {
                    if (
                        isset($_SESSION["country"]) &&
                        strcasecmp($_SESSION["country"], $country) == 0
                    ) {
                        echo "<option value=\"$country\" selected>$country</option>";
                    } else {
                        echo "<option value=\"$country\">$country</option>";
                    }
                } ?>
            </select>
          </div>

          <div class="form-group m-2">
            <label for="region">Change your region</label>
            <input name="region" id="region" type="text" class="form-control" placeholder="State/County"
                   minlength="2" maxlength="32" pattern="[A-Za-z0-9'-]+"
                <?php if (isset($_SESSION["region"])) {
                    echo "value=\"" . $_SESSION["region"] . "\"";
                } ?>>
          </div>

          <div class="form-group m-2">
            <label for="age">Change your age:</label>
            <input name="age" id="age" type="number" class="form-control w-25" placeholder="Age"
                   min="18" max="120" pattern="[0-9]{2,5}"
                <?php if (isset($_SESSION["age"])) {
                    echo "value=\"" . $_SESSION["age"] . "\"";
                } ?>>
          </div>

          <div class="form-group m-2">
            <label for="gender">Change your gender: </label>
            <select name="gender" id="gender" class="form-control" required>
                <?php foreach ($gender_arr as $gender) {
                    if (
                        isset($_SESSION["sex"]) &&
                        strcasecmp($_SESSION["sex"], $gender) == 0
                    ) {
                        echo "<option value=\"$gender\" selected>$gender</option>";
                    } else {
                        echo "<option value=\"$gender\">$gender</option>";
                    }
                } ?>
            </select>
          </div>

          <div class="form-group m-2">
            <label for="preference">Change your preference:</label>
            <select name="preference" id="preference" class="form-control">
                <?php foreach ($preference_arr as $pref) {
                    if (
                        isset($_SESSION["preference"]) &&
                        strcasecmp($_SESSION["preference"], $pref) == 0
                    ) {
                        echo "<option value=\"$pref\" selected>$pref</option>";
                    } else {
                        echo "<option value=\"$pref\">$pref</option>";
                    }
                } ?>
            </select>
          </div>

          <div class="form-group m-2">
            <label for="interests">Interests</label>
            <select name="user_interests[]" multiple
                    class="interest-select form-control"
                    id="interests">
                <?php foreach ($interests_arr as $interest_id => $interest) {
                    if (in_array($interest_id, $user_interests)) {
                        echo "<option value=\"$interest_id\" selected>$interest</option>";
                    } else {
                        echo "<option value=\"$interest_id\">$interest</option>";
                    }
                } ?>
            </select>
          </div>

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
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" name="save" value="save" class="btn ll-button">Save Changes</button>
        </div>
      </form>
    </div>
  </div>
</div>

