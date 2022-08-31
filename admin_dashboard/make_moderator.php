<?php
include('../include/connection.php');

$user_id = $_GET['uid'];
$user_name = $_GET['uname'];

$sql = "INSERT INTO `admin_list` (`rank`, `uid`, `username`) VALUES ('moderator', '$user_id', '$user_name')";
$res = mysqli_query($con, $sql);

header('Location: admin_dashboard.php?type=admin&size=99999&subtype=op2');
