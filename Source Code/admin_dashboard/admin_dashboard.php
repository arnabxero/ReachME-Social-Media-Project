<?php

session_start();
include('../include/connection.php');
include('backend.php');

$add_admin_vis = "display: none;";
$add_mod_vis = "display: none;";


if (!(isset($_SESSION['logid']) and isset($_SESSION['admin']))) {
    header('Location: ../logreg.php');
} else {
    if ($_SESSION["rank"] == 'super_admin') {
        $add_admin_vis = "";
        $add_mod_vis = "";
    } else if ($_SESSION["rank"] == 'admin') {
        $add_mod_vis = "";
    } else if ($_SESSION["rank"] == 'moderator') {
        //nothing
    }
}

$admin_opt1 = "";
$admin_opt2 = "";
$admin_opt3 = "";
$admin_opt4 = "";
$admin_opt5 = "";
$admin_opt6 = "";


$cat = "overview";

if (!isset($_GET['type'])) {
    $admin_opt1 = "active";
} else {
    if ($_GET['type'] == "overview") {
        $admin_opt1 = "active";
        $cat = "overview";
    } else if ($_GET['type'] == "pending") {
        $admin_opt2 = "active";
        $cat = "pending";
    } else if ($_GET['type'] == "user") {
        $admin_opt3 = "active";
        $cat = "user";
    } else if ($_GET['type'] == "post") {
        $admin_opt4 = "active";
        $cat = "post";
    } else if ($_GET['type'] == "admin") {
        $admin_opt5 = "active";
        $cat = "admin";
    } else if ($_GET['type'] == "extraopt") {
        $admin_opt6 = "active";
        $cat = "extraopt";
    }
}


$selected_5 = "";
$selected_10 = "";
$selected_20 = "";
$selected_100 = "";
$sz = 5;

if (isset($_GET['size'])) {
    if ($_GET['size'] == 5) {
        $selected_5 = "selected";
        $sz = 5;
    } else if ($_GET['size'] == 10) {
        $selected_10 = "selected";
        $sz = 10;
    } else if ($_GET['size'] == 20) {
        $selected_20 = "selected";
        $sz = 20;
    } else if ($_GET['size'] == 99999) {
        $selected_100 = "selected";
        $sz = 99999;
    }
}


$subtype = "";

