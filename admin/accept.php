<?php

include('../include/connection.php');

$user_id = $_GET['user_id'];
$yes = "YES";

$sql = "UPDATE users SET s_verified = '$yes' WHERE id ='$user_id'";
$res = mysqli_query($con, $sql);
$sql2 = "DELETE FROM `pending_ver` WHERE `user_id` = '$user_id'";
$res2 = mysqli_query($con, $sql2);
header("location: ../Admin/admin.php");



?>