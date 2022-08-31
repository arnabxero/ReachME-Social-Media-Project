<?php

class chatusers
{

    public $out;
    public $count;
    function isfriend($user_id)
    {
        include('../include/connection.php');
        $myid = $_SESSION['logid'];

        $sql1 = "SELECT * FROM friend_list WHERE (sid = '$myid' AND rid = '$user_id' AND stat = 'a') OR (rid = '$myid' AND sid = '$user_id' AND stat = 'a')";
        $res1 = mysqli_query($con, $sql1);
        $count1 = mysqli_num_rows($res1);

        if ($count1 < 1) {
            return false;
        }
        return true;
    }
    function chatu()
    {

        $isfrnd = false;

        include('../include/connection.php');

        $sender_id = $_SESSION['logid'];
        $sql = "SELECT * FROM users WHERE NOT id = '$sender_id' ORDER BY id DESC";


        $query = mysqli_query($con, $sql);
        $output = "";
        $count = 0;

        if (mysqli_num_rows($query) == 0) {
            $output .= "No users are available to chat";
        } elseif (mysqli_num_rows($query) > 0) {


            while ($row = mysqli_fetch_assoc($query)) {

                $isfrnd = $this->isfriend($row['id']);

                if ($isfrnd == true) {
                    $sql2 = "SELECT * FROM messages WHERE (receiver = {$row['id']} OR sender = {$row['id']}) AND (sender = '$sender_id' OR receiver = '$sender_id') ORDER BY msg_id DESC LIMIT 1";

                    $query2 = mysqli_query($con, $sql2);

                    $row2 = mysqli_fetch_assoc($query2);
                    (mysqli_num_rows($query2) > 0) ? $result = $row2['msg'] : $result = "No message available";
                    (strlen($result) > 28) ? $msg =  substr($result, 0, 28) . '...' : $msg = $result;

                    if (isset($row2['sender'])) {
                        ($sender_id == $row2['sender']) ? $you = "You: " : $you = "";
                    } else {
                        $you = "";
                    }

                    // ($row['status'] == "Offline") ? $offline = "offline" : $offline = "";
                    if ($row['status'] == "Offline") {
                        $offline = "offline";
                    } else {
                        $offline = "";
                        $count++;
                    }

                    if ($sender_id == $row['id']) {
                        $hid_me = "hide";
                    } else {
                        $hid_me = "";
                    }
                    //($sender_id == $row['id']) ? $hid_me = "hide" : $hid_me = "";



                    $cheakpic;
                    if ($row['pro_pic'] != NULL) {
                        $cheakpic = $row['pro_pic'];
                    } else {
                        $cheakpic = 'default.jpg';
                    }
                    $output .= '<a href="chatbox.php?user_id=' . $row['id'] . '" style="text-decoration: none;">
            
                        <div class="content">
                              <img src="../ext-files/user/' . $cheakpic . '" alt="">
                        <div class="details">
                            <span>' . $row['fname'] . " " . $row['lname'] . '</span>
                            <p>' . $you . $msg . '</p>
                            <hide>
                        </div>
                        </div>
                        <div class="status-dot ' . $offline . '"><i class="fas fa-circle"></i></div>
                    </a>';
                }
            }
        }
        $this->out = $output;
        $this->count = $count;
    }
}

$chat = new chatusers();
$chat->chatu();
