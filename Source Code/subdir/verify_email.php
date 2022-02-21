<?php

include('../phpClasses/allclass.php');

$veruser = new verifymail();
$veruser->check_vercode_and_transfer_user();


?>