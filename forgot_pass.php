<?php
include('include/connection.php');

$dialog = "";

if (isset($_POST['submit'])) {
    $uname_email = $_POST['uname'];

    $sql = "SELECT * FROM users WHERE uname = '$uname_email' OR email = '$uname_email'";
    $res = mysqli_query($con, $sql);
    $count = mysqli_num_rows($res);

    if ($count < 1) {
        $dialog = "<h3 style='color:red;'><strong>No Account Exist With That UserName or Email!<br>Please Try Again!</strong></h3>";
    } else {
        while ($row = mysqli_fetch_assoc($res)) {
            $dialog = '<h3><strong>Is this your account?</strong></h3><div class="card-main" style="width:99%;">
            <a title="View User Profile" class="unformatted-link homepage-poster-name" href="view_user.php?uid=' . $row['id'] . '">
             <img class="profile-pic-home-post" src="ext-files/user/' . $row['pro_pic'] . '">
            &nbsp' . $row['fname'] . ' ' . $row['lname'] . '</a>
            </div><br><a style="margin-right: 20px;" class="small-btn" href="subdir/send_rec_mail.php?uid=' . $row['id'] . '&uemail='.$row['email'].'">YES</a><a class="small-btn" href="index.php">NO</a>';
        }
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
            width: 800px;
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

        .reg form label {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 50px;
            height: 50px;
            background-color: #1760be;
            color: #fcfafa;
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
    </style>



</head>

<body style="text-align: center;">
    <script src="assets/bootstrap/js/bootstrap.bundle.min.js"></script>

    <a href="index.php">
        <img src="files/logo/rm.png" height="70px" width="70px" style="margin-top: 30px;">
    </a>
    <div class="reg">
        <h3> Find Your Account </h3>
        <?= $dialog ?>
        <form name="myform" align="center" method="POST" action='forgot_pass.php' onsubmit="return checkForm()">

            <input type="text" name="uname" placeholder="User Name" id="uname" required>

            <input type="submit" name="submit" value="Find Your Account">

        </form>
    </div>

</body>

</html>