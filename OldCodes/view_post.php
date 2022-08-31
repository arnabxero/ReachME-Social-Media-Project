<?php

include('include/connection.php');
session_start();

if (!isset($_SESSION['logid']) || !isset($_GET['pid'])) {
    header('Location: index.php');
}

$username = "Guest";
$display = " ";

$own_profile_link = "logreg.php";
$loguser_propic = "ext-files/user/default.jpg";

$ulogid = -99;
$pid = $_GET['pid'];



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


class comment_card_creation
{
    public $class_con;

    function get_con()
    {
        include('include/connection.php');
        $this->class_con = $con;
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
    function generate_card($pid)
    {
        $sql = "SELECT * FROM comments WHERE post_id = '$pid'";

        $res = mysqli_query($this->class_con, $sql);

        while ($class_row = mysqli_fetch_assoc($res)) {
            $id = $class_row['id'];
            $authorname = $this->get_authorname($class_row['authorid']);
            $time = $class_row['time'];
            $propic_link = $this->get_author_propic($class_row['authorid']);
            $menulink = "subdir/modify_comment.php?cid=" . $id . "&pid=" . $pid;


            echo '
                <div class="card-main">
                    <a title="View User Profile" class="unformatted-link homepage-poster-name" href="view_user.php?uid=
                    ' . $class_row['authorid'] . '"><img class="profile-pic-home-post" src="' . $propic_link . '">&nbsp' . $authorname . '
                    <p class="timestamp-home" title="Timestamp">' . $time . '</p></a>';


            if ($_SESSION['logid'] == $class_row['authorid']) {

                echo '
                    <div class="dropdown" style="float: right; margin-top: -60px;">
                        <button style="" class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-bars"></i>
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <li><a class="dropdown-item" href="' . $menulink . '&operation=edit"><i class="fas fa-edit"></i> Edit Comment</a></li>
                            <li><a class="dropdown-item" href="' . $menulink . '&operation=del"><i class="fas fa-trash-alt"></i> Delete Comment</a></li>
                        </ul>
                    </div>';
            }

            echo '
                <div class="post-text">
                    <span>' . $class_row['content'] . '</span>
                </div>
            </div>';
        }
    }
}


class view_post
{
    public $class_con;
    public $like_color = "color: #4d4d4d;";
    public $dis_color = "color: #4d4d4d;";

    function get_con()
    {
        include('include/connection.php');

        $this->class_con = $con;
    }

    function count_likes($post_id)
    {
        $cnt = 0;

        $sql = "SELECT * FROM votes WHERE post_id = '$post_id' AND stat = 'u'";
        $res = mysqli_query($this->class_con, $sql);

        while ($row = mysqli_fetch_assoc($res)) {
            $cnt++;
            if ($row['user_id'] == $_SESSION['logid']) {
                $this->like_color = "color: #0d6efd;";
            }
        }

        return $cnt;
    }

