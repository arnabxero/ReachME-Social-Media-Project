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
$gen = "Undefined";
$pol = "Undefined";
$spo = "Undefined";
$hobb = "Undefined";
$ulname = "Undefined";
$id = -99;

$vcheck = "hidden";


if (isset($_SESSION['logid'])) {
    function get_flag_count($user_id)
    {
        include('include/connection.php');
        $count = 0;
        $sql = "SELECT * FROM flaglist WHERE user_id = '$user_id'";
        $res = mysqli_query($con, $sql);
        $count = mysqli_num_rows($res);

        return $count;
    }

    $id = $_GET['uid'];

    $sql = "SELECT * FROM users WHERE id = '$id'";

    $result = mysqli_query($con, $sql);

    while ($row = mysqli_fetch_assoc($result)) {
        $name = $row['fname'] . ' ' . $row['lname'];
        $ulname = $row['fname'];
        $username = $row['uname'];
        $email = $row['email'];
        $phone = $row['phone'];
        $job = $row['job'];
        $about = $row['about'];
        $flags = get_flag_count($row['id']);
        $propic = "ext-files/user/" . $row['pro_pic'];


        $dob = $row['date_of_birth'];
        $rel = $row['religion'];
        $lan = $row['language'];
        $rstat = $row['relation'];
        $bg = $row['blood'];
        $nat = $row['nation'];
        $addr = $row['address'];
        $gen = $row['gender'];
        $pol = $row['politics'];
        $spo = $row['sports'];
        $hobb = $row['hobby'];

        if ($row['s_verified'] == 'YES') {
            $vcheck = "";
        }
    }
} else {
    header('Location: logreg.php');
}




$myid = $_SESSION['logid'];
$uid = $_GET['uid'];

$frnd_bt = "Add Friend";
$frnd_op_link = "subdir/friendop.php?sid=" . $myid . "&rid=" . $uid . "&op=add";
$frnd_bt2 = "See Friendship";
$frnd_op_link2 = "";
$custom_style = "";
$custom_style2 = "";
$frnd_bt_dialog = "Send Friend Request?";

$sql = "SELECT * FROM friend_list WHERE ((sid = $myid AND rid = $uid AND stat = 'a') OR (sid = $uid AND rid = $myid AND stat = 'a'))";
$res = mysqli_query($con, $sql);
$count = mysqli_num_rows($res);
if ($count == 1) {
    $frnd_bt = "Friends";
    $frnd_op_link = "subdir/friendop.php?sid=" . $myid . "&rid=" . $uid . "&op=rem";
    $frnd_bt2 = "Message";
    $frnd_op_link2 = 'chat/chatbox.php?user_id='.$uid;
    $frnd_bt_dialog = "Unfriend User?";
    $custom_style = "background-color: green;";
}

$sql2 = "SELECT * FROM friend_list WHERE sid = $myid AND rid = $uid AND stat = 'r'";
$res2 = mysqli_query($con, $sql2);
$count2 = mysqli_num_rows($res2);
if ($count2 == 1) {
    $frnd_bt = "Requested";
    $frnd_op_link = "subdir/friendop.php?sid=" . $myid . "&rid=" . $uid . "&op=canc";
    $frnd_bt_dialog = "Cancel Friend Request?";
    $custom_style = "background-color: gray;";
}

