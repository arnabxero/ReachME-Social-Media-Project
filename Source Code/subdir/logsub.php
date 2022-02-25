<?php


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

            if ($row['temp_id'] == 1 || is_null($row['temp_id'])) {
                $_SESSION["logid"] = $row['id'];
                $_SESSION["logname"] = $row['fname'] . ' ' . $row['lname'];
                $_SESSION["logUname"] = $row['uname'];
                $_SESSION["propic_link"] = $row['pro_pic'];
                echo "<h1> Login Successful<br>Loading Your Profile</h1>";
                header('Location: ../index.php');
            } else {
                echo "<h2>You Have Not Verified Your New Email Address Yet, Please check inbox and click verification link to verify email.<br><a href='../login.php'>Login After Verification</a></h2>";
            }
        } else {
            echo "<h1> Login failed<br>Invalid username or password<br>Please Try Again</h1>";
            echo "<h1><a href='../login.php'>Login Again</a></h1>";
        }
    }
}

if (isset($_POST['submit'])) {
    $primemailusername = $_POST['emailusername'];
    $primpassword = $_POST['pass'];

    $ulogsub = new ulogin();

    $ulogsub->login_user($primemailusername, $primpassword);
}
