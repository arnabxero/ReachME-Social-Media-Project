<?php

include('include/connection.php');

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
    <link rel="stylesheet" href="assets/fontawesome/css/all.css">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css?v=<?php echo time(); ?>">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700&display=swap" rel="stylesheet" />
    <title>Header</title>


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

                <form method="GET" action="subdir/searchnow.php">
                    <div class="form-group" style="float:left;">
                        <div class="input-group" style="padding: 2%; margin-top:2%;">
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

                    <a type="button" class=" home-rbtn btn btn-primary btn-rounded btn-icon" href="logout.php">
                        <i class="fas fa-sign-out-alt"></i>
                    </a>
                </div>

                <div style="margin-top: 3%;">
                    <div class="btn-group">
                        <a href="profile.php" class="btn btn-secondary btn-sm home-profile-shortcut" type="button">
                            <img src="files/images/arnabxero_profile.jpg" height="20px" width="20px" style="border-radius: 50%;">
                            Iftekhar Ahmed Arnab
                        </a>
                        <button type="button" class="btn btn-sm btn-secondary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">
                            <span class="visually-hidden">Toggle Dropdown</span>
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            <li><a class="dropdown-item" href="#">Update Profile</a></li>
                            <li><a class="dropdown-item" href="#">Disable Account</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!--Profile, User Menu, Message, Logout End-->
        </div>
    </div>


    <!-- Homepage Content pane start -->
    <div class="row" style="background-color:aliceblue;">

        <!-- Promotional Content -->
        <div class="col-sm-4 home1" style="background-color: rgb(255, 231, 185); overflow-y:scroll;" id="home1">
            <?php
            for ($i = 0; $i < 20; $i++) {
                echo '<div class="card-main">';
                echo '<p>Hello World</p>';
                echo '</div>';
            }
            ?>
        </div>

        <!-- Personalized Content -->
        <div class="col-sm-4" style="overflow-y:scroll;" id="home2">


            <div class="card-main">

                <a title="View User Profile" class="unformatted-link" href="#"><img class="profile-pic-home-post" src="files/images/arnabxero_profile.jpg">&nbspIftekhar Ahmed Arnab</a>

                <div class="post-text">
                    <span>Lorem ipsum dolor sit amet consectetur adipisicing elit. Odit fuga dolore recusandae vel tenetur excepturi cum neque obcaecati Lorem ipsum dolor sit amet consectetur adipisicing elit. Odit fuga dolore recusandae vel tenetur excepturi cum neque obcaecati ipsa voluptatibus corporis, expedita ex vitae. Et voluptatum dicta sed deleniti facere?
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Odit fuga dolore recusandae vel tenetur excepturi cum neque obcaecati ipsa voluptatibus corporis, expedita ex vitae. Et voluptatum dicta sed deleniti facere?
                        ipsa voluptatibus corporis, expedita ex vitae. Et voluptatum dicta sed deleniti facere?</span>
                </div>

                <div style="margin-bottom: 30px;">
                    <img src="ext-files/photo/1.jpg" height="auto" width="100%">
                </div>

                <a class="unformatted-link" href="view_post.php" title="See More">
                    <div class="card-button-see-more"><i class="fas fa-expand-alt"></i> See More <i class="fas fa-expand-alt"></i></div>
                </a>

                <a href="like.php" title="Upvote">
                    <div class="card-button"><i class="fas fa-thumbs-up"></i></div>
                </a>
                <a href="like.php" title="Downvote">
                    <div class="card-button"><i class="fas fa-thumbs-down"></i></div>
                </a>
                <a href="like.php" title="Comment">
                    <div class="card-button"><i class="fas fa-comment"></i></div>
                </a>
                <a href="like.php" title="Share">
                    <div class="card-button"><i class="fas fa-share-square"></i></div>
                </a>

            </div>

            <div class="card-main">

                <a title="View User Profile" class="unformatted-link" href="#"><img class="profile-pic-home-post" src="files/images/arnabxero_profile.jpg">&nbspIftekhar Ahmed Arnab</a>

                <div class="post-text">
                    <span>Lorem ipsum dolor sit amet consectetur adipisicing elit. Odit fuga dolore recusandae vel tenetur excepturi cum neque obcaecati Lorem ipsum dolor sit amet consectetur adipisicing elit. Odit fuga dolore recusandae vel tenetur excepturi cum neque obcaecati ipsa voluptatibus corporis, expedita ex vitae. Et voluptatum dicta sed deleniti facere?
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Odit fuga dolore recusandae vel tenetur excepturi cum neque obcaecati ipsa voluptatibus corporis, expedita ex vitae. Et voluptatum dicta sed deleniti facere?
                        ipsa voluptatibus corporis, expedita ex vitae. Et voluptatum dicta sed deleniti facere?</span>
                </div>

                <div style="margin-bottom: 30px;">
                    <img src="ext-files/photo/1.jpg" height="auto" width="100%">
                </div>

                <a class="unformatted-link" href="view_post.php" title="See More">
                    <div class="card-button-see-more"><i class="fas fa-expand-alt"></i> See More <i class="fas fa-expand-alt"></i></div>
                </a>

                <a href="like.php" title="Upvote">
                    <div class="card-button"><i class="fas fa-thumbs-up"></i></div>
                </a>
                <a href="like.php" title="Downvote">
                    <div class="card-button"><i class="fas fa-thumbs-down"></i></div>
                </a>
                <a href="like.php" title="Comment">
                    <div class="card-button"><i class="fas fa-comment"></i></div>
                </a>
                <a href="like.php" title="Share">
                    <div class="card-button"><i class="fas fa-share-square"></i></div>
                </a>

            </div>

            <div class="card-main">

                <a title="View User Profile" class="unformatted-link" href="#"><img class="profile-pic-home-post" src="files/images/arnabxero_profile.jpg">&nbspIftekhar Ahmed Arnab</a>

                <div class="post-text">
                    <span>Lorem ipsum dolor sit amet consectetur adipisicing elit. Odit fuga dolore recusandae vel tenetur excepturi cum neque obcaecati Lorem ipsum dolor sit amet consectetur adipisicing elit. Odit fuga dolore recusandae vel tenetur excepturi cum neque obcaecati ipsa voluptatibus corporis, expedita ex vitae. Et voluptatum dicta sed deleniti facere?
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Odit fuga dolore recusandae vel tenetur excepturi cum neque obcaecati ipsa voluptatibus corporis, expedita ex vitae. Et voluptatum dicta sed deleniti facere?
                        ipsa voluptatibus corporis, expedita ex vitae. Et voluptatum dicta sed deleniti facere?</span>
                </div>

                <div style="margin-bottom: 30px;">
                    <img src="ext-files/photo/1.jpg" height="auto" width="100%">
                </div>

                <a class="unformatted-link" href="view_post.php" title="See More">
                    <div class="card-button-see-more"><i class="fas fa-expand-alt"></i> See More <i class="fas fa-expand-alt"></i></div>
                </a>

                <a href="like.php" title="Upvote">
                    <div class="card-button"><i class="fas fa-thumbs-up"></i></div>
                </a>
                <a href="like.php" title="Downvote">
                    <div class="card-button"><i class="fas fa-thumbs-down"></i></div>
                </a>
                <a href="like.php" title="Comment">
                    <div class="card-button"><i class="fas fa-comment"></i></div>
                </a>
                <a href="like.php" title="Share">
                    <div class="card-button"><i class="fas fa-share-square"></i></div>
                </a>

            </div>


        </div>

        <!-- Alert Type Content -->
        <div class="col-sm-4" style="background-color: rgb(243, 98, 98); overflow-y:scroll;" id="home3">
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Odit fuga dolore recusandae vel tenetur excepturi cum neque obcaecati ipsa voluptatibus corporis, expedita ex vitae. Et voluptatum dicta sed deleniti facere?</p>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Odit fuga dolore recusandae vel tenetur excepturi cum neque obcaecati ipsa voluptatibus corporis, expedita ex vitae. Et voluptatum dicta sed deleniti facere?</p>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Odit fuga dolore recusandae vel tenetur excepturi cum neque obcaecati ipsa voluptatibus corporis, expedita ex vitae. Et voluptatum dicta sed deleniti facere?</p>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Odit fuga dolore recusandae vel tenetur excepturi cum neque obcaecati ipsa voluptatibus corporis, expedita ex vitae. Et voluptatum dicta sed deleniti facere?</p>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Odit fuga dolore recusandae vel tenetur excepturi cum neque obcaecati ipsa voluptatibus corporis, expedita ex vitae. Et voluptatum dicta sed deleniti facere?</p>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Odit fuga dolore recusandae vel tenetur excepturi cum neque obcaecati ipsa voluptatibus corporis, expedita ex vitae. Et voluptatum dicta sed deleniti facere?</p>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Odit fuga dolore recusandae vel tenetur excepturi cum neque obcaecati ipsa voluptatibus corporis, expedita ex vitae. Et voluptatum dicta sed deleniti facere?</p>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Odit fuga dolore recusandae vel tenetur excepturi cum neque obcaecati ipsa voluptatibus corporis, expedita ex vitae. Et voluptatum dicta sed deleniti facere?</p>
        </div>




        <div class="login-dialog">
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