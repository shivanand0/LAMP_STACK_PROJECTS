<?php
    session_start();
    if(isset($_SESSION['unique_id']))
    {
        require "config.php";

        $logout_id = $_GET['logout_id'];
        $logout_id = mysqli_real_escape_string($con, $logout_id);

        if(isset($logout_id))
        {
            $status = "Offline now";
            $sql = "UPDATE users SET status = '{$status}' WHERE unique_id={$logout_id}";
            $sql_run = mysqli_query($con, $sql);

            if($sql_run)
            {
                session_unset();
                session_destroy();
                header("location: ../index.php");
            }
            else{
                header("location: ../users.php");
            }
        }
    }
    else
    {
        header("location: ../index.php");
    }
?>