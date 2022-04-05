<?php

class verified_users
{

    public $out;
    public $count;
    function ver_user()
    {



        include('../include/connection.php');


        $admin = $_SESSION['logid'];
        $yes = "Yes";
        $sql = "SELECT * FROM users WHERE s_verified = '$yes' ORDER BY id";


        $query = mysqli_query($con, $sql);
        $output = "";
        $count = 0;

        if (mysqli_num_rows($query) == 0) {
            $output .= "No users are available.";
        } elseif (mysqli_num_rows($query) > 0) {

            while ($row = mysqli_fetch_assoc($query)) {

                if ($row['s_verified'] == "YES") {
                    $count++;
                }






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
                        
                            <span>' . $row['fname'] . " " . $row['lname'] . '</span>
                            <hide>
                        
                        </div>
                    </a>';
            }
        }
        $this->out = $output;
        $this->count = $count;
    }
}

$verfied = new verified_users();
$verfied->ver_user();
