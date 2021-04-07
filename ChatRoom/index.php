<?php
    session_start();
    if(isset($_SESSION['unique_id']))
    {
        header("location: users.php");
    }
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
    <title>Chat App</title>
    <style>
        /* errr */
        .error-text {
            color: #721c24;
            padding: 8px 10px;
            text-align: center;
            border-radius: 5px;
            background: #f8d7da;
            border: 1px solid #f5c6cb;
            margin-bottom: 10px;
            display: none;
        }
    </style>
</head>

<body>
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Realtime Chat App</h5>
        </div>

        <div class="card-body">
            <form enctype="multipart/form-data">
                <div class="error-text">hjdfhfd</div>
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" name="username" id="username" placeholder="Start with an username" onkeyup="showHint(this.value)" required autocomplete="off">
                    <small id="txtHint" class="form-text text-muted">Start typing...</small>
                </div>
                <div class="form-group">
                    <!-- if user is new then only show Select image option
                    i.e if device and username already exists then disbale this option -->
                    <label id="selectImg">Select Image</label><br>
                    <input type="file" name="profilePic" id="profilePic" required>
                </div>
                <div class="text-center startChatBtn">
                    <button type="submit" class="btn btn-dark btn-block" name="submit">Start Chatting</button>
                </div>
            </form>
        </div>
        <div class="card-footer text-muted">
            Don't use any Proxy or VPN or you'll be unable to login again.
        </div>
    </div>
    <!-- footer -->
    <?php include "includes/footer.php"; ?>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>
<script>
    //js ajax to php for submission
    const form = document.querySelector(".card-body form");
    const startChatBtn = form.querySelector(".startChatBtn button");
    const errTxt = form.querySelector(".error-text");
    form.onsubmit = (e) => {
        e.preventDefault(); //prevent from reloading page
    }

    startChatBtn.onclick = () => {
        //ajax
        /*
        The XMLHttpRequest object can be used to exchange data with a web server behind the scenes.
        This means that it is possible to update parts of a web page,
        without reloading the whole page.
        */
        let xhttp = new XMLHttpRequest(); //XMLHttpRequest object
        xhttp.open("POST", "php/sign.php", true); //send request to server
        xhttp.onload = () => {
            //readyState property holds the status of the XMLHttpRequest.
            if (xhttp.readyState === XMLHttpRequest.DONE) {
                //The status property and the statusText property holds the status of the XMLHttpRequest object.
                if (xhttp.status === 200) {
                    let data = xhttp.response;
                    if (data == "success") {
                        location.assign("users.php");
                    } else {
                        errTxt.textContent = data;
                        errTxt.style.display = "block";
                    }
                }
            }
        }
        //Sends the request to the server
        //send ajax to php
        let formData = new FormData(form); //new formData object
        xhttp.send(formData);
    }

    // check if usename is in DB if is then disable choose image option
    $(document).ready(function() {
        $("#username").keypress(function() {
            $.ajax({
                type: 'POST',
                url: 'php/searchUser.php',
                data: {
                    //payload that will send the data to above url
                    username: $("#username").val(),
                },
                //success function which will execute after successful
                //execution of bankend(searchUser.php script)
                success:function(data) {
                    $("#selectImg").html(data);
                    if(data == "")
                    {
                        document.getElementById("profilePic").required = false;
                        document.getElementById("profilePic").disabled = true;
                    }
                    else{
                        document.getElementById("profilePic").required = true;
                        document.getElementById("profilePic").disabled = false;
                    }
                }
            });
        });
    });

    function showHint(str) {
        if (str.length != 0) //if input field is empty
        {
            document.getElementById("txtHint").innerHTML = "";
            return;
        }
        else{
            document.getElementById("txtHint").innerHTML = "Start typing...";
            return;
        }
    }
</script>