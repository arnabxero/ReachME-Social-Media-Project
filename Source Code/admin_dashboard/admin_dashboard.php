<?php

session_start();
include('../include/connection.php');
include('backend.php');

if (!(isset($_SESSION['logid']) and isset($_SESSION['admin']))) {
    header('Location: ../logreg.php');
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
    } else if ($_GET['size'] == 100) {
        $selected_100 = "selected";
        $sz = 100;
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


            <!--Home Nevigation Start-->
            <div class="col-sm-10">
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
                            <option value="admin_dashboard.php?type=<?= $cat ?>&size=100&subtype=<?= $subtype ?>" <?= $selected_100 ?>>100</option>
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
                            $subtype = $vertbar_obj->pending($cat, $sz, $subtype);
                        } else if ($_GET['type'] == "user") {
                            $subtype = $vertbar_obj->user($cat, $sz, $subtype);
                        } else if ($_GET['type'] == "post") {
                            $subtype = $vertbar_obj->post($cat, $sz, $subtype);
                        } else if ($_GET['type'] == "admin") {
                            $subtype = $vertbar_obj->admin($cat, $sz, $subtype);
                        } else if ($_GET['type'] == "extraopt") {
                            $subtype = $vertbar_obj->extra($cat, $sz, $subtype);
                        }
                    }
                    ?>
                </div>

                <!-- Section - 2 -->
                <div class="col-sm-10" style="overflow-y:scroll;" id="home2">
                    <?php
                    $body_obj = new admin_dash();


                    if ($cat == 'overview') {
                    } else if ($cat == 'pending') {
                        if ($subtype == 'op1') {
                            $body_obj->create_pending_verlist($sz);
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
                        }
                    }


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