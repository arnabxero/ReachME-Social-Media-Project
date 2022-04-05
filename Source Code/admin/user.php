<?php

class users
{

    public $out;
    public $count;
    function user()
    {



        include('../include/connection.php');


        $admin = $_SESSION['logid'];
        $sql = "SELECT * FROM users WHERE NOT id = '$admin' ORDER BY id";


        $query = mysqli_query($con, $sql);
        $output = "";
        $count = 0;

        if (mysqli_num_rows($query) == 0) {
            $output .= "No users are available.";
        } elseif (mysqli_num_rows($query) > 0) {

            while ($row = mysqli_fetch_assoc($query)) {

                if ($row['status'] == "Offline") {
                    $offline = "offline";
                } else {
                    $offline = "";
                    $count++;
                }
                $sql6 = "SELECT * FROM users ORDER BY id";
                $ress = mysqli_query($con, $sql6);
                $rowcount = mysqli_num_rows($ress);




                $cheakpic;
                if ($row['pro_pic'] != NULL) {
                    $cheakpic = $row['pro_pic'];
                } else {
                    $cheakpic = 'default.jpg';
                }

                $c_user_id = $row['id'];
                $c_user_href = '../view_user.php?uid=' . $c_user_id;

                $output .= '<a href="' . $c_user_href . '" style="text-decoration: none;">
                            
            
                        <div class="content">
                              <img src="../ext-files/user/' . $cheakpic . '" alt="">
                        <div class="details">
                            <span>' . $row['fname'] . " " . $row['lname'] . '</span>
                            <hide>
                        </div>
                        </div>
                    </a>';
            }
        }
        $this->out = $output;
        $this->count = $rowcount;
    }
}

$chat = new users();
$chat->user();
