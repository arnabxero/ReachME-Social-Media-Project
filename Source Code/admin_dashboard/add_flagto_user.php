<?php


include('../include/connection.php');

$post_id = $_GET['pid'];
$user_id = $_GET['uid'];

$today = new DateTime("now", new DateTimeZone('Asia/Dhaka'));
$saveTime =  $today->format('h:i A|Y/m/d');

$sql = "INSERT INTO `flaglist` (`post_id`, `user_id`, `time`) VALUES ('$post_id', '$user_id', '$saveTime')";
$res = mysqli_query($con, $sql);

header('Location: admin_dashboard.php?type=pending&size=99999&subtype=op2');
