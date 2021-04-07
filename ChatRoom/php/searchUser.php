<?php
//script to check is username already exists in DB while logging in 
    require "config.php";
    
    $sql = "SELECT * FROM users WHERE username LIKE '%{$_POST['username']}%'";
    $sql_run = mysqli_query($con, $sql);
    $row = mysqli_num_rows(($sql_run));
    if($row > 0){
        echo "";
    }
    else{
        echo "Select image";
    }
?>