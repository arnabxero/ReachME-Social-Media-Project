<?php

class admin_dash
{
    function get_user_details($id)
    {
        $row2 = '';
        include('../include/connection.php');

        $sql = "SELECT * FROM users WHERE id = '$id'";
        $res = mysqli_query($con, $sql);

        $row2 = mysqli_fetch_assoc($res);

        return $row2;
    }
    function create_pending_verlist($sz)
    {
        $counter = 0;

        include('../include/connection.php');

        $sql = "SELECT * FROM pending_ver ORDER BY id DESC";
        $res = mysqli_query($con, $sql);

        while ($row = mysqli_fetch_assoc($res)) {

            $row2 = $this->get_user_details($row['user_id']);
            $profile_picture_link = "../ext-files/user/" . $row2['pro_pic'];

            echo '<div class="card-main">
                    <a title="View User Profile" class="unformatted-link homepage-poster-name" href="../view_user.php?uid=' . $row['user_id'] . '">
                        <img class="profile-pic-home-post" src="' . $profile_picture_link . '">
                    &nbsp' . $row2['fname'] . ' ' . $row2['lname'] . '</a>
                    

                    <a href="accept.php?user_id=' . $row2['id'] . '" style="float:right;" class="accept-btn">Approve</a>
                    <a href="reject.php?user_id=' . $row2['id'] . '" style="float:right;" class="cancel-btn">Reject</a>
                    <a href="../view_user.php?uid=' . $row2['id'] . '" style="float:right;" class="neutral-btn">View Profile</a>

                    <a href="../ext-files/ver_file/' . $row2['id'] . '/' . $row['file_2'] . '" style="float:right;" class="neutral-btn">View FIle 2</a>
                    <a href="../ext-files/ver_file/' . $row2['id'] . '/' . $row['file_1'] . '" style="float:right;" class="neutral-btn">View File 1</a>

                </div>';

            $counter = $counter + 1;

            if ($counter == $sz) {
                break;
            }
        }
    }
    function create_all_userlist($sz)
    {
        $counter = 0;

        include('../include/connection.php');

        $sql = "SELECT * FROM users ORDER BY id DESC";
        $res = mysqli_query($con, $sql);

        while ($row = mysqli_fetch_assoc($res)) {

            $profile_picture_link = "../ext-files/user/" . $row['pro_pic'];

            echo '<div class="card-main">
                    <a title="View User Profile" class="unformatted-link homepage-poster-name" href="../view_user.php?uid=' . $row['id'] . '">
                        <img class="profile-pic-home-post" src="' . $profile_picture_link . '">
                    &nbsp' . $row['fname'] . ' ' . $row['lname'] . '</a>

                    <a href="../view_user.php?uid=' . $row['id'] . '" style="float:right;" class="neutral-btn">View Profile</a>
                </div>';

            $counter = $counter + 1;

            if ($counter == $sz) {
                break;
            }
        }
    }
    function create_verified_userlist($sz)
    {
        $counter = 0;

        include('../include/connection.php');

        $sql = "SELECT * FROM users WHERE s_verified = 'YES' ORDER BY id DESC";
        $res = mysqli_query($con, $sql);

        while ($row = mysqli_fetch_assoc($res)) {

            $profile_picture_link = "../ext-files/user/" . $row['pro_pic'];

            echo '<div class="card-main">
                    <a title="View User Profile" class="unformatted-link homepage-poster-name" href="../view_user.php?uid=' . $row['id'] . '">
                        <img class="profile-pic-home-post" src="' . $profile_picture_link . '">
                    &nbsp' . $row['fname'] . ' ' . $row['lname'] . '</a>

                    <a href="../view_user.php?uid=' . $row['id'] . '" style="float:right;" class="neutral-btn">View Profile</a>
                </div>';

            $counter = $counter + 1;

            if ($counter == $sz) {
                break;
            }
        }
    }
    function create_nonverified_userlist($sz)
    {
        $counter = 0;

        include('../include/connection.php');

        $sql = "SELECT * FROM users ORDER BY id DESC";
        $res = mysqli_query($con, $sql);

        while ($row = mysqli_fetch_assoc($res)) {
            if ($row['s_verified'] == 'YES') {
                continue;
            }

            $profile_picture_link = "../ext-files/user/" . $row['pro_pic'];

            echo '<div class="card-main">
                    <a title="View User Profile" class="unformatted-link homepage-poster-name" href="../view_user.php?uid=' . $row['id'] . '">
                        <img class="profile-pic-home-post" src="' . $profile_picture_link . '">
                    &nbsp' . $row['fname'] . ' ' . $row['lname'] . '</a>

                    <a href="../view_user.php?uid=' . $row['id'] . '" style="float:right;" class="neutral-btn">View Profile</a>
                </div>';

            $counter = $counter + 1;

            if ($counter == $sz) {
                break;
            }
        }
    }
    function create_all_postlist($sz)
    {
        $counter = 0;

        include('../include/connection.php');

        $sql = "SELECT * FROM posts ORDER BY id DESC";
        $res = mysqli_query($con, $sql);

        while ($row = mysqli_fetch_assoc($res)) {

            $content = $row['content'];
            $time = $row[''];
            
            echo '<div class="card-main">
                    <a title="View User Profile" class="unformatted-link homepage-poster-name" href="../view_post.php?pid=' . $row['id'] . '">
                        <span>' . $row['id'] . '</span>
                    </a>
                </div>';

            $counter = $counter + 1;

            if ($counter == $sz) {
                break;
            }
        }
    }
}





