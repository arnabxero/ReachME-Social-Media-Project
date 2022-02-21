<?php

class post_card_creation
{
    public $class_con;

    function get_con($con)
    {
        $this->class_con = $con;
    }

    function generate_card($htype)
    {
        $class_home_type = $htype;

        $sql = "SELECT * FROM posts";

        $res = mysqli_query($this->class_con, $sql);
        $type = "none";

        while ($class_row = mysqli_fetch_assoc($res)) {
            $type = $class_row['category'];
            $id = $class_row['id'];
            $media_tag = 'img';
            $authorname = $class_row['authorname'];
            $time = $class_row['time'];

            if ($class_home_type == 'all') {
                if ($type == 'photo') {
                    $media_tag = 'img';
                } else if ($type == 'video') {
                    $media_tag = 'iframe';
                }

                echo '<div class="card-main">
    
                    <a title="View User Profile" class="unformatted-link homepage-poster-name" href="view_user.php?uid=' . $class_row['authorid'] . '"><img class="profile-pic-home-post" src="files/images/arnabxero_profile.jpg">&nbsp' . $authorname . '<p class="timestamp-home" title="Timestamp">' . $time . '</p></a>
    
                    <div class="post-text">
                        <span>' . $class_row['content'] . '</span>
                    </div>
    
                    <div style="margin-bottom: 30px;">
                        <' . $media_tag . ' src="' . $class_row['media_link'] . '" height="auto" width="100%" controlsList="nodownload"></' . $media_tag . '>
                    </div>
    
                    <a class="unformatted-link" href="view_post.php?pid=' . $class_row['id'] . '" title="See More">
                        <div class="card-button-see-more"><i class="fas fa-expand-alt"></i> See More <i class="fas fa-expand-alt"></i></div>
                    </a>
    
                    <a href="like.php" title="Upvote">
                        <div class="card-button"><i class="fas fa-thumbs-up"></i></div>
                    </a>
                    <a href="like.php" title="Downvote">
                        <div class="card-button"><i class="fas fa-thumbs-down"></i></div>
                    </a>
                    <a href="like.php" title="Comment">
                        <div class="card-button"><i class="fas fa-comment-alt"></i></div>
                    </a>
                    <a href="like.php" title="Share">
                        <div class="card-button"><i class="fas fa-share-square"></i></div>
                    </a>
    
                </div>';
            } else {
                if ($type == $class_home_type) {
                    if ($type == 'photo') {
                        $media_tag = 'img';
                    } else if ($type == 'video') {
                        $media_tag = 'iframe';
                    }

                    echo '<div class="card-main">
    
                    <a title="View User Profile" class="unformatted-link homepage-poster-name" href="view_user.php?uid=' . $class_row['authorid'] . '"><img class="profile-pic-home-post" src="files/images/arnabxero_profile.jpg">&nbsp' . $authorname . '<p class="timestamp-home" title="Timestamp">' . $time . '</p></a>
    
                    <div class="post-text">
                        <span>' . $class_row['content'] . '</span>
                    </div>
    
                    <div style="margin-bottom: 30px;">
                        <' . $media_tag . ' src="' . $class_row['media_link'] . '" height="auto" width="100%" controlsList="nodownload"></' . $media_tag . '>
                    </div>
    
                    <a class="unformatted-link" href="view_post.php?pid=' . $class_row['id'] . '" title="See More">
                        <div class="card-button-see-more"><i class="fas fa-expand-alt"></i> See More <i class="fas fa-expand-alt"></i></div>
                    </a>
    
                    <a href="like.php" title="Upvote">
                        <div class="card-button"><i class="fas fa-thumbs-up"></i></div>
                    </a>
                    <a href="like.php" title="Downvote">
                        <div class="card-button"><i class="fas fa-thumbs-down"></i></div>
                    </a>
                    <a href="like.php" title="Comment">
                        <div class="card-button"><i class="fas fa-comment-alt"></i></div>
                    </a>
                    <a href="like.php" title="Share">
                        <div class="card-button"><i class="fas fa-share-square"></i></div>
                    </a>
    
                </div>';
                }
            }
        }
    }
}

class ulogin
{

    function login_user($emailusername, $password)
    {

        include('../include/connection.php');
        session_start();

        $emailusername = stripcslashes($emailusername);
        $password = stripcslashes($password);
        $emailusername = mysqli_real_escape_string($con, $emailusername);
        $password = mysqli_real_escape_string($con, $password);


        $sql = "SELECT * FROM users WHERE uname = '$emailusername' or email = '$emailusername' and pass = '$password'";

        $result = mysqli_query($con, $sql);

        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

        $count = mysqli_num_rows($result);

        if ($count == 1) {
            $_SESSION["logid"] = $row['id'];
            $_SESSION["logname"] = $row['fname'] . ' ' . $row['lname'];
            echo "<h1> Login Successful<br>Loading Your Profile</h1>";
            header('Location: ../index.php');
        } else {
            echo "<h1> Login failed<br>Invalid username or password<br>Please Try Again</h1>";
        }
    }
}


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

        $sql3 = "SELECT * FROM users WHERE uname = '$uname' OR email = '$email'";

        $res3 = mysqli_query($con, $sql3);
        $row3 = mysqli_fetch_array($res3, MYSQLI_ASSOC);
        $count = mysqli_num_rows($res3);

        if ($count > 0) {
            return true;
        } else {
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
            $this->class_link = "<a href='" . $verifymail_website . "subdir/verify_email.php?vcode=" . $vercode . "&id=" . $this->class_uid . "&email=" . $email . "'>Click and Verify Your Email On ReachMe</a>";

            //verification status insert --start
            $sql4 = "UPDATE nonver_users SET verified = '" . $vercode . "' WHERE id = " . $this->class_uid;
            $rs4 = mysqli_query($con, $sql4);
            //verification status insert --end
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


class verifymail
{
    function check_vercode_and_transfer_user()
    {
        include("../include/connection.php");
        $verification_code = $_GET['vcode'];
        $id = $_GET['id'];
        $vercode = "1";
        $email = $_GET['email'];

        $sql = "SELECT * FROM nonver_users WHERE verified = $verification_code";
        $res = mysqli_query($con, $sql);
        $row = mysqli_fetch_array($res, MYSQLI_ASSOC);
        $count = mysqli_num_rows($res);

        if ($count < 1) {
            echo "Check your email, if verification email exist then you are already verified, <a href='../login.php'>Login</a><br>If verification email not exists, then please <a href='../registration.php'>Register</a>";
        } else {
            $fname = $row['fname'];
            $lname = $row['lname'];
            $uname = $row['uname'];
            $job = $row['job'];
            $pass = $row['pass'];
            $email = $row['email'];
            $phone = $row['phone'];
            $about = $row['about'];
            $verified = "1";

            $sql2 = "INSERT INTO `users` (`fname`, `lname`, `uname`, `job`, `pass`, `email`, `phone`, `verified`, `about`) VALUES ('$fname', '$lname', '$uname', '$job', '$pass', '$email', '$phone', '$verified', '$about')";
            $res2 = mysqli_query($con, $sql2);

            $sql3 = "DELETE FROM `nonver_users` WHERE `verified` = $verification_code";
            $res3 = mysqli_query($con, $sql3);

            if ($res && $res2 && $res3) {
                echo "Verification Successfull <a href='../login.php'>Go to Login</a>";
            } else {
                echo "Failed Verification.";
            }
        }
    }
}


?>