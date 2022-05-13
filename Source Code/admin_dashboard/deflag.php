<?php
include('../include/connection.php');

$post_id = $_GET['pid'];

$sql = "UPDATE posts SET report = '' WHERE id = '$post_id'";
$res = mysqli_query($con, $sql);

header('Location: ../view_post.php?pid='.$post_id);

?>