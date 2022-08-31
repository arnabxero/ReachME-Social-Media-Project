<?php

include('../include/connection.php');
session_start();


if (isset($_SESSION['logid'])) {
    if (isset($_GET['pid']) && isset($_GET['tid'])) {

        $pid = $_GET['pid'];
        $tid = $_GET['tid'];
        $op = $_GET['op'];


        if ($op == 'untag') {
            $sql = "DELETE FROM tag_list WHERE post_id = '$pid' AND tag_id = '$tid'";
            $res = mysqli_query($con, $sql);
        } else {
            $sql = "INSERT INTO `tag_list` (`post_id`, `tag_id`) VALUES ('$pid', '$tid')";
            $res = mysqli_query($con, $sql);
        }

        //$goto = "Location: ../view_post.php?pid=".$pid;
        $goto = "Location: ../tag.php?pid=".$pid;

        header($goto);
    } else {
        header('Location: ../index.php');
    }
} else {
    header('Location: ../logreg.php');
}
