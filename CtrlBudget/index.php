<?php 
// Output buffering start
ob_start();
    require '$con.php'; //Database connection
    include 'login-modal.php'; 
    include 'signup-modal.php';
    
    //if session is set then redirect to home.php page
    if(isset($_SESSION['email']))
    {
      header ('location: home.php'); 
    }
// Output buffering end
ob_end_flush();

?>

<!doctype html>
<html lang="en">
  <head>
      <!-- link to required botstrap,css,jquery and meta tags -->
      <?php require 'boot-links.php' ?>
       
    <title>Welcome | CT₹L Budget- Control your expenses</title>

    <style type="text/css">
      body,html
      {
        background-color: #66b3ff;
      }
      #banner_image
      {
        padding-top: 20em;
        margin: 3.8% 0 0 0;
        background-image: linear-gradient(rgba(0,0,0,0.3),rgba(0,0,0,0.3)), url("img/backM.jpg");

        /* Full height */
        height: 100%; 

        /* Center and scale the image nicely */
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
        border-bottom: 3px solid #ccff33;
      }
      .modal-dialog-centered{
        margin-top: 50px !important;
      }
       
       /*Media Queries*/
       @media (max-height: 600px)
        {
          #banner_image{
            padding-top: 10em;
          }
        }
        @media (max-height: 440px)
        {
          #banner_image{
            padding-top: 6em;
          }
        }

      footer
      {
        border-top: 1px solid #cc3399;
        
        position: fixed;
        left: 0;
        bottom: 0;
        width: 100%;
    
      }
    </style>
  </head>

  <body>
              <!-- Header Start -->
        <?php include 'header.php'; ?>
              <!-- Header End -->
  
      <div id="banner_image">
        <div class="container">
          <div id="banner_content">

            <h3>We help you control your budget</h3>
            <button type="button" class="btn btn-warning btn-block" data-toggle="modal" data-target="#signupModal">Start Today</button>
            
          </div>
        </div>
      </div>

                <!-- Footer Start -->
      <?php include 'footer.php'; ?>
                <!-- Footer End -->



    
  </body>
</html>

