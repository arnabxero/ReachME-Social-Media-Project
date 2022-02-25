<?php
include('../include/connection.php');

session_start();

$goto = "Location: ../index.php";

if(isset($_GET['to'])){
    $goto = "Location: ../login.php";
}

session_unset(); 
session_destroy();  
echo "Logging Out!";
header($goto);

?>