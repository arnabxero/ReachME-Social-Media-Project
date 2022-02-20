<?php
include("../include/connection.php");

$verification_code = $_GET['vcode'];
$id = $_GET['id'];
$vercode = "1";
$email = $_GET['email'];

$sql = "SELECT * FROM nonver_users WHERE verified = $verification_code";
$res = mysqli_query($con, $sql);
$row = mysqli_fetch_array($res, MYSQLI_ASSOC);
$count = mysqli_num_rows($res);

if($count<1){
    echo "Check your email, if verification email exist then you are already verified, <a href='../login.php'>Login</a><br>If verification email not exists, then please <a href='../registration.php'>Register</a>";
}else{
    
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

if($res && $res2 && $res3){
    echo "Verification Successfull <a href='../login.php'>Go to Login</a>";
}else{
    echo "Failed Verification.";
}
}
