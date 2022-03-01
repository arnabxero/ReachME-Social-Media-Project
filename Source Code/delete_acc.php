<?php

include('include/connection.php');
session_start();

$dialog = "";

if (isset($_SESSION['logid'])) {
    if (isset($_POST['submit'])) {
        $pass = $_POST['pass'];
        $id = $_SESSION['logid'];

        $csql = "SELECT * FROM users WHERE id = '$id' AND pass = '$pass'";
        $cresult = mysqli_query($con, $csql);
        $ccount = mysqli_num_rows($cresult);

        if ($ccount < 1) {
            $dialog = "<h2 style='color: red;'><strong>Password Wrong</strong></h2>";
        } else {
            $sql = "DELETE FROM users WHERE id = '$id' AND pass = '$pass'";
            $result = mysqli_query($con, $sql);
            header('Location: subdir/logout.php');
        }
    }
} else {
    header('Location: logreg.php');
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


    <title> Change Password - ReachMe </title>
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
            background-color: #a30000;
        }

        .reg {
            width: 500px;
            border-radius: 30px;
            background-color: #ffffff;
            box-shadow: 0 0 9px 0 rgba(0, 0, 0, 0.3);
            margin: 100px auto;
            margin-top: 20px;
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

        .reg form input[type="submit"] {
            width: 100%;
            padding: 15px;
            margin-top: 20px;
            background-color: #08101b;
            border-bottom-right-radius: 30px 30px;
            border-bottom-left-radius: 30px 30px;
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
    </style>



</head>

<body style="text-align: center;">
    <script src="assets/bootstrap/js/bootstrap.bundle.min.js"></script>

    <a href="index.php">
        <img src="files/logo/rm.png" height="70px" width="70px" style="margin-top: 30px;">
    </a>
    <div class="reg">
        <h3> Delete Your Account Parmanently </h3>
        <?= $dialog ?>
        <form name="myform" align="center" method="POST" action='delete_acc.php' onsubmit="return checkForm()">

            <input type="password" name="pass" placeholder="Password" id="mainpass">

            <input type="password" name="con_pass" placeholder="Confirm Password" id="cmainpass">

            <label style="margin-top: 10px; margin-bottom: 5px;"><strong>Please Type "Confirm" To Continue</strong></label>

            <input type="text" name="con_pass" placeholder="Type Confirm" id="conf">

            <input type="submit" name="submit" value="Delete Parmanently">

        </form>
    </div>


    <script>
        function checkForm() {
            let x = document.forms["myform"]["mainpass"].value;
            let y = document.forms["myform"]["cmainpass"].value;
            let z = document.forms["myform"]["conf"].value;

            if (x == "") {
                alert("Please Enter Password!");
                return false;
            } else if (y == "") {
                alert("Please Confirm Password!");
                return false;
            } else if (z == "") {
                alert("Please Type Confirm!");
                return false;
            } else if (x != y) {
                alert("Confirm Password Does Not Match!");
                return false;
            } else {
                if (z != "Confirm") {
                    alert("Please Type Confirm!");
                    return false;
                } else {
                    return true;
                }
            }
        }
    </script>

</body>

</html>