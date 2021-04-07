<?php 
//script to insert texts
    session_start();
    if(isset($_SESSION['unique_id'])){
        require 'config.php';

        $outgoing_id = $_SESSION['unique_id'];;
        $incoming_id = $_POST['incoming_id'];
        $incoming_id = mysqli_real_escape_string($con, $incoming_id);
        $msg = $_POST['msg'];
        $msg = mysqli_real_escape_string($con, $msg);
        
        if(!empty($msg)){
            $sql = "INSERT INTO messages (incoming_msg_id, outgoing_msg_id, msg)
                   VALUES ('$incoming_id', '$outgoing_id', '$msg')"; 

            $sql_run = mysqli_query($con, $sql) or die(mysqli_error($con));
            
            if($sql_run){
                echo "donee";
                header("location: ../chat.php");
            }
        }
    }else{
        header("location: ../index.php");
    }


    
?>