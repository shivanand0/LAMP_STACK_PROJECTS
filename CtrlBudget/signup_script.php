
<?php 

	  // Databse connection
	  require '$con.php';
     

     if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
	  // variables
	  $name = $_POST['name'];
	  $name = mysqli_real_escape_string($con, $name);

	  $email = $_POST['email'];
	  $email = mysqli_real_escape_string($con, $email);

	  $password = $_POST['password'];
	  $password = mysqli_real_escape_string($con, $password);
	  $password = md5($password); //md5 encryption

	  $contact = $_POST['contact'];
	  // $contact = mysqli_real_escape_string($con, $contact);

	  $city = $_POST['city'];
	  $city = mysqli_real_escape_string($con , $city);

	  $address = $_POST['address'];
	  $address = mysqli_real_escape_string($con , $address);

	  // backend validation
	  $email_regex = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/";

	  $contact_regex = "/^[789][0-9]{9}$/";

	  // Here we'll check if entered email already exists inDB or not.if exists then through an error.//

	  // select query to select email from users table

	  $select_query = "SELECT * FROM users WHERE email='$email'";
	  //RUn query result
	  $select_query_result = mysqli_query($con, $select_query) or die(mysqli_error($con));

	  //check number of rows fetched.mysqli_num_rows()function calculates number of rows fetched
	  $rows_fetched  = mysqli_num_rows($select_query_result);

	  //if rows>0 then entered email already exists in DB
	  if($rows_fetched != 0)
		{
	      echo "<script>
	           alert('Sorry. Entered Email: $email already exists!');
	           window.location.href='index.php';
	           </script>";
	    }

	  // if not then add details to DB
	  else
		{
		    // insert query to add entered details to DB
			$insert_query = "INSERT INTO users (name,email,password,contact,city,address) 
			VALUES ('$name','$email','$password',$contact,'$city','$address')";

			// run insert query
		    $insert_query_result = mysqli_query($con, $insert_query) or die(mysqli_error($con));
		    
		    // insert uid
		    $user_id = mysqli_insert_id($con);

		    // start Session
		    $_SESSION['user_id'] = $user_id;
		    $_SESSION['email'] = $email;

		    //redirect to home.php page
		    header('location: home.php');

		}
    }
?>