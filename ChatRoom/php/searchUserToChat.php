<?php
//searchbox script on page users.php
session_start();
require "config.php";

$outgoing_id = $_SESSION['unique_id'];
$getUser = $_POST['username'];
$sql = "SELECT * FROM users WHERE username LIKE '%{$getUser}%' AND unique_id != {$outgoing_id}";
$sql_run = mysqli_query($con, $sql);
$row = mysqli_num_rows(($sql_run));
if ($row > 0) {
    while ($user = mysqli_fetch_assoc($sql_run)) 
    {

        //get last msg query
        $sql2 = "SELECT * FROM messages WHERE (incoming_msg_id = {$user['unique_id']}
        OR outgoing_msg_id = {$user['unique_id']}) AND (outgoing_msg_id = {$outgoing_id} 
        OR incoming_msg_id = {$outgoing_id}) ORDER BY msg_id DESC LIMIT 1";
        $sql2_run = mysqli_query($con, $sql2);
        $row2 = mysqli_fetch_assoc($sql2_run);

        if (mysqli_num_rows($sql2_run) > 0) {
            $result = $row2['msg'];
        } else {
            $result = "No message available";
        }
        //trimming msg if characters are more than 28
        (strlen($result) > 28) ? $msg =  substr($result, 0, 28) . '...' : $msg = $result;
        //offlinw-online check
        ($row['status'] == "Offline now") ? $offline = "offline" : $offline = "";

        echo  '<a href="chat.php?user_id=' . $user['unique_id'] . '">
        <div class="content">
            <img src="php/profileImg/' . $user['profileImg'] . '" alt="">
            <div class="details">
                <span>' . $user['username'] . '</span>
                <p>'. $msg .'</p>
            </div>
        </div>
        <div class="status-dot">
            <i class="fas fa-circle '. $offline .'"></i>
        </div>
    </a>';
    }
} else {
    echo "User not found";
}
