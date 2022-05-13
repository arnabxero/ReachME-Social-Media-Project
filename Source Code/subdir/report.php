<?php
include('../include/connection.php');

if(!isset($_SESSION['logid'])){
    header('Location: ../logreg.php');
}

$post_id = $_GET['pid'];

$sql = "UPDATE posts SET report = 'Report' WHERE id = '$post_id'";
$res = mysqli_query($con, $sql);

header('Location: ../view_post.php?pid='.$post_id);

?>