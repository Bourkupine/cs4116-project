<?php

require_once "../database/database_connect.php";
require_once "../database/users.php";

if (isset($_POST["delete"])) {
    session_start();
    try {
        $db_con = connect();
    } catch (Exception $e) {
        $code = $e->getCode();
        $message = $e->getMessage();
        $file = $e->getFile();
        $line = $e->getLine();
        echo "<script> console.log(\"Exception thrown in $file on line $line: [Code $code] $message\"); </script>";
    }
    delete_user_by_user_id($db_con, $_SESSION["user_id"]);
    session_unset();
}
?>

<div class="modal fade" id="delete-account" tabindex="-1" role="dialog" aria-labelledby="modal-label"
     aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header d-flex justify-content-between">
        <h5 class="modal-title text-danger" id="modal-label">Delete Account</h5>
        <button type="button" class="btn close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <span>Are you sure you want to delete your account? This action cannot be undone</span>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <form method="post">
          <button name="delete" value="delete" type="submit" class="btn btn-danger">Delete Account</button>
        </form>
      </div>
    </div>
  </div>
</div>
