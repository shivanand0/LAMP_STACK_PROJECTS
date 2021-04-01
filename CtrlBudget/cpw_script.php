<?php 
 // chnage password script
 require '$con.php';

 if ($_SERVER['REQUEST_METHOD'] == 'POST') 
 {
 	// store change password details in variables
 	$oldPassword = $_POST['oldPassword'];
 	$oldPassword = mysqli_real_escape_string ($con, $oldPassword);
 	$oldPassword = md5($oldPassword);

 	$newPassword = $_POST['newPassword'];
 	$newPassword = mysqli_real_escape_string ($con, $newPassword);
 	$newPassword = md5($newPassword);

 	$newPasswordRe = $_POST['newPasswordRe'];
 	$newPasswordRe = mysqli_real_escape_string ($con, $newPasswordRe);
 	$newPasswordRe = md5($newPasswordRe);

 	$email = $_SESSION['email'];

 	// slect query to fetch old password from DB
 	$select_query = "SELECT * FROM users WHERE email='$email' AND password='$oldPassword'";
 	$select_query_result = mysqli_query($con, $select_query)
 	    or die(mysqli_error($con));

 	//run mysqli_num_rows() function if rows are fetched that means entered oldPassword is correct
 	$rows = mysqli_num_rows($select_query_result);

 	// condition1: if rows>0 means entered oldPassword is correct
 	// condition2: $newPassword==$newPasswordRe to make sure both new password fields are same

 	if ($rows > 0 && $newPassword == $newPasswordRe) 
 	{
 			// update passwrod in DB
 		$update_query = "UPDATE users SET password= '$newPassword' WHERE email='$email'";
 		$update_query_result = mysqli_query($con, $update_query)
 					or die(mysqli_error($con));

		session_unset();
		session_destroy();

        // show success alert & redirect to home.php
        echo "<script>
                      alert('Success! password changed. Please sign-in again to continue :) ');
                      window.location.href='index.php';
              </script>";
 	    
 	}

 	elseif($rows == 0)
 	{
       echo "<script>
       			alert('Incorrect current password :/');
       			window.location.href='home.php';
            </script>";
 	}

 	elseif ($newPassword != $newPasswordRe) 
 	{
 		echo "<script>
 		 		alert('New password confirmation failed!');
 		 		window.location.href='home.php';
 			  </script>";
 	}
 	else
 	{
 		echo "<script>
 					alert('Invalid Creditnals!');
 					window.location.href='home.php';
 		     </script>";
 	}
 }
?>
