<div class="fluid-container">
    <nav class="navbar navbar-fixed-top navbar-expand-lg navbar-light" style="background-color: #ccff33;">
      
        <a class="navbar-brand brand" href="index.php">CT₹L Budget</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarText">
            <ul class="navbar-nav mr-auto links">
                    <?php 
                    require 'common_codes\$con.php';
                    // if($_SERVER['REQUEST_METHOD'] == 'POST')
                    // {
                    //   $email = $_POST['email'];
                    //   $email = mysqli_real_escape_string($con, $email);
                    // }
                        if(isset($_SESSION['email'])) //if user is logged in, show this links in navbar
                        { ?>
                            <li class="nav-item">
                                <a class="nav-link link1" href="about.php">About Us</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link link2" href="#" data-toggle="modal" data-target="#cpwModal"><i class="fa fa-cog"></i>Change Password</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link link3" href="logout.php"><i class="fa fa-sign-out-alt"></i> Logout</a>
                            </li>
                 <?php }
                        else //if user is not logged in, show this links in navbar
                        { ?>
                            <li class="nav-item">
                                <a class="nav-link link1" href="about.php">About Us</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link link2" href="#" data-toggle="modal" data-target="#signupModal">Sign Up</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link link3" href="#" data-toggle="modal" data-target="#loginModal"><i class="fa fa-sign-in-alt"></i> Login</a>
                            </li>
            </ul>
                 <?php } ?>


            <span class="navbar-text">
              Manage your expenses here  ^_^ 
            </span>
        </div>
      
    </nav>
</div>