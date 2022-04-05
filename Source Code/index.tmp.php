<?php

include('include/connection.php');

$username = "Guest";
$display = " ";
$display2 = "display: none;";

$own_profile_link = "logreg.php";
$loguser_propic = "ext-files/user/default.jpg";

$ulogid = -99;

session_start();


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
    $display2 = "";
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


class post_card_creation
{
    public $class_con;
    public $like_color = "color: #4d4d4d;";
    public $dis_color = "color: #4d4d4d;";

    function get_con($con)
    {
        $this->class_con = $con;
    }

    function count_likes($post_id)
    {
        $cnt = 0;
        $lgid = -99;

        if (isset($_SESSION['logid'])) {
            $lgid = $_SESSION['logid'];
        }

        $sql = "SELECT * FROM votes WHERE post_id = '$post_id' AND stat = 'u'";
        $res = mysqli_query($this->class_con, $sql);

        while ($row = mysqli_fetch_assoc($res)) {
            $cnt++;
            if ($row['user_id'] == $lgid) {
                $this->like_color = "color: #0d6efd;";
            }
        }

        return $cnt;
    }

    function count_dislikes($post_id)
    {
        $cnt = 0;
        $lgid = -99;

        if (isset($_SESSION['logid'])) {
            $lgid = $_SESSION['logid'];
        }

        $sql = "SELECT * FROM votes WHERE post_id = '$post_id' AND stat = 'd'";
        $res = mysqli_query($this->class_con, $sql);

        while ($row = mysqli_fetch_assoc($res)) {
            $cnt++;
            if ($row['user_id'] == $lgid) {
                $this->dis_color = "color: #0d6efd;";
            }
        }

        return $cnt;
    }

    function count_comments($post_id)
    {
        $count = 0;

        $sql = "SELECT * FROM comments WHERE post_id = '$post_id'";
        $res = mysqli_query($this->class_con, $sql);
        $count = mysqli_num_rows($res);

        return $count;
    }

    function get_author_propic($aid)
    {
        $apic = "ext-files/user/default.jpg";

        $asql = "SELECT * FROM users WHERE id = '$aid'";

        $ares = mysqli_query($this->class_con, $asql);

        while ($class_arow = mysqli_fetch_assoc($ares)) {
            if (!(empty($class_arow['pro_pic']))) {
                $apic = "ext-files/user/" . $class_arow['pro_pic'];
            }
        }

        return $apic;
    }

    function get_authorname($aid)
    {
        $aname = "Undefined";

        $asql = "SELECT * FROM users WHERE id = '$aid'";

        $ares = mysqli_query($this->class_con, $asql);

        while ($class_arow = mysqli_fetch_assoc($ares)) {
            $aname = $class_arow['fname'] . " " . $class_arow['lname'];
        }

        return $aname;
    }

    //Function to check logged in user is in post author's friendlist in the case of a friends only post
    function check_friendlist($lid, $pid)
    {
        $return_value = false;

        $fsql = "SELECT * FROM friend_list WHERE sid = '$lid' AND rid = '$pid' AND stat = 'a'";
        $fresult = mysqli_query($this->class_con, $fsql);
        $fcount = mysqli_num_rows($fresult);
        if ($fcount > 0) {
            $return_value = true;
        }


        $f2sql = "SELECT * FROM friend_list WHERE sid = '$pid' AND rid = '$lid' AND stat = 'a'";
        $f2result = mysqli_query($this->class_con, $f2sql);
        $f2count = mysqli_num_rows($f2result);
        if ($f2count > 0) {
            $return_value = true;
        }

        return $return_value;
    }