$sql3 = "SELECT * FROM friend_list WHERE sid = $uid AND rid = $myid AND stat = 'r'";
$res3 = mysqli_query($con, $sql3);
$count3 = mysqli_num_rows($res3);
if ($count3 == 1) {
    $frnd_bt = "Accept";
    $frnd_op_link = "subdir/friendop.php?sid=" . $uid . "&rid=" . $myid . "&op=acc";
    $frnd_bt_dialog = "Accept Friend Request?";
    $custom_style = "background-color: gray;";
    $frnd_bt2 = "Reject";
    $frnd_op_link2 = "subdir/friendop.php?sid=" . $uid . "&rid=" . $myid . "&op=reject";
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

    <h2 style="text-align:center; font-weight:bold;"><?= $ulname ?>'s Profile</h2>
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
            <div class="col-6" style="text-align:right;">

                <span class="profile-details-param"><i class="fas fa-user"></i> Name : </span>
                <span class="profile-details-param"><i class="fas fa-link"></i> Username : </span>
                <span class="profile-details-param"><i class="fas fa-at"></i> Email : </span>
                <span class="profile-details-param"><i class="fas fa-phone"></i> Phone Number : </span>
                <span class="profile-details-param"><i class="fas fa-user-tie"></i> Profession : </span>

            </div>

            <div class="col-6" style="text-align:left;">

                <span class="profile-details"><?= $name ?> &nbsp<img src="files/logo/verified.png" height="25px" width="25px" title="User Identity Verified" <?= $vcheck ?> onclick=" window.alert('User is Identity Verified!');"></span>
                <span class="profile-details"><?= $username ?></span>
                <span class="profile-details"><?= $email ?></span>
                <span class="profile-details"><?= $phone ?></span>
                <span class="profile-details"><?= $job ?></span>

            </div>
        </div>

        <hr>
        <div class="row">
            <div class="col-6">
                <a class="pro-btn" style="float: right; margin-right: 50px;<?= $custom_style ?>" href="<?= $frnd_op_link ?>" onclick="if (confirm('<?= $frnd_bt_dialog ?>')){return true;}else{event.stopPropagation(); event.preventDefault();};" title=""><?= $frnd_bt ?></a>
            </div>

            <div class="col-6">
                <a class="pro-btn" style="float: left; margin-left: 50px;<?= $custom_style2 ?>" href="<?= $frnd_op_link2 ?>"><?= $frnd_bt2 ?></a>
            </div>
        </div>
        <hr>

        <div class="row">
            <div class="col-2">
            </div>

            <div class="col-8" style="text-align:center;">
                <span class="profile-details-param" style="font-size:24px;">About</span>
                <p class="profile-details"><?= $about ?></p>
            </div>

            <div class="col-2">
            </div>
        </div>

        <hr>

        <div class="row">
            <div class="col-6" style="text-align:right;">

                <span class="profile-details-param" style="font-size:24px;">Personal</span>
                <br>

                <span class="profile-details-param"><i class="fas fa-birthday-cake"></i> Date of Birth : </span>
                <span class="profile-details-param"><i class="fas fa-pray"></i> Religion : </span>
                <span class="profile-details-param"><i class="fas fa-language"></i> Language : </span>
                <span class="profile-details-param"><i class="fas fa-heart"></i> Relationship Status : </span>
                <span class="profile-details-param"><i class="fas fa-ambulance"></i> Blood Group : </span>
                <span class="profile-details-param"><i class="fas fa-globe"></i> Nationality : </span>
                <span class="profile-details-param"><i class="fas fa-map-marker-alt"></i> Address : </span>
                <span class="profile-details-param"><i class="fas fa-venus-mars"></i> Gender : </span>
                <span class="profile-details-param"><i class="fas fa-landmark"></i> Political View : </span>
                <span class="profile-details-param"><i class="fas fa-running"></i> Sports : </span>
                <span class="profile-details-param"><i class="fas fa-code"></i> Hobby : </span>

            </div>

            <div class="col-6" style="text-align:left;">

                <span class="profile-details-param" style="font-size:24px;">Information</span>
                <br>

                <span class="profile-details"><?= $dob ?></span>
                <span class="profile-details"><?= $rel ?></span>
                <span class="profile-details"><?= $lan ?></span>
                <span class="profile-details"><?= $rstat ?></span>
                <span class="profile-details"><?= $bg ?></span>
                <span class="profile-details"><?= $nat ?></span>
                <span class="profile-details"><?= $addr ?></span>
                <span class="profile-details"><?= $gen ?></span>
                <span class="profile-details"><?= $pol ?></span>
                <span class="profile-details"><?= $spo ?></span>
                <span class="profile-details"><?= $hobb ?></span>

            </div>
        </div>

        <hr>

        <div class="row">
            <div class="col-6" style="text-align:right;">
                <span class="profile-details-param"><i class="fas fa-flag"></i> Report Flags : </span>
            </div>

            <div class="col-6" style="text-align:left;">
                <span class="profile-details"><?= $flags ?></span>
            </div>
        </div>

        <hr>
        <br>
        <div class="row">
            <div class="col-sm-5" style="text-align:right;">
            </div>
            <div class="col-sm-2" style="text-align:center;">
                <a class="pro-btn" href="subdir/logout.php">Log Out</a>
            </div>
            <div class="col-sm-5" style="text-align:left;">
            </div>
        </div>
        <br>


    </div>

</body>

</html>