<?php
require_once "../database/languages.php";
require_once "../database/user_languages.php";

try {
    $connection = connect();
    $languages = get_all_languages($connection);
    $user_languages = get_user_languages_by_user_id($connection, $_SESSION["user_id"]);
} catch (Exception $e) {
    $code = $e->getCode();
    $message = $e->getMessage();
    $file = $e->getFile();
    $line = $e->getLine();
    echo "<script> console.log(\"Exception thrown in $file on line $line: [Code $code] $message\"); </script>";
}

$error_msg = "";
$unique = true;
if (isset($_POST["save_fluent"])) {
    if (empty($_POST["fluent_languages"])) {
        $error_msg = "<div><small class=\"text-warning\">Please select at least one fluent language</small></div>";
    } else {
        foreach ($user_languages as $id => $status) {
            if (strcmp($status, "learning") == 0 && in_array($id, $_POST["fluent_languages"])) {
                $unique = false;
                break;
            }
        }
        if ($unique) {
            delete_all_user_languages_by_status($connection, $_SESSION["user_id"], "fluent");
            add_user_languages($connection, $_SESSION["user_id"], $_POST["fluent_languages"], 'speaks', 'fluent');
            $user_languages = get_user_languages_by_user_id($connection, $_SESSION["user_id"]);
        } else {
            $error_msg = "<div><small class=\"text-warning\">You cannot be fluent in and learning the same language</small></div>";
        }
    }
}


?>

<div class="modal fade" id="edit-fluent-languages" tabindex="-1" role="dialog" aria-labelledby="modal-label"
     aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <form method="post">
        <div class="modal-header d-flex justify-content-between">
          <h5 class="modal-title" id="modal-label">Edit Fluent Languages</h5>
          <button type="button" class="btn close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group m-2">
            <label for="fluent-languages">I am fluent in...</label>
            <select name="fluent_languages[]" multiple
                    class="form-control" id="fluent-languages">
                <?php foreach ($languages as $language_id => $language) {
                    if (array_key_exists($language_id, $user_languages) && strcmp($user_languages[$language_id], "speaks") == 0) {
                        echo "<option value=\"$language_id\" selected>$language</option>";
                    } else {
                        echo "<option value=\"$language_id\">$language</option>";
                    }
                } ?>
            </select>
          </div>
          <script>
            $(document).ready(function() {
              const fluentLanguagesDropdown = new Choices("#fluent-languages", {
                removeItemButton: true
              });
            });
          </script>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" name="save_fluent" value="save_fluent" class="btn ll-button">Save Changes</button>
            <?php echo $error_msg ?>
        </div>
      </form>
    </div>
  </div>
</div>

