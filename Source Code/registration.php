
<?php
    include("db.php");
    if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
    $fullname = mysqli_real_escape_string($obj->conn,$_POST['fname']);
    $lastname = mysqli_real_escape_string($obj->conn,$_POST['lname']);
    $username = mysqli_real_escape_string($obj->conn,$_POST['uname']);
	$email = mysqli_real_escape_string($obj->conn,$_POST['uemail']);
	$phone = mysqli_real_escape_string($obj->conn,$_POST['mobile']);
    $job = mysqli_real_escape_string($obj->conn,$_POST['job']);
    $about = mysqli_real_escape_string($obj->conn,$_POST['about']);
	$pass = mysqli_real_escape_string($obj->conn,$_POST['pass']);

    if(isset($_POST['submit'])){
        $sql = "INSERT INTO `users` (`fname`, `lname`, `uname`,`email`, `phone`, `job`, `about`, `pass`) VALUES ('$fullname', '$lastname', '$username', '$email', '$phone', '$job', '$about', '$pass')";
	    $result = mysqli_query($obj->conn, $sql);
	    if($result){
		    echo "Registration Successfull!";
            header('Location: login.php');
	    } else {
		    echo "Registration Failed.";
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

    <title> Form Validation </title>
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
        #pass{
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
    </style>



</head>

<body>
    <div class="logo">
        <img src="icon/rm.png" height="70px" width="70px" style="float:left; margin-top:5px;margin-left:20px;">
    </div>

    <div class="reg">
        <h3> Welcome </h3>
        <form name="myform" align="center" method="POST" action='registration.php' onsubmit="return checkPass()">


            <input type="text" name="fname" placeholder="Full Name" id="fname" required>

            <input type="text" name="lname" placeholder="Last Name" id="lname">

            <input type="text" name="uname" placeholder="User Name" id="uname">

            <input type="number" name="mobile" placeholder="Phone No" id="phone" required>

            <input type="email" name="uemail" placeholder="Email" id="email" required>

            <input type="text" name="job" placeholder="Job" id="job">

            <input type="text" name="about" placeholder="About" id="about">

            <input type="password" name="password" placeholder="Password" id="password" required>

            <input type="password" name="pass" placeholder="Confirm Password" id="pass" required>




            <input type="submit" name="submit" value="sign in">


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