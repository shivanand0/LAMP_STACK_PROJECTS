<?php
//script for getting chat of users in their inbox
session_start();
if (isset($_SESSION['unique_id'])) 
{
    require 'config.php';
    $outgoing_id = $_SESSION['unique_id'];;
    $incoming_id = $_POST['incoming_id'];
    $incoming_id = mysqli_real_escape_string($con, $incoming_id);

    $chats = "";

    $sql = "SELECT * FROM messages LEFT JOIN users ON users.unique_id = messages.incoming_msg_id
            WHERE (outgoing_msg_id = {$outgoing_id} AND incoming_msg_id = {$incoming_id})
            OR (outgoing_msg_id = {$incoming_id} AND incoming_msg_id = {$outgoing_id}) ORDER BY msg_id";

    $sql_run = mysqli_query($con, $sql) or die(mysqli_error($con));

    if (mysqli_num_rows($sql_run) > 0) 
    {
        while ($row = mysqli_fetch_assoc($sql_run)) 
        {
            if ($row['outgoing_msg_id'] === $outgoing_id) //sender
            {
                $chats .= '<div class="chat outgoing">
                    <div class="details">
                        <p>' . $row['msg'] . '</p>
                    </div>
                    </div>';
            } 
            else //receiver
            {
                $chats .= '<div class="chat incoming">
                <img src="php/profileImg/' . $row['profileImg'] . '" alt="">
                <div class="details">
                    <p>' . $row['msg'] . '</p>
                </div>
                </div>';
            }
            echo $chats;
        }
    } 
    else 
    {
        $chats .= '<div class="text">No messages are available. Once you send message they will appear here.</div>';
        echo $chats;
    }
} 
else 
{
    header("location: ../index.php");
}
