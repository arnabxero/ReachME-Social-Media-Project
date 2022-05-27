<?php
include('include/connection.php');

$sql = "SELECT NOW() as `now`";
$res = mysqli_query($con, $sql);
$row = mysqli_fetch_array($res);
$now = $row['now'];

echo $now."----------";

echo $now[15];