<?php

include('include/connection.php');

session_start();

$uid = -99;

if (isset($_SESSION["logid"])) {
    $uid = $_SESSION['logid'];
} else {
    header('Location: logreg.php');
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
    function generate_card($uid)
    {
        $sql = "SELECT * FROM posts WHERE authorid = '$uid' ORDER BY id DESC";

        $res = mysqli_query($this->class_con, $sql);
        $type = "none";

        while ($class_row = mysqli_fetch_assoc($res)) {

            $shared = false;

            $this->like_color = "color: #4d4d4d;";
            $this->dis_color = "color: #4d4d4d;";

            $likes = $this->count_likes($class_row['id']);
            $dislikes = $this->count_dislikes($class_row['id']);
            $commnt_count = $this->count_comments($class_row['id']);

            $type = $class_row['category'];
            $id = $class_row['id'];
            $media_tag = 'img';
            $authorname = $this->get_authorname($class_row['authorid']);
            $time = $class_row['time'];
            $height = "auto";
            $propic_link = $this->get_author_propic($class_row['authorid']);
            $cpriv = '<i class="fas fa-globe-americas"></i> Public';

            $content = $class_row['content'];
            $media_link = $class_row['media_link'];

            $menulink = "subdir/modify_post.php?pid=" . $id;

            $priv = $class_row['privacy'];
            if ($priv == 'p') {
                $cpriv = '<i class="fas fa-user-friends"></i> Friends';
                $privacy_show = '<i class="fas fa-globe-americas"></i> Public';
            } else {
                $privacy_show = '<i class="fas fa-user-friends"></i> Friends';
            }

            if ($type == 'photo') {
                $media_tag = 'img';
            } else if ($type == 'video' || $type == 'sell') {
                $media_tag = 'iframe';
                $height = "400";
            }


            //Share check//
            if ($class_row['shared'] == 'Y') {
                $shared = true;

                echo '<div class="card-main">
    
                <a title="View User Profile" class="unformatted-link homepage-poster-name" href="view_user.php?uid=' . $class_row['authorid'] . '"><img class="profile-pic-home-post" src="' . $propic_link . '">&nbsp' . $authorname . '<p class="timestamp-home" title="Timestamp & Privacy">' . $time . ' &nbsp&nbsp&nbsp ' . $privacy_show . '</p></a>
               
               
                <div class="dropdown" style="float: right; margin-top: -60px;">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-bars"></i>
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        <li><a class="dropdown-item" href="' . $menulink . '&operation=tag"><i class="fas fa-user-tag"></i> Tag Friends</a></li>
                        <li><a class="dropdown-item" href="' . $menulink . '&operation=del"><i class="fas fa-trash-alt"></i> Delete Post</a></li>
                    </ul>
                </div>';

                ////////////////////
                $actual_id = $class_row['shared_pid'];

                $share_sql = "SELECT * FROM posts WHERE id = '$actual_id'";
                $share_res = mysqli_query($this->class_con, $share_sql);
                $share_class_row = mysqli_fetch_assoc($share_res);
                ///////////////////////


                $likes = $this->count_likes($share_class_row['id']);
                $dislikes = $this->count_dislikes($share_class_row['id']);
                $commnt_count = $this->count_comments($share_class_row['id']);

                $type = $share_class_row['category'];
                $id = $share_class_row['id'];
                $media_tag = 'img';
                $authorname = $this->get_authorname($share_class_row['authorid']);
                $time = $share_class_row['time'];
                $height = "auto";
                $propic_link = $this->get_author_propic($share_class_row['authorid']);
                $cpriv = '<i class="fas fa-globe-americas"></i> Public';

                $content = $share_class_row['content'];
                $media_link = $share_class_row['media_link'];

                $menulink = "subdir/modify_post.php?pid=" . $id;

                $priv = $share_class_row['privacy'];
                if ($priv == 'p') {
                    $cpriv = '<i class="fas fa-user-friends"></i> Friends';
                    $privacy_show = '<i class="fas fa-globe-americas"></i> Public';
                } else {
                    $privacy_show = '<i class="fas fa-user-friends"></i> Friends';
                }

                if ($type == 'photo') {
                    $media_tag = 'img';
                } else if ($type == 'video' || $type == 'sell') {
                    $media_tag = 'iframe';
                    $height = "400";
                }
            }
            //share check//


            echo '<div class="card-main">
    
            <a title="View User Profile" class="unformatted-link homepage-poster-name" href="view_user.php?uid=' . $class_row['authorid'] . '"><img class="profile-pic-home-post" src="' . $propic_link . '">&nbsp' . $authorname . '<p class="timestamp-home" title="Timestamp & Privacy">' . $time . ' &nbsp&nbsp&nbsp ' . $privacy_show . '</p></a>
            ';


            if (!$shared) {
                echo '<div class="dropdown" style="float: right; margin-top: -60px;">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-bars"></i>
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                    <li><a class="dropdown-item" href="' . $menulink . '&operation=edit"><i class="fas fa-edit"></i> Edit Post</a></li>
                    <li><a class="dropdown-item" href="' . $menulink . '&operation=cpriv">Change Privacy to ' . $cpriv . '</a></li>
                    <li><a class="dropdown-item" href="' . $menulink . '&operation=tag"><i class="fas fa-user-tag"></i> Tag Friends</a></li>
                    <li><a class="dropdown-item" href="' . $menulink . '&operation=del"><i class="fas fa-trash-alt"></i> Delete Post</a></li>
                    <li><a class="dropdown-item" href="subdir/promote_submit.php?pid=' . $class_row['id'] . '"><i class="fas fa-bullhorn"></i> Submit for Promotion</a></li>
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
            <div class="post-text">
                <span>' . $content . '</span>
            </div>';

            if ($media_link != "" || !is_null($media_link)) {
                echo '
        <div style="margin-bottom: 30px;">
            <' . $media_tag . ' src="' . $media_link . '" height="' . $height . '" width="100%" controlsList="nodownload"></' . $media_tag . '>
        </div>';
            }

            echo '<a class="unformatted-link" href="view_post.php?pid=' . $id . '" title="See More">
                <div class="card-button-see-more"><i class="fas fa-expand-alt"></i> See Post <i class="fas fa-expand-alt"></i></div>
            </a>

            <a href="subdir/post_inter.php?pid=' . $id . '&oper=like" title="Upvote">
            <div class="card-button" style="' . $this->like_color . '"><i class="fas fa-thumbs-up"></i> ' . $likes . '</div>
            </a>
            <a href="subdir/post_inter.php?pid=' . $id . '&oper=dislike" title="Downvote">
                <div class="card-button" style="' . $this->dis_color . '"><i class="fas fa-thumbs-down"></i> ' . $dislikes . '</div>
            </a>
            <a href="view_post.php?pid=' . $id . '&oper=comment" title="Comment">
                <div class="card-button"><i class="fas fa-comment-alt"></i> ' . $commnt_count . '</div>
            </a>
            <a href="subdir/post_inter.php?pid=' . $id . '&oper=share" title="Share">
                <div class="card-button"><i class="fas fa-share-square"></i></div>
            </a>

        </div>';

            //////////////////////
            if ($shared) {
                echo '</div>';
            }
            //////////////////////
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
    <title>ReachMe - Your Contents</title>
    <link rel="shortcut icon" type="image/x-icon" href="rm.ico" />



    <style>

    </style>
</head>

<body>

    <script src="assets/bootstrap/js/bootstrap.bundle.min.js"></script>

    <div style="background-color: rgb(214, 214, 214);">

        <div class="row">
            <!--Search Bar Start-->
            <div class="col-sm-12" style="text-align:center;">
                <h2><a href="index.php"><img src="files/logo/rm.png" height="50px" width="50px"></a>Your Contents</h2>
            </div>
            <!--Search Bar End-->


            <!--Home Nevigation Start-->
            <div class="col-sm-4">
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
        <div class="col-sm-3 home1 hide-in-mobile" style="overflow-y:scroll;" id="home1">
            <a href="index.php">
                <h3 style="text-align:center;">Go To Home</h3>
            </a>
            <?php

            ?>
        </div>

        <!-- Personalized Content -->
        <div class="col-sm-6" style="overflow-y:scroll;" id="home2">
            <?php
            $gen_post_list = new post_card_creation();
            $gen_post_list->get_con($con);
            $gen_post_list->generate_card($uid);
            ?>
        </div>

        <!-- Alert Type Content -->
        <div class="col-sm-3 hide-in-mobile" style="overflow-y:scroll;" id="home3">
            <a href="profile.php">
                <h3 style="text-align:center;">Go To Profile</h3>
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

    </div>
</body>

</html>