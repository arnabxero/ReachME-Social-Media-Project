<?php

include('../include/connection.php');
session_start();


if (isset($_SESSION['logid'])) {

    $uid = $_SESSION['logid'];
    $pid = $_POST['pid'];
    $comment = $_POST['comment'];
    $today = new DateTime("now", new DateTimeZone('Asia/Dhaka'));
    $saveTime =  $today->format('h:i A|Y/m/d');

    $sql = "INSERT INTO `comments` (`authorid`, `time`, `content`, `post_id`) VALUES ('$uid', '$saveTime', '$comment', '$pid')";

    $res = mysqli_query($con, $sql);

    if ($res) {
        header('Location: ../view_post.php?pid=' . $pid . '');
    } else {
        echo "Comment Failed, Getting back in 2 seconds";

        header('Refresh: 2; URL=../view_post.php?pid=' . $pid . '');
    }
} else {
    header('Location: ../logreg.php');
}
