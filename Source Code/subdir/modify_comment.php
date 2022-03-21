<?php

include('../include/connection.php');

session_start();

$uid = -99;
$pid = -99;

if (isset($_SESSION["logid"])) {
    $uid = $_SESSION['logid'];
    $cid = $_GET['cid'];
    $pid = $_GET['pid'];
    $oper = $_GET['operation'];

    $edlnk = 'Location: ../edit_comment.php?cid=' . $cid . "&pid=" . $pid;
    $dlink = 'Location: delete_comment.php?cid=' . $cid . "&pid=" . $pid;

    if ($oper == 'edit') {
        header($edlnk);
    } else if ($oper == 'del') {
        header($dlink);
    }
} else {
    header('Location: ../logreg.php');
}
