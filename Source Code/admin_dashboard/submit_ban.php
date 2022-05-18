<?php

include('../include/connection.php');

$user_id = $_GET['uid'];

$sql = "INSERT INTO `ban_user` (`user_id`, `ban_stat`) VALUES ('$user_id', 'pending')";
$res = mysqli_query($con, $sql);

header("location: admin_dashboard.php?type=pending&size=99999&subtype=op4");

?>
