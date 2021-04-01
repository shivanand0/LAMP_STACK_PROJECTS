<?php
 	require '$con.php';

 	if($_SERVER['REQUEST_METHOD'] == 'POST')
 	{
 		$duser_id = $_SESSION['user_id'];

 		$title = $_POST['title'];
 		mysqli_real_escape_string($con, $title);

 		$budget = $_POST['budgetd'];
 		mysqli_real_escape_string($con, $budget);

 		$people = $_POST['peopled'];
 		mysqli_real_escape_string($con, $people);
 		
 		$dateF = $_POST['dateF'];
 		$dateT = $_POST['dateT'];


 		$insert = "INSERT INTO plan_details (duser_id, title, budget, people, start_date, end_date) 
 		           VALUES ('$duser_id', '$title', '$budget', '$people', '$dateF', '$dateT')";

 		$insert_run = mysqli_query($con, $insert) or die(mysqli_error($con));
        
        $last_id = mysqli_insert_id($con); //get last inserted records id
        // echo $last_id;
 		
 		for ($i=0; $i < $_POST['np'] ; $i++) 
 		{ 
 			$user_id = $_SESSION['user_id'];
 			$people = $_POST['people'][$i];
 			$insert_query = "INSERT INTO people_in_plan (user_id, pd_id, persons) 
 			                 VALUES ('$user_id', '$last_id', '$people')";
 			$insert_query_run = mysqli_query($con, $insert_query) or die(mysqli_error($con));
 		}
 		//redirect to home.php page
	    header('location: home.php');
 	}
 	
?>