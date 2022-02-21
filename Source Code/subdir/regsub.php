<?php


include('../phpClasses/allclass.php');


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


?>