<?php

include('../include/connection.php');

session_start();


$post_id = -99;

if (isset($_GET['pid'])) {
    $post_id = $_GET['pid'];
}

$today = new DateTime("now", new DateTimeZone('Asia/Dhaka'));
$saveTime =  $today->format('h:i A|Y/m/d');

$sql = "DELETE FROM `pending_promote` WHERE post_id = '$post_id'";
$res = mysqli_query($con, $sql);

header('Location: admin_dashboard.php?type=pending&size=99999&subtype=op3');
