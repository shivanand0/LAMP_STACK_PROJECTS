                                    <!-- Sign Up modal -->

<div class="modal fade" id="signupModal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Sign Up</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <form method="post" action="signup_script.php">
            <div class="form-group">
              <input type="text" class="form-control" name="name" placeholder="Name" pattern="^[A-Za-z\s]{1,}[\.]{0,1}[A-Za-z\s]{0,}$" required>
            </div>

           <div class="form-group">
              <input type="email" class="form-control" name="email" placeholder="Email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" required>
            </div>

            <div class="form-group">
              <input type="password" class="form-control" name="password" placeholder="Password" pattern=".{6,}" required>
            </div>

            <div class="form-group">
              <input type="number" class="form-control" name="contact" maxlength="10" size="10" placeholder="Contact"  required>
            </div>

            <div class="form-group">
              <input type="text" class="form-control" name="city" placeholder="City" required>
            </div>
                            
            <div class="form-group">
              <input type="text" class="form-control" name="address" placeholder="Address" required>
            </div>

              <p>Already an Registered User? <a data-toggle="modal" data-target="#loginModal" type="button" style="color: blue; text-decoration: underline;">Click Here</a> to Sign in</p>

              <button class="btn btn-warning btn-block">Submit</button>

          </form>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>