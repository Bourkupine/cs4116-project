<div class="modal fade" id="delete-user" tabindex="-1" role="dialog" aria-labelledby="modal-label"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header d-flex justify-content-between">
                <h5 class="modal-title text-danger" id="modal-label">Delete Account</h5>
                <button type="button" class="btn close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post">
                <div class="modal-body delete-modal">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button name="delete-btn" value="delete" type="submit" class="btn btn-danger">Delete User</button>
                </div>
            </form>
        </div>
    </div>
</div>