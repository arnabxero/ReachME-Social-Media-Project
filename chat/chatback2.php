<?php

session_start();
    if(isset($_SESSION['logid'])){
        include('../include/connection.php');
        $sender_id = $_SESSION['logid'];
        $receiver_id = mysqli_real_escape_string($con, $_GET['incoming_id']);
        $message = mysqli_real_escape_string($con, $_GET['message']);
        if(!empty($message)){
            
            $sql = "INSERT INTO messages (receiver, sender, msg) VALUES ('$receiver_id', '$sender_id', '$message')";
            $res = mysqli_query($con, $sql ) or die();
            if ($res) {
                header('Location: chatbox.php?user_id=' . $receiver_id . '');
            } else {
                echo "Failed to send messege";
        
                header('Refresh: 2; URL=chatbox.php?user_id=' . $receiver_id . '');
            }
        }else{
             header('Location: chatbox.php?user_id=' . $receiver_id . '');
        }
        
    }else{
        header('Location: ../login.php');
    }


?>