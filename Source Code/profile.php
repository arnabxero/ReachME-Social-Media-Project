<?php

include('include/connection.php');
session_start();

$dp_dialog = "";

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
    $id = $_SESSION['logid'];

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

        if (!(empty($row['pro_pic'])) || !is_null($row['pro_pic'])) {
            $propic = "ext-files/user/" . $row['pro_pic'];
        }


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
    }


    function push_profile_photo_string_to_db($get_id, $get_id_str)
    {
        include('include/connection.php');

        $psql = "UPDATE users SET pro_pic = '$get_id_str' WHERE id = '$get_id'";

        $res = mysqli_query($con, $psql);

        if ($res) {
            $dp_dialog = "<p style='Color: red; font-weight: bold;'>Profile Picture Upload Failed</p>";
        } else {
            $dp_dialog = "<p style='Color: red; font-weight: bold;'>Profile Picture Upload Failed</p>";
        }
    }

    if (isset($_FILES['image'])) {

        $errors = array();
        $file_name = $_FILES['image']['name'];
        $file_size = $_FILES['image']['size'];
        $file_tmp = $_FILES['image']['tmp_name'];
        $file_type = $_FILES['image']['type'];

        $new_file_name = $_SESSION['logid'] . '.jpg';

        $hold_tmp = explode('.', $_FILES['image']['name']);

        $file_ext = strtolower(end($hold_tmp));

        $extensions = array("jpeg", "jpg", "png");

        if (in_array($file_ext, $extensions) === false) {
            $errors[] = "extension not allowed, please choose a JPEG or PNG file.";
            $dp_dialog = "<p style='Color: red; font-weight: bold;'>extension not allowed, please choose a JPEG or PNG file.</p>";
        }

        if ($file_size > 2097152) {
            $errors[] = 'File size must be excately 2 MB';
            $dp_dialog = '<p style="Color: red; font-weight: bold;">File size must be excately 2 MB</p>';
        }

        if (empty($errors) == true) {
            move_uploaded_file($file_tmp, "ext-files/user/" . $new_file_name);
            $dp_dialog = "<p style='Color: green; font-weight: bold;'>Profile Picture Updated</p>";
            push_profile_photo_string_to_db($id, $new_file_name);
        } else {
            $dp_dialog = $dp_dialog . "<p style='Color: red; font-weight: bold;'>Profile Picture Upload Failed</p>";
        }
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

            <div class="col-sm-4" style="text-align: left;">
                <?= $dp_dialog ?>

                <button class="cdp-btn" id="toggle">Change DP <i class="fas fa-caret-square-down"></i></button>

                <span><a href="#"></a></span>

                <div class="cdp-form" id="upl" style="display: none;">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <input class="up-file-dp" type="file" name="image" />
                        <input class="up-file-btn" type="submit" value="Change Profile Photo" />
                    </form>
                </div>
                <br>

                <script>
                    const targetDiv = document.getElementById("upl");
                    const btn = document.getElementById("toggle");
                    btn.onclick = function() {
                        if (targetDiv.style.display !== "none") {
                            targetDiv.style.display = "none";
                        } else {
                            targetDiv.style.display = "block";
                        }
                    };
                </script>
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
                <span class="profile-details-param"><i class="fas fa-venus-mars"></i> Gender : </span>
                <span class="profile-details-param"><i class="fas fa-landmark"></i> Political View : </span>
                <span class="profile-details-param"><i class="fas fa-running"></i> Sports : </span>
                <span class="profile-details-param"><i class="fas fa-code"></i> Hobby : </span>

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
                <span class="profile-details"><?= $gen ?></span>
                <span class="profile-details"><?= $pol ?></span>
                <span class="profile-details"><?= $spo ?></span>
                <span class="profile-details"><?= $hobb ?></span>

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
                <a class="pro-btn" href="your_contents.php">Your Contents</a>
                <a class="pro-btn" href="friend_list.php">Friend List</a>
            </div>
            <div class="col-sm-2" style="text-align:center;">



                <div class="btn-group dropup">
                    <button type="button" class="btn btn-sm btn-secondary dropdown-toggle dropdown-toggle-split pro-btn-dropup" data-bs-toggle="dropdown" aria-expanded="false">
                        Update Profile
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                        <li><a class="dropdown-item" href="edit_profile.php">Edit Profile Details</a></li>
                        <li><a class="dropdown-item" href="change_email.php">Change Email Address</a></li>
                        <li><a class="dropdown-item" href="change_pass.php">Change Password</a></li>
                    </ul>
                </div>




            </div>

            <div class="col-sm-5" style="text-align:left;">
                <a class="pro-btn" href="subdir/logout.php">Log Out</a>
                <a class="pro-btn" href="delete_acc.php">Delete Account</a>
            </div>
        </div>
        <br>


    </div>

</body>

</html>