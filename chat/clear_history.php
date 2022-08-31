
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="assets/fontawesome/css/all.css">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src='assets/bootstrap/js/bootstrap.min.js'></script>
    <script src="assets/bootstrap/js/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>


    <title>Chat</title>

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
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            background-color: #d7da31;
            padding: 0 10px;
        }

        .wrapper {
            background: #fff;
            max-width: 700px;
            max-height: 700px;
            width: 100%;
            height: 100%;
            border-radius: 16px;
            box-shadow: 0 0 128px 0 rgba(0, 0, 0, 0.1), 0 32px 64px -48px rgba(0, 0, 0, 0.5);
            margin: 100px auto;
            margin-top: 20px;
        }

      
        
    </style>


</head>


<body>

    <div class="wrapper">
        <div class = hist>
            <form action="">
                <input type="submit" name="delete" value="Clear History">
                <?php
                    session_start();
                    if(isset($_SESSION['logid'])){
                        include('../include/connection.php');
                        $outgoing_id = $_SESSION['logid'];
                        $incoming_id = mysqli_real_escape_string($con, $_GET['user_id']);
                       
                        if(!empty($message)){
                            $sql3 = "DELETE FROM `messages` WHERE  `incoming_msg_id` = $incoming_id, `outgoing_msg_id` = $outgoing_id ";
                            $res3 = mysqli_query($con, $sql3);
                            
                        }
                        
                    }else{
                        //header("location: ../login.php");
                    }

                ?>
            </form>


        </div>
    </div>




</body>
<script>
    
</script>

</html>