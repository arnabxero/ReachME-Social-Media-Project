<?php
include('include/connection.php');
session_start();

$logid = $_SESSION['logid'];
$loguname = $_SESSION['logUname'];


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

  <form name="myform" method="POST" action='submit_admin_token.php' style="text-align:center;">

    <input class="topic-box" type="text" name="topic" placeholder="Topic" required><br>

    <textarea name="msg" class="one textbox" rows="10" cols="50" placeholder="What do you want to share...?">
    </textarea>

    <input type="hidden" name="admin_id" value="<?= $logid ?>" required>

    <input type="hidden" name="admin_name" value="<?= $loguname ?>" required><br>


    <input class="accept-btn" type="submit" name="submit" value="Submit">

  </form>

</body>

</html>