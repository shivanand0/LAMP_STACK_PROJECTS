                                                <!-- Modal -->
<div class="modal fade" id="cpwModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Change Password</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">

        <form method="post" action="cpw_script.php">
          
          <div class="form-group">
            <label for="oldPassword">Old Password</label>
            <input type="password" class="form-control" name="oldPassword" pattern=".{6,}" required>
          </div>

          <div class="form-group">
              <label for="newPassword">New Password</label>
              <input type="password" class="form-control" name="newPassword" pattern=".{6,}" required>
          </div>

          <div class="form-group">
              <label for="newPasswordRe">Re-type New Password</label>
              <input type="password" class="form-control" name="newPasswordRe" pattern=".{6,}" required>
          </div>

          <button type="submit" class="btn btn-warning">Submit</button>

        </form>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>