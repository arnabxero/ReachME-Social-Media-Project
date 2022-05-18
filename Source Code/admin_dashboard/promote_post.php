<?php
include('../include/connection.php');

$sql = "SELECT NOW() as `now`";
$res = mysqli_query($con, $sql);
$row = mysqli_fetch_array($res);
$now = $row['now'];

$time_int = (int)($now[11] . $now[12]);

echo $time_int;

$add_time = 0;
$pid = -99;

if (isset($_GET['time'])) {
    $add_time = $_GET['time'];
}

if (isset($_GET['pid'])) {
    $pid = $_GET['pid'];
}

$schedule_sql = "CREATE EVENT promote_" . $pid . "
ON SCHEDULE AT '2021-09-01 " . ($time_int + $add_time) . ":30:00'
DO 
  INSERT INTO heroes.users (first_name, last_name) VALUES ('Peter', 'Parker')";
