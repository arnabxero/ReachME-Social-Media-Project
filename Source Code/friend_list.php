<?php

include('include/connection.php');

session_start();

$uid = -99;
$pid = -99;

if (isset($_SESSION["logid"])) {
    $uid = $_SESSION['logid'];
} else {
    header('Location: logreg.php');
}


class create_friendlist
{
    public $class_con;

    function get_con()
    {
        include('include/connection.php');
        $this->class_con = $con;
    }

    function check_friendlist($lid, $pid)
    {
        $return_value = false;

        $fsql = "SELECT * FROM friend_list WHERE sid = '$lid' AND rid = '$pid' AND stat = 'a'";
        $fresult = mysqli_query($this->class_con, $fsql);
        $fcount = mysqli_num_rows($fresult);
        if ($fcount > 0) {
            $return_value = true;
        }


        $f2sql = "SELECT * FROM friend_list WHERE sid = '$pid' AND rid = '$lid' AND stat = 'a'";
        $f2result = mysqli_query($this->class_con, $f2sql);
        $f2count = mysqli_num_rows($f2result);
        if ($f2count > 0) {
            $return_value = true;
        }

        return $return_value;
    }

    function get_author_propic($aid)
    {
        $apic = "ext-files/user/default.jpg";

        $asql = "SELECT * FROM users WHERE id = '$aid'";

        $ares = mysqli_query($this->class_con, $asql);

        while ($class_arow = mysqli_fetch_assoc($ares)) {
            if (!(empty($class_arow['pro_pic']))) {
                $apic = "ext-files/user/" . $class_arow['pro_pic'];
            }
        }

        return $apic;
    }

    function generate($uid)
    {
        $slq_pro = "SELECT * FROM users";
        $class_result_pro = mysqli_query($this->class_con, $slq_pro);
        while ($class_row_pro = mysqli_fetch_assoc($class_result_pro)) {

            $propicid = $class_row_pro['id'];

            $show_or_not = $this->check_friendlist($uid, $propicid);

            $propic_link_prores = $this->get_author_propic($propicid);

            $dg2 = "Remove Friend?";

            if ($show_or_not) {
                echo '<div class="card-main">
                <a title="View User Profile" class="unformatted-link homepage-poster-name" href="view_user.php?uid=' . $class_row_pro['id'] . '">
                    <img class="profile-pic-home-post" src="' . $propic_link_prores . '">
                &nbsp' . $class_row_pro['fname'] . ' ' . $class_row_pro['lname'] . '</a>
                <a href="chat/chatbox.php?user_id=' . $propicid . '" style="float:right;" class="msg-btn">Message</a>
                <a onclick="if (confirm(' . $dg2 . ')){return true;}else{event.stopPropagation(); event.preventDefault();};"
                href="subdir/friendop.php?sid=' . $propicid . '&rid=' . $uid . '&op=rem&getback=friends" style="float:right;" class="cancel-btn">Unfriend</a>
                            </div>';
            }
        }
    }
}

class create_requestlist
{
    public $class_con;

    function get_con()
    {
        include('include/connection.php');
        $this->class_con = $con;
    }

    function check_friendlist($lid, $pid)
    {
        $return_value = false;

        $fsql = "SELECT * FROM friend_list WHERE rid = '$lid' AND sid = '$pid' AND stat = 'r'";
        $fresult = mysqli_query($this->class_con, $fsql);
        $fcount = mysqli_num_rows($fresult);
        if ($fcount > 0) {
            $return_value = true;
        }

        return $return_value;
    }

    function get_author_propic($aid)
    {
        $apic = "ext-files/user/default.jpg";

        $asql = "SELECT * FROM users WHERE id = '$aid'";

        $ares = mysqli_query($this->class_con, $asql);

        while ($class_arow = mysqli_fetch_assoc($ares)) {
            if (!(empty($class_arow['pro_pic']))) {
                $apic = "ext-files/user/" . $class_arow['pro_pic'];
            }
        }

        return $apic;
    }

    function generate($uid)
    {
        $slq_pro = "SELECT * FROM users";
        $class_result_pro = mysqli_query($this->class_con, $slq_pro);
        while ($class_row_pro = mysqli_fetch_assoc($class_result_pro)) {

            $propicid = $class_row_pro['id'];

            $show_or_not = $this->check_friendlist($uid, $propicid);

            $propic_link_prores = $this->get_author_propic($propicid);

            $dg1 = "'Accept Friend Request?'";
            $dg2 = "'Reject Friend Request?'";

            if ($show_or_not) {
                echo '<div class="card-main">
                <a title="View User Profile" class="unformatted-link homepage-poster-name" href="view_user.php?uid=' . $class_row_pro['id'] . '">
                    <img class="profile-pic-home-post" src="' . $propic_link_prores . '">
                &nbsp' . $class_row_pro['fname'] . ' ' . $class_row_pro['lname'] . '</a>
                <a onclick="if (confirm(' . $dg2 . ')){return true;}else{event.stopPropagation(); event.preventDefault();};"
                href="subdir/friendop.php?sid=' . $propicid . '&rid=' . $uid . '&op=reject&getback=friends" style="float:right;" class="cancel-btn">Reject</a>
                <a onclick="if (confirm(' . $dg1 . ')){return true;}else{event.stopPropagation(); event.preventDefault();};"
                 href="subdir/friendop.php?sid=' . $propicid . '&rid=' . $uid . '&op=acc&getback=friends" style="float:right;" class="accept-btn">Accept</a>
            </div>';
            }
        }
    }
}


