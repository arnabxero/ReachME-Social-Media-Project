<?php

include('../include/connection.php');
session_start();

if (isset($_SESSION['logid'])) {
    $logid = $_SESSION['logid'];
} else {
    header('Location: ../logreg.php');
}

$operation = $_GET['op'];
$sid = $_GET['sid'];
$rid = $_GET['rid'];


if ($operation == "add") {
    $sql = "INSERT INTO `friend_list` (`sid`, `rid`, `stat`) values ('$sid', '$rid', 'r')";
    $res = mysqli_query($con, $sql);
} else if ($operation == "rem") {
    $sql = "DELETE FROM friend_list WHERE (sid = '$sid' AND rid = '$rid' AND stat = 'a') OR (rid = '$sid' AND sid = '$rid' AND stat = 'a')";
    $res = mysqli_query($con, $sql);
} else if ($operation == "canc") {
    $sql = "DELETE FROM friend_list WHERE sid = '$sid' AND rid = '$rid' AND stat = 'r'";
    $res = mysqli_query($con, $sql);
} else if ($operation == "acc") {
    $sql = "UPDATE friend_list SET stat = 'a' WHERE sid = '$sid' AND rid = '$rid' AND stat = 'r'";
    $res = mysqli_query($con, $sql);
    $rid = $sid;
} else if ($operation == "reject") {
    $sql = "DELETE FROM friend_list WHERE sid = '$sid' AND rid = '$rid' AND stat = 'r'";
    $res = mysqli_query($con, $sql);
    $rid = $sid;
}


if (isset($_GET['getback'])) {
    header('Location: ../friend_list.php');
} else {
    header('Location: ../view_user.php?uid=' . $rid);
}
