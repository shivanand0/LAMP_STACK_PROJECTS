<?php
	
	require '$con.php';

	if($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		$user_id = $_SESSION['user_id'];

		$pid =$_POST['pid'];
		$extitle = $_POST['extitle']; //expense title
		mysqli_real_escape_string($con, $extitle);

		$exdate = $_POST['exdate']; //expense date
        mysqli_real_escape_string($con, $exdate);

		$amnt_spent = $_POST['amnt']; //amount spent
        mysqli_real_escape_string($con, $amnt_spent);

		$spent_by =  $_POST['person']; //amount spent by
		mysqli_real_escape_string($con, $spent_by);
        

        // bill unpload and store in DB
        $fileName = $_FILES['bill']['name']; //file name
        
        

        $fileNameTmp = $_FILES['bill']['tmp_name']; //temprorory file name to store file

        //upload directory path
        $bill_upload_dir = "bills/".basename($fileName);

        

        $insert = "INSERT INTO expenses (pid, user_id, extitle, exdate, amount_spent, spent_by, bill)
                  VALUES ('$pid', '$user_id', '$extitle', '$exdate', '$amnt_spent', '$spent_by', '$fileName')";

        $insert_run = mysqli_query($con, $insert) or die(mysqli_error($con));
        

         //move uploaded file
        move_uploaded_file($fileNameTmp,$bill_upload_dir); 

        header ('location: home.php');
       
        




	}
?>