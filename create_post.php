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
    <title>ReachMe - New Post</title>
    <link rel="shortcut icon" type="image/x-icon" href="rm.ico" />


    <style>

    </style>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

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



                <form class="create-post-form" action="subdir/post_now.php" method="POST" enctype="multipart/form-data">
                    <a title="View User Profile" class="unformatted-link homepage-poster-name" href="profile.php">
                        <img class="profile-pic-home-post" src="<?= $loguser_propic ?>">
                        <?= $username ?>
                        <hr><br>
                    </a>

                    <textarea name="content" class="one textbox" rows="10" cols="90" placeholder="What do you want to share...?"></textarea><br>
                    <button type="button" class="emoji-btn"><i class="fas fa-grin"></i> Add Emojies <i class="fas fa-grin-beam"></i></button>

                    <hr>

                    <div class="create-post-option-panel">
                        <div class="row">
                            <div class="col-4" style="float:right;">
                                <label for="type">Select Category</label><br>
                                <select name="type" class="select-btn type">
                                    <option value="text" selected>TEXT</option>
                                    <option value="photo">PHOTO</option>
                                    <option value="video">VIDEO</option>
                                    <option value="sell">SELL</option>
                                </select>
                            </div>


                            <div class="col-4" style="float:left;">
                                <div class="hidden" id="filebox">
                                    <label>Attach A File</label>
                                    <div class="create-post-file">
                                        <input class="up-file-dp" type="file" name="image" />
                                    </div>
                                </div>

                                <script>
                                    $('.type').change(function() {
                                        var responseID = $(this).val();
                                        if (responseID == "photo" || responseID == "video" || responseID == "sell") {
                                            $('#filebox').removeClass("hidden");
                                            $('#filebox').addClass("show");
                                        } else {
                                            $('#filebox').removeClass("show");
                                            $('#filebox').addClass("hidden");
                                        }
                                        console.log(responseID);
                                    });
                                </script>
                            </div>
                            <div class="col-4" style="float:left;">
                                <label for="type">Select Privacy</label><br>
                                <select class="select-btn" id="type" name="privacy">
                                    <option value="p">Public</option>
                                    <option value="f">Friends</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <input type="submit" name="submit" class="post-btn" value="Post Now">
                    <hr>
                </form>
            </div>

        </div>

        <!-- Alert Type Content -->
        <div class="col-sm-2 hide-in-mobile" style="overflow-y:scroll;" id="home3">
            <a href="your_contents.php">
                <h3 style="text-align:center;">Go To Your Contents</h3>
            </a>
        </div>



        <script>
            let h = (screen.height) - 190;
            let hh = h.toString();
            let pp = "px";

            document.getElementById("home1").style.height = hh.concat(pp);
            document.getElementById("home2").style.height = hh.concat(pp);
            document.getElementById("home3").style.height = hh.concat(pp);
        </script>


        <script src="assets/emoji/vanillaEmojiPicker.js"></script>
        <script>
            new EmojiPicker({
                trigger: [{
                    selector: '.emoji-btn',
                    insertInto: ['.one', '.two']
                }],
                closeButton: true,
            });
        </script>

    </div>

</body>

</html>