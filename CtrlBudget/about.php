<?php 
	
	session_start();
	include 'boot-links.php';
  include "cpw-modal.php"
?>
<!doctype html>
<html lang="en">
  <head>
     <title>About | CT₹L Budget</title>

     <style type="text/css">
     body,html{
     	   /*background-color: #66b3ff !important;*/
                 background-color: lightgrey !important;

     	}
      .abt{
        margin-top: 10rem;
      }
      .footer{
          position: fixed;
          left: 0;
          bottom: 0;
          width: 100%;
      }
     </style>

  </head>

  <body>

  	<!-- Header -->
  	<?php include 'header.php'; ?>

    
  <div class="container abt">
      <div class="row">
        <div class="col-sm">
            <h4>Who are we?</h4>
            <p>
              We are a group of young technocrats who came up with an idea of solving budget and time issues which we usually face in our daily lives. we are here to provide a budget controller according to your aspects.
            </p>
            <p>Budget control is the biggest financial issue in the present world. One should look after their budget control to get rid off their financial aspects</p>
        </div>

        <div class="col-sm ml-4">
          <h4>Why choose us?</h4>
          <p>We provide a predominant way to control and manage your budget estimations with ease of accessing for multiple users.</p>
        </div>
        </div>
        <div class="row">
          <div class="col-sm mt-4">
            <h4>Contact us</h4>
            <p><strong>Email</strong>: trainings@intershala.com</p>
            <p><strong>Mobile</strong>: +91-8448444853</p>
          </div>
        </div>
  </div>

                  <!-- Footer -->
  	<?php include 'footer.php'; ?>

  </body>
 </html>
