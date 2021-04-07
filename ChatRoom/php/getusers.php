<?php
//script for showing all users in page users.php
session_start();
require "config.php";

$outgoing_id = $_SESSION['unique_id'];
$other_users_id = $_SESSION['unique_id'];
$sql = "SELECT * FROM users WHERE NOT unique_id = {$other_users_id} ORDER BY id DESC";
$sql_run = mysqli_query($con, $sql);

$otherUsers = "";


if (mysqli_num_rows($sql_run) == 0)
{
    $otherUsers .= "No users are available to chat";
} 
elseif (mysqli_num_rows($sql_run) > 0) 
{

    while ($row = mysqli_fetch_assoc($sql_run)) 
    {

        //get last msg query
        $sql2 = "SELECT * FROM messages WHERE (incoming_msg_id = {$row['unique_id']}
                OR outgoing_msg_id = {$row['unique_id']}) AND (outgoing_msg_id = {$outgoing_id} 
                OR incoming_msg_id = {$outgoing_id}) ORDER BY msg_id DESC LIMIT 1";
        $sql2_run = mysqli_query($con, $sql2);
        $row2 = mysqli_fetch_assoc($sql2_run);

        if (mysqli_num_rows($sql2_run) > 0) {
            $result = $row2['msg'];
        } 
        else {
            $result = "No message available";
        }
        //trimming msg if characters are more than 28
        (strlen($result) > 28) ? $msg =  substr($result, 0, 28) . '...' : $msg = $result;
        //offline-online status
        ($row['status'] == "Offline now") ? $offline = "offline" : $offline = "";

        $otherUsers .= '<a href="chat.php?user_id=' . $row['unique_id'] . '">
        <div class="content">
            <img src="php/profileImg/' . $row['profileImg'] . '" alt="">
            <div class="details">
                <span>' . $row['username'] . '</span>
                <p>' . $msg . '</p>
            </div>
        </div>
        <div class="status-dot">
            <i class="fas fa-circle '. $offline .'"></i>
        </div>
    </a>';
    }
}
echo $otherUsers;
