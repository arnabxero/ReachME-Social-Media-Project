<?php
class appsub
{
    function apply()
    {
        session_start();
        include('../include/connection.php');
    

        $name = $_SESSION["logUname"];


        $email = stripcslashes($_POST['uemail']);
        $phone = stripcslashes($_POST['mobile']);
        $fname = stripcslashes($_POST['fname']);
        $lname = stripcslashes($_POST['lname']);
        $uname = stripcslashes($_POST['uname']);



        $email = mysqli_real_escape_string($con, $email);

        $phone = mysqli_real_escape_string($con, $phone);
        $fname = mysqli_real_escape_string($con, $fname);
        $lname = mysqli_real_escape_string($con, $lname);
        $uname = mysqli_real_escape_string($con, $uname);

        $sql = "SELECT * FROM users WHERE uname = '$name'";
        $res =  mysqli_query($con, $sql);
        $row = mysqli_fetch_array($res, MYSQLI_ASSOC);

        $folder = $row['id'];
        $structure = "../ext-files/ver_file/" . $folder;
        $one = "1.pdf";
        $two = "2.pdf";
        // Check if the folder exists before creating new folder
        if (is_dir($structure)) {
           
        } else {
            if (!mkdir($structure, 0777, true)) {
                die('Failed to create folders...');
            }
        }

        // If file exists delete the previous one before procceding.......
        if (file_exists("../ext-files/ver_file/" . $folder . '/' . $one)) {
            unlink("../ext-files/ver_file/" . $folder . '/' . $one);
            
        }
        if (file_exists("../ext-files/ver_file/" . $folder . '/' . $two)) {
                unlink("../ext-files/ver_file/" . $folder . '/' . $two);
            }


        $pdf = $_FILES['pdf1']['name'];

        $pdf_type = $_FILES['pdf1']['type'];
        $pdf_size = $_FILES['pdf1']['size'];
        $pdf_tem_loc = $_FILES['pdf1']['tmp_name'];
        $pdf_store = "../ext-files/ver_file/" . $folder . '/' . $pdf;

        $pdf_rename = "../ext-files/ver_file/" . $folder . '/' . $one;

        $pdf2 = $_FILES['pdf2']['name'];

        $pdf_type2 = $_FILES['pdf2']['type'];
        $pdf_size2 = $_FILES['pdf2']['size'];
        $pdf_tem_loc2 = $_FILES['pdf2']['tmp_name'];
        $pdf_store2 = "../ext-files/ver_file/" . $folder . '/' . $pdf2;

        $pdf_rename2 = "../ext-files/ver_file/" . $folder . '/' . $two;




        move_uploaded_file($pdf_tem_loc, $pdf_store);
        move_uploaded_file($pdf_tem_loc2, $pdf_store2);
        // rename the file as 1.pdf and 2.pdf
        rename($pdf_store, $pdf_rename);
        rename($pdf_store2, $pdf_rename2);

        $newname = basename($pdf_rename);
        $newname2 = basename($pdf_rename2);




        if ($row['fname'] == $fname) {
            if ($row['lname'] == $lname) {
                if ($row['email'] == $email) {
                    if ($row['phone'] == $phone) {

                        $user_id = $row['id'];
                        $sql4 = "SELECT * FROM pending_ver WHERE user_id = '$user_id'";
                        $res4 =  mysqli_query($con, $sql4);
                        $row2 = mysqli_fetch_array($res4, MYSQLI_ASSOC);
                        if ($row2['user_id'] != $user_id) {
                            
                                $sql2 = "INSERT INTO `pending_ver` (`user_id`, `user_name`,  `file_1`, `file_2`) VALUES ('$user_id' ,'$uname', '$pdf', '$pdf2')";
                                $res2 =  mysqli_query($con, $sql2);
                                $sql3 = "UPDATE pending_ver SET file_1 = '$newname', file_2 = '$newname2' WHERE user_id = '$folder'";
                                $res3 = mysqli_query($con, $sql3);
                            
                        }
                        else{
                            $sql3 = "UPDATE pending_ver SET file_1 = '$newname', file_2 = '$newname2' WHERE user_id = '$folder'";
                            $res3 = mysqli_query($con, $sql3);
                            header('Location: ../Admin/application.php');

                        }
                    }
                }
            }
        }
        session_destroy();
        header('Location: ../login.php');
    }
}
$verfied = new appsub();
if (!empty($_POST['uemail'])) {
    if (isset($_POST['submit'])) {
        $verfied->apply();
    }
}



