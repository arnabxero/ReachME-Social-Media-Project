<?php

include('include/connection.php');
session_start();

if (!isset($_SESSION['logid'])) {
    header('Location: logreg.php');
}

$username = "Guest";
$display = " ";

$own_profile_link = "logreg.php";
$loguser_propic = "ext-files/user/default.jpg";

$ulogid = -99;



function get_propic($aid)
{
    include('include/connection.php');
    $apic = "ext-files/user/default.jpg";
    $asql = "SELECT * FROM users WHERE id = '$aid'";
    $ares = mysqli_query($con, $asql);

    while ($class_arow = mysqli_fetch_assoc($ares)) {
        if (!(empty($class_arow['pro_pic']))) {
            $apic = "ext-files/user/" . $class_arow['pro_pic'];
        }
    }

    return $apic;
}


function get_uname($aid)
{
    include('include/connection.php');
    $rt_val = "Guest";
    $asql = "SELECT * FROM users WHERE id = '$aid'";
    $ares = mysqli_query($con, $asql);

    while ($class_arow = mysqli_fetch_assoc($ares)) {
        $rt_val = $class_arow['fname'] . ' ' . $class_arow['lname'];
    }

    return $rt_val;
}


if (isset($_SESSION["logid"])) {
    $display = "display:none;";
    $own_profile_link = "profile.php";
    $ulogid = $_SESSION["logid"];

    $username = get_uname($ulogid);
    $loguser_propic = get_propic($ulogid);
}

$home_type = 'all';

$all_active = '';
$text_active = '';
$photo_active = '';
$video_active = '';

if (isset($_GET['type'])) {
    $home_type = $_GET['type'];
}

if ($home_type == 'text') {
    $text_active = 'active';
} else if ($home_type == 'photo') {
    $photo_active = 'active';
} else if ($home_type == 'video') {
    $video_active = 'active';
} else if ($home_type == 'sell') {
    $sell_active = 'active';
} else {
    $all_active = 'active';
}



?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--<link rel="stylesheet" href="assets/fontawesome/css/all.css">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">-->

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="css/style.css?v=<?php echo time(); ?>">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700&display=swap" rel="stylesheet" />
    <title>ReachMe - New Post</title>
    <link rel="shortcut icon" type="image/x-icon" href="rm.ico" />


    <link href="assets/emoji/lib/css/emoji.css" rel="stylesheet">




    <style>

    </style>
</head>

