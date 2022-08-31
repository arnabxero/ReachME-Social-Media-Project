<?php

class con_new_mail
{
    function do_the_operation($vcode, $mail)
    {
        include('../include/connection.php');

        $sql = "UPDATE users SET temp_id = '1' WHERE temp_id = '$vcode' AND email = '$mail'";
        $res = mysqli_query($con, $sql);

        header('Location: ../login.php');
    }
}


$vcode = $_GET['vrcode'];
$mail = $_GET['NewEmail'];
$obj = new con_new_mail();

$obj->do_the_operation($vcode, $mail);



?>