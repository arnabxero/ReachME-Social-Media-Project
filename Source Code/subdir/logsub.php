<?php


include('../phpClasses/allclass.php');


if (isset($_POST['submit'])) {
    $primemailusername = $_POST['emailusername'];
    $primpassword = $_POST['pass'];

    $ulogsub = new ulogin();

    $ulogsub->login_user($primemailusername, $primpassword);
}

?>