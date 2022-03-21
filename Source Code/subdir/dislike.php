<?php
include('../include/connection.php');
session_start();

if (!isset($_SESSION['logid'])) {
    header('Location: ../logreg.php');
}


$pid = $_GET['pid'];
$uid = $_SESSION['logid'];

$liked = 0;

$sql = "SELECT * FROM votes WHERE user_id = $uid AND post_id = $pid AND stat = 'd'";
$res = mysqli_query($con, $sql);
$count = mysqli_num_rows($res);
if ($count > 0) {
    $liked = 1;
}


if ($liked == 0) {
    $sql2 = "INSERT INTO `votes` (`post_id`, `user_id`, `stat`) VALUES ('$pid', '$uid', 'd')";
    $res2 = mysqli_query($con, $sql2);
}
else if($liked == 1){
    $sql3 = "DELETE FROM votes WHERE user_id = $uid AND post_id = $pid AND stat = 'd'";
    $res3 = mysqli_query($con, $sql3);
}

$goto = "Location: ../view_post.php?pid=" . $pid;
header($goto);


?>