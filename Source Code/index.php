<?php 

    $home_type = 'all';

    $all_active = '';
    $text_active = '';
    $photo_active = '';
    $video_active = '';

    if(isset($_GET['type'])) {
        $home_type = $_GET['type'];
    }

    if($home_type=='text'){
        $text_active = 'active';
    }
    else if($home_type=='photo'){
        $photo_active = 'active';
    }
    else if($home_type=='video'){
        $video_active = 'active';
    }
    else{
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
    <script src='assets/bootstrap/js/bootstrap.min.js'></script>
    <script src="assets/bootstrap/js/jquery.min.js"></script>
    <link rel="stylesheet" href="css/style.css?v=<?php echo time(); ?>">
    <title>Header</title>


    <style>
        

    </style>
</head>

<body>

    <div style="background-color: rgb(214, 214, 214);">

        <div class="row">
            <!--Search Bar Start-->
            <div class="col-sm-4">

            <img src="files/logo/rm.png" height="50px" width="50px" style="float:left; margin-top:5px;margin-left:20px;">

                <form method="GET" action="subdir/searchnow.php">
                    <div class="form-group" style="float:left;">
                        <div class="input-group" style="padding: 2%; margin-top:1%">
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
            <div class="col-sm-4">
                <a class="unformatted-link" href="profile.php">
                    <div class="home-profile-shortcut">
                        <img style="margin:2%; border-radius:50%; float:left;" src="files/images/arnabxero_profile.jpg" height="65%" width="10%" >
                        <label style="float:left; margin:auto;">Iftekhar Ahmed Arnab</label>
                    </div>
                </a>
            </div>
            <!--Profile, User Menu, Message, Logout End-->
        </div>
    </div>


    <div class="home-profile-shortcut">
        <img src="files/images/arnabxero_profile.jpg" height="65%" width="10%">
        <label>Arnab</label>
</div>

</body>

</html>