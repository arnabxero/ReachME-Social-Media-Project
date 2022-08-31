<?php

class ver_request
{

    public $out;
    public $count;
    function req()
    {



        include('../include/connection.php');


        $admin = $_SESSION['logid'];
        $sql = "SELECT * FROM pending_ver ORDER BY id";


        $query = mysqli_query($con, $sql);
        $output = "";
        $count = 0;

        if (mysqli_num_rows($query) == 0) {
            $output .= "No application is avilable.";
        } elseif (mysqli_num_rows($query) > 0) {

            while ($row = mysqli_fetch_assoc($query)) {

                $id = $row['user_id'];
                $sql2 = "SELECT * FROM users where id = '$id'";
                $res = mysqli_query($con, $sql2);
                $row2 = mysqli_fetch_array($res, MYSQLI_ASSOC);

                $cheakpic;
                if ($row2['pro_pic'] != NULL) {
                    $cheakpic = $row2['pro_pic'];
                } else {
                    $cheakpic = 'default.jpg';
                }
                $folder = $id;
                $strature = $structure = "../ext-files/ver_file/" . $folder;
                $one = "1.pdf";
                $two = "2.pdf";

                $output .= '<div class="list">
                <div class="container-fluid card-main" style="margin-left: -100px; width: 99%;">
                    <div class="row">
                        <div class="col-sm-1" id="rat">
                        <img src="../ext-files/user/' . $cheakpic . '" alt="">
                        </div>


                        <div class="col-sm-1" id="same1">
                            <p>' . $row['user_id'] . '</p>
                        </div>

                        <div class="col-sm-1.5" id="same1">
                        <a href="../view_user.php?uid=' . $row['user_id'] . '">View Profile</a>
                        </div>

                        <div class="col-sm-1.5" id="same1">
                        <p>' . $row2['fname'] . ' ' . $row2['lname'] . '</p>
                        </div>

                        <div class="col-sm-1" id="same1">

                            <p>' . $row['user_name'] . '</p>
                        </div>


                        <div class="col-sm-1" id="same2">

                            
                            <a target="_blank" href="' . $strature . '/' . $one . '" id="file">View File 1</a>
                            
                        </div>
                        <div class="col-sm-1" id="same2">
                            <a target="_blank" href="' . $strature . '/' . $two . '"id="file">View File 1</a>

                        </div>

                        <div class="col-sm-1" id="same3">
                            <a href="accept.php?user_id=' . $row['user_id'] . '" style="background-color: rgb(7, 194, 23);padding-left:25px;">Accept</a>
                        </div>
                        <div class="col-sm-1" id="same3">
                            
                            <a href="reject.php?user_id=' . $row['user_id'] . '" style="background-color: rgb(230, 71, 71); padding-left:30px;">Reject</a>

                        </div>


                    </div>
                </div>
            </div>';
            }
        }
        $this->out = $output;
        $this->count = $count;
    }
}

$ver_approve = new ver_request();
$ver_approve->req();
