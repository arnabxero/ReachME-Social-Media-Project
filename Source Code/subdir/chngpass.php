<?php


class u_chng_pass
{
    public $class_uid;
    public $class_code;
    public $class_name;
    public $class_email;
    


    function change_password($oldpass)
    {

        include('../include/connection.php');
        session_start();

        $oldpass = stripcslashes($oldpass);
        
        $oldpass = mysqli_real_escape_string($con, $oldpass);
        
        $user =  $_SESSION["logUname"];
 
        $sql = "SELECT * FROM users WHERE uname = '$user' and pass = '$oldpass'";

        $result = mysqli_query($con, $sql);

        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

        $count = mysqli_num_rows($result);

        if ($count == 1) {
            
            $this->class_name = $row['fname'] . ' ' . $row['lname'];
            $this->class_email = $row['email'];
            $this->class_uid = $row['id'];
            
            $codegen = rand(0000, 9999);
            $vercode = $codegen . $this->class_uid;
            $this->class_code = "<h3> $vercode </h3>";

            $sql1 = "UPDATE users SET temp_id = '" . $vercode . "' WHERE id = " . $this->class_uid;
            
            $rs = mysqli_query($con, $sql1);

        } else {
            echo "<h1> Password Changing failed <br>Invalid username or password<br>Please Try Again</h1>";
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
        $mail->Body    = 'ReachMe change password Verification System - please enter this code : ' . $this->class_code . '';
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
    $primOldpass = $_POST['old_pass'];
    

    $changepass = new u_chng_pass();

    $changepass->change_password($primOldpass);
    if ($changepass->mail_the_code()) {
        echo "Registration Successfull";
        header("Location: ../new_pass.php");
    } else {
        echo "Failed to change the password";
    }

}

?>