if (isset($_GET['subtype'])) {
    $subtype = $_GET['subtype'];
} else {
    $subtype = 'op1';
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
    <title>ReachMe - Admin Panel</title>
    <link rel="shortcut icon" type="image/x-icon" href="../rm.ico" />



    <style>

    </style>
</head>

<body>

    <script src="../assets/bootstrap/js/bootstrap.bundle.min.js"></script>

    <div style="background-color: rgb(214, 214, 214);">

        <div class="row">
            <!--Search Bar Start-->
            <div class="col-sm-1">
                <a href="../index.php">
                    <img src="../files/logo/rm.png" height="50px" width="50px" style="float:left; margin-top:5px;margin-left:20px; margin-top: 25px;">
                </a>
            </div>
            <!--Search Bar End-->
            <div class="col-sm-1">

                <div class="find-friend" style="text-align: center; margin-top: 10px;">
                    <form id=f1 name="f1" action="" onSubmit="if(this.t1.value!=null && this.t1.value!='')findString(this.t1.value);return false">
                        <input type="text" id="t1" name="t1" value="" size=6 style="padding:2px; float:left; margin-left: -30px; margin-top: 20px;">
                        <input class="" style=" background-color:blueviolet; float: left; margin-top: 22px; margin-left: 0px;" type="submit" name="b1" value="Find">
                    </form>

                    <script language="JavaScript">
                        var TRange = null;

                        function findString(str) {

                            var strFound;

                            if (window.find) {
                                strFound = self.find(str);

                                if (!strFound) {
                                    strFound = self.find(str, 0, 1);
                                    while (self.find(str, 0, 1)) continue;
                                }
                            }
                            return true;
                        }
                    </script>
                </div>
            </div>


            <!--Home Nevigation Start-->
            <div class="col-sm-9">
                <div class="myTab" style="margin: 2%;">
                    <nav class="nav nav-pills nav-fill">
                        <a class="nav-link <?= $admin_opt1 ?>" href="admin_dashboard.php?type=overview&size=<?= $sz ?>">Overview</a>
                        <a class="nav-link <?= $admin_opt2 ?>" href="admin_dashboard.php?type=pending&size=<?= $sz ?>">Pending Tasks</a>
                        <a class="nav-link <?= $admin_opt3 ?>" href="admin_dashboard.php?type=user&size=<?= $sz ?>">User Management</a>
                        <a class="nav-link <?= $admin_opt4 ?>" href="admin_dashboard.php?type=post&size=<?= $sz ?>">Post Management</a>
                        <a class="nav-link <?= $admin_opt5 ?>" href="admin_dashboard.php?type=admin&size=<?= $sz ?>">Admin Roles</a>
                        <a class="nav-link <?= $admin_opt6 ?>" href="admin_dashboard.php?type=extraopt&size=<?= $sz ?>">Extra Option</a>
                    </nav>
                </div>
            </div>

            <div class="col-sm-1">
                <button style="border-radius: 5px; margin-top: 20px;" id="toggle"><i class="fas fa-cogs"> Filter</i></button>
                <div id="upl" style="display: none;">
                    <label>
                        Show Last
                        <select id="size" onchange="location = this.value;" name="example_length" aria-controls="example" class="form-select form-select-sm arnab-dropdown">
                            <option value="admin_dashboard.php?type=<?= $cat ?>&size=5&subtype=<?= $subtype ?>" <?= $selected_5 ?>>5</option>
                            <option value="admin_dashboard.php?type=<?= $cat ?>&size=10&subtype=<?= $subtype ?>" <?= $selected_10 ?>>10</option>
                            <option value="admin_dashboard.php?type=<?= $cat ?>&size=20&subtype=<?= $subtype ?>" <?= $selected_20 ?>>20</option>
                            <option value="admin_dashboard.php?type=<?= $cat ?>&size=99999&subtype=<?= $subtype ?>" <?= $selected_100 ?>>All</option>
                        </select>
                        Entries
                    </label>
                </div>
            </div>
            <!--Home Nevigation End-->





            <div class="row" style="background-color:aliceblue; width: 99.9%;">

                <!-- Section - 1 -->
                <div class="col-sm-2 home1" style="overflow-y:scroll;" id="home1">
                    <?php

                    $vertbar_obj = new admin_vertbar();

                    if (!isset($_GET['type'])) {
                        $subtype = $vertbar_obj->overview($cat, $sz, $subtype);
                    } else {
                        if ($_GET['type'] == "overview") {
                            $subtype = $vertbar_obj->overview($cat, $sz, $subtype);
                        } else if ($_GET['type'] == "pending") {
                            $subtype = $vertbar_obj->pending($cat, $sz, $subtype, $add_admin_vis, $add_mod_vis);
                        } else if ($_GET['type'] == "user") {
                            $subtype = $vertbar_obj->user($cat, $sz, $subtype);
                        } else if ($_GET['type'] == "post") {
                            $subtype = $vertbar_obj->post($cat, $sz, $subtype);
                        } else if ($_GET['type'] == "admin") {
                            $subtype = $vertbar_obj->admin($cat, $sz, $subtype, $add_admin_vis, $add_mod_vis);
                        } else if ($_GET['type'] == "extraopt") {
                            $subtype = $vertbar_obj->extra($cat, $sz, $subtype, $add_admin_vis, $add_mod_vis);
                        }
                    }
                    ?>
                </div>

                <!-- Section - 2 -->
                <div class="col-sm-10" style="overflow-y:scroll;" id="home2">
                    <?php
                    $body_obj = new admin_dash();


                    if ($cat == 'overview') {
                        //Nothing 
                    } else if ($cat == 'pending') {
                        if ($subtype == 'op1') {
                            $body_obj->create_pending_verlist($sz);
                        } else if ($subtype == 'op2') {
                            $body_obj->create_reported_postlist($sz);
                        } else if ($subtype == 'op3') {
                            $body_obj->create_promote_list($sz);
                        } else if ($subtype == 'op4') {
                            $body_obj->create_flagged_userlist($sz);
                        }
                    } else if ($cat == 'user') {
                        if ($subtype == 'op1') {
                            $body_obj->create_all_userlist($sz);
                        } else if ($subtype == 'op2') {
                            $body_obj->create_verified_userlist($sz);
                        } else if ($subtype == 'op3') {
                            $body_obj->create_nonverified_userlist($sz);
                        }
                    } else if ($cat == 'post') {
                        if ($subtype == 'op1') {
                            $body_obj->create_all_postlist($sz);
                        } else if ($subtype == 'op2') {
                            echo '<div style="text-align: center;" id="scanbox">
                                    <div class="loading-text"><div style="display: inline-block;" class="loading-text" id="ptext2">0</div>% Completed</div>

                                    <progress class="loading-bar" value="0" max="10" id="progressBar"></progress>

                                    <div class="loading-text">Scanning Posts - <div style="display: inline-block;" class="loading-text" id="ptext">X</div> Seconds Left...</div>
                                    
                                    <button onclick="start_scan()">Start Scanning</button>
                                </div>';

                            $body_obj->create_post_scanner($sz);
                        } else if ($subtype == 'op3') {
                            $body_obj->create_reported_postlist($sz);
                        }
                    } else if ($cat == 'admin') {
                        if ($subtype == 'op1' and isset($_GET['subtype'])) {
                            $body_obj->make_adminlist($sz);
                        } else if ($subtype == 'op2' and isset($_GET['subtype'])) {
                            $body_obj->make_moderatorlist($sz);
                        } else if ($subtype == 'op3') {
                            $body_obj->create_ban_list($sz);
                        } else if ($subtype == 'op4') {
                            $body_obj->create_adminlist($sz, $add_mod_vis, $add_admin_vis);
                        } else if ($subtype == 'op5') {
                            $body_obj->create_moderatorlist($sz, $add_mod_vis);
                        }
                    } else if ($cat == 'extraopt') {
                        if ($subtype == 'op1') {
                            $body_obj->create_admin_token_form($sz, $_SESSION['logid'], $_SESSION['logUname']);
                        } else if ($subtype == 'op2') {
                            $body_obj->create_admin_tokenlist($sz);
                        }
                    }


                    ?>
                </div>


                <script>
                    var timeleft = 10;

                    function start_scan() {
                        var downloadTimer = setInterval(function() {
                            if (timeleft <= 0) {
                                clearInterval(downloadTimer);
                            }
                            document.getElementById("progressBar").value = 10 - timeleft;

                            document.getElementById("ptext2").textContent = (100 - timeleft);

                            document.getElementById("ptext").textContent = timeleft / 10;

                            timeleft -= 1;

                            if ((100 - timeleft) == 100) {
                                document.getElementById('scanresult').style.display = '';
                                document.getElementById('scanbox').style.display = 'none';
                            }
                        }, 100);
                    }
                </script>

                <script>
                    let h = (screen.height) - 190;
                    let hh = h.toString();
                    let pp = "px";

                    document.getElementById("home1").style.height = hh.concat(pp);
                    document.getElementById("home2").style.height = hh.concat(pp);
                    document.getElementById("home3").style.height = hh.concat(pp);
                </script>

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

            </div>
</body>

</html>