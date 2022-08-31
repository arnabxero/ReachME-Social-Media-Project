<?php


class uregister
{
    public $class_uid;
    public $class_link;

    function sub_reg($fname, $lname, $uname, $job, $pass, $email, $phone, $about)
    {
        include('../include/connection.php');
        include('../include/mailer.php');

        $uname = stripcslashes($uname);
        $email = stripcslashes($email);
        $pass = stripcslashes($pass);
        $phone = stripcslashes($phone);
        $fname = stripcslashes($fname);
        $lname = stripcslashes($lname);
        $job = stripcslashes($job);
        $about = stripcslashes($about);

        $uname = mysqli_real_escape_string($con, $uname);
        $email = mysqli_real_escape_string($con, $email);
        $pass = mysqli_real_escape_string($con, $pass);
        $phone = mysqli_real_escape_string($con, $phone);
        $fname = mysqli_real_escape_string($con, $fname);
        $lname = mysqli_real_escape_string($con, $lname);
        $job = mysqli_real_escape_string($con, $job);
        $about = mysqli_real_escape_string($con, $about);


        //insert user into database table --start
        $sql = "INSERT INTO `nonver_users` (`fname`, `lname`, `uname`, `job`, `pass`, `email`, `phone`, `about`) VALUES ('$fname', '$lname', '$uname', '$job', '$pass', '$email', '$phone', '$about')";
        $rs = mysqli_query($con, $sql);
        //insert user into database table --end

        //create a row for that user in database --start
        $sql2 = "SELECT * FROM nonver_users WHERE uname = '$uname' AND email = '$email' AND pass = '$pass'";
        $res2 = mysqli_query($con, $sql2);
        $row = mysqli_fetch_array($res2, MYSQLI_ASSOC);
        $this->class_uid = $row['id'];

        //mail verification email to user email address --start
        $codegen = rand(0000, 9999);
        $vercode = $codegen . $this->class_uid;
        $this->class_link = "<h3><a href='" . $verifymail_website . "subdir/verify_email.php?vcode=" . $vercode . "&id=" . $this->class_uid . "&email=" . $email . "'>Click and Verify Your Email On ReachMe</a></h3>";

        //verification status insert --start
        $sql4 = "UPDATE nonver_users SET verified = '" . $vercode . "' WHERE id = " . $this->class_uid;
        $rs4 = mysqli_query($con, $sql4);
        //verification status insert --end

    }

    function mail_the_code()
    {
        include('../include/mailer.php');
        require_once('../phpmailer/PHPMailerAutoload.php');

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
        $mail->Body    = 'ReachMe Email Verification System - Click on this link : ' . $this->class_link . '';
        $mail_rs = $mail->Send();
        //mail verification email to user email address --start

        if ($mail_rs) {
            return true;
        } else {
            return false;
        }
    }
}



$uname = $_POST['uname'];
$email = $_POST['uemail'];
$pass = $_POST['pass'];
$phone = $_POST['mobile'];
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$job = $_POST['job'];
$about = $_POST['about'];


$register_user = new uregister();

if ($register_user->sub_reg($fname, $lname, $uname, $job, $pass, $email, $phone, $about)) {
    echo "<h1>Sorry User Already Registered</h1>";
}

if ($register_user->mail_the_code()) {
    echo "Registration Successfull";
    header('Location: ../regverpage.php');
} else {
    echo "Registration Failed";
}
