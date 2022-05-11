<?php

session_start();
include('../include/connection.php');


if(isset($_SESSION['logid']) and isset($_SESSION['admin'])){
    header('Location: admin_dashboard.php');
} else {
    header('Location: ../logreg.php');
}

?>