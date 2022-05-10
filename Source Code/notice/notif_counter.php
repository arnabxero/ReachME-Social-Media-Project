<?php

header('Content-Type: application.json');

$method = $_SERVER['REQUEST_METHOD'];

if ($method == 'GET') {
    $data = json_decode(file_get_contents('php://input'), true);
    Operate_GET($data);
}

function Operate_GET($data)
{
    $uid = $_GET['uid'];

    $return_val = 0;

    $return_val = count_likes($uid);

    $return_val = $return_val + count_comments($uid);

    echo $return_val;
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
function count_likes($uid)
{
    include('../include/connection.php');

    $sql = "SELECT * FROM votes";
    $res = mysqli_query($con, $sql);
    $count = 0;

    while ($row = mysqli_fetch_assoc($res)) {
        $pid = $row['post_id'];
        if (check_post_ownership($pid, $uid)) {
            $count = $count + 1;
        }
    }

    return $count;
}
function count_comments($uid)
{
    include('../include/connection.php');

    $sql = "SELECT * FROM comments";
    $res = mysqli_query($con, $sql);
    $count = 0;

    while ($row = mysqli_fetch_assoc($res)) {
        $pid = $row['post_id'];
        if (check_post_ownership($pid, $uid)) {
            $count = $count + 1;
        }
    }

    return $count;
}
