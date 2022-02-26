<?php

include('include/connection.php');
session_start();


$name = "Undefined";
$username = "Undefined";
$email = "Undefined";
$phone = "Undefined";
$job = "Undefined";
$about = "Undefined";
$flags = 0;
$propic = "ext-files/user/default.jpg";

$dob = "Undefined";
$rel = "Undefined";
$lan = "Undefined";
$rstat = "Undefined";
$bg = "Undefined";
$nat = "Undefined";
$addr = "Undefined";

$id = -99;


if (isset($_SESSION['logid'])) {
    $id = $_GET['uid'];

    $sql = "SELECT * FROM users WHERE id = '$id'";

    $result = mysqli_query($con, $sql);

    while ($row = mysqli_fetch_assoc($result)) {
        $name = $row['fname'] . ' ' . $row['lname'];
        $username = $row['uname'];
        $email = $row['email'];
        $phone = $row['phone'];
        $job = $row['job'];
        $about = $row['about'];
        $flags = $row['flag'];
        $propic = "ext-files/user/" . $row['pro_pic'];


        $dob = $row['date_of_birth'];
        $rel = $row['religion'];
        $lan = $row['language'];
        $rstat = $row['relation'];
        $bg = $row['blood'];
        $nat = $row['nation'];
        $addr = $row['address'];
    }
} else {
    header('Location: logreg.php');
}


?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/fontawesome/css/all.css">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css?v=<?php echo time(); ?>">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700&display=swap" rel="stylesheet" />
    <title>ReachMe - Profile</title>
    <link rel="shortcut icon" type="image/x-icon" href="rm.ico" />



    <style>

    </style>
</head>

<body style="background-color:#f7ffd2; text-align:center;">

    <script src="assets/bootstrap/js/bootstrap.bundle.min.js"></script>

    <a href="index.php">
        <img src="files/logo/rm.png" height="70px" width="70px">
    </a>

    <h2 style="text-align:center; font-weight:bold;">Your Profile</h2>
    <hr>

    <div class="container">

        <div class="row">
            <div class="col-sm-4">
            </div>
            <div class="col-sm-4" style="text-align:center;">
                <img class="profile-picture" src="<?= $propic ?>"></img>
            </div>

            <div class="col-sm-4">
            </div>
        </div>

        <hr>

        <div class="row">
            <div class="col-sm-6" style="text-align:right;">

                <span class="profile-details-param"><i class="fas fa-user"></i> Name : </span>
                <span class="profile-details-param"><i class="fas fa-link"></i> Username : </span>
                <span class="profile-details-param"><i class="fas fa-at"></i> Email : </span>
                <span class="profile-details-param"><i class="fas fa-phone"></i> Phone Number : </span>
                <span class="profile-details-param"><i class="fas fa-user-tie"></i> Profession : </span>

            </div>

            <div class="col-sm-6" style="text-align:left;">

                <span class="profile-details"><?= $name ?></span>
                <span class="profile-details"><?= $username ?></span>
                <span class="profile-details"><?= $email ?></span>
                <span class="profile-details"><?= $phone ?></span>
                <span class="profile-details"><?= $job ?></span>

            </div>
        </div>

        <hr>

        <div class="row">
            <div class="col-sm-2">
            </div>

            <div class="col-sm-8" style="text-align:center;">
                <span class="profile-details-param" style="font-size:24px;">About</span>
                <p class="profile-details"><?= $about ?></p>
            </div>

            <div class="col-sm-2">
            </div>
        </div>

        <hr>

        <div class="row">
            <div class="col-sm-6" style="text-align:right;">

                <span class="profile-details-param" style="font-size:24px;">Personal</span>
                <br>

                <span class="profile-details-param"><i class="fas fa-birthday-cake"></i> Date of Birth : </span>
                <span class="profile-details-param"><i class="fas fa-pray"></i> Religion : </span>
                <span class="profile-details-param"><i class="fas fa-language"></i> Language : </span>
                <span class="profile-details-param"><i class="fas fa-heart"></i> Relationship Status : </span>
                <span class="profile-details-param"><i class="fas fa-ambulance"></i> Blood Group : </span>
                <span class="profile-details-param"><i class="fas fa-globe"></i> Nationality : </span>
                <span class="profile-details-param"><i class="fas fa-map-marker-alt"></i> Address : </span>

            </div>

            <div class="col-sm-6" style="text-align:left;">

                <span class="profile-details-param" style="font-size:24px;">Information</span>
                <br>

                <span class="profile-details"><?= $dob ?></span>
                <span class="profile-details"><?= $rel ?></span>
                <span class="profile-details"><?= $lan ?></span>
                <span class="profile-details"><?= $rstat ?></span>
                <span class="profile-details"><?= $bg ?></span>
                <span class="profile-details"><?= $nat ?></span>
                <span class="profile-details"><?= $addr ?></span>

            </div>
        </div>

        <hr>

        <div class="row">
            <div class="col-sm-6" style="text-align:right;">
                <span class="profile-details-param"><i class="fas fa-flag"></i> Report Flags : </span>
            </div>

            <div class="col-sm-6" style="text-align:left;">
                <span class="profile-details"><?= $flags ?></span>
            </div>
        </div>

        <hr>
        <br>
        <div class="row">
            <div class="col-sm-5" style="text-align:right;">
                <a class="pro-btn" href="addfriend.php">Add Friend</a>
            </div>
            <div class="col-sm-2" style="text-align:center;">
                <a class="pro-btn" href="msg.php">Send Message</a>
            </div>

            <div class="col-sm-5" style="text-align:left;">
                <a class="pro-btn" href="subdir/logout.php">Log Out</a>
            </div>
        </div>
        <br>


    </div>

</body>

</html>