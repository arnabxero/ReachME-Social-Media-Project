<?php
include('../include/connection.php');

$sql = "SELECT NOW() as `now`";
$res = mysqli_query($con, $sql);
$row = mysqli_fetch_array($res);
$now = $row['now'];

$add_time = 3;
$pid = -99;

if (isset($_GET['time'])) {
    if ($_GET['time'] != "testtime") {
        $add_time = $_GET['time'];
    }
}

if (isset($_GET['pid'])) {
    $pid = $_GET['pid'];
}

$sql1 = "INSERT INTO `promoted` (`post_id`) VALUES ('$pid')";
$res1 = mysqli_query($con, $sql1);


$sql2 = "DELETE FROM `pending_promote` WHERE post_id = '$pid'";
$res2 = mysqli_query($con, $sql2);

if ($_GET['time'] != "testtime") {
    $hour_str = $now[11] . $now[12];
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

    $event_name = "promote_post_" . $pid;
    //$new_time_str = "2022-05-27 17:20:00";

    $schedule_sql = "CREATE DEFINER=`root`@`localhost` EVENT `" . $event_name . "` ON SCHEDULE AT '" . $new_time_str . "' ON COMPLETION NOT PRESERVE ENABLE DO DELETE FROM `promoted` WHERE post_id = '" . $pid . "'";
    $res = mysqli_query($con, $schedule_sql);
} else {
    $hour_str = $now[14] . $now[15];
    $new_time_str = "";

    for ($i = 0; $i < strlen($now); $i++) {
        if ($i == '14') {
            $tmp = $hour_str + 1;
            $new_time_str = $new_time_str . $tmp;
        }
        if ($i == '14' or $i == '15') {
        } else {
            $new_time_str = $new_time_str . $now[$i];
        }
    }

    $event_name = "promote_post_" . $pid;
    //$new_time_str = "2022-05-27 17:20:00";

    $schedule_sql = "CREATE DEFINER=`root`@`localhost` EVENT `" . $event_name . "` ON SCHEDULE AT '" . $new_time_str . "' ON COMPLETION NOT PRESERVE ENABLE DO DELETE FROM `promoted` WHERE post_id = '" . $pid . "'";
    $res = mysqli_query($con, $schedule_sql);
}


header('Location: admin_dashboard.php?type=pending&size=99999&subtype=op3');
