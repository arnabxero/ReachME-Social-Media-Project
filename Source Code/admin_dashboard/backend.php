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
                            <div class="col-sm-2">
                                <span>' . $content . '</span>
                            </div>
                            <div class="col-sm-2">
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
                                <a target="_blank" class="unformatted-link accept-btn" href="deflag.php?pid=' . $row['id'] . '">
                                    Deflag
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
    function create_adminlist($sz)
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
                    <a href="remove_admin.php?uid=' . $row['id'] . '&uname=' . $row['uname'] . '" style="float:right;" class="cancel-btn">Remove Admin</a>
                </div>
            </div>
        </div>';

            $counter = $counter + 1;

            if ($counter == $sz) {
                break;
            }
        }
    }
    function create_moderatorlist($sz)
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
                    <a href="remove_moderator.php?uid=' . $row['id'] . '&uname=' . $row['uname'] . '" style="float:right;" class="cancel-btn">Remove Moderator</a>
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
        echo '<a class="va" href="admin_dashboard.php?type=' . $cat . '&size=' . $sz . '&subtype=op3"><div class="vert-navbar ' . $opt3_act . '">Appoint New Users</div></a>';
        echo '<a class="va" href="admin_dashboard.php?type=' . $cat . '&size=' . $sz . '&subtype=op4"><div class="vert-navbar ' . $opt4_act . '">All Admins</div></a>';
        echo '<a class="va" href="admin_dashboard.php?type=' . $cat . '&size=' . $sz . '&subtype=op5"><div class="vert-navbar ' . $opt5_act . '">All Moderators</div></a>';



        return $subtype;
    }
    function extra($cat, $sz, $sub)
    {
    }
}