    function count_dislikes($post_id)
    {
        $cnt = 0;

        $sql = "SELECT * FROM votes WHERE post_id = '$post_id' AND stat = 'd'";
        $res = mysqli_query($this->class_con, $sql);

        while ($row = mysqli_fetch_assoc($res)) {
            $cnt++;
            if ($row['user_id'] == $_SESSION['logid']) {
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

    function get_authorpic($aid)
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

    function get_authorname($aid)
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

    function display_post($pid)
    {
        $this->get_con();

        include('include/connection.php');
        $sql = "SELECT * FROM posts WHERE id = '$pid'";
        $result = mysqli_query($con, $sql);
        $count = mysqli_num_rows($result);

        if ($count == 1) {
            while ($row = mysqli_fetch_assoc($result)) {

                $shared = false;
                $authorid2 = $row['authorid'];
                $time2 = $row['time'];
                $id2 = $pid;

                if ($row['shared'] == 'Y') {
                    $actual_id = $row['shared_pid'];

                    $sql = "SELECT * FROM posts WHERE id = '$actual_id'";
                    $result = mysqli_query($con, $sql);
                    $row = mysqli_fetch_assoc($result);
                    $shared = true;
                }

                $likes = $this->count_likes($row['id']);

                $dislikes = $this->count_dislikes($row['id']);

                $commnt_count = $this->count_comments($row['id']);


                $authorid = $row['authorid'];
                $authorname = $this->get_authorname($authorid);
                $authorpic = $this->get_authorpic($authorid);

                $time = $row['time'];
                $cpriv = '<i class="fas fa-user-friends"></i> Friends';
                $privacy_show = '<i class="fas fa-globe-americas"></i> Public';
                if ($row['privacy'] == 'f') {
                    $cpriv = '<i class="fas fa-globe-americas"></i> Public';
                    $privacy_show = '<i class="fas fa-user-friends"></i> Friends';
                }
                $id = $row['id'];
                $content = $row['content'];

                $media_tag = "img";
                $media_link = "";
                $height = "auto";
                $menulink = "subdir/modify_post.php?pid=" . $id . "&getback=true";

                if ($row['category'] == "video"  || $row['category'] == 'sell') {
                    $media_tag = "iframe";
                    $height = "450";
                }
                if (!($row['category'] == "text")) {
                    $media_link = $row['media_link'];
                }

                if ($shared) {

                    $authorname2 = $this->get_authorname($authorid2);
                    $authorpic2 = $this->get_authorpic($authorid2);
                    $menulink2 = "subdir/modify_post.php?pid=" . $id2 . "&getback=true";


                    echo '<div class="card-main">';

                    echo '
                <a title="View User Profile" class="unformatted-link homepage-poster-name" href="view_user.php?uid=' . $authorid2 . '"><img class="profile-pic-home-post" src="' . $authorpic2 . '">&nbsp' . $authorname2 . '<p class="timestamp-home" title="Timestamp & Privacy">' . $time2 . ' &nbsp&nbsp&nbsp ' . $privacy_show . '</p></a>';

                    if ($_SESSION['logid'] == $authorid2) {
                        echo '<div class="dropdown" style="float: right; margin-top: -60px;">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-bars"></i>
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                <li><a class="dropdown-item" href="' . $menulink2 . '&operation=tag"><i class="fas fa-user-tag"></i> Tag Friends</a></li>
                                <li><a class="dropdown-item" href="' . $menulink2 . '&operation=del"><i class="fas fa-trash-alt"></i> Delete Post</a></li>
                            </ul>
                        </div>';
                    } else {
                        echo '<div class="dropdown" style="float: right; margin-top: -60px;">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-bars"></i>
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <li><a class="dropdown-item" href="see_taglist.php?pid=' . $id2 . '"><i class="fas fa-user-tag"></i> See Tagged Users</a></li>
                            </ul>
                        </div>';
                    }
                }


                echo '<div class="card-main">';

                echo '
                <a title="View User Profile" class="unformatted-link homepage-poster-name" href="view_user.php?uid=' . $authorid . '"><img class="profile-pic-home-post" src="' . $authorpic . '">&nbsp' . $authorname . '<p class="timestamp-home" title="Timestamp & Privacy">' . $time . ' &nbsp&nbsp&nbsp ' . $privacy_show . '</p></a>';

                if ($_SESSION['logid'] == $authorid) {
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


                echo '
                <p class="post-text-view-post">' . $content . '</p>';

                if ($row['media_link'] != "" || !is_null($row['media_link'])) {
                    echo '
            <div style="margin-bottom: 30px;">
                <' . $media_tag . ' src="' . $row['media_link'] . '" height="' . $height . '" width="100%" controlsList="nodownload"></' . $media_tag . '>
            </div>';
                }

                echo '<hr>

                <a href="subdir/post_inter.php?pid=' . $row['id'] . '&oper=like" title="Upvote">
                <div class="card-button" style="' . $this->like_color . '"><i class="fas fa-thumbs-up"></i> ' . $likes . '</div>
                </a>
                <a href="subdir/post_inter.php?pid=' . $row['id'] . '&oper=dislike" title="Downvote">
                    <div class="card-button" style="' . $this->dis_color . '"><i class="fas fa-thumbs-down"></i> ' . $dislikes . '</div>
                </a>
                <a href="view_post.php?pid=' . $row['id'] . '&oper=comment" title="Comment">
                    <div class="card-button"><i class="fas fa-comment-alt"></i> ' . $commnt_count . '</div>
                </a>
                <a href="subdir/post_inter.php?pid=' . $row['id'] . '&oper=share" title="Share">
                    <div class="card-button"><i class="fas fa-share-square"></i></div>
                </a>
    

            ';
                echo '</div>';

                if ($shared) {
                    echo '</div>';
                }
            }
        } else {
            echo "<h1>Post Does Not Exists</h1>";
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
            <div class="col-4">

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
            <div class="col-4 hide-in-mobile">
                <div class="myTab" style="margin: 2%; text-align:center;">
                    <h1>View Post</h1>
                </div>
            </div>
            <!--Home Nevigation End-->


            <!--Profile, User Menu, Message, Logout Start-->
            <div class="col-4 userpane">
                <div class="hide-in-mobile" style="float:right; margin-top: 2%; margin-right: 10%;">
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
        <div class="col-sm-1 home1 hide-in-mobile" style="overflow-y:scroll;" id="home1">
            <a href="index.php">
                <h3 style="text-align:center;">Go To Home</h3>
            </a>

        </div>

        <!-- Personalized Content -->
        <div class="col-sm-7" style="overflow-y:scroll;" id="home2">
            <?php
            $obj = new view_post();
            $obj->display_post($pid);
            ?>
        </div>

        <!-- Alert Type Content -->
        <div class="col-sm-4" style="overflow-y:scroll;" id="home3">
            <h3 style="text-align:center;">Comments</h3>
            <hr>

            <form action="subdir/commentnow.php" method="POST">
                <textarea name="comment" class="one textbox" rows="3" cols="49" placeholder="What do you want to share...?"></textarea><br>
                <button type="button" class="emoji-btn"><i class="fas fa-grin"></i> Emojies <i class="fas fa-grin-beam"></i></button>
                <input type="hidden" name="pid" value="<?= $_GET['pid'] ?>">

                <button type="submit" class="commentnow" value="submit">Post Comment</button>
            </form>

            <hr>
            <?php
            $cobj = new comment_card_creation();
            $cobj->get_con();
            $cobj->generate_card($pid);
            ?>
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