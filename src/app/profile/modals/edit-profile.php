<?php

require_once '../register/gender-preference.php';
require_once '../database/database_connect.php';
require_once '../database/interests.php';

/** @var array $gender_arr ...
 *
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


?>

<div class="modal fade" id="edit-profile" tabindex="-1" role="dialog" aria-labelledby="modal-label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="upfrm">
                    <!-- upload form -->
                    <form method="post" enctype="multipart/form-data">
                        <label>Change your profile picture: </label>
                        <input type="file" name="file">
                        <input type="submit" name="submit" value="Change picture">
                    </form>
                </div>

                <div class="upfrm">
                    <!-- upload form -->
                    <form method="post" enctype="multipart/form-data">
                        <label>Change your name</label>
                        <input id="Name" type="text" name="Name" class="form-control" required placeholder="Full Name">
                    </form>
                </div>

                <div class="upfrm">
                    <!-- upload form -->
                    <form method="post" enctype="multipart/form-data">
                        <label>Change your location</label>
                        <input id="Location" type="text" name="Location" class="form-control" required
                               placeholder="Address">
                    </form>
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
                        $(document).ready(function () {
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
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            <button type="button" class="btn ">Save</button>
        </div>
    </div>
</div>

