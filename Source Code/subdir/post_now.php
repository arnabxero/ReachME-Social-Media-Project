<?php

include('../include/connection.php');
session_start();


class post_now
{
    function get_filename_random()
    {
        $legal_charset = 'abcdefghijklmnopqrstwxyzABCDEFGHIJKLMNOPQRSTWXYZ0123456789';
        $legal_charset_len = strlen($legal_charset);
        $random_filename = "";

        for ($i = 0; $i < 20; $i++) {
            $random_filename .= $legal_charset[rand(0, $legal_charset_len - 1)];
        }
        return $random_filename;
    }

    function check_filename_unique($gen_fname)
    {
        include('../include/connection.php');

        $rt = false;

        $sql = "SELECT * FROM posts WHERE media_link = '$gen_fname'";
        $res = mysqli_query($con, $sql);
        $count = mysqli_num_rows($res);

        if ($count < 1) {
            $rt = true;
        }
        return $rt;
    }

    function generate_filename()
    {
        $temp_filename = $this->get_filename_random();
        $temp_filename = $temp_filename . $_SESSION['logid'];

        while (!$this->check_filename_unique($temp_filename)) {
            $temp_filename = $this->get_filename_random();
            $temp_filename = $temp_filename . $_SESSION['logid'];
        }

        return $temp_filename;
    }

    function create_post()
    {
        $content = $_POST['content'];
        $category = $_POST['type'];
        $privacy = $_POST['privacy'];
        $media_name = "";

        if (isset('file')) {
            $media_name = $this->generate_filename();
        }

        //Get time date start
        //Get Time of BD Zone
        $today = new DateTime("now", new DateTimeZone('Asia/Dhaka'));

        //Print Data On Webpage
        //Print visitor ip
        //echo "Your IP Address is $ip ";
        //Print Current Date And Time
        //echo "BD Time - ";
        //echo $today->format('Y/m/d - h:i:sa');

        //Adding Time Date and Zone to Log
        $saveTime =  $today->format('Y/m/d          h:i:sa');

        //get time date end
    }
}


if (isset($_SESSION['logid'])) {
} else {
    header('Location: logreg.php');
}