class create_sentlist
{
    public $class_con;

    function get_con()
    {
        include('include/connection.php');
        $this->class_con = $con;
    }

    function check_friendlist($lid, $pid)
    {
        $return_value = false;

        $fsql = "SELECT * FROM friend_list WHERE sid = '$lid' AND rid = '$pid' AND stat = 'r'";
        $fresult = mysqli_query($this->class_con, $fsql);
        $fcount = mysqli_num_rows($fresult);
        if ($fcount > 0) {
            $return_value = true;
        }

        return $return_value;
    }

    function get_author_propic($aid)
    {
        $apic = "ext-files/user/default.jpg";

        $asql = "SELECT * FROM users WHERE id = '$aid'";

        $ares = mysqli_query($this->class_con, $asql);

        while ($class_arow = mysqli_fetch_assoc($ares)) {
            if (!(empty($class_arow['pro_pic']))) {
                $apic = "ext-files/user/" . $class_arow['pro_pic'];
            }
        }

        return $apic;
    }

    function generate($uid)
    {
        $slq_pro = "SELECT * FROM users";
        $class_result_pro = mysqli_query($this->class_con, $slq_pro);
        while ($class_row_pro = mysqli_fetch_assoc($class_result_pro)) {

            $propicid = $class_row_pro['id'];

            $show_or_not = $this->check_friendlist($uid, $propicid);

            $propic_link_prores = $this->get_author_propic($propicid);

            $dg2 = "Cancel Sent Request?";

            if ($show_or_not) {
                echo '<div class="card-main">
                <a title="View User Profile" class="unformatted-link homepage-poster-name" href="view_user.php?uid=' . $class_row_pro['id'] . '">
                    <img class="profile-pic-home-post" src="' . $propic_link_prores . '">
                &nbsp' . $class_row_pro['fname'] . ' ' . $class_row_pro['lname'] . '</a>
                <a onclick="if (confirm(' . $dg2 . ')){return true;}else{event.stopPropagation(); event.preventDefault();};"
                href="subdir/friendop.php?rid=' . $propicid . '&sid=' . $uid . '&op=canc&getback=friends" style="float:right;" class="cancel-btn">Cancel</a>
                            </div>';
            }
        }
    }
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
    <title>ReachMe - Friend List</title>
    <link rel="shortcut icon" type="image/x-icon" href="rm.ico" />



    <style>

    </style>
</head>

<body>

    <script src="assets/bootstrap/js/bootstrap.bundle.min.js"></script>

    <div style="background-color: rgb(214, 214, 214);">

        <div class="row">

            <div class="col-sm-12" style="text-align:center;">
                <h2><a href="index.php"><img src="files/logo/rm.png" height="50px" width="50px"></a>Your Friend List</h2>
            </div>


            <div class="col-sm-4">
            </div>


            <div class="col-sm-4 userpane">
            </div>

        </div>
    </div>


    <!-- Homepage Content pane start -->
    <div class="row" style="background-color:aliceblue; width: 99.9%;">

        <div class="col-sm-4 home1 hide-in-mobile" style="overflow-y:scroll;" id="home1">
            <h3 style="text-align:center;">Pending Requests</h3>
            <hr>
            <hr>
            <hr>
            <?php
            $gen = new create_requestlist();
            $gen->get_con();
            $gen->generate($uid);
            ?>
        </div>

        <div class="col-sm-4" style="overflow-y:scroll;" id="home2">
            <h3 style="text-align:center;">Friends</h3>

            <div class="find-friend" style="text-align: center; margin-top: 10px;">
                <form id=f1 name="f1" action="" onSubmit="if(this.t1.value!=null && this.t1.value!='')findString(this.t1.value);return false">
                    <input type="text" id="t1" name="t1" value="" size=36 style="padding:5px; float:left; margin-left: 7px;">
                    <input class="accept-btn" style="background-color:blueviolet;float:right; margin-top: 0px; margin-right: 0px;" type="submit" name="b1" value="Find a Friend">
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

            <br>
            <br>
            <hr>
            <?php
            $gen = new create_friendlist();
            $gen->get_con();
            $gen->generate($uid);
            ?>
        </div>

        <div class="col-sm-4 hide-in-mobile" style="overflow-y:scroll;" id="home3">
            <h3 style="text-align:center;">Sent Requests</h3>
            <hr>
            <hr>
            <hr>
            <?php
            $gen = new create_sentlist();
            $gen->get_con();
            $gen->generate($uid);
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