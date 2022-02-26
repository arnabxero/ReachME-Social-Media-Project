<?php

include('../include/connection.php');

session_start();

$goto = "Location: ../logreg.php";

if (isset($_SESSION['logid'])) {
    if ($_GET['oper'] == 'like') {
        $goto = "Location: like.php?pid=" . $_GET['pid'];
    } else if ($_GET['oper'] == 'dislike') {
        $goto = "Location: dislike.php?pid=" . $_GET['pid'];
    } else if ($_GET['oper'] == 'comment') {
        $goto = "Location: comment.php?pid=" . $_GET['pid'];
    } else if ($_GET['oper'] == 'share') {
        $goto = "Location: share.php?pid=" . $_GET['pid'];
    } else if ($_GET['oper'] == 'view') {
        $goto = "Location: ../view_post.php?pid=" . $_GET['pid'];
    } else{
        $goto = "Location: ../index.php";
    }
    header($goto);
} else {
    header($goto);
}
