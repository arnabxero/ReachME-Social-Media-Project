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

    function push_file($media_name)
    {
        $errors = array();
        //$file_name = $_FILES['image']['name'];
        $file_size = $_FILES['image']['size'];
        $file_tmp = $_FILES['image']['tmp_name'];
        //$file_type = $_FILES['image']['type'];

        $new_file_name = $media_name;
        $directory = "ext-files/photo/";

        $hold_tmp = explode('.', $_FILES['image']['name']);
        $file_ext = strtolower(end($hold_tmp));
        $extensions = array("jpeg", "jpg", "png", "mp4");

        if (in_array($file_ext, $extensions) === false) {
            if ($file_ext == "mp4") {
                $directory = "ext-files/video/";
            }
            $errors[] = "extension not allowed, please choose a JPEG or PNG file.";
            //$dp_dialog = "<p style='Color: red; font-weight: bold;'>extension not allowed, please choose a JPEG or PNG file.</p>";
        }

        if ($file_size > 2097152) {
            $errors[] = 'File size must be excately 2 MB';
            //$dp_dialog = '<p style="Color: red; font-weight: bold;">File size must be excately 2 MB</p>';
        }

        if (empty($errors) == true) {
            move_uploaded_file($file_tmp, $directory . $new_file_name);
            //$dp_dialog = "<p style='Color: green; font-weight: bold;'>Profile Picture Updated</p>";
        } else {
            //$dp_dialog = $dp_dialog . "<p style='Color: red; font-weight: bold;'>Profile Picture Upload Failed</p>";
        }

        return $directory.$new_file_name;
    }

    function push_post($media_name_with_dir, $content, $category, $privacy, $authorid, $authorname, $saveTime)
    {
        include('../include/connection.php');

        $sql = "INSERT INTO `posts` (`authorid`, `content`, `time`, `category`, `media_link`, `privacy`, `authorname`) 
        VALUES ('$authorid', '$content', '$saveTime', '$category', '$media_name_with_dir', '$privacy', '$authorname')";

        $res = mysqli_query($con, $sql);
    }

    function create_post()
    {
        $content = $_POST['content'];
        $category = $_POST['type'];
        $privacy = $_POST['privacy'];
        $media_name = "";
        $media_name_with_dir = "";
        $authorid = $_SESSION['logid'];
        $authorname = $_SESSION['logname'];
        $today = new DateTime("now", new DateTimeZone('Asia/Dhaka'));
        $saveTime =  $today->format('h:i A|Y/m/d');


        if (isset($_POST['image'])) {
            echo "File Found";
            $media_name = $this->generate_filename();

            $media_name_with_dir = $this->push_file($media_name);
        }
    }
}


if (isset($_SESSION['logid'])) {
    $obj = new post_now();
    $obj->create_post();
} else {
    header('Location: logreg.php');
}
