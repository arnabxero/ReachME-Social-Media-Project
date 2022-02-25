<?php
include('include/connection.php');
session_start();


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


    function generate_result()
    {
        $class_sql = "SELECT * FROM posts WHERE content LIKE '%" . $this->class_search_string . "%' OR authorname LIKE '%" . $this->class_search_string . "%'";

        if ($this->class_type != 'all') {
            $class_sql = "SELECT * FROM posts WHERE (content LIKE '%" . $this->class_search_string . "%' AND category = '" . $this->class_type . "') OR (authorname LIKE '%" . $this->class_search_string . "%' AND category = '" . $this->class_type . "')";
        }

        $class_result = mysqli_query($this->class_con, $class_sql);

        while ($class_row = mysqli_fetch_assoc($class_result)) {
            $media_tag = 'img';

            if ($class_row['category'] == 'video') {
                $media_tag = 'iframe';
            }

            echo '<div class="card-main">
    
                    <a title="View User Profile" class="unformatted-link homepage-poster-name" href="view_user.php?uid=' . $class_row['authorid'] . '"><img class="profile-pic-home-post" src="files/images/arnabxero_profile.jpg">&nbsp' . $class_row['authorname'] . '<p class="timestamp-home" title="Timestamp">' . $class_row['time'] . '</p></a>
    
                    <div class="post-text">
                        <span>' . $class_row['content'] . '</span>
                    </div>
    
                    <div style="margin-bottom: 30px;">
                        <' . $media_tag . ' src="' . $class_row['media_link'] . '" height="auto" width="100%" controlsList="nodownload"></' . $media_tag . '>
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


    function generate_result_users()
    {
        $slq_pro = "SELECT * FROM users WHERE fname LIKE '%" . $this->class_search_string . "%' OR lname LIKE '%" . $this->class_search_string . "%'";

        $class_result_pro = mysqli_query($this->class_con, $slq_pro);

        while ($class_row_pro = mysqli_fetch_assoc($class_result_pro)) {

            echo '<div class="card-main">
                    <a title="View User Profile" class="unformatted-link homepage-poster-name" href="view_user.php?uid=' . $class_row_pro['id'] . '">
                        <img class="profile-pic-home-post" src="files/images/arnabxero_profile.jpg">
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
                <div class="form-group" style="float:left;">
                    <div class="input-group" style="padding: 2%; margin-left:300px; width: 650px;">
                        <input type="search" name="q" class="form-control" placeholder="Search..." value="<?= $search_string ?>" />
                        <button type="submit" class="btn btn-primary" style="background-color: #6c6d30;">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
                <label for="type">Filter Category</label><br>
                <select id="type" name="type">
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
        <div class="col-sm-3 home1" style="overflow-y:scroll;" id="home1">
            <h3 style="text-align:center;">Promotional</h3>
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