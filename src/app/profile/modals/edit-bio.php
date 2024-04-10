<?php
require_once '../database/profiles.php';

try {
    $connection = connect();
} catch (Exception $e) {
    $code = $e->getCode();
    $message = $e->getMessage();
    $file = $e->getFile();
    $line = $e->getLine();
    echo "<script> console.log(\"Exception thrown in $file on line $line: [Code $code] $message\"); </script>";
}

if (isset($_POST["save_bio"])) {
    if (isset($_POST["bio"])) {
        if (update_bio_by_user_id($connection, $_SESSION["user_id"], $_POST["bio"])) {
            $_SESSION["bio"] = $_POST["bio"];
        }
    }
}


?>

<div class="modal fade" id="edit-bio" tabindex="-1" role="dialog" aria-labelledby="modal-label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form method="post">
                <div class="modal-header d-flex justify-content-between">
                    <h5 class="modal-title" id="modal-label">Edit Profile Bio</h5>
                    <button type="button" class="btn close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group m-2">
                        <label for="bio">Enter your new bio:</label>
                        <input name="bio" id="bio" type="text" class="form-control"
                            <?php if (isset($_SESSION["bio"])) {
                                echo "value=\"" . $_SESSION["bio"] . "\"";
                            } ?>>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" name="save_bio" value="save_bio" class="btn ll-button">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

