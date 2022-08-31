<?php

include('../include/connection.php');

$user_id = $_GET['user_id'];

$sql = "SELECT * FROM pending_ver ORDER BY id";

$query = mysqli_query($con, $sql);

$row = mysqli_fetch_array($query, MYSQLI_ASSOC);

$id = $row['user_id'];
$folder = $row['user_id'];
$structure = "../ext-files/ver_file/" . $folder;
$one = "1.pdf";
$two = "2.pdf";


if (file_exists("../ext-files/ver_file/" . $folder . '/' . $one)) {
    if (file_exists("../ext-files/ver_file/" . $folder . '/' . $two)) {
        unlink("../ext-files/ver_file/" . $folder . '/' . $one);
        unlink("../ext-files/ver_file/" . $folder . '/' . $two);
        if (!rmdir($structure)) {
            echo ("Could not remove $folder");
        }
    }
}

$sql2 = "DELETE FROM `pending_ver` WHERE `user_id` = '$user_id'";
$res = mysqli_query($con, $sql2);
header("location: ../Admin/admin.php");


?>