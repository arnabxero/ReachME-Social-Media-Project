<?php
include('include/connection.php');
session_start();

if(!isset($_SESSION['logid'])){
    header('Location: logreg.php');
}

class update_profile
{
    public $fname;
    public $lname;
    public $uname;
    public $email;
    public $phone;
    public $address;
    public $job;
    public $dob;
    public $religion;
    public $language;
    public $nationality;
    public $politics;
    public $relation;
    public $blood;
    public $gender;
    public $sports;
    public $hobby;
    public $about;

    function show_profile()
    {

        include('include/connection.php');

        $user =  $_SESSION["logUname"];
        $uemail = $_SESSION["logEmail"];

        $sql = "SELECT * FROM users WHERE uname = '$user' and email = '$uemail'";

        $result = mysqli_query($con, $sql);

        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

        $count = mysqli_num_rows($result);

        if ($count > 0) {

            if (!empty($row['fname'])) {
                $this->fname = $row['fname'];
            }
            if (!empty($row['lname'])) {
                $this->lname = $row['lname'];
            }
            if (!empty($row['uname'])) {
                $this->uname = $row['uname'];
            }
            if (!empty($row['phone'])) {
                $this->phone = $row['phone'];
            }
            if (!empty($row['job'])) {
                $this->job = $row['job'];
            }
            if (!empty($row['about'])) {
                $this->about = $row['about'];
            }
            if (!empty($row['address'])) {
                $this->address = $row['address'];
            }
            if (!empty($row['date_of_birth'])) {
                $this->dob = $row['date_of_birth'];
            }
            if (!empty($row['religion'])) {
                $this->religion = $row['religion'];
            }
            if (!empty($row['language'])) {
                $this->language = $row['language'];
            }
            if (!empty($row['nation'])) {
                $this->nationality = $row['nation'];
            }
            if (!empty($row['politics'])) {
                $this->politics = $row['politics'];
            }
            if (!empty($row['relation'])) {
                $this->relation = $row['relation'];
            }
            if (!empty($row['blood'])) {
                $this->blood = $row['blood'];
            }
            if (!empty($row['gender'])) {
                $this->gender = $row['gender'];
            }
            if (!empty($row['sports'])) {
                $this->sports = $row['sports'];
            }
            if (!empty($row['hobby'])) {
                $this->hobby = $row['hobby'];
            }
        } else {
            echo "<h1> Password Changing failed <br>Invalid username or password<br>Please Try Again</h1>";
        }
    }
}


$up_profile = new update_profile();

$up_profile->show_profile();


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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700&display=swap" rel="stylesheet" />
    <link rel="shortcut icon" type="image/x-icon" href="rm.ico" />


    <title> Update Profile - ReachMe </title>
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
            display: none;
            width: 100px;
            height: 50px;
            border: none;
            border-bottom: 4px solid #10081a;
            margin-bottom: 20px;
            margin-left: 10px;
            color: #775151;
        }

        .reg form select {
            width: 400px;
            height: 50px;
            justify-content: center;
            border: none;
            border-bottom: 4px solid #10081a;
            margin-bottom: 20px;
            margin-left: 10px;
            padding: 0 15px;
        }

        .reg form input[type="password"],
        .reg form input[type="text"],
        .reg form input[type="email"],
        .reg form input[type="number"] {
            width: 400px;
            height: 50px;
            font-size: 20px;
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

        .cng-width {
            text-align: right;
        }

        @media only screen and (max-width: 600px) {
            .reg {
                width: 95%;
            }

            .reg form input[type="password"],
            .reg form input[type="text"],
            .reg form input[type="email"],
            .reg form input[type="number"] {
                font-size: 12px;
                width: 120%;
                border: 1px solid #10081a;
            }

            .cng-width {
                width: 35%;
            }
        }
    </style>



</head>

<body style="text-align: center;">
    <script src="assets/bootstrap/js/bootstrap.bundle.min.js"></script>

    <a href="index.php">
        <img src="files/logo/rm.png" height="70px" width="70px" style="margin-top: 30px;">
    </a>
    <div class="reg update-pro">
        <h3> Update Your Profile </h3>
        <form name="myform" align="center" method="POST" action='subdir/update_profile.php'>

            <div class="updt-lbl">
                <div class="row">
                    <div class="col-6 cng-width">
                        <p class="update-pro-label">
                            First Name :
                        </p><br>
                        <p class="update-pro-label">
                            Last Name :
                        </p><br>
                        <p class="update-pro-label">
                            User Name :
                        </p><br>

                        <p class="update-pro-label">
                            Phone Number :
                        </p><br>
                        <p class="update-pro-label">
                            Address :
                        </p><br>
                        <p class="update-pro-label">
                            Job :
                        </p><br>
                        <p class="update-pro-label">
                            Date of Birth :
                        </p><br>
                        <p class="update-pro-label">
                            Religion :
                        </p><br>
                        <p class="update-pro-label">
                            Language :
                        </p><br>
                        <p class="update-pro-label">
                            Nationality :
                        </p><br>
                        <p class="update-pro-label">
                            Politics :
                        </p><br>
                        <p class="update-pro-label">
                            Relationship Status :
                        </p><br>
                        <p class="update-pro-label">
                            Blood Group :
                        </p><br>
                        <p class="update-pro-label">
                            Blood Group :
                        </p><br>
                        <p class="update-pro-label">
                            Sports :
                        </p><br>
                        <p class="update-pro-label">
                            Hobby :
                        </p><br>
                        <p class="update-pro-label">
                            Bio :
                        </p><br>
                    </div>

                    <div class="col-6" style="text-align: left;">
                        <input type="text" name="fname" placeholder="First Name" id="fname" value="<?= $up_profile->fname ?>" required>

                        <input type="text" name="lname" placeholder="Last Name" id="lname" value="<?= $up_profile->lname ?>" required>

                        <input type="text" name="uname" placeholder="User Name" id="uname" value="<?= $up_profile->uname ?>" required>

                        <input type="number" name="mobile" placeholder="Phone No" id="phone" value="<?= $up_profile->phone ?>">

                        <input type="text" name="add" placeholder="Address" id="add" value="<?= $up_profile->address ?>">

                        <input type="text" name="job" placeholder="Job" id="job" value="<?= $up_profile->job ?>">

                        <input type="text" name="dob" placeholder="Date of Birth" id="dob" value="<?= $up_profile->dob ?>">

                        <input type="text" name="rel" placeholder="Religion" id="rel" value="<?= $up_profile->religion ?>">

                        <input type="text" name="lan" placeholder="Language" id="lan" value="<?= $up_profile->language ?>">

                        <input type="text" name="nat" placeholder="Nationality" id="nat" value="<?= $up_profile->nationality ?>">

                        <input type="text" name="pol" placeholder="Politics" id="pol" value="<?= $up_profile->politics ?>">

                        <input type="text" name="relation" placeholder="Relationship Status" id="relation" value="<?= $up_profile->relation ?>">

                        <input type="text" name="blood" placeholder="Blood Group" id="blood" value="<?= $up_profile->blood ?>">

                        <input type="text" name="gen" placeholder="Gender" id="gen" value="<?= $up_profile->gender ?>">

                        <input type="text" name="sports" placeholder="Sports" id="sports" value="<?= $up_profile->sports ?>">

                        <input type="text" name="hobby" placeholder="Hobby" id="hobby" value="<?= $up_profile->hobby ?>">

                        <input type="text" name="about" placeholder="About" id="about" value="<?= $up_profile->about ?>">

                    </div>
                </div>
            </div>

            <input type="submit" name="submit" value="Update">


        </form>
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