<?php

include('../include/connection.php');

$user_id = $_GET['uid'];

$sql = "UPDATE ban_user SET ban_stat = 'banned' WHERE user_id ='$user_id'";
$res = mysqli_query($con, $sql);


header("location: admin_dashboard.php?type=admin&size=5&subtype=op3");
