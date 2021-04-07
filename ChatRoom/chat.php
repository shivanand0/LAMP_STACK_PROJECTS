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
  <title>Chat App | Users Chat area</title>


  <style>
    .chat-area .card-header {
      display: flex;
      align-items: center;
      padding: 18px 30px;
    }

    .chat-area .card-header img {
      height: 45px;
      width: 45px;
      border-radius: 50%;
      margin: 0 15px;
    }

    .chat-area .card-header .back-icon {
      font-size: 18px;
      color: #333;
    }

    .chat-area .card-header span {
      font-size: 19px;
      font-weight: 500;
    }

    .chat-area .card-header p {
      font-size: 16px;
    }

    .chat-box {
      position: relative;
      min-height: 500px;
      max-height: 500px;
      overflow-y: auto;
      padding: 10px 30px 20px 30px;
      background: #f7f7f7;
      box-shadow: inset 0 32px 32px -32px rgb(0 0 0 / 5%),
        inset 0 -32px 32px -32px rgb(0 0 0 / 5%);
    }

    .chat-box .text {
      position: absolute;
      top: 45%;
      left: 50%;
      width: calc(100% - 50px);
      text-align: center;
      transform: translate(-50%, -50%);
    }

    .chat-box .chat {
      margin: 15px 0;
    }

    .chat-box .chat p {
      word-wrap: break-word;
      padding: 8px 16px;
      box-shadow: 0 0 32px rgb(0 0 0 / 8%),
        0rem 16px 16px -16px rgb(0 0 0 / 10%);
    }

    .chat-box .outgoing {
      display: flex;
    }

    .chat-box .outgoing .details {
      margin-left: auto;
      max-width: calc(100% - 130px);
    }

    .outgoing .details p {
      background: #333;
      color: #fff;
      border-radius: 18px 18px 0 18px;
    }

    .chat-box .incoming {
      display: flex;
      align-items: flex-end;
    }

    .chat-box .incoming img {
      height: 35px;
      width: 35px;
      border-radius: 50%;
    }

    .chat-box .incoming .details {
      margin-right: auto;
      margin-left: 10px;
      max-width: calc(100% - 130px);
    }

    .incoming .details p {
      background: #fff;
      color: #333;
      border-radius: 18px 18px 18px 0;
    }

    .chat-area .typing-area {
      padding: 18px 30px;
      display: flex;
      justify-content: space-between;
    }

    .chat-box::-webkit-scrollbar {
      width: 12px;
      /* width of the entire scrollbar */
    }

    .chat-box::-webkit-scrollbar-track {
      /* background: #333; */
      /* color of the tracking area */
    }

    .chat-box::-webkit-scrollbar-thumb {
      background-color: #fff;
      /* color of the scroll thumb */
      border-radius: 20px;
      /* roundness of the scroll thumb */
      border: 3px solid purple;
      /* creates padding around scroll thumb */
    }

    .typing-area input {
      height: 45px;
      width: calc(100% - 58px);
      font-size: 17px;
      border: 1px solid #ccc;
      padding: 0 13px;
      border-radius: 5px;
      outline: none;
    }

    .typing-area button {
      width: 55px;
      border: none;
      outline: none;
      background: #333;
      color: #fff;
      font-size: 19px;
      cursor: pointer;
      border-radius: 0 5px 5px 0;
    }
  </style>
</head>

<body>
  <div class="log">
    <section class="chat-area">
      <div class="card">
        <div class="card-header">
          <a href="users.php" class="back-icon"><i class="fas fa-arrow-left"></i></a>

          <?php
          $user = $_GET['user_id'];
          $user = mysqli_real_escape_string($con, $user);
          $sql = "SELECT * FROM users WHERE unique_id = {$user}";
          $sql_run = mysqli_query($con, $sql) or die(mysqli_error($con));

          if (mysqli_num_rows($sql_run) > 0) {
            $row = mysqli_fetch_assoc($sql_run);
          } else {
            header("location: users.php");
          }
          ?>

          <img src="php/profileImg/<?php echo $row['profileImg']; ?>" alt="">
          <div class="details">
            <span><?php echo $row['username']; ?></span>
            <p><?php echo $row['status']; ?></p>
          </div>
        </div>
        <div class="chat-box">
        
          <!-- <div class="chat outgoing">
            <div class="details">
              <p>Lorem ipsum dolor, sit amet.</p>
            </div>
          </div>
          <div class="chat incoming">
            <img src="img.jpg" alt="">
            <div class="details">
              <p>Lorem ipsum dolor </p>
            </div>
          </div> -->
        </div>
        <form action="" class="typing-area">
          <input type="hidden" name="outgoing_id" value="<?php echo $_SESSION['unique_id']; ?>">
          <input type="hidden" name="incoming_id" value="<?php echo $user; ?>">
          <input type="text" name="msg" class="input-field" placeholder="Type a message here..." autocomplete="off">
          <button type="submit"><i class="fab fa-telegram-plane"></i></button>
        </form>
      </div>
      <!-- <header>
                <a href="#" class="back"><i class="fas fa-arrow-left"></i></a>
                <div class="details">
                    <i class="fas fa-user"></i><span>Username</span>
                    <p>Active Now</p>
                </div>
            </header> -->

      <!-- <div class="chat-box">
                <div class="chat outgoing">
                    <div class="details">
                        <p>Lorem ipsum dolor, sit amet.</p>
                    </div>
                </div>
                <div class="chat incoming">
                    <div class="details">
                        <p>Lorem ipsum dolor </p>
                    </div>
                </div>
                
            </div>
            <form action="#" class="typing-area">
                <input type="text" placeholder="Type a message here...">
                <button><i class="fab fa-telegram-plane"></i></button>
            </form> -->
    </section>
  </div>
  <!-- footer -->
  <?php include "includes/footer.php"; ?>
  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>
<script>
  const form = document.querySelector(".typing-area");
  const sendBtn = document.querySelector("button");
  const inputField = document.querySelector(".input-field");
  const chatBox = document.querySelector(".chat-box");

  form.onsubmit = (e) => {
    e.preventDefault();
  }

  sendBtn.onclick = () => {
    let xhttp = new XMLHttpRequest();
    xhttp.open("POST", "php/insert-chat.php", true);
    xhttp.onload = () => {
      if (xhttp.readyState === XMLHttpRequest.DONE) {
        if (xhttp.status === 200) {
          inputField.value = "";
          scrollToBottom();
        }
      }
    }
    let formData = new FormData(form);
    xhttp.send(formData);
  }

  
  chatBox.onmouseenter = ()=>{
    chatBox.classList.add("active");
}

chatBox.onmouseleave = ()=>{
    chatBox.classList.remove("active");
}
chatBox.touchenter = ()=>{
    chatBox.classList.add("active");
}

chatBox.touchleave = ()=>{
    chatBox.classList.remove("active");
}


  setInterval(() =>{
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "php/get-chat.php", true);
    xhr.onload = ()=>{
      if(xhr.readyState === XMLHttpRequest.DONE){
          if(xhr.status === 200){
            let data = xhr.response;
            chatBox.innerHTML = data;
            if(!chatBox.classList.contains("active")){
                scrollToBottom();
              }
          }
      }
    }
    let formData = new FormData(form);
    xhr.send(formData);
}, 500);


  function scrollToBottom() {
    chatBox.scrollTop = chatBox.scrollHeight;
  }
</script>