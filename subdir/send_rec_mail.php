<?php

class send_mail
{
    function sendit()
    {
        include('../include/mailer.php');
        include('../include/connection.php');
        require_once('../phpmailer/PHPMailerAutoload.php');

        $id = $_GET['uid'];

        $codegen = rand(0000, 9999);
        $codegen = $codegen . $id;

        $sql = "UPDATE users SET temp_id2 = '$codegen' WHERE id = '$id'";
        $res = mysqli_query($con, $sql);
        if ($res) {
            echo "<h1>Recovery Email Sent To Your Email Address, Please Check!<br><a href='../index.php'>Home</a></h1>";
        }

        $linktosend = "<h3><a href='" . $verifymail_website . "set_new_pass.php?vcode=" . $codegen . "&id=" . $id . "'>Click Here to Reset Your Password On ReachMe</a></h3>";
    
        $mail = new PHPMailer();
        $mail->CharSet =  "utf-8";
        $mail->IsSMTP();
        // enable SMTP authentication
        $mail->SMTPAuth = true;
        // GMAIL username
        $mail->Username = $mailer_mail;
        // GMAIL password
        $mail->Password = $mailer_pass;
        $mail->SMTPSecure = "ssl";
        // sets GMAIL as the SMTP server
        $mail->Host = "smtp.gmail.com";
        // set the SMTP port for the GMAIL server
        $mail->Port = "465";
        $mail->From = 'reachme.versys@gmail.com';
        $mail->FromName = 'ReachMe';
        $name = "Recovery User";
        $mail->AddAddress($_GET['uemail'], $name);
        $mail->Subject  =  'Verify Your Email Address on ReachMe';
        $mail->IsHTML(true);
        $mail->Body    = 'ReachMe Account Recovery System - Click on this link : ' . $linktosend . '';
        $mail_rs = $mail->Send();
        //mail verification email to user email address --start
    
    }
}



$obj = new send_mail();
$obj->sendit();

?>