?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/fontawesome/css/all.css">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css?v=<?php echo time(); ?>">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700&display=swap" rel="stylesheet" />
    <link rel="shortcut icon" type="image/x-icon" href="rm.ico" />


    <title> Registration - ReachMe </title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
    <style>
        * {
            box-sizing: border-box;
            font-family: -apple-system, BlinkMacSystemFont, "segoe ui", roboto, oxygen, ubuntu, cantarell, "fira sans", "droid sans", "helvetica neue", Arial, sans-serif;
            font-size: 16px;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        .logo {
            align-items: center;
            color: #202f49;
            padding: 20px 10px 20px 900px;
        }

        body {
            background-color: #d7da31;
        }

        .reg {
            width: 700px;
            background-color: #ffffff;
            box-shadow: 0 0 9px 0 rgba(0, 0, 0, 0.3);
            margin: 100px auto;
            margin-top: 20px;
        }

        .reg label {
            margin-left: 200px;
            font-size: 20px;
            font-family: fantasy;
        }

        .reg h3 {
            text-align: center;
            color: #0e1116;
            font-size: 24px;
            padding: 20px 0 20px 0;
            border-bottom: 1px solid #080803;
        }

        .reg form {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            padding-top: 20px;
        }



        .reg form input[type="password"],
        .reg form input[type="text"],
        .reg form input[type="email"],
        .reg form input[type="number"] {
            width: 310px;
            height: 50px;
            justify-content: center;
            border: none;
            border-bottom: 4px solid #10081a;
            margin-bottom: 20px;
            margin-left: 10px;
            padding: 0 15px;
        }

        .reg form input[type="file"] {
            padding-top: 5px;


        }


        #pass {
            width: 310px;
            height: 50px;
            justify-content: center;
            border: none;
            border-bottom: 4px solid #10081a;
            margin-bottom: 20px;
            margin-left: 10px;
            padding-left: 80px;
        }

        .reg form input[type="submit"] {
            width: 100%;
            padding: 15px;
            margin-top: 20px;
            background-color: #08101b;
            border: 0;
            cursor: pointer;
            font-weight: bold;
            color: #ffffff;
            transition: background-color 0.2s;
        }

        .reg form input[type="submit"]:hover {
            background-color: #2868c7;
            transition: background-color 0.2s;
        }

        @media only screen and (max-width: 600px) {
            .reg {
                width: 95%;
            }
        }


        #pdf1 {
            padding-left: 142px;



        }

        #pdf2 {

            padding-left: 40px;


        }

        #nid {
            width: 700px;
            margin-bottom: 5px;

        }

        #bc {
            width: 700px;
            margin-bottom: 5px;

        }
    </style>



</head>

<body style="text-align: center;">
    <script src="assets/bootstrap/js/bootstrap.bundle.min.js"></script>

    <a href="index.php">
        <img src="../files/logo/rm.png" height="70px" width="70px" style="margin-top: 30px;">
    </a>
    <div class="reg">
        <h3> Welcome </h3>

        <div class="row">
            <div class="col-12">
                <form name="myform" align="center" method="POST" action='application.php' enctype="multipart/form-data">



                    <input type="text" name="fname" placeholder="First Name" id="fname" required>

                    <input type="text" name="lname" placeholder="Last Name" id="lname" required>

                    <input type="text" name="uname" placeholder="User Name" id="uname" required>

                    <input type="number" name="mobile" placeholder="Phone No" id="phone" required>

                    <input type="email" name="uemail" placeholder="Email" id="email" required><br>

                    <div id="nid">
                        <label for="pdf1" id="lab1">NID</label><input type="file" name="pdf1" id="pdf1" placeholder="NID" required>
                    </div>
                    <div id="bc">
                        <label for="pdf2" id=lab2>Birth Certificate</label><input type="file" name="pdf2" id="pdf2" required>

                    </div>




                    <input type="submit" name="submit" value="Submit">


                </form>

            </div>
        </div>
    </div>


    <script>
        function checkForm() {
            let x = document.forms["myform"]["uname"].value;

            let y = document.forms["myform"]["pass"].value;

            let z = document.forms["myform"]["mobile"].value;

            let w = document.forms["myform"]["uemail"].value;

            if (x == "") {
                alert("Please Fill The Name Field!");
                return false;
            } else if (y == "") {
                alert("Please Fill The Password Field!");
                return false;
            } else if (z == "") {
                alert("Please Fill The Password Field!");
                return false;
            } else if (w == "") {
                alert("Please Fill The Password Field!");
                return false;
            }
            return true;
        }

        function checkPass() {
            let x = document.forms["myform"]["password"].value;

            let y = document.forms["myform"]["pass"].value;

            if (x != y) {
                alert("Please confirm Your Password");
                return false;
            }
            return true;

        }
    </script>

</body>

</html>