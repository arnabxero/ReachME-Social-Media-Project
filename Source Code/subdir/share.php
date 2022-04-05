<?php

include('../include/connection.php');
session_start();

$pid = $_GET['pid'];
$uid = $_SESSION['logid'];


$today = new DateTime("now", new DateTimeZone('Asia/Dhaka'));
$saveTime =  $today->format('h:i A|Y/m/d');

$sql = "INSERT INTO `posts` (`shared_pid`, `shared`, `authorid`, `time`) VALUES ('$pid', 'Y', '$uid', '$saveTime')";
$result = mysqli_query($con, $sql);


header('Location: ../your_contents.php');

?>