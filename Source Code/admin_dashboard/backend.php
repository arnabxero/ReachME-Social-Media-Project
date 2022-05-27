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
        echo '<hr><div class="row" style="margin-left:30px; text-align:center;">
                <div class="col-sm-1">
                    <strong>Index</strong>
                </div>
                <div class="col-sm-1">
                    <strong>User ID</strong>
                </div>
                <div class="col-sm-2">
                    <strong>Photo</strong>
                </div>
                <div class="col-sm-3">
                    <strong>Name</strong>
                </div>
                <div class="col-sm-3">
                    <strong>Username</strong>
                </div>
                <div class="col-sm-2">
                    <strong>View</strong>
                </div>
            </div><hr>';
        $counter = 0;

        include('../include/connection.php');

        $sql = "SELECT * FROM users ORDER BY id DESC";
        $res = mysqli_query($con, $sql);

        while ($row = mysqli_fetch_assoc($res)) {

            $profile_picture_link = "../ext-files/user/" . $row['pro_pic'];

            echo '<div class="card-main">
                    <div class="row" style="margin-left:0px; text-align:center;">
                        <div class="col-sm-1">
                            <span>' . ($counter + 1) . '</span>
                        </div>
                        <div class="col-sm-1">
                            <span>' . $row['id'] . '</span>
                        </div>
                        <div class="col-sm-2">
                            <img class="profile-pic-home-post" src="' . $profile_picture_link . '">
                        </div>
                        <div class="col-sm-3">
                            <a title="View User Profile" class="unformatted-link homepage-poster-name" href="../view_user.php?uid=' . $row['id'] . '">
                                <span>&nbsp' . $row['fname'] . ' ' . $row['lname'] . '</span>
                            </a>
                        </div>
                        <div class="col-sm-3">
                            <span>&nbsp' . $row['uname'] . '</span>
                        </div>
                        <div class="col-sm-2">
                            <a href="../view_user.php?uid=' . $row['id'] . '" style="float:right;" class="neutral-btn">View Profile</a>
                        </div>
                    </div>
                </div>';

            $counter = $counter + 1;

            if ($counter == $sz) {
                break;
            }
        }
    }

    /////////////////////////////////////////
    ////////////////// FFFFFF ///////////////
    function user_isin_flaglist($uid)
    {
        include('../include/connection.php');
        $sql = "SELECT * FROM flaglist WHERE user_id = '$uid'";
        $res = mysqli_query($con, $sql);

        if (mysqli_num_rows($res) > 0) {
            return true;
        }
        return false;
    }
    function get_flag_count($user_id)
    {
        include('../include/connection.php');
        $count = 0;
        $sql = "SELECT * FROM flaglist WHERE user_id = '$user_id'";
        $res = mysqli_query($con, $sql);
        $count = mysqli_num_rows($res);

        return $count;
    }
    function check_ban_list($user_id)
    {
        include('../include/connection.php');

        $sql = "SELECT * FROM ban_user WHERE user_id = '$user_id'";
        $res = mysqli_query($con, $sql);
        $c = mysqli_num_rows($res);

        if ($c > 0) {
            return true;
        }
        return false;
    }
    function create_flagged_userlist($sz)
    {
        echo '<hr><div class="row" style="margin-left:30px; text-align:center;">
                <div class="col-sm-1">
                    <strong>Index</strong>
                </div>
                <div class="col-sm-1">
                    <strong>User ID</strong>
                </div>
                <div class="col-sm-2">
                    <strong>Photo</strong>
                </div>
                <div class="col-sm-2">
                    <strong>Name</strong>
                </div>
                <div class="col-sm-1">
                    <strong>Username</strong>
                </div>
                <div class="col-sm-1">
                    <strong>Flags</strong>
                </div>
                <div class="col-sm-4">
                    <strong>Actions</strong>
                </div>
            </div><hr>';
        $counter = 0;

        include('../include/connection.php');

        $sql = "SELECT * FROM users ORDER BY id DESC";
        $res = mysqli_query($con, $sql);

        while ($row = mysqli_fetch_assoc($res)) {

            if ($this->user_isin_flaglist($row['id'])) {

                $num_flags = $this->get_flag_count($row['id']);
                $profile_picture_link = "../ext-files/user/" . $row['pro_pic'];

                $disp_or_not = '';

                if ($this->check_ban_list($row['id'])) {
                    $disp_or_not = 'display: none;';
                }

                echo '<div class="card-main">
                    <div class="row" style="margin-left:0px; text-align:center;">
                        <div class="col-sm-1">
                            <span>' . ($counter + 1) . '</span>
                        </div>
                        <div class="col-sm-1">
                            <span>' . $row['id'] . '</span>
                        </div>
                        <div class="col-sm-2">
                            <img class="profile-pic-home-post" src="' . $profile_picture_link . '">
                        </div>
                        <div class="col-sm-2">
                            <a title="View User Profile" class="unformatted-link homepage-poster-name" href="../view_user.php?uid=' . $row['id'] . '">
                                <span>&nbsp' . $row['fname'] . ' ' . $row['lname'] . '</span>
                            </a>
                        </div>
                        <div class="col-sm-1">
                            <span>&nbsp' . $row['uname'] . '</span>
                        </div>
                        <div class="col-sm-1">
                            <strong>' . $num_flags . '</strong>
                        </div>
                        <div class="col-sm-4">
                            <a href="../view_user.php?uid=' . $row['id'] . '" style="float:right;" class="neutral-btn">View Profile</a>
                            <a href="submit_ban.php?uid=' . $row['id'] . '" style="float:right; ' . $disp_or_not . '" class="cancel-btn">Submit For Restriction</a>
                        </div>
                    </div>
                </div>';

                $counter = $counter + 1;

                if ($counter == $sz) {
                    break;
                }
            }
        }
    }
    /////////////////////////////////
    /////////////////////////////////
    function create_verified_userlist($sz)
    {
        echo '<hr><div class="row" style="margin-left:30px; text-align:center;">
                <div class="col-sm-1">
                    <strong>Index</strong>
                </div>
                <div class="col-sm-1">
                    <strong>User ID</strong>
                </div>
                <div class="col-sm-2">
                    <strong>Photo</strong>
                </div>
                <div class="col-sm-3">
                    <strong>Name</strong>
                </div>
                <div class="col-sm-3">
                    <strong>Username</strong>
                </div>
                <div class="col-sm-2">
                    <strong>View</strong>
                </div>
            </div><hr>';
        $counter = 0;

        include('../include/connection.php');

        $sql = "SELECT * FROM users WHERE s_verified = 'YES' ORDER BY id DESC";
        $res = mysqli_query($con, $sql);

        while ($row = mysqli_fetch_assoc($res)) {

            $profile_picture_link = "../ext-files/user/" . $row['pro_pic'];

            echo '<div class="card-main">
                    <div class="row" style="margin-left:0px; text-align:center;">
                        <div class="col-sm-1">
                            <span>' . ($counter + 1) . '</span>
                        </div>
                        <div class="col-sm-1">
                            <span>' . $row['id'] . '</span>
                        </div>
                        <div class="col-sm-2">
                            <img class="profile-pic-home-post" src="' . $profile_picture_link . '">
                        </div>
                        <div class="col-sm-3">
                            <a title="View User Profile" class="unformatted-link homepage-poster-name" href="../view_user.php?uid=' . $row['id'] . '">
                                <span>&nbsp' . $row['fname'] . ' ' . $row['lname'] . '</span>
                            </a>
                        </div>
                        <div class="col-sm-3">
                            <span>&nbsp' . $row['uname'] . '</span>
                        </div>
                        <div class="col-sm-2">
                            <a href="../view_user.php?uid=' . $row['id'] . '" style="float:right;" class="neutral-btn">View Profile</a>
                        </div>
                    </div>
                </div>';
            $counter = $counter + 1;

            if ($counter == $sz) {
                break;
            }
        }
    }
    function create_nonverified_userlist($sz)
    {
        echo '<hr><div class="row" style="margin-left:30px; text-align:center;">
                <div class="col-sm-1">
                    <strong>Index</strong>
                </div>
                <div class="col-sm-1">
                    <strong>User ID</strong>
                </div>
                <div class="col-sm-2">
                    <strong>Photo</strong>
                </div>
                <div class="col-sm-3">
                    <strong>Name</strong>
                </div>
                <div class="col-sm-3">
                    <strong>Username</strong>
                </div>
                <div class="col-sm-2">
                    <strong>View</strong>
                </div>
            </div><hr>';
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
                    <div class="row" style="margin-left:0px; text-align:center;">
                        <div class="col-sm-1">
                            <span>' . ($counter + 1) . '</span>
                        </div>
                        <div class="col-sm-1">
                            <span>' . $row['id'] . '</span>
                        </div>
                        <div class="col-sm-2">
                            <img class="profile-pic-home-post" src="' . $profile_picture_link . '">
                        </div>
                        <div class="col-sm-3">
                            <a title="View User Profile" class="unformatted-link homepage-poster-name" href="../view_user.php?uid=' . $row['id'] . '">
                                <span>&nbsp' . $row['fname'] . ' ' . $row['lname'] . '</span>
                            </a>
                        </div>
                        <div class="col-sm-3">
                            <span>&nbsp' . $row['uname'] . '</span>
                        </div>
                        <div class="col-sm-2">
                            <a href="../view_user.php?uid=' . $row['id'] . '" style="float:right;" class="neutral-btn">View Profile</a>
                        </div>
                    </div>
                </div>';
            $counter = $counter + 1;

            if ($counter == $sz) {
                break;
            }
        }
    }
    function create_all_postlist($sz)
    {
        echo '<hr><div class="row" style="margin-left:30px; text-align:center;">
                <div class="col-sm-1">
                    <strong>Index</strong>
                </div>
                <div class="col-sm-1">
                    <strong>Post ID</strong>
                </div>
                <div class="col-sm-2">
                    <strong>Author</strong>
                </div>
                <div class="col-sm-1">
                    <strong>Privacy</strong>
                </div>
                <div class="col-sm-5">
                    <strong>Content</strong>
                </div>
                <div class="col-sm-2">
                    <strong>Time</strong>
                </div>
            </div><hr>';
        $counter = 0;

        include('../include/connection.php');

        $sql = "SELECT * FROM posts ORDER BY id DESC";
        $res = mysqli_query($con, $sql);

        while ($row = mysqli_fetch_assoc($res)) {

            $authorname = $this->get_user_details($row['authorid']);
            $authorname = $authorname['fname'];
            $postid = $row['id'];
            $content = $row['content'];
            $content = substr($content, 0, 80);
            $time = $row['time'];
            $privacy = $row['privacy'];
            $privicon = '<i class="fas fa-globe-americas"></i>';

            if ($privacy == 'f') {
                $privicon = '<i class="fas fa-user-friends"></i>';
            }

            echo '<a title="View User Profile" class="unformatted-link homepage-poster-name" href="../view_post.php?pid=' . $row['id'] . '">
                    <div class="card-main">
                        <div class="row" style="margin-left:0px; text-align:center;">
                            <div class="col-sm-1">
                                <span>' . ($counter + 1) . '</span>
                            </div>
                            <div class="col-sm-1">
                                <span>' . $postid . '</span>
                            </div>
                            <div class="col-sm-2">
                                <span>&nbsp' . $authorname . '</span>
                            </div>
                            <div class="col-sm-1">
                                <strong>' . $privicon . '</strong>
                            </div>
                            <div class="col-sm-5">
                                <span>' . $content . '</span>
                            </div>
                            <div class="col-sm-2">
                                <em>' . $time . '</em>
                            </div>
                        </div>
                    </div>
                </a>';

            $counter = $counter + 1;

            if ($counter == $sz) {
                break;
            }
        }
    }
    function create_post_scanner($sz)
    {
        echo '<div id="scanresult" style="display:none;"><hr><div class="row" style="margin-left:-20px; text-align:center;">
                <div class="col-sm-1">
                    <strong>Index</strong>
                </div>
                <div class="col-sm-1">
                    <strong>Post ID</strong>
                </div>
                <div class="col-sm-2">
                    <strong>Author</strong>
                </div>
                <div class="col-sm-1">
                    <strong>Privacy</strong>
                </div>
                <div class="col-sm-1">
                    <strong>Words</strong>
                </div>
                <div class="col-sm-2">
                    <strong>Content</strong>
                </div>
                <div class="col-sm-1">
                    <strong>Time</strong>
                </div>
                <div class="col-sm-3">
                    <strong>Action</strong>
                </div>
            </div><hr>';
        $counter = 0;

        $off_words = array("bad", "negative", "false", "fake");

        include('../include/connection.php');

        $sql = "SELECT * FROM posts ORDER BY id DESC";
        $res = mysqli_query($con, $sql);

        while ($row = mysqli_fetch_assoc($res)) {

            $show = false;
            $off_word_count = 0;

            for ($i = 0; $i < count($off_words); $i++) {
                if (strpos($row['content'], $off_words[$i])) {
                    $off_word_count++;
                    $show = true;
                }
            }

            if ($show) {
                $authorname = $this->get_user_details($row['authorid']);
                $authorname = $authorname['fname'];
                $postid = $row['id'];
                $content = $row['content'];
                $content = substr($content, 0, 80);
                $time = $row['time'];
                $privacy = $row['privacy'];
                $privicon = '<i class="fas fa-globe-americas"></i>';

                if ($privacy == 'f') {
                    $privicon = '<i class="fas fa-user-friends"></i>';
                }

                echo '
                    <div class="card-main">
                        <div class="row" style="margin-left:-40px; text-align:center;">
                            <div class="col-sm-1">
                                <span>' . ($counter + 1) . '</span>
                            </div>
                            <div class="col-sm-1">
                                <span>' . $postid . '</span>
                            </div>
                            <div class="col-sm-2">
                                <strong>&nbsp' . $authorname . '</strong>
                            </div>
                            <div class="col-sm-1">
                                <strong>' . $privicon . '</strong>
                            </div>
                            <div class="col-sm-1">
                                <strong>' . $off_word_count . '</strong>
                            </div>
                            <div class="col-sm-2">
                                <span>' . $content . '</span>
                            </div>
                            <div class="col-sm-1">
                                <em>' . $time . '</em>
                            </div>
                            <div class="col-sm-3">
                                <a target="_blank" class="unformatted-link cancel-btn" href="edit_post_admin.php?pid=' . $row['id'] . '">
                                    Edit
                                </a>
                                <a target="_blank" class="unformatted-link cancel-btn" href="deletepost_admin.php?pid=' . $row['id'] . '">
                                    Delete
                                </a>     
                                <a target="_blank" class="unformatted-link accept-btn" href="../view_post.php?pid=' . $row['id'] . '">
                                    View
                                </a>   
                            </div>
                        </div>
                    </div>
                </a>';

                $counter = $counter + 1;

                if ($counter == $sz) {
                    break;
                }
            }
        }
        echo '</div>';
    }
    function check_flaglist($pid)
    {
        include('../include/connection.php');

        $sql = "SELECT * FROM flaglist WHERE post_id = '$pid'";
        $res = mysqli_query($con, $sql);

        if (mysqli_num_rows($res) > 0) {
            return true;
        }
        return false;
    }
    function create_reported_postlist($sz)
    {
        echo '<div><hr><div class="row" style="margin-left:-20px; text-align:center;">
                <div class="col-sm-1">
                    <strong>Index</strong>
                </div>
                <div class="col-sm-1">
                    <strong>Post ID</strong>
                </div>
                <div class="col-sm-2">
                    <strong>Author</strong>
                </div>
                <div class="col-sm-1">
                    <strong>Privacy</strong>
                </div>
                <div class="col-sm-2">
                    <strong>Content</strong>
                </div>
                <div class="col-sm-2">
                    <strong>Time</strong>
                </div>
                <div class="col-sm-3">
                    <strong>Action</strong>
                </div>
            </div><hr>';
        $counter = 0;


        include('../include/connection.php');

        $sql = "SELECT * FROM posts WHERE report = 'Report' ORDER BY id DESC";
        $res = mysqli_query($con, $sql);

        while ($row = mysqli_fetch_assoc($res)) {

            $flag_user_vis = "";

            if ($this->check_flaglist($row['id'])) {
                $flag_user_vis = "display: none;";
            }

            $authorname = $this->get_user_details($row['authorid']);
            $authorname = $authorname['fname'];
            $postid = $row['id'];
            $content = $row['content'];
            $content = substr($content, 0, 80);
            $time = $row['time'];
            $privacy = $row['privacy'];
            $privicon = '<i class="fas fa-globe-americas"></i>';

            if ($privacy == 'f') {
                $privicon = '<i class="fas fa-user-friends"></i>';
            }

            echo '
                    <div class="card-main">
                        <div class="row" style="margin-left:-40px; text-align:center;">
                            <div class="col-sm-1">
                                <span>' . ($counter + 1) . '</span>
                            </div>
                            <div class="col-sm-1">
                                <span>' . $postid . '</span>
                            </div>
                            <div class="col-sm-1">
                                <strong>&nbsp' . $authorname . '</strong>
                            </div>
                            <div class="col-sm-1">
                                <strong>' . $privicon . '</strong>
                            </div>
                            <div class="col-sm-2">
                                <span>' . $content . '</span>
                            </div>
                            <div class="col-sm-2">
                                <em>' . $time . '</em>
                            </div>
                            <div class="col-sm-4">
                                <a target="_blank" class="unformatted-link cancel-btn" href="edit_post_admin.php?pid=' . $row['id'] . '">
                                    Edit
                                </a>
                                <a target="_blank" class="unformatted-link cancel-btn" href="deletepost_admin.php?pid=' . $row['id'] . '">
                                    Delete
                                </a>     
                                <a target="_blank" class="unformatted-link neutral-btn" href="../view_post.php?pid=' . $row['id'] . '">
                                    View
                                </a>
                                <a target="_blank" class="unformatted-link accept-btn" href="deflag.php?pid=' . $row['id'] . '">
                                    Deflag
                                </a>
                                <a style="' . $flag_user_vis . '" class="unformatted-link accept-btn" href="add_flagto_user.php?pid=' . $row['id'] . '&uid=' . $row['authorid'] . '">
                                    Flag User
                                </a>
                            </div>
                        </div>
                    </div>
                </a>';

            $counter = $counter + 1;

            if ($counter == $sz) {
                break;
            }
        }
        echo '</div>';
    }
    function exist_in_adminlist($id)
    {
        include('../include/connection.php');

        $sql = "SELECT * FROM admin_list WHERE uid = '$id'";
        $res = mysqli_query($con, $sql);

        if (mysqli_num_rows($res) > 0) {
            return true;
        }
        return false;
    }
    function make_adminlist($sz)
    {
        echo '<hr><div class="row" style="margin-left:30px; text-align:center;">
                <div class="col-sm-1">
                    <strong>Index</strong>
                </div>
                <div class="col-sm-1">
                    <strong>User ID</strong>
                </div>
                <div class="col-sm-1">
                    <strong>Photo</strong>
                </div>
                <div class="col-sm-3">
                    <strong>Name</strong>
                </div>
                <div class="col-sm-2">
                    <strong>Username</strong>
                </div>
                <div class="col-sm-2">
                    <strong>View</strong>
                </div>
                <div class="col-sm-2">
                    <strong>Action</strong>
                </div>
            </div><hr>';
        $counter = 0;

        include('../include/connection.php');

        $sql = "SELECT * FROM users ORDER BY id DESC";
        $res = mysqli_query($con, $sql);

        while ($row = mysqli_fetch_assoc($res)) {

            if (!($this->exist_in_adminlist($row['id']))) {



                $profile_picture_link = "../ext-files/user/" . $row['pro_pic'];

                echo '<div class="card-main">
                    <div class="row" style="margin-left:0px; text-align:center;">
                        <div class="col-sm-1">
                            <span>' . ($counter + 1) . '</span>
                        </div>
                        <div class="col-sm-1">
                            <span>' . $row['id'] . '</span>
                        </div>
                        <div class="col-sm-1">
                            <img class="profile-pic-home-post" src="' . $profile_picture_link . '">
                        </div>
                        <div class="col-sm-3">
                            <a title="View User Profile" class="unformatted-link homepage-poster-name" href="../view_user.php?uid=' . $row['id'] . '">
                                <span>&nbsp' . $row['fname'] . ' ' . $row['lname'] . '</span>
                            </a>
                        </div>
                        <div class="col-sm-2">
                            <span>&nbsp' . $row['uname'] . '</span>
                        </div>
                        <div class="col-sm-2">
                            <a href="../view_user.php?uid=' . $row['id'] . '" style="float:right;" class="neutral-btn">View Profile</a>
                        </div>
                        <div class="col-sm-2">
                            <a href="make_admin.php?uid=' . $row['id'] . '&uname=' . $row['uname'] . '" style="float:right;" class="cancel-btn">Make Admin</a>
                        </div>
                    </div>
                </div>';

                $counter = $counter + 1;

                if ($counter == $sz) {
                    break;
                }
            }
        }
    }
    function make_moderatorlist($sz)
    {
        echo '<hr><div class="row" style="margin-left:30px; text-align:center;">
                <div class="col-sm-1">
                    <strong>Index</strong>
                </div>
                <div class="col-sm-1">
                    <strong>User ID</strong>
                </div>
                <div class="col-sm-1">
                    <strong>Photo</strong>
                </div>
                <div class="col-sm-3">
                    <strong>Name</strong>
                </div>
                <div class="col-sm-2">
                    <strong>Username</strong>
                </div>
                <div class="col-sm-2">
                    <strong>View</strong>
                </div>
                <div class="col-sm-2">
                    <strong>Action</strong>
                </div>
            </div><hr>';
        $counter = 0;

        include('../include/connection.php');

        $sql = "SELECT * FROM users ORDER BY id DESC";
        $res = mysqli_query($con, $sql);

        while ($row = mysqli_fetch_assoc($res)) {

            if (!($this->exist_in_adminlist($row['id']))) {

                $profile_picture_link = "../ext-files/user/" . $row['pro_pic'];

                echo '<div class="card-main">
                    <div class="row" style="margin-left:0px; text-align:center;">
                        <div class="col-sm-1">
                            <span>' . ($counter + 1) . '</span>
                        </div>
                        <div class="col-sm-1">
                            <span>' . $row['id'] . '</span>
                        </div>
                        <div class="col-sm-1">
                            <img class="profile-pic-home-post" src="' . $profile_picture_link . '">
                        </div>
                        <div class="col-sm-3">
                            <a title="View User Profile" class="unformatted-link homepage-poster-name" href="../view_user.php?uid=' . $row['id'] . '">
                                <span>&nbsp' . $row['fname'] . ' ' . $row['lname'] . '</span>
                            </a>
                        </div>
                        <div class="col-sm-2">
                            <span>&nbsp' . $row['uname'] . '</span>
                        </div>
                        <div class="col-sm-2">
                            <a href="../view_user.php?uid=' . $row['id'] . '" style="float:right;" class="neutral-btn">View Profile</a>
                        </div>
                        <div class="col-sm-2">
                            <a href="make_moderator.php?uid=' . $row['id'] . '&uname=' . $row['uname'] . '" style="float:right;" class="cancel-btn">Make Moderator</a>
                        </div>
                    </div>
                </div>';

                $counter = $counter + 1;

                if ($counter == $sz) {
                    break;
                }
            }
        }
    }
    function create_adminlist($sz, $add_mod_vis, $add_admin_vis)
    {
        echo '<hr><div class="row" style="margin-left:30px; text-align:center;">
        <div class="col-sm-1">
            <strong>Index</strong>
        </div>
        <div class="col-sm-1">
            <strong>User ID</strong>
        </div>
        <div class="col-sm-1">
            <strong>Photo</strong>
        </div>
        <div class="col-sm-3">
            <strong>Name</strong>
        </div>
        <div class="col-sm-2">
            <strong>Username</strong>
        </div>
        <div class="col-sm-2">
            <strong>View</strong>
        </div>
        <div class="col-sm-2">
            <strong>Action</strong>
        </div>
    </div><hr>';
        $counter = 0;

        include('../include/connection.php');

        $sql = "SELECT * FROM admin_list WHERE rank = 'admin' ORDER BY id DESC";
        $res = mysqli_query($con, $sql);


        while ($rowadmin = mysqli_fetch_assoc($res)) {

            $row = $this->get_user_details($rowadmin['uid']);

            $profile_picture_link = "../ext-files/user/" . $row['pro_pic'];

            echo '<div class="card-main">
            <div class="row" style="margin-left:0px; text-align:center;">
                <div class="col-sm-1">
                    <span>' . ($counter + 1) . '</span>
                </div>
                <div class="col-sm-1">
                    <span>' . $row['id'] . '</span>
                </div>
                <div class="col-sm-1">
                    <img class="profile-pic-home-post" src="' . $profile_picture_link . '">
                </div>
                <div class="col-sm-3">
                    <a title="View User Profile" class="unformatted-link homepage-poster-name" href="../view_user.php?uid=' . $row['id'] . '">
                        <span>&nbsp' . $row['fname'] . ' ' . $row['lname'] . '</span>
                    </a>
                </div>
                <div class="col-sm-2">
                    <span>&nbsp' . $row['uname'] . '</span>
                </div>
                <div class="col-sm-2">
                    <a href="../view_user.php?uid=' . $row['id'] . '" style="float:right;" class="neutral-btn">View Profile</a>
                </div>
                <div class="col-sm-2">
                    <a href="remove_admin.php?uid=' . $row['id'] . '&uname=' . $row['uname'] . '" style="' . $add_mod_vis . ' ' . $add_admin_vis . ' float:right;" class="cancel-btn">Remove Admin</a>
                </div>
            </div>
        </div>';

            $counter = $counter + 1;

            if ($counter == $sz) {
                break;
            }
        }
    }
    function get_post_details($post_id)
    {
        include('../include/connection.php');

        $sql = "SELECT * FROM posts WHERE id = '$post_id'";
        $res = mysqli_query($con, $sql);
        $row = mysqli_fetch_assoc($res);
        return $row;
    }
    function create_promote_list($sz)
    {
        echo '<div><hr><div class="row" style="margin-left:-20px; text-align:center;">
                <div class="col-sm-1">
                    <strong>Index</strong>
                </div>
                <div class="col-sm-1">
                    <strong>Post ID</strong>
                </div>
                <div class="col-sm-1">
                    <strong>Author</strong>
                </div>
                <div class="col-sm-1">
                    <strong>Privacy</strong>
                </div>
                <div class="col-sm-2">
                    <strong>Content</strong>
                </div>
                <div class="col-sm-2">
                    <strong>Time</strong>
                </div>
                <div class="col-sm-4">
                    <strong>Action</strong>
                </div>
            </div><hr>';
        $counter = 0;


        include('../include/connection.php');

        $sql = "SELECT * FROM pending_promote ORDER BY id DESC";
        $res = mysqli_query($con, $sql);

        while ($row2 = mysqli_fetch_assoc($res)) {

            $row = $this->get_post_details($row2['post_id']);

            $flag_user_vis = "";

            if ($this->check_flaglist($row['id'])) {
                $flag_user_vis = "display: none;";
            }

            $authorname = $this->get_user_details($row['authorid']);
            $authorname = $authorname['fname'];
            $postid = $row['id'];
            $content = $row['content'];
            $content = substr($content, 0, 80);
            $time = $row['time'];
            $privacy = $row['privacy'];
            $privicon = '<i class="fas fa-globe-americas"></i>';

            if ($privacy == 'f') {
                $privicon = '<i class="fas fa-user-friends"></i>';
            }

            echo '
                    <div class="card-main">
                        <div class="row" style="margin-left:-40px; text-align:center;">
                            <div class="col-sm-1">
                                <span>' . ($counter + 1) . '</span>
                            </div>
                            <div class="col-sm-1">
                                <span>' . $postid . '</span>
                            </div>
                            <div class="col-sm-1">
                                <strong>&nbsp' . $authorname . '</strong>
                            </div>
                            <div class="col-sm-1">
                                <strong>' . $privicon . '</strong>
                            </div>
                            <div class="col-sm-2">
                                <span>' . $content . '</span>
                            </div>
                            <div class="col-sm-2">
                                <em>' . $time . '</em>
                            </div>
                            <div class="col-sm-4">

                                <label>
                                    Promote For
                                    <select style="color: black; background-color:#ffa1a1;" title="Selecting an option will automatically submit a promotion token for the post" onchange="location = this.value;" name="example_length" aria-controls="example" class="form-select form-select-sm arnab-dropdown">
                                        <option value="#">Select</option>
    
                                        <option value="promote_post.php?pid=' . $row['id'] . '&time=testtime">1 Minute [Test]</option>
                                        <option value="promote_post.php?pid=' . $row['id'] . '&time=4">4 Hours</option>
                                        <option value="promote_post.php?pid=' . $row['id'] . '&time=6">6 Hours</option>
                                        <option value="promote_post.php?pid=' . $row['id'] . '&time=10">10 Hours</option>
                                        <option value="promote_post.php?pid=' . $row['id'] . '&time=14">15 Hours</option>
                                        <option value="promote_post.php?pid=' . $row['id'] . '&time=24">24 Hours</option>
                                        <option value="promote_post.php?pid=' . $row['id'] . '&time=48">48 Hours</option>
                                    </select>
                                </label>
                                
                                <a target="_blank" class="unformatted-link cancel-btn" href="dismiss_promo.php?pid=' . $row['id'] . '">
                                    Dismiss
                                </a>
                                
                            </div>
                        </div>
                    </div>
                </a>';

            $counter = $counter + 1;

            if ($counter == $sz) {
                break;
            }
        }
        echo '</div>';
    }
    function create_moderatorlist($sz, $add_mod_vis)
    {
        echo '<hr><div class="row" style="margin-left:30px; text-align:center;">
        <div class="col-sm-1">
            <strong>Index</strong>
        </div>
        <div class="col-sm-1">
            <strong>User ID</strong>
        </div>
        <div class="col-sm-1">
            <strong>Photo</strong>
        </div>
        <div class="col-sm-3">
            <strong>Name</strong>
        </div>
        <div class="col-sm-2">
            <strong>Username</strong>
        </div>
        <div class="col-sm-2">
            <strong>View</strong>
        </div>
        <div class="col-sm-2">
            <strong>Action</strong>
        </div>
    </div><hr>';
        $counter = 0;

        include('../include/connection.php');

        $sql = "SELECT * FROM admin_list WHERE rank = 'moderator' ORDER BY id DESC";
        $res = mysqli_query($con, $sql);


        while ($rowadmin = mysqli_fetch_assoc($res)) {

            $row = $this->get_user_details($rowadmin['uid']);

            $profile_picture_link = "../ext-files/user/" . $row['pro_pic'];

            echo '<div class="card-main">
            <div class="row" style="margin-left:0px; text-align:center;">
                <div class="col-sm-1">
                    <span>' . ($counter + 1) . '</span>
                </div>
                <div class="col-sm-1">
                    <span>' . $row['id'] . '</span>
                </div>
                <div class="col-sm-1">
                    <img class="profile-pic-home-post" src="' . $profile_picture_link . '">
                </div>
                <div class="col-sm-3">
                    <a title="View User Profile" class="unformatted-link homepage-poster-name" href="../view_user.php?uid=' . $row['id'] . '">
                        <span>&nbsp' . $row['fname'] . ' ' . $row['lname'] . '</span>
                    </a>
                </div>
                <div class="col-sm-2">
                    <span>&nbsp' . $row['uname'] . '</span>
                </div>
                <div class="col-sm-2">
                    <a href="../view_user.php?uid=' . $row['id'] . '" style="float:right;" class="neutral-btn">View Profile</a>
                </div>
                <div class="col-sm-2">
                    <a href="remove_moderator.php?uid=' . $row['id'] . '&uname=' . $row['uname'] . '" style="' . $add_mod_vis . ' float:right;" class="cancel-btn">Remove Moderator</a>
                </div>
            </div>
        </div>';

            $counter = $counter + 1;

            if ($counter == $sz) {
                break;
            }
        }
    }

    ///////////////////////////////////
    ///////// ffffffffffff ///////////////
    function check_restlist($user_id)
    {
        include('../include/connection.php');

        $sql = "SELECT * FROM ban_user WHERE user_id = '$user_id' and ban_stat = 'banned'";
        $res = mysqli_query($con, $sql);
        $c = mysqli_num_rows($res);

        if ($c > 0) {
            return true;
        }
        return false;
    }
    function create_ban_list($sz)
    {
        echo '<hr><div class="row" style="margin-left:30px; text-align:center;">
                <div class="col-sm-1">
                    <strong>Index</strong>
                </div>
                <div class="col-sm-1">
                    <strong>User ID</strong>
                </div>
                <div class="col-sm-2">
                    <strong>Photo</strong>
                </div>
                <div class="col-sm-2">
                    <strong>Name</strong>
                </div>
                <div class="col-sm-1">
                    <strong>Username</strong>
                </div>
                <div class="col-sm-1">
                    <strong>Flags</strong>
                </div>
                <div class="col-sm-4">
                    <strong>Actions</strong>
                </div>
            </div><hr>';
        $counter = 0;

        include('../include/connection.php');

        $sql = "SELECT * FROM users ORDER BY id DESC";
        $res = mysqli_query($con, $sql);

        while ($row = mysqli_fetch_assoc($res)) {

            if ($this->check_ban_list($row['id'])) {

                $num_flags = $this->get_flag_count($row['id']);
                $profile_picture_link = "../ext-files/user/" . $row['pro_pic'];

                $rest_bt_vis = '';

                if ($this->check_restlist($row['id'])) {
                    $rest_bt_vis = 'display: none;';
                }
                echo '<div class="card-main">
                    <div class="row" style="margin-left:0px; text-align:center;">
                        <div class="col-sm-1">
                            <span>' . ($counter + 1) . '</span>
                        </div>
                        <div class="col-sm-1">
                            <span>' . $row['id'] . '</span>
                        </div>
                        <div class="col-sm-2">
                            <img class="profile-pic-home-post" src="' . $profile_picture_link . '">
                        </div>
                        <div class="col-sm-2">
                            <a title="View User Profile" class="unformatted-link homepage-poster-name" href="../view_user.php?uid=' . $row['id'] . '">
                                <span>&nbsp' . $row['fname'] . ' ' . $row['lname'] . '</span>
                            </a>
                        </div>
                        <div class="col-sm-1">
                            <span>&nbsp' . $row['uname'] . '</span>
                        </div>
                        <div class="col-sm-1">
                            <strong>' . $num_flags . '</strong>
                        </div>
                        <div class="col-sm-4">
                            <a href="../view_user.php?uid=' . $row['id'] . '" style="float:right;" class="neutral-btn">View Profile</a>
                            <a href="restrict_user.php?uid=' . $row['id'] . '" style="' . $rest_bt_vis . ' float:right;" class="cancel-btn">Restrict User</a>
                        </div>
                    </div>
                </div>';

                $counter = $counter + 1;

                if ($counter == $sz) {
                    break;
                }
            }
        }
    }
    //////////////////////////////
    //////////////////////////


    /////////////////////////////////
    ///////// fffffffffff////////////////
    function create_admin_token_form($sz, $id, $uname)
    {
        echo '<form name="myform" method="POST" action="submit_admin_token.php" style="text-align:center;">

        <input class="topic-box" type="text" name="topic" placeholder="Topic" required><br>
    
        <textarea name="msg" class="one textbox" rows="10" cols="50" placeholder="What do you want to share...?">
        </textarea>
    
        <input type="hidden" name="admin_id" value="' . $id . '" required>
    
        <input type="hidden" name="admin_name" value="' . $uname . '" required><br>
    
    
        <input class="accept-btn" type="submit" name="submit" value="Submit">
    
      </form>
      
      <hr>
      <hr>';



        echo '<hr><div class="row" style="margin-left:30px; text-align:center;">
                <div class="col-sm-1">
                    <strong>Index</strong>
                </div>
                <div class="col-sm-1">
                    <strong>admin ID</strong>
                </div>
                <div class="col-sm-1">
                    <strong>Admin Username</strong>
                </div>
                <div class="col-sm-1">
                    <strong>Time</strong>
                </div>
                <div class="col-sm-1">
                    <strong>Topic</strong>
                </div>
                <div class="col-sm-4">
                    <strong>Message</strong>
                </div>
                <div class="col-sm-3">
                    <strong>Super Admin Response</strong>
                </div>
            </div><hr>';
        $counter = 0;

        include('../include/connection.php');

        $sql = "SELECT * FROM admin_request ORDER BY id DESC";
        $res = mysqli_query($con, $sql);

        while ($row = mysqli_fetch_assoc($res)) {

            if ($row['admin_id'] == $id) {
                echo '<div class="card-main">
                    <div class="row" style="margin-left:0px; text-align:center;">
                        <div class="col-sm-1">
                            <span>' . ($counter + 1) . '</span>
                        </div>
                        <div class="col-sm-1">
                            <span>' . $row['admin_id'] . '</span>
                        </div>
                        <div class="col-sm-1">
                        <a title="View User Profile" class="unformatted-link homepage-poster-name" href="../view_user.php?uid=' . $row['admin_id'] . '">
                            <span>' . $row['admin_name'] . '</span>
                        </a>
                        </div>
                        <div class="col-sm-1">
                            <span>&nbsp' . $row['time'] . '</span>
                        </div>
                        <div class="col-sm-1">
                            <span>&nbsp' . $row['topic'] . '</span>
                        </div>
                        <div class="col-sm-4">
                            <span>&nbsp' . $row['msg'] . '</span>
                        </div>
                        <div class="col-sm-3">
                            <span>&nbsp' . $row['reply'] . '</span>
                        </div>
                    </div>
                </div>';

                $counter = $counter + 1;

                if ($counter == $sz) {
                    break;
                }
            }
        }
    }

    function create_admin_tokenlist($sz)
    {
        echo '<hr><div class="row" style="margin-left:30px; text-align:center;">
                <div class="col-sm-1">
                    <strong>Index</strong>
                </div>
                <div class="col-sm-1">
                    <strong>admin ID</strong>
                </div>
                <div class="col-sm-1">
                    <strong>Admin Username</strong>
                </div>
                <div class="col-sm-1">
                    <strong>Time</strong>
                </div>
                <div class="col-sm-1">
                    <strong>Topic</strong>
                </div>
                <div class="col-sm-4">
                    <strong>Message</strong>
                </div>
                <div class="col-sm-3">
                    <strong>Actions</strong>
                </div>
            </div><hr>';
        $counter = 0;

        include('../include/connection.php');

        $sql = "SELECT * FROM admin_request ORDER BY id DESC";
        $res = mysqli_query($con, $sql);

        while ($row = mysqli_fetch_assoc($res)) {

            echo '<div class="card-main">
                    <div class="row" style="margin-left:0px; text-align:center;">
                        <div class="col-sm-1">
                            <span>' . ($counter + 1) . '</span>
                        </div>
                        <div class="col-sm-1">
                            <span>' . $row['admin_id'] . '</span>
                        </div>
                        <div class="col-sm-1">
                        <a title="View User Profile" class="unformatted-link homepage-poster-name" href="../view_user.php?uid=' . $row['admin_id'] . '">
                            <span>' . $row['admin_name'] . '</span>
                        </a>
                        </div>
                        <div class="col-sm-1">
                            <span>&nbsp' . $row['time'] . '</span>
                        </div>
                        <div class="col-sm-1">
                            <span>&nbsp' . $row['topic'] . '</span>
                        </div>
                        <div class="col-sm-4">
                            <span>&nbsp' . $row['msg'] . '</span>
                            <br><strong>Reply:</strong>
                            <br><span>&nbsp' . $row['reply'] . '</span>
                        </div>
                        <div class="col-sm-3">
                            <form name="myform" method="POST" action="reply_admin_token.php" style="text-align:center;">

                                <input type="text" name="reply">
                                <br>

                                <input type="hidden" name="token_id" value="' . $row['id'] . '" required>


                                <input class="accept-btn" type="submit" name="submit" value="Reply">

                            </form>
                        </div>
                    </div>
                </div>';

            $counter = $counter + 1;

            if ($counter == $sz) {
                break;
            }
        }
    }
    ////////////////////////
    //////////////////////
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
    function pending($cat, $sz, $sub, $add_admin_vis, $add_mod_vis)
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


        echo '<a style="' . $add_admin_vis . ' ' . $add_mod_vis . '" class="va" href="admin_dashboard.php?type=' . $cat . '&size=' . $sz . '&subtype=op1"><div class="vert-navbar ' . $opt1_act . '">User Verification</div></a>';
        echo '<a class="va" href="admin_dashboard.php?type=' . $cat . '&size=' . $sz . '&subtype=op2"><div class="vert-navbar ' . $opt2_act . '">Reported Posts</div></a>';
        echo '<a class="va" href="admin_dashboard.php?type=' . $cat . '&size=' . $sz . '&subtype=op3"><div class="vert-navbar ' . $opt3_act . '">Pending Promote</div></a>';
        echo '<a class="va" href="admin_dashboard.php?type=' . $cat . '&size=' . $sz . '&subtype=op4"><div class="vert-navbar ' . $opt4_act . '">Flagged Users</div></a>';


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
    function admin($cat, $sz, $sub, $add_admin_vis, $add_mod_vis)
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


        echo '<a style="' . $add_admin_vis . '" class="va" href="admin_dashboard.php?type=' . $cat . '&size=' . $sz . '&subtype=op1"><div class="vert-navbar ' . $opt1_act . '">Appoint New Admins</div></a>';
        echo '<a style="' . $add_mod_vis . '" class="va" href="admin_dashboard.php?type=' . $cat . '&size=' . $sz . '&subtype=op2"><div class="vert-navbar ' . $opt2_act . '">Appoint New Moderators</div></a>';
        echo '<a style="' . $add_mod_vis . '" class="va" href="admin_dashboard.php?type=' . $cat . '&size=' . $sz . '&subtype=op3"><div class="vert-navbar ' . $opt3_act . '">Restriction Tokens</div></a>';
        echo '<a class="va" href="admin_dashboard.php?type=' . $cat . '&size=' . $sz . '&subtype=op4"><div class="vert-navbar ' . $opt4_act . '">All Admins</div></a>';
        echo '<a class="va" href="admin_dashboard.php?type=' . $cat . '&size=' . $sz . '&subtype=op5"><div class="vert-navbar ' . $opt5_act . '">All Moderators</div></a>';



        return $subtype;
    }
    function extra($cat, $sz, $sub, $add_admin_vis, $add_mod_vis)
    {
        $opt1_act = "";
        $opt2_act = "";

        $subtype = "";

        if (isset($sub)) {
            if ($sub == "op1") {
                $opt1_act = "active-vbar";
                $subtype = "op1";
            } else if ($sub == "op2") {
                $opt2_act = "active-vbar";
                $subtype = "op2";
            }
        } else {
            $opt1_act = "active-vbar";
            $subtype = "op1";
        }


        echo '
            <a style="' . $add_mod_vis . '" class="va" href="admin_dashboard.php?type=' . $cat . '&size=' . $sz . '&subtype=op1"><div class="vert-navbar ' . $opt1_act . '">Submit Admin Token</div></a>
            <a style="' . $add_mod_vis . ' ' . $add_admin_vis . '" class="va" href="admin_dashboard.php?type=' . $cat . '&size=' . $sz . '&subtype=op2"><div class="vert-navbar ' . $opt2_act . '">Super Admin Tokens</div></a>
            ';

        return $subtype;
    }
}
