<?php
	// Databse connection
	  require '$con.php';

	   if($_SERVER['REQUEST_METHOD'] == 'POST') //check server request method
	  // if(isset($_POST['name']) && isset($_POST['email']))
  {
        //store login form data into variables
        $email = $_POST['email'];
        $email = mysqli_real_escape_string($con, $email);

        $password = $_POST['password'];
        $password = mysqli_real_escape_string($con, $password);
        $password = md5($password);

        //select query to fetch email & id entered by user in login form
        $login_select_query = "SELECT uid, email FROM users WHERE email='$email' AND password='$password'";

        //to run select query use mysqli_query function.
        $login_select_query_result = mysqli_query($con, $login_select_query)
                                    or die(mysqli_error($con));

        //calculate number of rows fetched if rows_fetched == 0 then there is no user with the email and password entered.
        //use mysqli_num_rows() function to calculate number of rows fetched.
        $total_rows_fetched = mysqli_num_rows($login_select_query_result);
        
        if($total_rows_fetched != 0)
        {
            //use mysqli_fetch_array() function to fetch rows from the database and store it as an array.
            $row = mysqli_fetch_array($login_select_query_result);
            
            //Initialize email and user_id session variables.
            $_SESSION['email'] = $email;
            $_SESSION['user_id'] = $row['uid'];
            
            //after successfull login redirect to home.php page
            header('location: home.php');
        }
        else
        {
             echo "<script>
                      alert('Sorry. Entered Email: $email or password is incorrect!');
                      window.location.href='index.php';
                  </script>";

        }
    }
?>