<?php

include('include/connection.php');

$username = "Guest";
$display = " ";

session_start();

if (isset($_SESSION["logid"])) {
    $username = $_SESSION['logname'];
    $display = "display:none;";
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


class post_card_creation
{
    public $class_con;

    function get_con($con)
    {
        $this->class_con = $con;
    }

    function generate_card($htype)
    {
        $class_home_type = $htype;

        $sql = "SELECT * FROM posts";

        $res = mysqli_query($this->class_con, $sql);
        $type = "none";

        while ($class_row = mysqli_fetch_assoc($res)) {
            $type = $class_row['category'];
            $id = $class_row['id'];
            $media_tag = 'img';
            $authorname = $class_row['authorname'];
            $time = $class_row['time'];

            $height = "auto";

            if ($class_home_type == 'all') {
                if ($type == 'photo') {
                    $media_tag = 'img';
                } else if ($type == 'video') {
                    $media_tag = 'iframe';
                    $height = "400";
                }

                echo '<div class="card-main">
    
                    <a title="View User Profile" class="unformatted-link homepage-poster-name" href="view_user.php?uid=' . $class_row['authorid'] . '"><img class="profile-pic-home-post" src="files/images/arnabxero_profile.jpg">&nbsp' . $authorname . '<p class="timestamp-home" title="Timestamp">' . $time . '</p></a>
    
                    <div class="post-text">
                        <span>' . $class_row['content'] . '</span>
                    </div>
    
                    <div style="margin-bottom: 30px;">
                        <' . $media_tag . ' src="' . $class_row['media_link'] . '" height="'.$height.'" width="100%" controlsList="nodownload"></' . $media_tag . '>
                    </div>
    
                    <a class="unformatted-link" href="view_post.php?pid=' . $class_row['id'] . '" title="See More">
                        <div class="card-button-see-more"><i class="fas fa-expand-alt"></i> See More <i class="fas fa-expand-alt"></i></div>
                    </a>
    
                    <a href="like.php" title="Upvote">
                        <div class="card-button"><i class="fas fa-thumbs-up"></i></div>
                    </a>
                    <a href="like.php" title="Downvote">
                        <div class="card-button"><i class="fas fa-thumbs-down"></i></div>
                    </a>
                    <a href="like.php" title="Comment">
                        <div class="card-button"><i class="fas fa-comment-alt"></i></div>
                    </a>
                    <a href="like.php" title="Share">
                        <div class="card-button"><i class="fas fa-share-square"></i></div>
                    </a>
    
                </div>';
            } else {
                if ($type == $class_home_type) {
                    if ($type == 'photo') {
                        $media_tag = 'img';
                    } else if ($type == 'video') {
                        $media_tag = 'iframe';
                        $height = "400";
                    }

                    echo '<div class="card-main">
    
                    <a title="View User Profile" class="unformatted-link homepage-poster-name" href="view_user.php?uid=' . $class_row['authorid'] . '"><img class="profile-pic-home-post" src="files/images/arnabxero_profile.jpg">&nbsp' . $authorname . '<p class="timestamp-home" title="Timestamp">' . $time . '</p></a>
    
                    <div class="post-text">
                        <span>' . $class_row['content'] . '</span>
                    </div>
    
                    <div style="margin-bottom: 30px;">
                        <' . $media_tag . ' src="' . $class_row['media_link'] . '" height="'.$height.'" width="100%" controlsList="nodownload"></' . $media_tag . '>
                    </div>
    
                    <a class="unformatted-link" href="view_post.php?pid=' . $class_row['id'] . '" title="See More">
                        <div class="card-button-see-more"><i class="fas fa-expand-alt"></i> See More <i class="fas fa-expand-alt"></i></div>
                    </a>
    
                    <a href="like.php" title="Upvote">
                        <div class="card-button"><i class="fas fa-thumbs-up"></i></div>
                    </a>
                    <a href="like.php" title="Downvote">
                        <div class="card-button"><i class="fas fa-thumbs-down"></i></div>
                    </a>
                    <a href="like.php" title="Comment">
                        <div class="card-button"><i class="fas fa-comment-alt"></i></div>
                    </a>
                    <a href="like.php" title="Share">
                        <div class="card-button"><i class="fas fa-share-square"></i></div>
                    </a>
    
                </div>';
                }
            }
        }
    }
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
    <title>ReachMe - Home</title>
    <link rel="shortcut icon" type="image/x-icon" href="rm.ico" />



    <style>

    </style>
</head>

<body>

    <script src="assets/bootstrap/js/bootstrap.bundle.min.js"></script>

    <div style="background-color: rgb(214, 214, 214);">

        <div class="row">
            <!--Search Bar Start-->
            <div class="col-sm-4">

                <img src="files/logo/rm.png" height="50px" width="50px" style="float:left; margin-top:5px;margin-left:20px;">

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
                <div class="myTab" style="margin: 2%;">
                    <nav class="nav nav-pills nav-fill">
                        <a title="Home" class="nav-link <?= $all_active ?>" href="index.php?type=all"><i class="fa fa-home"></i></a>
                        <a title="Text" class="nav-link <?= $text_active ?>" href="index.php?type=text"><i class="fas fa-text-height"></i></a>
                        <a title="Photos" class="nav-link <?= $photo_active ?>" href="index.php?type=photo"><i class="fas fa-images"></i></a>
                        <a title="Videos" class="nav-link <?= $video_active ?>" href="index.php?type=video"><i class="fas fa-play-circle"></i></a>
                        <a title="Sell" class="nav-link <?= $sell_active ?>" href="index.php?type=sell"><i class="fas fa-store-alt"></i></a>
                    </nav>
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
                        <a href="profile.php" class="btn btn-secondary btn-sm home-profile-shortcut" type="button">
                            <img src="files/images/arnabxero_profile.jpg" height="20px" width="20px" style="border-radius: 50%;">
                            <?= $username ?>
                        </a>
                        <button type="button" class="btn btn-sm btn-secondary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">
                            <span class="visually-hidden">Toggle Dropdown</span>
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            <li><a class="dropdown-item" href="update_profile.php">Update Profile</a></li>
                            <li><a class="dropdown-item" href="delete_account.php">Disable Account</a></li>
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
        <div class="col-sm-3 home1" style="overflow-y:scroll;" id="home1">
            <h3 style="text-align:center;">Promoted Content</h3>
            <?php
            $gen_post_list = new post_card_creation();
            $gen_post_list->get_con($con);
            $gen_post_list->generate_card('promoted');
            ?>
        </div>

        <!-- Personalized Content -->
        <div class="col-sm-6" style="overflow-y:scroll;" id="home2">
            <?php
            $gen_post_list = new post_card_creation();
            $gen_post_list->get_con($con);
            $gen_post_list->generate_card($home_type);
            ?>
        </div>

        <!-- Alert Type Content -->
        <div class="col-sm-3" style="overflow-y:scroll;" id="home3">
            <h3 style="text-align:center;">Alerts</h3>
            <?php
            $gen_post_list = new post_card_creation();
            $gen_post_list->get_con($con);
            $gen_post_list->generate_card('alert');
            ?>
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
</body>

</html>