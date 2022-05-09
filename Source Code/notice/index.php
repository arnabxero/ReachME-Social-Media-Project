<?php
session_start();

$logid = "-99";

if (!isset($_SESSION['logid'])) {
    header('Location: ../logreg.php');
} else {
    $logid = $_SESSION['logid'];
}


$selected_5 = "";
$selected_10 = "";
$selected_15 = "";
$selected_20 = "";
$sz = 5;

$cat_alerts = "";
$cat_blood = "";
$cat_message = "";
$cat_likes = "";
$cat_comments = "";
$cat_req = "";
$cat_tags = "";
$cat_warnings = "";

$cat = "likes";


if (isset($_GET['size'])) {
    if ($_GET['size'] == 5) {
        $selected_5 = "selected";
        $sz = 5;
    } else if ($_GET['size'] == 10) {
        $selected_10 = "selected";
        $sz = 10;
    } else if ($_GET['size'] == 15) {
        $selected_15 = "selected";
        $sz = 15;
    } else if ($_GET['size'] == 20) {
        $selected_20 = "selected";
        $sz = 20;
    }
}

if (isset($_GET['cat'])) {
    if ($_GET['cat'] == "alerts") {
        $cat_alerts = "selected";
        $cat = "alerts";
    } else if ($_GET['cat'] == "blood") {
        $cat_blood = "selected";
        $cat = "blood";
    } else if ($_GET['cat'] == "message") {
        $cat_message = "selected";
        $cat = "message";
    } else if ($_GET['cat'] == "likes") {
        $cat_likes = "selected";
        $cat = "likes";
    } else if ($_GET['cat'] == "comments") {
        $cat_comments = "selected";
        $cat = "comments";
    } else if ($_GET['cat'] == "req") {
        $cat_req = "selected";
        $cat = "req";
    } else if ($_GET['cat'] == "tags") {
        $cat_tags = "selected";
        $cat = "tags";
    } else if ($_GET['cat'] == "warnings") {
        $cat_warnings = "selected";
        $cat = "warnings";
    }
} else {
    $cat_likes = "selected";
    $cat = "likes";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/fontawesome/css/all.css">
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css?v=<?php echo time(); ?>">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700&display=swap" rel="stylesheet" />
    <title>ReachMe - Notofication</title>
    <link rel="shortcut icon" type="image/x-icon" href="../rm.ico" />



    <style>

    </style>
</head>

<body>

    <script src="../assets/bootstrap/js/bootstrap.bundle.min.js"></script>

    <div style="background-color: rgb(214, 214, 214);">

        <div class="row">

            <div class="col-4">

            </div>


            <div class="col-4" style="text-align:center;">
                <h2><a href="../index.php"><img src="../files/logo/rm.png" height="50px" width="50px"></a>All Notifications</h2>

                <button style="border-radius: 5px;" id="toggle"><i class="fas fa-cogs"> Filter</i></button>
                <div id="upl" style="display: none;">
                    <label>
                        Show Last
                        <select id="size" onchange="location = this.value;" name="example_length" aria-controls="example" class="form-select form-select-sm arnab-dropdown">
                            <option value="index.php?size=5&cat=<?= $cat ?>" <?= $selected_5 ?>>5</option>
                            <option value="index.php?size=10&cat=<?= $cat ?>" <?= $selected_10 ?>>10</option>
                            <option value="index.php?size=15&cat=<?= $cat ?>" <?= $selected_15 ?>>15</option>
                            <option value="index.php?size=20&cat=<?= $cat ?>" <?= $selected_20 ?>>20</option>
                        </select>
                        Notifications
                    </label>

                    <label>
                        Selected
                        <select id="size" onchange="location = this.value;" name="example_length" aria-controls="example" class="form-select form-select-sm arnab-dropdown">
                            <option value="index.php?size=<?= $sz ?>&cat=alerts" <?= $cat_alerts ?>>Alerts</option>
                            <option value="index.php?size=<?= $sz ?>&cat=blood" <?= $cat_blood ?>>Blood</option>
                            <option value="index.php?size=<?= $sz ?>&cat=message" <?= $cat_message ?>>Message</option>
                            <option value="index.php?size=<?= $sz ?>&cat=likes" <?= $cat_likes ?>>Likes</option>
                            <option value="index.php?size=<?= $sz ?>&cat=comments" <?= $cat_comments ?>>Comments</option>
                            <option value="index.php?size=<?= $sz ?>&cat=req" <?= $cat_req ?>>Friend Requests</option>
                            <option value="index.php?size=<?= $sz ?>&cat=tags" <?= $cat_tags ?>>Taggings</option>
                            <option value="index.php?size=<?= $sz ?>&cat=warnings" <?= $cat_warnings ?>>Warnings</option>
                        </select>
                        Category
                    </label>
                </div>
            </div>


            <div class="col-4">
            </div>

        </div>
    </div>


    <script>
        const targetDiv = document.getElementById("upl");
        const btn = document.getElementById("toggle");
        btn.onclick = function() {
            if (targetDiv.style.display !== "none") {
                targetDiv.style.display = "none";
            } else {
                targetDiv.style.display = "block";
            }
        };
    </script>

    <!-- Homepage Content pane start -->
    <div class="row" style="background-color:aliceblue; width: 99.9%;">

        <div class="col-sm-4 home1 hide-in-mobile" style="overflow-y:scroll;" id="home1">
            <h3 style="text-align:center;">Disaster Alerts</h3>
            <hr>
            <?php
            include('notification_collector.php');

            $obj = new notice_bucket();

            $obj->alert_posts($sz, $logid);

            ?>
        </div>

        <div class="col-sm-4" style="overflow-y:scroll;" id="home2">
            <h3 style="text-align:center;">Your Notifications</h3>
            <hr>
            <?php
            if (isset($_GET['cat'])) {
                if ($_GET['cat'] == "alerts") {
                    $obj->alert_posts($sz, $logid);
                } else if ($_GET['cat'] == "blood") {
                    $obj->blood_posts($sz, $logid);
                } else if ($_GET['cat'] == "message") {
                    $obj->got_text($sz, $logid);
                } else if ($_GET['cat'] == "likes") {
                    $obj->got_likes($sz, $logid);
                } else if ($_GET['cat'] == "comments") {
                    $obj->got_comments($sz, $logid);
                } else if ($_GET['cat'] == "req") {
                    $obj->got_friend_req($sz, $logid);
                } else if ($_GET['cat'] == "tags") {
                    $obj->got_tagged($sz, $logid);
                } else if ($_GET['cat'] == "warnings") {
                    $obj->warnings($sz, $logid);
                }
            } else {
                $obj->got_likes($sz, $logid);
            }
            ?>
        </div>

        <div class="col-sm-4 hide-in-mobile" style="overflow-y:scroll;" id="home3">
            <h3 style="text-align:center;">New Friend Requests</h3>
            <hr>
            <?php
            
            $obj->got_friend_req($sz, $logid);


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