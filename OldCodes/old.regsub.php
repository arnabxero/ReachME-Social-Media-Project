<?php
//database connection file
include('../include/connection.php');
//email variable file
include('../include/mailer.php');
//phpmailer inclusion
require_once('../phpmailer/PHPMailerAutoload.php');

//get data from reg form --start
$uname = $_POST['uname'];
$email = $_POST['uemail'];
$pass = $_POST['pass'];
$phone = $_POST['mobile'];
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$job = $_POST['job'];
$about = $_POST['about'];
//get data from reg form --end

//
$sql3 = "SELECT * FROM users WHERE uname = '$uname' OR email = '$email'";

$res3 = mysqli_query($con, $sql3);
$row3 = mysqli_fetch_array($res3, MYSQLI_ASSOC);
$count = mysqli_num_rows($res3);

if ($count > 0) {
    echo "<h1>Sorry User Already Registered</h1>";
} else {
    //insert user into database table --start
    $sql = "INSERT INTO `nonver_users` (`fname`, `lname`, `uname`, `job`, `pass`, `email`, `phone`, `about`) VALUES ('$fname', '$lname', '$uname', '$job', '$pass', '$email', '$phone', '$about')";

    $rs = mysqli_query($con, $sql);
    //insert user into database table --end

    //create a row for that user in database --start
    $sql2 = "SELECT * FROM nonver_users WHERE uname = '$uname' AND email = '$email' AND pass = '$pass'";

    $res2 = mysqli_query($con, $sql2);

    $row = mysqli_fetch_array($res2, MYSQLI_ASSOC);

    $id = $row['id'];
    //create a row for that user in database --end



    //mail verification email to user email address --start
    $codegen = rand(0000, 9999);
    $vercode = $codegen . $id;
    $link = "<a href='" . $verifymail_website . "subdir/verify_email.php?vcode=" . $vercode . "&id=" . $id . "&email=" . $email . "'>Click and Verify Your Email On ReachMe</a>";


    //verification status insert --start
    $sql4 = "UPDATE nonver_users SET verified = '" . $vercode . "' WHERE id = " . $id;
    $rs4 = mysqli_query($con, $sql4);
    //verification status insert --end


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
    $name = $_POST['fname'] . " " . $_POST['lname'];
    $mail->AddAddress($_POST['uemail'], $name);
    $mail->Subject  =  'Verify Your Email Address on ReachMe';
    $mail->IsHTML(true);
    $mail->Body    = 'ReachMe Email Verification System - Click on this link : ' . $link . '';
    $mail->Send();
    //mail verification email to user email address --start

    if ($rs) {
        echo "Registration Successfull";
        header('Location: ../regverpage.php');
    } else {
        echo "Registration Failed";
    }
}
//
