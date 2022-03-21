<?php
include('include/connection.php');
session_start();

if(!isset($_SESSION['logid'])){
    header('Location: logreg.php');
}

$pid = $_GET['pid'];
$cid = $_GET['cid'];
$uid = $_SESSION['logid'];

$comment_content = "Undefined";

$sql = "SELECT * FROM comments WHERE post_id = '$pid' AND authorid = '$uid' AND id = '$cid'";
$res = mysqli_query($con, $sql);

while($row = mysqli_fetch_assoc($res)){
    $comment_content = $row['content'];
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
    <title>Edit Comment</title>
    <link rel="shortcut icon" type="image/x-icon" href="rm.ico" />


    <style>

    </style>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

</head>

<body style="text-align:center;">

    <script src="assets/bootstrap/js/bootstrap.bundle.min.js"></script>


    <h3 style="text-align:center;">Edit Comment</h3>
    <hr>

    <form action="subdir/update_comment_now.php" method="POST">
        <textarea name="comment" class="one textbox" rows="3" cols="49" placeholder="What do you want to share...?"><?= $comment_content ?></textarea><br>
        <input type="hidden" name="pid" value="<?= $_GET['pid'] ?>">
        <input type="hidden" name="cid" value="<?= $_GET['cid'] ?>">

        <button type="submit" class="commentnow" style="margin-left: 35%;" value="submit">Update Comment</button>
        <button type="button" class="emoji-btn" style="float: left;"><i class="fas fa-grin"></i> Emojies <i class="fas fa-grin-beam"></i></button>

    </form>

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

</body>

</html>