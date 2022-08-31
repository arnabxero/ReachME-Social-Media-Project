<?php

class notice_bucket
{
    function alert_posts($limit, $uid)
    {
        include('../include/connection.php');

        $sql = "SELECT * FROM posts WHERE category = 'alert' LIMIT $limit";
        $res = mysqli_query($con, $sql);
        $count = mysqli_num_rows($res);

        while ($row = mysqli_fetch_assoc($res)) {
            $content = $row['content'];
            $content = substr($content, 0, 85);
            $link = '../view_post.php?pid=' . $row['id'];
            $datetime = $row['time'];
            $time = substr($datetime, 0, 8);
            $date = substr($datetime, 9, 40);

            echo '<div class="notice-box">
                    <a href="' . $link . '" style="text-decoration: none; color: black;">
                        <div class="row">
                            <div class="col-2">
                                <img style="margin-left: 10px; margin-top: 5px;" src="../files/logo/alert.png" height="40px" width="40px">
                            </div>
                        <div class="col-8">
                            <p>
                                ' . $content . '
                            </p>
                        </div>
                            <div class="col-2">
                                <p style="margin-left: -20px; font-style: italic; font-size: 12px; margin-top: 10px; color: gray;">' . $time . '
                                ' . $date . '</p>
                            </div>
                        </div>
                    </a>
                </div>';
        }

        if ($count <= 0) {
            echo "<p>No Notifications in this category.</p>";
        }
    }
    function blood_posts($limit, $uid)
    {
        include('../include/connection.php');

        $sql = "SELECT * FROM posts WHERE category = 'blood' LIMIT $limit";
        $res = mysqli_query($con, $sql);
        $count = mysqli_num_rows($res);

        while ($row = mysqli_fetch_assoc($res)) {
            $content = $row['content'];
            $content = substr($content, 0, 85);
            $link = '../view_post.php?pid=' . $row['id'];
            $datetime = $row['time'];
            $time = substr($datetime, 0, 8);
            $date = substr($datetime, 9, 40);

            echo '<div class="notice-box">
                    <a href="' . $link . '" style="text-decoration: none; color: black;">
                        <div class="row">
                            <div class="col-2">
                                <img style="margin-left: 10px; margin-top: 5px;" src="../files/logo/blood.png" height="40px" width="40px">
                            </div>
                        <div class="col-8">
                            <p>
                                ' . $content . '
                            </p>
                        </div>
                            <div class="col-2">
                                <p style="margin-left: -20px; font-style: italic; font-size: 12px; margin-top: 10px; color: gray;">' . $time . '
                                ' . $date . '</p>
                            </div>
                        </div>
                    </a>
                </div>';
        }

        if ($count <= 0) {
            echo "<p>No Notifications in this category.</p>";
        }
    }
    function get_name($id)
    {
        include('../include/connection.php');

        $name = "No Name Found";

        $sql = "SELECT * FROM users WHERE id = '$id'";
        $res = mysqli_query($con, $sql);
        while ($row = mysqli_fetch_assoc($res)) {
            $name = $row['fname'] . " " . $row['lname'];
        }

        return $name;
    }
    function got_text($limit, $uid)
    {
        include('../include/connection.php');

        $sql = "SELECT * FROM messages WHERE receiver = '$uid' ORDER BY msg_id DESC LIMIT $limit";
        $res = mysqli_query($con, $sql);
        $count = mysqli_num_rows($res);

        while ($row = mysqli_fetch_assoc($res)) {
            $content = $row['msg'];
            $content = substr($content, 0, 85);
            $link = '../chat/chatbox.php?user_id=' . $row['sender'];
            $sender_name = $this->get_name($row['sender']);

            echo '<div class="notice-box">
                    <a href="' . $link . '" style="text-decoration: none; color: black;">
                        <div class="row">
                            <div class="col-2">
                                <img style="margin-left: 10px; margin-top: 5px;" src="../files/logo/text.png" height="40px" width="40px">
                            </div>
                        <div class="col-4">
                            <p><strong>
                            ' . $sender_name . '
                            </strong></p>
                        </div>
                            <div class="col-6">
                                <p>
                                ' . $content . '
                                </p>
                            </div>
                        </div>
                    </a>
                </div>';
        }

        if ($count <= 0) {
            echo "<p>No Notifications in this category.</p>";
        }
    }
    function check_post_ownership($pid, $uid)
    {
        include('../include/connection.php');

        $sql = "SELECT * FROM posts WHERE id = '$pid' AND authorid = '$uid'";
        $res = mysqli_query($con, $sql);
        $count = mysqli_num_rows($res);
        if ($count > 0) {
            return true;
        }

        return false;
    }
    function get_post_content($pid, $uid)
    {
        include('../include/connection.php');

        $content = "No Content";

        $sql = "SELECT * FROM posts WHERE id = '$pid' AND authorid = '$uid'";
        $res = mysqli_query($con, $sql);

        while ($row = mysqli_fetch_assoc($res)) {
            $content = $row['content'];
        }

        return $content;
    }
    function got_likes($limit, $uid)
    {
        include('../include/connection.php');

        $sql = "SELECT * FROM votes ORDER BY id DESC";
        $res = mysqli_query($con, $sql);
        $count = 0;

        while ($row = mysqli_fetch_assoc($res)) {

            $pid = $row['post_id'];

            if ($this->check_post_ownership($pid, $uid)) {
                $content = $this->get_post_content($pid, $uid);
                $content = substr($content, 0, 85);
                $name = $this->get_name($row['user_id']);
                $link = '../view_post.php?pid=' . $row['post_id'];
                $like_msg = "";

                if ($row['stat'] == 'u') {
                    $like_msg = ' <i class="fas fa-thumbs-up"></i> Liked';
                } else {
                    $like_msg = ' <i class="fas fa-thumbs-down"></i> Disliked';
                }

                echo '<div class="notice-box">
                    <a href="' . $link . '" style="text-decoration: none; color: black;">
                        <div class="row">
                            <div class="col-2">
                                <img style="margin-left: 10px; margin-top: 5px;" src="../files/logo/like.png" height="40px" width="40px">
                            </div>
                            <div class="col-5">
                                <p><strong>
                                ' . $name . ' ' . $like_msg . ' Your Post.
                                </strong></p>
                            </div>
                            <div class="col-5">
                                <p>
                                ' . $content . '
                                </p>
                            </div>
                        </div>
                    </a>
                </div>';
                $count = $count + 1;
            }

            if ($count == $limit) {
                break;
            }
        }

        if ($count <= 0) {
            echo "<p>No Notifications in this category.</p>";
        }
    }
    function got_comments($limit, $uid)
    {
        include('../include/connection.php');

        $sql = "SELECT * FROM comments ORDER BY id DESC";
        $res = mysqli_query($con, $sql);
        $count = 0;

        while ($row = mysqli_fetch_assoc($res)) {

            $pid = $row['post_id'];

            if ($this->check_post_ownership($pid, $uid)) {
                $name = $this->get_name($row['authorid']);
                $link = '../view_post.php?pid=' . $row['post_id'];
                $comment_msg = $row['content'];
                $comment_msg = substr($comment_msg, 0, 15);

                echo '<div class="notice-box">
                    <a href="' . $link . '" style="text-decoration: none; color: black;">
                        <div class="row">
                            <div class="col-2">
                                <img style="margin-left: 10px; margin-top: 5px;" src="../files/logo/comment.png" height="40px" width="40px">
                            </div>
                            <div class="col-5">
                                <p><strong>
                                ' . $name . ' Commented on Your Post.
                                </strong></p>
                            </div>
                            <div class="col-5">
                                <p>
                                ' . $comment_msg . '
                                </p>
                            </div>
                        </div>
                    </a>
                </div>';
                $count = $count + 1;
            }

            if ($count == $limit) {
                break;
            }
        }

        if ($count <= 0) {
            echo "<p>No Notifications in this category.</p>";
        }
    }
    function got_friend_req($limit, $uid)
    {
        include('../include/connection.php');

        $sql = "SELECT * FROM friend_list WHERE rid = '$uid' AND stat = 'r' ORDER BY id DESC";
        $res = mysqli_query($con, $sql);
        $count = 0;

        while ($row = mysqli_fetch_assoc($res)) {

            $user_id = $row['sid'];

            $name = $this->get_name($row['sid']);
            $link = '../view_user.php?uid=' . $row['sid'];

            echo '<div class="notice-box">
                    <a href="' . $link . '" style="text-decoration: none; color: black;">
                        <div class="row">
                            <div class="col-2">
                                <img style="margin-left: 10px; margin-top: 5px;" src="../files/logo/freq.png" height="40px" width="40px">
                            </div>
                            <div class="col-10">
                                <p><strong>
                                ' . $name . '</strong> sent you a friend request.
                                </p>
                            </div>
                        </div>
                    </a>
                </div>';
            $count = $count + 1;


            if ($count == $limit) {
                break;
            }
        }

        if ($count <= 0) {
            echo "<p>No Notifications in this category.</p>";
        }
    }
    function get_content($pid)
    {
        include('../include/connection.php');

        $content = "No Content";

        $sql = "SELECT * FROM posts WHERE id = '$pid'";
        $res = mysqli_query($con, $sql);

        while ($row = mysqli_fetch_assoc($res)) {
            $content = $row['content'];
        }

        return $content;
    }
    function got_tagged($limit, $uid)
    {
        include('../include/connection.php');

        $sql = "SELECT * FROM tag_list WHERE tag_id = '$uid' ORDER BY id DESC";
        $res = mysqli_query($con, $sql);
        $count = 0;

        while ($row = mysqli_fetch_assoc($res)) {

            $pid = $row['post_id'];

            $link = '../view_post.php?pid=' . $row['post_id'];
            $content = $this->get_content($pid);
            $content = substr($content, 0, 15);

            echo '<div class="notice-box">
                    <a href="' . $link . '" style="text-decoration: none; color: black;">
                        <div class="row">
                            <div class="col-2">
                                <img style="margin-left: 10px; margin-top: 5px;" src="../files/logo/tag.png" height="40px" width="40px">
                            </div>
                            <div class="col-5">
                                <p><strong>
                                You have been tagged in a Post.
                                </strong></p>
                            </div>
                            <div class="col-5">
                                <p>
                                ' . $content . '
                                </p>
                            </div>
                        </div>
                    </a>
                </div>';
            $count = $count + 1;


            if ($count == $limit) {
                break;
            }
        }

        if ($count <= 0) {
            echo "<p>No Notifications in this category.</p>";
        }
    }
    function warnings()
    {
        echo '<h3>Warning/User Reporting system is not built yet</h1>';
    }
}
