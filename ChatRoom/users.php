<?php
session_start();

require "php/config.php";
if (!isset($_SESSION['unique_id']))
{
    header("location: index.php");
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
    <title>Chat App | Users</title>

    <style>
        .users {
            padding: 25px 30px;
        }

        .users .card-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 1px solid #e6e6e6;
        }

        .users .details {
            color: #000;
        }

        .log img {
            object-fit: cover;
            border-radius: 50%;
        }

        .users .card-header .content {
            display: flex;
        }

        .users .content {
            display: flex;
            align-items: center;
        }

        .users .card-header .content img {
            height: 50px;
            width: 50px;
        }

        .users .card-header .details {
            margin-left: 15px;
        }

        .users .card-header .details p {
            font-size: 11px;
            font-weight: 500;
        }

        .users .search {
            /* margin: 20px 0; */
            display: flex;
            position: relative;
            align-items: center;
            justify-content: space-between;
        }

        .users .search .text {
            font-size: 18px;
        }

        .users .search input {
            position: absolute;
            height: 42px;
            width: calc(100% - 50px);
            border: 1px solid #ccc;
            padding: 0 13px;
            font-size: 16px;
            border-radius: 5px 0 0 5px;
            outline: none;

            /* for js */
            opacity: 0;
            pointer-events: none;
            transition: all 0.3s ease;
        }

        .users .search input.active {
            opacity: 1;
            pointer-events: auto;
        }

        .users .search button {
            width: 47px;
            height: 42px;
            border: none;
            outline: none;
            color: #333;
            background: #fff;
            transition: all 0.3s ease;
        }

        .users .search button.active {
            /* for js */
            color: #fff;
            background: #333;
        }

        .users-list {
            max-height: 350px;
            overflow-y: auto;
        }

        .users-list::-webkit-scrollbar {
            width: 12px;
            /* width of the entire scrollbar */
        }

        .users-list::-webkit-scrollbar-track {
            /* background: #333; */
            /* color of the tracking area */
        }

        .users-list::-webkit-scrollbar-thumb {
            background-color: #fff;
            /* color of the scroll thumb */
            border-radius: 20px;
            /* roundness of the scroll thumb */
            border: 3px solid purple;
            /* creates padding around scroll thumb */
        }

        .users-list .content {
            display: flex;
        }

        .users-list .details {
            color: #000;
        }

        .users-list a {
            margin-top: 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #e6e6e6;

            margin-bottom: 15px;
            page-break-after: 10px;
            padding-right: 15px;
            border-bottom-color: #f1f1f1;
            text-decoration: none;
        }

        .users-list a .content {
            display: flex;
        }

        .users-list a .content img {
            margin-right: 10px;
            height: 40px;
            width: 40px;
        }

        .users-list a .content p {
            color: #676767;
        }

        .users-list a .status-dot {
            /* if user is online */
            font-size: 12px;
            color: #468646;
        }

        .users-list a .status-dot .offline {
            /* if user is offline */
            color: #ccc;
        }
    </style>
</head>

<body>
    <div class="log">
        <section class="users">
            <div class="card" style="border-radius: 16px;">
                <div class="card-header">
                    <div class="content">
                        <?php
                        $sql = "SELECT * FROM users WHERE unique_id = {$_SESSION['unique_id']}";
                        $sql_run = mysqli_query($con, $sql) or die(mysqli_error($con));
                        if (mysqli_num_rows($sql_run) > 0) {
                            $row = mysqli_fetch_assoc($sql_run);
                        }
                        ?>
                        <img src="php/profileImg/<?php echo $row['profileImg']; ?>" alt="">
                        <div class="details">
                            <span><?php echo $row['username']; ?></span>
                            <p><?php echo $row['status']; ?></p>
                        </div>
                    </div>
                    <!-- logout button -->
                    <button type="submit" class="btn btn-dark"><a href="php/logout.php?logout_id=<?php echo $row['unique_id']; ?>" style="color: #fff;">Logout</a></button>
                </div>
                <br>
                <div class="card-body">
                    <div class="search">
                        <span class="text">Select an user to start chat with</span>
                        <input type="text" placeholder="Enter name to search..." id="searchbar">
                        <button><i class="fas fa-search"></i></button>
                    </div>
                    <!-- Users -->
                    <div class="users-list">
                        
                    </div>
                </div>
            </div>

        </section>
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
<!-- search toggle -->
<script>
    const searchBar = document.querySelector(".users .search input");
    const searchBtn = document.querySelector(".users .search button");
    const crossBtn = document.querySelector(".users .search button i");

    searchBtn.onclick = () => {
        searchBar.classList.toggle("active");
        searchBar.focus();
        searchBtn.classList.toggle("active");

        crossBtn.classList.toggle("fa-times");
        searchBar.value = "";
    }

    //show users js
    const usersList = document.querySelector(".users .users-list");
    setInterval(() => {
        let xhttp = new XMLHttpRequest();
        xhttp.open("GET", "php/getusers.php", true); //get data from php/getusers.php
        xhttp.onload = () => {
            if (xhttp.readyState === XMLHttpRequest.DONE) {
                if (xhttp.status === 200) {
                    let data = xhttp.response;
                    if (!searchBar.classList.contains("active")) { //if search bar dosent contains active class then only show all users list
                                                                    //& if we remove thiis condition then ajax will run two times one for showing all users list and 2nd time when user searches
                        // console.log(data);
                        usersList.innerHTML = data;
                    }
                }
            }
        }
        xhttp.send();
    }, 500); //this function will run after every 500ms

    //searchbar
    $(document).ready(function() {
        $("#searchbar").keypress(function() {
            $.ajax({
                type: 'POST',
                url: 'php/searchUserToChat.php',
                data: {
                    //payload that will send the data to above url
                    username: $("#searchbar").val(),
                },
                //success function which will execute after successful
                //execution of bankend(searchUser.php script)
                success:function(data) {
                    $(".users-list").html(data);
                    // console.log(data);
                }
            });
        });
    });
</script>