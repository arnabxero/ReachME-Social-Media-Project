<?php

include('include/connection.php');

session_start();

$uid = -99;

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

    function istagged($pid, $tid){
        $rt = false;

        $tsql = "SELECT * FROM tag_list WHERE post_id = '$pid' AND tag_id = '$tid'";
        $res = mysqli_query($this->class_con, $tsql);

        $count = mysqli_num_rows($res);

        if($count>0){
            $rt = true;
        }
        return $rt;
    }

    function generate($uid)
    {
        $slq_pro = "SELECT * FROM users";
        $class_result_pro = mysqli_query($this->class_con, $slq_pro);
        while ($class_row_pro = mysqli_fetch_assoc($class_result_pro)) {

            $propicid = $class_row_pro['id'];

            $show_or_not = $this->check_friendlist($uid, $propicid);

            $propic_link_prores = $this->get_author_propic($propicid);

            $pid = -99;
            $op = "tag";
            $tg = '<i class="fas fa-tag"></i> Tag';

            if(isset($_GET['pid'])){
                $pid = $_GET['pid'];
            }

            if($this->istagged($pid, $class_row_pro['id'])){
                $tg = '<i class="fas fa-user-tag"></i> Tagged';
                $op = 'untag';
            }

            if ($show_or_not) {
                echo '<div class="card-main">
                <a title="View User Profile" class="unformatted-link homepage-poster-name" href="view_user.php?uid=' . $class_row_pro['id'] . '">
                    <img class="profile-pic-home-post" src="' . $propic_link_prores . '">
                &nbsp' . $class_row_pro['fname'] . ' ' . $class_row_pro['lname'] . '</a>

                <a class="tag-btn" href="subdir/tagadd.php?pid='.$pid.'&tid='.$class_row_pro['id'].'&op='.$op.'">'.$tg.'</a>
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
                <h2><a href="index.php"><img src="files/logo/rm.png" height="50px" width="50px"></a>Tag A Friend</h2>
            </div>
        </div>
    </div>


    <!-- Homepage Content pane start -->
    <div class="row" style="background-color:aliceblue; width: 99.9%;">

        <div class="col-sm-3 home1 hide-in-mobile" style="overflow-y:scroll;" id="home1">
            <a href="your_contents.php">
                <h3 style="text-align:center;">Go To Your Content</h3>
            </a>
        </div>

        <div class="col-sm-6" style="overflow-y:scroll;" id="home2">
            <div class="find-friend" style="text-align: center; margin-top: 10px;">
                <form id=f1 name="f1" action="" onSubmit="if(this.t1.value!=null && this.t1.value!='')findString(this.t1.value);return false">
                    <input type="text" id="t1" name="t1" value="" size=40>
                    <input type="submit" name="b1" value="Find a Friend">
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

            <?php
            $gen = new create_friendlist();
            $gen->get_con();
            $gen->generate($uid);
            ?>
        </div>

        <div class="col-sm-3 hide-in-mobile" style="overflow-y:scroll;" id="home3">
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