class admin_vertbar
{
    function overview($cat, $sz, $sub)
    {
        $opt1_act = "";
        $opt2_act = "";
        $opt3_act = "";
        $opt4_act = "";
        $subtype = "";

        if (isset($sub)) {
            if ($sub == "op1") {
                $opt1_act = "active-vbar";
                $subtype = "op1";
            } else if ($sub == "op2") {
                $opt2_act = "active-vbar";
                $subtype = "op2";
            } else if ($sub == "op3") {
                $opt3_act = "active-vbar";
                $subtype = "op3";
            } else if ($sub == "op4") {
                $opt4_act = "active-vbar";
                $subtype = "op4";
            }
        } else {
            $opt1_act = "active-vbar";
            $subtype = "op1";
        }


        echo '<a class="va" href="admin_dashboard.php?type=' . $cat . '&size=' . $sz . '&subtype=op1"><div class="vert-navbar ' . $opt1_act . '">All Graphs</div></a>';
        echo '<a class="va" href="admin_dashboard.php?type=' . $cat . '&size=' . $sz . '&subtype=op2"><div class="vert-navbar ' . $opt2_act . '">Total Users</div></a>';
        echo '<a class="va" href="admin_dashboard.php?type=' . $cat . '&size=' . $sz . '&subtype=op3"><div class="vert-navbar ' . $opt3_act . '">Total Posts</div></a>';
        echo '<a class="va" href="admin_dashboard.php?type=' . $cat . '&size=' . $sz . '&subtype=op4"><div class="vert-navbar ' . $opt4_act . '">Verified Users</div></a>';


        return $subtype;
    }
    function pending($cat, $sz, $sub)
    {
        $opt1_act = "";
        $opt2_act = "";
        $opt3_act = "";
        $opt4_act = "";
        $subtype = "";

        if (isset($sub)) {
            if ($sub == "op1") {
                $opt1_act = "active-vbar";
                $subtype = "op1";
            } else if ($sub == "op2") {
                $opt2_act = "active-vbar";
                $subtype = "op2";
            } else if ($sub == "op3") {
                $opt3_act = "active-vbar";
                $subtype = "op3";
            } else if ($sub == "op4") {
                $opt4_act = "active-vbar";
                $subtype = "op4";
            }
        } else {
            $opt1_act = "active-vbar";
            $subtype = "op1";
        }


        echo '<a class="va" href="admin_dashboard.php?type=' . $cat . '&size=' . $sz . '&subtype=op1"><div class="vert-navbar ' . $opt1_act . '">User Verification</div></a>';
        echo '<a class="va" href="admin_dashboard.php?type=' . $cat . '&size=' . $sz . '&subtype=op2"><div class="vert-navbar ' . $opt2_act . '">Reported Posts</div></a>';
        echo '<a class="va" href="admin_dashboard.php?type=' . $cat . '&size=' . $sz . '&subtype=op3"><div class="vert-navbar ' . $opt3_act . '">Reported Comments</div></a>';
        echo '<a class="va" href="admin_dashboard.php?type=' . $cat . '&size=' . $sz . '&subtype=op4"><div class="vert-navbar ' . $opt4_act . '">Reported Users</div></a>';


        return $subtype;
    }
    function user($cat, $sz, $sub)
    {
        $opt1_act = "";
        $opt2_act = "";
        $opt3_act = "";
        $subtype = "";

        if (isset($sub)) {
            if ($sub == "op1") {
                $opt1_act = "active-vbar";
                $subtype = "op1";
            } else if ($sub == "op2") {
                $opt2_act = "active-vbar";
                $subtype = "op2";
            } else if ($sub == "op3") {
                $opt3_act = "active-vbar";
                $subtype = "op3";
            }
        } else {
            $opt1_act = "active-vbar";
            $subtype = "op1";
        }


        echo '<a class="va" href="admin_dashboard.php?type=' . $cat . '&size=' . $sz . '&subtype=op1"><div class="vert-navbar ' . $opt1_act . '">All Users</div></a>';
        echo '<a class="va" href="admin_dashboard.php?type=' . $cat . '&size=' . $sz . '&subtype=op2"><div class="vert-navbar ' . $opt2_act . '">Verified Users</div></a>';
        echo '<a class="va" href="admin_dashboard.php?type=' . $cat . '&size=' . $sz . '&subtype=op3"><div class="vert-navbar ' . $opt3_act . '">Non Verified Users</div></a>';


        return $subtype;
    }
    function post($cat, $sz, $sub)
    {
        $opt1_act = "";
        $opt2_act = "";
        $opt3_act = "";
        $subtype = "";

        if (isset($sub)) {
            if ($sub == "op1") {
                $opt1_act = "active-vbar";
                $subtype = "op1";
            } else if ($sub == "op2") {
                $opt2_act = "active-vbar";
                $subtype = "op2";
            } else if ($sub == "op3") {
                $opt3_act = "active-vbar";
                $subtype = "op3";
            }
        } else {
            $opt1_act = "active-vbar";
            $subtype = "op1";
        }


        echo '<a class="va" href="admin_dashboard.php?type=' . $cat . '&size=' . $sz . '&subtype=op1"><div class="vert-navbar ' . $opt1_act . '">All Posts</div></a>';
        echo '<a class="va" href="admin_dashboard.php?type=' . $cat . '&size=' . $sz . '&subtype=op2"><div class="vert-navbar ' . $opt2_act . '">Scan Posts for Offensive Words</div></a>';
        echo '<a class="va" href="admin_dashboard.php?type=' . $cat . '&size=' . $sz . '&subtype=op3"><div class="vert-navbar ' . $opt3_act . '">Flagged Posts</div></a>';


        return $subtype;
    }
    function admin($cat, $sz, $sub)
    {
        $opt1_act = "";
        $opt2_act = "";
        $opt3_act = "";
        $opt4_act = "";
        $opt5_act = "";
        $subtype = "";

        if (isset($sub)) {
            if ($sub == "op1") {
                $opt1_act = "active-vbar";
                $subtype = "op1";
            } else if ($sub == "op2") {
                $opt2_act = "active-vbar";
                $subtype = "op2";
            } else if ($sub == "op3") {
                $opt3_act = "active-vbar";
                $subtype = "op3";
            } else if ($sub == "op4") {
                $opt4_act = "active-vbar";
                $subtype = "op4";
            } else if ($sub == "op5") {
                $opt5_act = "active-vbar";
                $subtype = "op5";
            }
        } else {
            $opt1_act = "active-vbar";
            $subtype = "op1";
        }


        echo '<a class="va" href="admin_dashboard.php?type=' . $cat . '&size=' . $sz . '&subtype=op1"><div class="vert-navbar ' . $opt1_act . '">Appoint New Admins</div></a>';
        echo '<a class="va" href="admin_dashboard.php?type=' . $cat . '&size=' . $sz . '&subtype=op2"><div class="vert-navbar ' . $opt2_act . '">Appoint New Moderators</div></a>';
        echo '<a class="va" href="admin_dashboard.php?type=' . $cat . '&size=' . $sz . '&subtype=op3"><div class="vert-navbar ' . $opt3_act . '">Appoint New Users</div></a>';
        echo '<a class="va" href="admin_dashboard.php?type=' . $cat . '&size=' . $sz . '&subtype=op4"><div class="vert-navbar ' . $opt4_act . '">All Admins</div></a>';
        echo '<a class="va" href="admin_dashboard.php?type=' . $cat . '&size=' . $sz . '&subtype=op5"><div class="vert-navbar ' . $opt5_act . '">All Moderators</div></a>';



        return $subtype;
    }
    function extra($cat, $sz, $sub)
    {
    }
}
