<?php
include('include/connection.php');

$sql = "SELECT NOW() as `now`";
$res = mysqli_query($con, $sql);
$row = mysqli_fetch_array($res);
$now = $row['now'];

$hour_str = $now[11] . $now[12];


$add_time = 3;
$pid = -99;

if (isset($_GET['time'])) {

    $add_time = $_GET['time'];
}

if (isset($_GET['pid'])) {
    $pid = $_GET['pid'];
}

$new_time_str = "";

for ($i = 0; $i < strlen($now); $i++) {
    if ($i == '11') {
        $tmp = $hour_str + $add_time;
        $new_time_str = $new_time_str . $tmp;
    }
    if ($i == '11' or $i == '12') {
    } else {
        $new_time_str = $new_time_str . $now[$i];
    }
}

echo $new_time_str;




$event_name = "promote_post_" . $pid;
//$new_time_str = "2022-05-27 17:20:00";

$schedule_sql = "CREATE DEFINER=`root`@`localhost` EVENT `" . $event_name . "` ON SCHEDULE AT '" . $new_time_str . "' ON COMPLETION NOT PRESERVE ENABLE DO INSERT INTO test1 (col2, col3, col4) VALUES ('arnaxero', 'arnabpass', 'xxxxx')";
$res = mysqli_query($con, $schedule_sql);
