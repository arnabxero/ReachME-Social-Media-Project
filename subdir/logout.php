<?php
include('../include/connection.php');

session_start();
$logid = $_SESSION['logid'];

$goto = "Location: ../index.php";

if(isset($_GET['to'])){
    $goto = "Location: ../login.php";
}
$sql1 = "UPDATE users SET status ='Offline' WHERE id =  $logid";
$rs = mysqli_query($con, $sql1);
session_unset(); 
session_destroy();  
echo "Logging Out!";
header($goto);

?>