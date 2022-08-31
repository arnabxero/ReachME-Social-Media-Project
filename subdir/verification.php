<?php

class verifycode
{
    function check_verification_code($verification_code, $newpass)
    {
        include("../include/connection.php");
        session_start();
        
        $verification_code = stripcslashes($verification_code);
        
        $verification_code = mysqli_real_escape_string($con, $verification_code);

        $newpass = stripcslashes($newpass);
        
        $newpass = mysqli_real_escape_string($con, $newpass);

    

        $sql = "SELECT * FROM users WHERE temp_id = $verification_code";
        $res = mysqli_query($con, $sql);
        $row = mysqli_fetch_array($res, MYSQLI_ASSOC);
        $count = mysqli_num_rows($res);
        $temp = "1";

        if ($count == 1) {


           if ($verification_code == $row['temp_id']){

                $sql1 = "UPDATE users SET pass = '$newpass' WHERE temp_id = '$verification_code'";
                $res1 = mysqli_query($con, $sql1);
                
                $sql2 = "UPDATE users SET temp_id = '$temp' WHERE temp_id = '$verification_code'";
                $res2 = mysqli_query($con, $sql2);

           }


        } else {
            echo "<h1> Incorrect verification code! </h1>";
        }
    }
}

if(isset($_POST['submit'])){
    $code = $_POST['code'];
    $pass = $_POST['cpass'];
    $veruser = new verifycode();
    $veruser->check_verification_code($code, $pass);
    header("Location: ../login.php");
}



?>