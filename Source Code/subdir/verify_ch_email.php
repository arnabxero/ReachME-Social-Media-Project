<?php

class verifyEmailcode
{
    public $class_uid;
    public $class_code;
    public $class_name;
    public $class_email;
    public $class_link;

    function check_verification_code($verification_code, $newemail)
    {
        include("../include/connection.php");
        include('../include/mailer.php');
        session_start();

        $verification_code = stripcslashes($verification_code);

        $verification_code = mysqli_real_escape_string($con, $verification_code);

        $newemail = stripcslashes($newemail);

        $newemail = mysqli_real_escape_string($con, $newemail);



        $sql = "SELECT * FROM users WHERE temp_id = $verification_code";
        $res = mysqli_query($con, $sql);
        $row = mysqli_fetch_array($res, MYSQLI_ASSOC);
        $count = mysqli_num_rows($res);
        $temp = "1";

        if ($count == 1) {

            $this->class_name = $row['fname'] . ' ' . $row['lname'];
            $this->class_email = $newemail;
            $this->class_uid = $row['id'];

            $new_email_vcode = rand(0000, 9999);
            $new_email_vcode_done = $new_email_vcode . $this->class_uid;
            $temp = $new_email_vcode_done;

            $this->class_link = "<h3><a href='" . $verifymail_website . "subdir/nmailver.php?oldemail=" . $row['email'] . "&id=" . $this->class_uid . "&NewEmail=" . $newemail . "&vrcode=" . $new_email_vcode_done . "'>Click here to re-login on ReachMe</a></h3>";

            if ($verification_code == $row['temp_id']) {

                $sql1 = "UPDATE users SET email = '$newemail' WHERE temp_id = '$verification_code'";
                $res1 = mysqli_query($con, $sql1);

                $sql2 = "UPDATE users SET temp_id = '$temp' WHERE temp_id = '$verification_code'";
                $res2 = mysqli_query($con, $sql2);
            }
        } else {
            echo "<h1> Incorrect verification code! </h1>";
        }
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
        $name = $this->class_name;
        $mail->AddAddress($this->class_email, $name);
        $mail->Subject  =  'Verify Your Email Address on ReachMe';
        $mail->IsHTML(true);
        $mail->Body    = 'You have changed your ReachMe email address  - Click on this link to re-login with your new email: ' . $this->class_link . '';
        $mail_rs = $mail->Send();
        //mail verification email to user email address --start

        if ($mail_rs) {
            return true;
        } else {
            return false;
        }
    }
}

if (isset($_POST['submit'])) {
    $code = $_POST['code'];
    $email = $_POST['nemail'];
    $veruser = new verifyEmailcode();
    $veruser->check_verification_code($code, $email);
    $veruser->mail_the_code();
    header("Location: logout.php?to=login");
}
