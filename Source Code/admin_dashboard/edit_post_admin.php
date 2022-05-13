<?php

include('../include/connection.php');
session_start();

if (!isset($_SESSION['logid'])) {
    header('Location: ../logreg.php');
}

$username = "Guest";
$display = " ";

$own_profile_link = "../logreg.php";
$loguser_propic = "../ext-files/user/default.jpg";

$ulogid = -99;



function get_propic($aid)
{
    include('../include/connection.php');
    $apic = "../ext-files/user/default.jpg";
    $asql = "SELECT * FROM users WHERE id = '$aid'";
    $ares = mysqli_query($con, $asql);

    while ($class_arow = mysqli_fetch_assoc($ares)) {
        if (!(empty($class_arow['pro_pic']))) {
            $apic = "../ext-files/user/" . $class_arow['pro_pic'];
        }
    }

    return $apic;
}


function get_uname($aid)
{
    include('../include/connection.php');
    $rt_val = "Guest";
    $asql = "SELECT * FROM users WHERE id = '$aid'";
    $ares = mysqli_query($con, $asql);

    while ($class_arow = mysqli_fetch_assoc($ares)) {
        $rt_val = $class_arow['fname'] . ' ' . $class_arow['lname'];
    }

    return $rt_val;
}



$content = "";
$post_id = -99;

$authorid = -99;
$send_post_id = -99;

if (isset($_GET['pid'])) {
    $post_id = $_GET['pid'];
}

$sql = "SELECT * FROM posts WHERE id = '$post_id'";
$res = mysqli_query($con, $sql);

if ($res) {
    $send_post_id = $post_id;

    while ($row = mysqli_fetch_assoc($res)) {
        $content = $row['content'];
        $authorid = $row['authorid'];
    }
}


$username = get_uname($authorid);
$loguser_propic = get_propic($authorid);

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/fontawesome/css/all.css">
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css?v=<?php echo time(); ?>">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700&display=swap" rel="stylesheet" />
    <title>ReachMe - Edit Post</title>
    <link rel="shortcut icon" type="image/x-icon" href="../srm.ico" />


    <style>

    </style>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

</head>

<body>

    <script src="../assets/bootstrap/js/bootstrap.bundle.min.js"></script>

    <div style="background-color: rgb(214, 214, 214);">

        <div class="row">
            <!--Search Bar Start-->
            <div class="col-sm-4">

                <a href="index.php">
                    <img src="../files/logo/rm.png" height="50px" width="50px" style="float:left; margin-top:5px;margin-left:20px;">
                </a>
            </div>
            <!--Search Bar End-->


            <!--Home Nevigation Start-->
            <div class="col-sm-4">
                <div class="myTab" style="margin: 2%; text-align:center;">
                    <h1>Admin Post Modification</h1>
                </div>
            </div>
            <!--Home Nevigation End-->


            <!--Profile, User Menu, Message, Logout Start-->
            <div class="col-sm-4 userpane">
                
            </div>
            <!--Profile, User Menu, Message, Logout End-->
        </div>
    </div>


    <!-- Homepage Content pane start -->
    <div class="row" style="background-color:aliceblue; width: 99.9%;">

        <!-- Promotional Content -->
        <div class="col-sm-2 home1 hide-in-mobile" style="overflow-y:scroll;" id="home1">
            <a href="admin_dashboard.php?type=post&size=5&subtype=op2">
                <h3 style="text-align:center;">Go Back</h3>
            </a>

        </div>

        <!-- Personalized Content -->
        <div class="col-sm-8" style="overflow-y:scroll;" id="home2">


            <div class="card-main">



                <form class="create-post-form" action="editnow_admin.php" method="POST" enctype="multipart/form-data">
                    <a title="View User Profile" class="unformatted-link homepage-poster-name" href="profile.php">
                        <img class="profile-pic-home-post" src="<?= $loguser_propic ?>">
                        <?= $username ?>
                        <hr><br>
                    </a>

                    <input type="hidden" name="post_id" value="<?= $send_post_id ?>">

                    <textarea name="content" class="one textbox" rows="12" cols="90" placeholder="What do you want to share...?"><?= $content ?></textarea><br>
                    <button type="button" class="emoji-btn"><i class="fas fa-grin"></i> Add Emojies <i class="fas fa-grin-beam"></i></button>

                    <hr>

                    <input type="submit" name="submit" class="post-btn" value="Update">
                    <hr>
                </form>
            </div>

        </div>

        <!-- Alert Type Content -->
        <div class="col-sm-2 hide-in-mobile" style="overflow-y:scroll;" id="home3">
            <a href="../index.php">
                <h3 style="text-align:center;">Go To Home</h3>
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


        <script src="../assets/emoji/vanillaEmojiPicker.js"></script>
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