<?php

include('../include/connection.php');

session_start();

$uid = -99;

if (isset($_SESSION["logid"])) {
    $uid = $_SESSION['logid'];
    $pid = $_GET['pid'];
    $oper = $_GET['operation'];

    $edlnk = 'Location: ../edit_post.php?pid=' . $pid;
    $dlink = 'Location: delete_post.php?pid=' . $pid;
    $tlink = 'Location: ../tag.php?pid=' . $pid;

    if ($oper == 'edit') {
        header($edlnk);
    } else if ($oper == 'del') {
        header($dlink);
    } else if ($oper == 'tag') {
        header($tlink);
    } else {
        $sql = "SELECT * FROM posts WHERE id = '$pid' AND authorid = '$uid'";

        $result = mysqli_query($con, $sql);

        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

        $count = mysqli_num_rows($result);

        if ($count == 1) {
            $priv = $row['privacy'];

            $cp = "";

            if ($priv == 'p') {
                $cp = 'f';
            } else {
                $cp = 'p';
            }

            $ssql = "UPDATE posts SET privacy = '$cp' WHERE id = '$pid' AND authorid = '$uid'";

            $rresult = mysqli_query($con, $ssql);

            if(isset($_GET['getback'])){
                header('Location: ../view_post.php?pid='.$pid.'');
            } else {
                header('Location: ../your_contents.php');
            }
        } else {
            header('Location: ../index.php');
        }
    }
} else {
    header('Location: ../logreg.php');
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
    <title>ReachMe - Modify Post</title>
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
        <div class="col-sm-3 home1" style="overflow-y:scroll;" id="home1">
            <a href="index.php">
                <h3 style="text-align:center;">Go To Home</h3>
            </a>
            <?php

            ?>
        </div>

        <!-- Personalized Content -->
        <div class="col-sm-6" style="overflow-y:scroll;" id="home2">

        </div>

        <!-- Alert Type Content -->
        <div class="col-sm-3" style="overflow-y:scroll;" id="home3">
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