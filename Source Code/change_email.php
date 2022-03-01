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


    <title> Change Email - ReachMe </title>
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
        <h3> Welcome </h3>
        <form name="myform" align="center" method="POST" action='subdir/chngmail.php' onsubmit="return checkForm()">

            <input type="email" name="old_mail" placeholder="Old Email" id="oldmail">

            <input type="submit" name="submit" value="Change">


        </form>
    </div>


    <script>
        function checkForm() {
            let x = document.forms["myform"]["oldmail"].value;

           


            if (x == "") {
                alert("Please Enter Your old email!");
                return false;
            } 
            return true;
        }
    </script>

</body>

</html>