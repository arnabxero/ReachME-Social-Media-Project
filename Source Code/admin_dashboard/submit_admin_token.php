<?php

include('../include/connection.php');

$admin_id = $_POST['admin_id'];
$admin_name = $_POST['admin_name'];
$msg = $_POST['msg'];
$topic = $_POST['topic'];

$today = new DateTime("now", new DateTimeZone('Asia/Dhaka'));
$saveTime =  $today->format('h:i A|Y/m/d');

$sql = "INSERT INTO `admin_request` (`msg`, `topic`, `admin_id`, `admin_name`, `time`) VALUES ('$msg', '$topic', '$admin_id', '$admin_name', '$saveTime')";
$res = mysqli_query($con, $sql);

header("location: admin_dashboard.php?type=extraopt&size=99999&subtype=op1");
