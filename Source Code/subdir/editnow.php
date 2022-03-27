<?php
include('../include/connection.php');
session_start();

$logid = -99;

if (isset($_SESSION['logid'])) {
    $logid = $_SESSION['logid'];
} else {
    header('Location: ../logreg.php');
}

$post_id = $_POST['post_id'];
$content = $_POST['content'];

$sql = "UPDATE posts SET content = '$content' WHERE authorid = '$logid' AND id = '$post_id'";
$res = mysqli_query($con, $sql);


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/fontawesome/css/all.css">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css?v=<?php echo time(); ?>">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700&display=swap" rel="stylesheet" />
    <title>ReachMe - Edit Post</title>
    <link rel="shortcut icon" type="image/x-icon" href="rm.ico" />


    <style>







    </style>
</head>

<body style="text-align: center;">


    <progress class="loading-bar" value="0" max="10" id="progressBar"></progress>

    <div class="loading-text">Loading - <div class="loading-text" id="ptext"></div> Seconds Left...</div>

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


<?php


if ($res) {
    $goto = 'Refresh: 3; URL=../view_post.php?pid=' . $post_id;
    header($goto);
}
?>