                                    <!-- login modal -->

<div class="modal fade" id="loginModal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Login</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <form method="post" action="login_script.php">
          <div class="form-group">
            <label for="email">Email address</label>
            <input type="email" class="form-control" id="email" aria-describedby="emailHelp" name="email" required>
            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
          </div>

          <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" name="password" pattern=".{6,}" required>
          </div>

          <p>Not Registered User? <a data-toggle="modal" data-target="#signupModal" type="button" style="color: blue; text-decoration: underline;">Click Here</a> to Sign Up</p>
          
          <button type="submit" class="btn btn-warning btn-block">Submit</button>
        </form>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>