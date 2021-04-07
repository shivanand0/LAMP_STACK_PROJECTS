<?php
    $con = mysqli_connect("localhost","root","","budget") or die(mysqli_error($con));
    if(!isset($_SESSION['email'])){
        session_start();
    }
?>