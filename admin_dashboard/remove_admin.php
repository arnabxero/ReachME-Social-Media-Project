<?php
include('../include/connection.php');

$user_id = $_GET['uid'];
$user_name = $_GET['uname'];

$sql = "DELETE FROM admin_list WHERE uid = '$user_id' AND username = '$user_name'";
$res = mysqli_query($con, $sql);

header('Location: admin_dashboard.php?type=admin&size=99999&subtype=op4');
