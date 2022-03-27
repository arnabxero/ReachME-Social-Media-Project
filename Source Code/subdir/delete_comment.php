<?php
include('../include/connection.php');
session_start();

if (!isset($_SESSION['logid'])) {
    header('Location: ../logreg.php');
}
if (!isset($_GET['cid'])) {
    header('Location: ../your_contents.php');
}

$cid = $_GET['cid'];
$pid = $_GET['pid'];

?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/fontawesome/css/all.css">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css?v=<?php echo time(); ?>">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700&display=swap" rel="stylesheet" />
    <title>Edit Comment</title>
    <link rel="shortcut icon" type="image/x-icon" href="rm.ico" />

    <style>

    </style>
</head>

<body style="text-align:center;">

    <h1 style="color:red;">COMMENT DELETE</h1>

    <h4>
        Are you sure want to delete the comment ?
    </h4>

    <?php

    if (array_key_exists('yes', $_POST)) {
        yes();
    }
    function yes()
    {
        include("../include/connection.php");
        $ctid =  $_GET['cid'];
        $ptid = $_GET['pid'];
        $user_id = $_SESSION['logid'];

        $sql2 = "DELETE FROM `comments` WHERE `id` = $ctid AND `authorid` = $user_id";
        $res2 = mysqli_query($con, $sql2);


        echo '<progress class="loading-bar" value="0" max="10" id="progressBar"></progress>

        <div class="loading-text">Loading - <div class="loading-text" id="ptext"></div> Seconds Left...</div>';

        $goto = 'Refresh: 1; URL=../view_post.php?pid=' . $ptid;
        header($goto);
    }
    ?>

    <form method="post">
        <input class="pro-btn" type="submit" name="yes" class="button" value="Yes" />
    </form>
    <br><br><a class="pro-btn" href="../view_post.php?pid=<?= $pid ?>">No</a>







    <script>
        var timeleft = 10;

        var downloadTimer = setInterval(function() {
            if (timeleft <= 0) {
                clearInterval(downloadTimer);
            }
            document.getElementById("progressBar").value = 10 - timeleft;

                document.getElementById("ptext").textContent = timeleft / 10;

            timeleft -= 1;
        }, 100);
    </script>
</body>

</html>