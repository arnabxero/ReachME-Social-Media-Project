<?php
include('include/connection.php');
session_start();

if(!isset($_SESSION['logid'])){
    header('Location: logreg.php');
}

class post_card_creation
{
    public $class_con;

    function get_con($con)
    {
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

            $priv = $class_row['privacy'];

            if ($priv == 'p') {
                $privacy_show = '<i class="fas fa-globe-americas"></i> Public';
                $show_or_not = true;
            } else {
                $privacy_show = '<i class="fas fa-user-friends"></i> Friends';
                if ($this->check_friendlist($auth_id, $class_logid)) {
                    $show_or_not = true;
                }
            }

            if ($show_or_not == true) {


                if ($class_home_type == 'all') {
                    if ($type == 'photo') {
                        $media_tag = 'img';
                    } else if ($type == 'video') {
                        $media_tag = 'iframe';
                        $height = "400";
                    }

                    echo '<div class="card-main">
    
                    <a title="View User Profile" class="unformatted-link homepage-poster-name" href="view_user.php?uid=' . $class_row['authorid'] . '"><img class="profile-pic-home-post" src="' . $propic_link . '">&nbsp' . $authorname . '<p class="timestamp-home" title="Timestamp & Privacy">' . $time . ' &nbsp&nbsp&nbsp ' . $privacy_show . '</p></a>
    
                    <div class="dropdown" style="float: right; margin-top: -60px;">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-bars"></i>
                        </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        <li><a class="dropdown-item" href="see_taglist.php?pid=' . $id . '"><i class="fas fa-user-tag"></i> See Tagged Users</a></li>
                    </ul>
                    </div>
            
                    <div class="post-text">
                        <span>' . $class_row['content'] . '</span>
                    </div>
    
                    <div style="margin-bottom: 30px;">
                        <' . $media_tag . ' src="' . $class_row['media_link'] . '" height="' . $height . '" width="100%" controlsList="nodownload"></' . $media_tag . '>
                    </div>
    
                    <a class="unformatted-link" href="subdir/post_inter.php?pid=' . $class_row['id'] . '&oper=view" title="See More">
                        <div class="card-button-see-more"><i class="fas fa-expand-alt"></i> See More <i class="fas fa-expand-alt"></i></div>
                    </a>
    
                    <a href="subdir/post_inter.php?pid=' . $class_row['id'] . '&oper=like" title="Upvote">
                        <div class="card-button"><i class="fas fa-thumbs-up"></i></div>
                    </a>
                    <a href="subdir/post_inter.php?pid=' . $class_row['id'] . '&oper=dislike" title="Downvote">
                        <div class="card-button"><i class="fas fa-thumbs-down"></i></div>
                    </a>
                    <a href="subdir/post_inter.php?pid=' . $class_row['id'] . '&oper=comment" title="Comment">
                        <div class="card-button"><i class="fas fa-comment-alt"></i></div>
                    </a>
                    <a href="subdir/post_inter.php?pid=' . $class_row['id'] . '&oper=share" title="Share">
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
    
                        <a title="View User Profile" class="unformatted-link homepage-poster-name" href="view_user.php?uid=' . $class_row['authorid'] . '"><img class="profile-pic-home-post" src="' . $propic_link . '">&nbsp' . $authorname . '<p class="timestamp-home" title="Timestamp & Privacy">' . $time . ' &nbsp&nbsp&nbsp ' . $privacy_show . '</p></a>
                        
                        <div class="dropdown" style="float: right; margin-top: -60px;">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-bars"></i>
                        </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        <li><a class="dropdown-item" href="see_taglist.php?pid=' . $id . '"><i class="fas fa-user-tag"></i> See Tagged Users</a></li>
                    </ul>
                    </div>

                    <div class="post-text">
                        <span>' . $class_row['content'] . '</span>
                    </div>
    
                    <div style="margin-bottom: 30px;">
                        <' . $media_tag . ' src="' . $class_row['media_link'] . '" height="' . $height . '" width="100%" controlsList="nodownload"></' . $media_tag . '>
                    </div>
    
                    <a class="unformatted-link" href="subdir/post_inter.php?pid=' . $class_row['id'] . '&oper=view" title="See More">
                        <div class="card-button-see-more"><i class="fas fa-expand-alt"></i> See More <i class="fas fa-expand-alt"></i></div>
                    </a>
    
                    <a href="subdir/post_inter.php?pid=' . $class_row['id'] . '&oper=like" title="Upvote">
                        <div class="card-button"><i class="fas fa-thumbs-up"></i></div>
                    </a>
                    <a href="subdir/post_inter.php?pid=' . $class_row['id'] . '&oper=dislike" title="Downvote">
                        <div class="card-button"><i class="fas fa-thumbs-down"></i></div>
                    </a>
                    <a href="subdir/post_inter.php?pid=' . $class_row['id'] . '&oper=comment" title="Comment">
                        <div class="card-button"><i class="fas fa-comment-alt"></i></div>
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
class search_result_generation
{
    public $class_search_string;
    public $class_type = "none";
    public $class_con;

    function get_con($con)
    {
        $this->class_con = $con;
    }

    function get_string_type($s_string, $s_type)
    {
        $this->class_search_string = $s_string;
        $this->class_type = $s_type;
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

    function generate_result()
    {
        $class_sql = "SELECT * FROM posts WHERE content LIKE '%" . $this->class_search_string . "%' OR authorname LIKE '%" . $this->class_search_string . "%'";

        if ($this->class_type != 'all') {
            $class_sql = "SELECT * FROM posts WHERE (content LIKE '%" . $this->class_search_string . "%' AND category = '" . $this->class_type . "') OR (authorname LIKE '%" . $this->class_search_string . "%' AND category = '" . $this->class_type . "')";
        }

        $class_result = mysqli_query($this->class_con, $class_sql);

        while ($class_row = mysqli_fetch_assoc($class_result)) {
            $media_tag = 'img';
            $show_or_not = false;
            $auth_id = $class_row['authorid'];
            $class_logid = $_SESSION['logid'];
            $time = $class_row['time'];
            $privacy_show = "Undefined";
            $height = "auto";


            $propic_link = $this->get_author_propic($class_row['authorid']);

            $authorname = $this->get_authorname($class_row['authorid']);


            if ($class_row['category'] == 'video') {
                $media_tag = 'iframe';
                $height = '400';
            }

            if ($class_row['privacy'] == 'p') {
                $show_or_not = true;
                $privacy_show = '<i class="fas fa-globe-americas"></i> Public';
            } else {
                $privacy_show = '<i class="fas fa-user-friends"></i> Friends';
                if ($this->check_friendlist($auth_id, $class_logid)) {
                    $show_or_not = true;
                }
            }


            if ($show_or_not) {

                echo '<div class="card-main">
    
                    <a title="View User Profile" class="unformatted-link homepage-poster-name" href="view_user.php?uid=' . $class_row['authorid'] . '"><img class="profile-pic-home-post" src="' . $propic_link . '">&nbsp' . $authorname . '<p class="timestamp-home" title="Timestamp & Privacy">' . $time . ' &nbsp&nbsp&nbsp ' . $privacy_show . '</p></a>
    
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


    function generate_result_users()
    {
        $slq_pro = "SELECT * FROM users WHERE fname LIKE '%" . $this->class_search_string . "%' OR lname LIKE '%" . $this->class_search_string . "%'";

        $class_result_pro = mysqli_query($this->class_con, $slq_pro);

        while ($class_row_pro = mysqli_fetch_assoc($class_result_pro)) {

            $propicid = $class_row_pro['id'];

            $propic_link_prores = $this->get_author_propic($propicid);

            echo '<div class="card-main">
                    <a title="View User Profile" class="unformatted-link homepage-poster-name" href="view_user.php?uid=' . $class_row_pro['id'] . '">
                        <img class="profile-pic-home-post" src="' . $propic_link_prores . '">
                    &nbsp' . $class_row_pro['fname'] . ' ' . $class_row_pro['lname'] . '</a>
                </div>';
        }
    }
}


$search_string = '';
$type = 'all';

$all_active = "";
$text_active = "";
$photo_active = "";
$video_active = "";
$sell_active = "";

$search_object = new search_result_generation();
$search_object->get_con($con);

if (isset($type)) {
    $type = $_GET['type'];

    if ($type == "text") {
        $text_active = "selected";
    } else if ($type == "photo") {
        $photo_active = "selected";
    } else if ($type == "video") {
        $video_active = "selected";
    } else if ($type == "sell") {
        $sell_active = "selected";
    } else {
        $all_active = "selected";
    }
} else {
    $all_active = "selected";
}


if (isset($_GET['q'])) {
    $search_string = $_GET['q'];
}

if (isset($_SESSION["logid"])) {

    if ($search_string != '') {
        $search_object->get_string_type($search_string, $type);
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
    <title> Search - ReachMe</title>
    <link rel="shortcut icon" type="image/x-icon" href="rm.ico" />



    <style>
        .srch-panel {
            float: left;
        }

        .textbox {
            padding: 2%;
            margin-left: 300px;
            width: 650px;
        }

        @media only screen and (max-width: 600px) {
            .srch-panel {
                text-align: left;
            }
            .textbox {
               margin-left: 0px;
               width: 270px;
            }
           
        }
    </style>
</head>

<body>

    <script src="assets/bootstrap/js/bootstrap.bundle.min.js"></script>


    <div class="row" style="background-color:bisque;">
        <!--Search Bar Start-->
        <div class="col-sm-12">

            <a href="index.php">
                <img src="files/logo/rm.png" height="50px" width="50px" style="float:left; margin-top:5px;margin-left:20px;">
            </a>
            <form method="GET" action="search.php">
                <div class="form-group srch-panel">
                    <div class="input-group textbox">
                        <input type="search" name="q" class="form-control tbox" placeholder="Search..." value="<?= $search_string ?>" />
                        <button type="submit" class="btn btn-primary" style="background-color: #6c6d30;">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
                <label for="type">Filter Category</label><br>
                <select class="select-btn" id="type" name="type">
                    <option value="all" <?= $all_active ?>>ALL TYPE</option>
                    <option value="text" <?= $text_active ?>>TEXT</option>
                    <option value="photo" <?= $photo_active ?>>PHOTO</option>
                    <option value="video" <?= $video_active ?>>VIDEO</option>
                    <option value="sell" <?= $sell_active ?>>SELL</option>
                </select>
            </form>
        </div>
    </div>

    <!--Search Bar End-->



    <!-- Homepage Content pane start -->
    <div class="row" style="background-color:aliceblue;">

        <!-- Promotional Content -->
        <div class="col-sm-3 home1 hide-in-mobile" style="overflow-y:scroll;" id="home1">
            <h3 style="text-align:center;">Promotional</h3>
            <?php
            $gen_post_list = new post_card_creation();
            $gen_post_list->get_con($con);
            $gen_post_list->generate_card('promoted', $_SESSION['logid']);
            ?>
            <hr>

        </div>

        <!-- Personalized Content -->
        <div class="col-sm-6" style="overflow-y:scroll;" id="home2">
            <h3 style="text-align:center;">Search Results</h3>
            <hr>

            <?php
            $search_object->generate_result();
            ?>

        </div>

        <!-- User Profile result-->
        <div class="col-sm-3" style="overflow-y:scroll;" id="home3">
            <h3 style="text-align:center;">Profiles</h3>
            <hr>
            <?php
            $search_object->generate_result_users();
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

    </div>
</body>

</html>