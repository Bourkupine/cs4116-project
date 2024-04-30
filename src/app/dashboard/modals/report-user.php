<div class="modal fade" id="report-user" tabindex="-1" role="dialog" aria-labelledby="modal-label"
     aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header d-flex justify-content-between">
        <h5 class="modal-title text-danger" id="modal-label">Report User</h5>
        <button type="button" class="btn close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post">
        <div class="modal-body">
          <div class="form-floating">
            <input name="reason" type="text" class="form-control" id="report" placeholder="Reason for reporting" minlength="1">
            <label for="report">Reason for reporting</label>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button name="report" value="report" type="submit" class="btn btn-danger">Report User</button>
        </div>
      </form>
    </div>
  </div>
</div>