<body>

    <script src="assets/bootstrap/js/bootstrap.bundle.min.js"></script>

    <div style="background-color: rgb(214, 214, 214);">

        <div class="row">
            <!--Search Bar Start-->
            <div class="col-sm-4">

                <a href="index.php">
                    <img src="files/logo/rm.png" height="50px" width="50px" style="float:left; margin-top:5px;margin-left:20px;">
                </a>
                <form method="GET" action="search.php">
                    <div class="form-group" style="float:left;">
                        <div class="input-group" style="padding: 2%; margin-top:2%;">
                            <input type="hidden" value="all" name="type" />
                            <input type="search" name="q" class="form-control" placeholder="Search..." />
                            <button type="submit" class="btn btn-primary" style="background-color: green;">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <!--Search Bar End-->


            <!--Home Nevigation Start-->
            <div class="col-sm-4">
                <div class="myTab" style="margin: 2%; text-align:center;">
                    <h1>Create New Post</h1>
                </div>
            </div>
            <!--Home Nevigation End-->


            <!--Profile, User Menu, Message, Logout Start-->
            <div class="col-sm-4 userpane">
                <div style="float:right; margin-top: 2%; margin-right: 10%;">
                    <a type="button" class=" home-rbtn btn btn-primary btn-rounded btn-icon" href="chat.php">
                        <i class="fas fa-comment"></i>
                    </a>

                    <a type="button" class=" home-rbtn btn btn-primary btn-rounded btn-icon" href="notification.php">
                        <i class="fas fa-bell"></i>
                    </a>

                    <a type="button" class=" home-rbtn btn btn-primary btn-rounded btn-icon" href="subdir/logout.php">
                        <i class="fas fa-sign-out-alt"></i>
                    </a>
                </div>

                <div style="margin-top: 3%;">
                    <div class="btn-group">
                        <a href="<?= $own_profile_link ?>" class="btn btn-secondary btn-sm home-profile-shortcut" type="button">
                            <img src="<?= $loguser_propic ?>" height="20px" width="20px" style="border-radius: 50%;">
                            <?= $username ?>
                        </a>
                        <button type="button" class="btn btn-sm btn-secondary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">
                            <span class="visually-hidden">Toggle Dropdown</span>
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            <li><a class="dropdown-item" href="edit_profile.php">Update Profile</a></li>
                            <li><a class="dropdown-item" href="delete_acc.php">Disable Account</a></li>
                            <li><a class="dropdown-item" href="subdir/logout.php">Logout Account</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!--Profile, User Menu, Message, Logout End-->
        </div>
    </div>


    <!-- Homepage Content pane start -->
    <div class="row" style="background-color:aliceblue; width: 99.9%;">

        <!-- Promotional Content -->
        <div class="col-sm-2 home1 hide-in-mobile" style="overflow-y:scroll;" id="home1">
            <a href="index.php">
                <h3 style="text-align:center;">Go To Home</h3>
            </a>

        </div>

        <!-- Personalized Content -->
        <div class="col-sm-8" style="overflow-y:scroll;" id="home2">


            <div class="card-main">



                <form class="create-post-form" method="POST" action="post_now.php">
                    <a title="View User Profile" class="unformatted-link homepage-poster-name" href="profile.php">
                        <img class="profile-pic-home-post" src="<?= $loguser_propic ?>">
                        <?= $username ?>
                        <hr><br>
                        <p class="timestamp-home" title="Timestamp & Privacy">

                        </p>
                    </a>


                    <input data-emojiable="true" data-emoji-input="unicode" type="textarea" name="content" class="text-box" 
                    placeholder="What do you want to share?..." rows="4" cols="50"/>


                    <input type="submit" name="submit" class="post-btn" value="Post Now">

                    <div class="cat-selection">
                        <label for="type">Filter Category</label><br>
                        <select id="type" name="type">
                            <option value="all">ALL TYPE</option>
                            <option value="text">TEXT</option>
                            <option value="photo">PHOTO</option>
                            <option value="video">VIDEO</option>
                            <option value="sell">SELL</option>
                        </select>
                    </div>
                </form>
            </div>



        </div>

        <!-- Alert Type Content -->
        <div class="col-sm-2 hide-in-mobile" style="overflow-y:scroll;" id="home3">
            <a href="your_contents.php">
                <h3 style="text-align:center;">Go To Your Contents</h3>
            </a>
        </div>


        <!-- For the login reg dialog box -->
        <div class="login-dialog" style="<?= $display ?>">
            <br>
            <br>
            <a class="home-dg-bt" href="login.php">Log In</a>
            <a class="home-dg-bt" href="registration.php">Sign Up</a>
        </div>




        <script>
            let h = (screen.height) - 190;
            let hh = h.toString();
            let pp = "px";

            document.getElementById("home1").style.height = hh.concat(pp);
            document.getElementById("home2").style.height = hh.concat(pp);
            document.getElementById("home3").style.height = hh.concat(pp);
        </script>

    </div>




    <script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>

    <!-- Begin emoji-picker JavaScript -->
    <script src="assets/emoji/lib/js/config.js"></script>
    <script src="assets/emoji/lib/js/util.js"></script>
    <script src="assets/emoji/lib/js/jquery.emojiarea.js"></script>
    <script src="assets/emoji/lib/js/emoji-picker.js"></script>
    <!-- End emoji-picker JavaScript -->

    <script>
        $(function() {
            // Initializes and creates emoji set from sprite sheet
            window.emojiPicker = new EmojiPicker({
                emojiable_selector: '[data-emojiable=true]',
                assetsPath: 'assets/emoji/lib/img/',
                popupButtonClasses: 'fa fa-smile-o',
                position: ''
            });
            // Finds all elements with `emojiable_selector` and converts them to rich emoji input fields
            // You may want to delay this step if you have dynamically created input fields that appear later in the loading process
            // It can be called as many times as necessary; previously converted input fields will not be converted again
            window.emojiPicker.discover();
        });
    </script>
</body>

</html>