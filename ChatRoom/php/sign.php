<?php
    session_start();
    require "config.php";
    require "checkIp.php";
    $username = $_POST["username"];
    $username = mysqli_real_escape_string($con, $username);
    if(!empty($username))
    {
        //first check if username already exist or not
        //if exist then go for login query->disable select image option using ajax->and check if device is correct or not->if correct then login
        //if not exists then go for signup query

        //check username
        $checkUsername = "SELECT * FROM users WHERE username = '{$username}'";
        $checkUsernameRun = mysqli_query($con, $checkUsername);
        if(mysqli_num_rows($checkUsernameRun) > 0)
        { //login query
            //user already exist->go for login query->disbale select image option->check if device is correct for this username
            
            //check device
            $checkIP = "SELECT IP_ADDR FROM users WHERE username = '{$username}'";
            $checkIPRun = mysqli_query($con, $checkIP);
            $rowIP = mysqli_fetch_assoc($checkIPRun);
            if($ip != $rowIP['IP_ADDR'])
            {
                //through an error that you cant login from this device
                echo "invalid device";
            }
            else
            {
                //user can login->start session
                $status = "Active now";

                $sql = "SELECT * FROM users WHERE username = '{$username}'";
                $sql_run = mysqli_query($con, $sql) or die(mysqli_error($con));

                $row = mysqli_fetch_assoc($sql_run);

                $update_status = "UPDATE users SET status = '{$status}' WHERE unique_id = {$row['unique_id']}";
                $update_status_run = mysqli_query($con, $update_status)
                                    or die(mysqli_error($con));

                if($update_status_run){
                    $_SESSION['unique_id'] = $row['unique_id'];
                    echo "success";
                }else{
                    echo "Something went wrong. Please try again!";
                }
                // echo "valid device";
            }
        }
        else
        { //sign up query
            //user dosent exist->go for signup query
            if(isset($_FILES['profilePic']))
            {
                $imgName = $_FILES['profilePic']['name']; //uploaded img name
                $imgType = $_FILES['profilePic']['type']; //uploaded img type
                $tmpName = $_FILES['profilePic']['tmp_name'];//temp file name to save/move file in folder

                $imgExplode = explode('.', $imgName);
                $imgExt = end($imgExplode); //extension of img file

                $extensions = ['png','jpeg','jpg'];
                if(in_array($imgExt, $extensions) == true)
                {
                    $time = time(); //current time, we'll rename user file with current time
                                    //while saving in out folder so unique name
                    $newImgName = $time.$imgName;

                    // move_uploaded_file($tmpName, "profileImg/".$newImgName); //move uploaded file to folder
                    if(move_uploaded_file($tmpName, "profileImg/".$newImgName))
                    {
                        $status = "Active now"; //signed up -> active status
                        
                        //create random unique id for each user
                        $randomId = rand(time(), 10000000);
                        //insert user details in DB
                        $sql = "INSERT INTO users (username, profileImg, IP_ADDR, unique_id, status)
                                VALUES ('$username', '$newImgName', '$ip', '$randomId', '$status')";
                        $sql_run = mysqli_query($con, $sql)
                        or die(mysqli_error($con));

                        //use mysqli_fetch_array() function to fetch rows from the database and store it as an array.
                        $sql2 = "SELECT * FROM users WHERE username = '{$username}'";
                        $sql2_run = mysqli_query($con, $sql2) or die(mysqli_error($con));

                        $row = mysqli_fetch_assoc($sql2_run);

                        //if user entered is an unique usenamr then only sign up
                        $_SESSION['unique_id'] = $row['unique_id'];
                        if($sql_run){
                            echo "success";
                        }
                    }
                }
                else
                {
                    echo "Please choose an image with jpg, jpeg, png extension";
                }
            }
        }
    }
    else{
        echo "All input fields are necessary";
    }
?>