    function generate_card($htype, $ulogid)
    {
        $class_logid = $ulogid;

        $class_home_type = $htype;

        $sql = "SELECT * FROM posts WHERE privacy = 'p'";

        if ($class_logid != -99) {
            $sql = "SELECT * FROM posts";
        }

        $res = mysqli_query($this->class_con, $sql);
        $type = "none";

        while ($class_row = mysqli_fetch_assoc($res)) {
            $this->like_color = "color: #4d4d4d;";
            $this->dis_color = "color: #4d4d4d;";

            $likes = $this->count_likes($class_row['id']);

            $dislikes = $this->count_dislikes($class_row['id']);

            $commnt_count = $this->count_comments($class_row['id']);


            $type = $class_row['category'];
            $id = $class_row['id'];
            $auth_id = $class_row['authorid'];
            $media_tag = 'img';
            $time = $class_row['time'];
            $privacy_show = "Undefined";
            $height = "auto";
            $propic_link = $this->get_author_propic($class_row['authorid']);

            $authorname = $this->get_authorname($class_row['authorid']);
            $show_or_not = false;

            $menulink = "subdir/modify_post.php?pid=" . $id . "&getback=true";

            $priv = $class_row['privacy'];

            $cpriv = '<i class="fas fa-globe-americas"></i> Public';

            if ($priv == 'p') {
                $privacy_show = '<i class="fas fa-globe-americas"></i> Public';
                $cpriv = '<i class="fas fa-user-friends"></i> Friends';
                $show_or_not = true;
            } else {
                $privacy_show = '<i class="fas fa-user-friends"></i> Friends';
                if ($this->check_friendlist($auth_id, $class_logid)) {
                    $show_or_not = true;
                }
            }

            if (isset($_SESSION['logid'])) {
                if ($_SESSION['logid'] == $auth_id) {
                    $show_or_not = true;
                }
            }

            if ($show_or_not == true) {


                if ($class_home_type == 'all') {
                    if ($type == 'photo') {
                        $media_tag = 'img';
                    } else if ($type == 'video' || $type == 'sell') {
                        $media_tag = 'iframe';
                        $height = "400";
                    }

                    echo '<div class="card-main">
    
                    <a title="View User Profile" class="unformatted-link homepage-poster-name" href="view_user.php?uid=' . $class_row['authorid'] . '"><img class="profile-pic-home-post" src="' . $propic_link . '">&nbsp' . $authorname . '<p class="timestamp-home" title="Timestamp & Privacy">' . $time . ' &nbsp&nbsp&nbsp ' . $privacy_show . '</p></a>';

                    if (isset($_SESSION['logid'])) {

                        if ($_SESSION['logid'] == $auth_id) {
                            echo '<div class="dropdown" style="float: right; margin-top: -60px;">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-bars"></i>
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                <li><a class="dropdown-item" href="' . $menulink . '&operation=edit"><i class="fas fa-edit"></i> Edit Post</a></li>
                                <li><a class="dropdown-item" href="' . $menulink . '&operation=cpriv">Change Privacy to ' . $cpriv . '</a></li>
                                <li><a class="dropdown-item" href="' . $menulink . '&operation=tag"><i class="fas fa-user-tag"></i> Tag Friends</a></li>
                                <li><a class="dropdown-item" href="' . $menulink . '&operation=del"><i class="fas fa-trash-alt"></i> Delete Post</a></li>
                            </ul>
                        </div>';
                        } else {
                            echo '<div class="dropdown" style="float: right; margin-top: -60px;">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-bars"></i>
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <li><a class="dropdown-item" href="see_taglist.php?pid=' . $id . '"><i class="fas fa-user-tag"></i> See Tagged Users</a></li>
                            </ul>
                        </div>';
                        }
                    }

                    echo '
                    <div class="post-text">
                        <span>' . $class_row['content'] . '</span>
                    </div>';

                    if ($class_row['media_link'] != "" || !is_null($class_row['media_link'])) {
                        echo '
                    <div style="margin-bottom: 30px;">
                        <' . $media_tag . ' src="' . $class_row['media_link'] . '" height="' . $height . '" width="100%" controlsList="nodownload"></' . $media_tag . '>
                    </div>';
                    }

                    echo '<a class="unformatted-link" href="subdir/post_inter.php?pid=' . $class_row['id'] . '&oper=view" title="See More">
                        <div class="card-button-see-more"><i class="fas fa-expand-alt"></i> See Post <i class="fas fa-expand-alt"></i></div>
                    </a>
    
                    <a href="subdir/post_inter.php?pid=' . $class_row['id'] . '&oper=like" title="Upvote">
                        <div class="card-button" style="' . $this->like_color . '"><i class="fas fa-thumbs-up"></i> ' . $likes . '</div>
                    </a>
                    <a href="subdir/post_inter.php?pid=' . $class_row['id'] . '&oper=dislike" title="Downvote">
                        <div class="card-button" style="' . $this->dis_color . '"><i class="fas fa-thumbs-down"></i> ' . $dislikes . '</div>
                    </a>
                    <a href="view_post.php?pid=' . $class_row['id'] . '&oper=comment" title="Comment">
                        <div class="card-button"><i class="fas fa-comment-alt"></i> ' . $commnt_count . '</div>
                    </a>
                    <a href="subdir/post_inter.php?pid=' . $class_row['id'] . '&oper=share" title="Share">
                        <div class="card-button"><i class="fas fa-share-square"></i></div>
                    </a>
    
                </div>';
                } else {
                    if ($type == $class_home_type) {
                        if ($type == 'photo') {
                            $media_tag = 'img';
                        } else if ($type == 'video'  || $type == 'sell') {
                            $media_tag = 'iframe';
                            $height = "400";
                        }

                        echo '<div class="card-main">
    
                        <a title="View User Profile" class="unformatted-link homepage-poster-name" href="view_user.php?uid=' . $class_row['authorid'] . '"><img class="profile-pic-home-post" src="' . $propic_link . '">&nbsp' . $authorname . '<p class="timestamp-home" title="Timestamp & Privacy">' . $time . ' &nbsp&nbsp&nbsp ' . $privacy_show . '</p></a>';
                        if (isset($_SESSION['logid'])) {

                            if ($_SESSION['logid'] == $auth_id) {
                                echo '<div class="dropdown" style="float: right; margin-top: -60px;">
                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-bars"></i>
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                    <li><a class="dropdown-item" href="' . $menulink . '&operation=edit"><i class="fas fa-edit"></i> Edit Post</a></li>
                                    <li><a class="dropdown-item" href="' . $menulink . '&operation=cpriv">Change Privacy to ' . $cpriv . '</a></li>
                                    <li><a class="dropdown-item" href="' . $menulink . '&operation=tag"><i class="fas fa-user-tag"></i> Tag Friends</a></li>
                                    <li><a class="dropdown-item" href="' . $menulink . '&operation=del"><i class="fas fa-trash-alt"></i> Delete Post</a></li>
                                </ul>
                            </div>';
                            } else {
                                echo '<div class="dropdown" style="float: right; margin-top: -60px;">
                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-bars"></i>
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                <li><a class="dropdown-item" href="see_taglist.php?pid=' . $id . '"><i class="fas fa-user-tag"></i> See Tagged Users</a></li>
                                </ul>
                            </div>';
                            }
                        }



                        echo '
                    <div class="post-text">
                        <span>' . $class_row['content'] . '</span>
                    </div>';

                        if ($class_row['media_link'] != "" || !is_null($class_row['media_link'])) {
                            echo '
                    <div style="margin-bottom: 30px;">
                        <' . $media_tag . ' src="' . $class_row['media_link'] . '" height="' . $height . '" width="100%" controlsList="nodownload"></' . $media_tag . '>
                    </div>';
                        }

                        echo '<a class="unformatted-link" href="subdir/post_inter.php?pid=' . $class_row['id'] . '&oper=view" title="See More">
                        <div class="card-button-see-more"><i class="fas fa-expand-alt"></i> See Post <i class="fas fa-expand-alt"></i></div>
                    </a>
    
                    <a href="subdir/post_inter.php?pid=' . $class_row['id'] . '&oper=like" title="Upvote">
                        <div class="card-button" style="' . $this->like_color . '"><i class="fas fa-thumbs-up"></i> ' . $likes . '</div>
                    </a>
                    <a href="subdir/post_inter.php?pid=' . $class_row['id'] . '&oper=dislike" title="Downvote">
                        <div class="card-button" style="' . $this->dis_color . '"><i class="fas fa-thumbs-down"></i> ' . $dislikes . '</div>
                    </a>
                    <a href="view_post.php?pid=' . $class_row['id'] . '&oper=comment" title="Comment">
                        <div class="card-button"><i class="fas fa-comment-alt"></i> ' . $commnt_count . '</div>
                    </a>
                    <a href="subdir/post_inter.php?pid=' . $class_row['id'] . '&oper=share" title="Share">
                        <div class="card-button"><i class="fas fa-share-square"></i></div>
                    </a>
    
                </div>';
                    }
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
                <a href="index.php">
                    <img src="files/logo/rm.png" height="50px" width="50px" style="float:left; margin-top:5px;margin-left:20px;">
                </a>
                <form method="GET" action="search.php">
                    <div class="form-group" style="float:left;">
                        <div class="input-group" style="padding: 2%; margin-top:2%;">
                            <input type="hidden" value="all" name="type" />
                            <input type="search" name="q" class="form-control hide-in-mobile" placeholder="Search..." />
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
                    <a type="button" class=" home-rbtn btn btn-primary btn-rounded btn-icon" href="chat">
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
        <div class="col-sm-3 home1 hide-in-mobile" style="overflow-y:scroll;" id="home1">
            <h3 style="text-align:center;">Promoted Content</h3>
            <hr>
            <?php
            $gen_post_list = new post_card_creation();
            $gen_post_list->get_con($con);
            $gen_post_list->generate_card('promoted', $ulogid);
            ?>
        </div>

        <!-- Personalized Content -->
        <div class="col-sm-6" style="overflow-y:scroll;" id="home2">
            <a style="text-decoration:none;" href="create_post.php">
                <div class="post-btn-home" style="<?= $display2 ?>">
                    Create A New Post
                </div>
            </a>
            <hr>
            <?php
            $gen_post_list = new post_card_creation();
            $gen_post_list->get_con($con);
            $gen_post_list->generate_card($home_type, $ulogid);
            ?>
        </div>

        <!-- Alert Type Content -->
        <div class="col-sm-3 hide-in-mobile" style="overflow-y:scroll;" id="home3">
            <h3 style="text-align:center;">Alerts</h3>
            <hr>
            <?php
            $gen_post_list = new post_card_creation();
            $gen_post_list->get_con($con);
            $gen_post_list->generate_card('alert', $ulogid);
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