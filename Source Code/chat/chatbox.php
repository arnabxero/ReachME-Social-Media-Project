<?php
class startchat
{
    public $name;
    public $pic;
    public $status;
    public $uid;

    function beging_chat()
    {
        session_start();
        include('../include/connection.php');

        $user_id = mysqli_real_escape_string($con, $_GET['user_id']);
        $this->uid = $user_id;
        $sql = mysqli_query($con, "SELECT * FROM users WHERE id = {$user_id}");
        if (mysqli_num_rows($sql) > 0) {
            $row = mysqli_fetch_assoc($sql);

            $this->name = $row['fname'] . " " . $row['lname'];

            $this->status = $row['status'];
            $cheakpic;
            if ($row['pro_pic'] != NULL) {
                $cheakpic = $row['pro_pic'];
            } else {
                $cheakpic = 'default.jpg';
            }
            $this->pic = $cheakpic;
        } else {
            //header("location: chat.php");
        }
    }
    function clear_chat()
    {


        if (isset($_SESSION['logid'])) {
            include('../include/connection.php');
            $sender_id = $_SESSION['logid'];
            $receiver_id = mysqli_real_escape_string($con, $_GET['user_id']);


            $sql3 = "DELETE FROM `messages` WHERE  `receiver` = $receiver_id, `sender` = $sender_id ";
            $result = mysqli_query($con, $sql3);
        } else {
            //header("location: ../login.php");
        }
    }
}



$st_chat = new startchat();
$st_chat->beging_chat();

if (isset($_POST['Clear'])) {
    $st_chat->clear_chat();
}

include('chatbackend.php');

if (isset($_POST['Dark'])) {
    $color = 'background-color: #333';
}

if (isset($_POST['back'])) {
    header("location: chat.php");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="assets/fontawesome/css/all.css">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css?v=<?php echo time(); ?>">
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
            max-width: 1000px;
            max-height: 700px;
            width: 100%;
            height: 100%;
            border-radius: 16px;
            box-shadow: 0 0 128px 0 rgba(0, 0, 0, 0.1), 0 32px 64px -48px rgba(0, 0, 0, 0.5);
            margin: 100px auto;
            margin-top: 20px;
        }

        .chat-area header {
            display: flex;
            align-items: center;
            padding: 18px 30px;
        }

        .chat-area header .back-icon {
            color: #333;
            font-size: 18px;
        }

        .chat-area header .content {
            display: flex;
            align-items: center;
            width: 850px;
        }


        .chat-area header img {
            height: 45px;
            width: 45px;
            margin: 0 15px;
        }

        .chat-area header .details span {
            font-size: 17px;
            font-weight: 500;
        }

        .chat-area header .logout {
            display: block;
            background: #333;
            color: #fff;
            outline: none;
            border: none;
            padding: 7px 15px;
            align-content: flex-end;
            text-decoration: none;
            border-radius: 5px;
            font-size: 17px;
        }

        .chat-box {
            position: relative;
            min-height: 500px;
            max-height: 500px;
            overflow-y: auto;
            padding: 10px 30px 20px 30px;
            background: #f7f7f7;
            box-shadow: inset 0 32px 32px -32px rgb(0 0 0 / 5%),
                inset 0 -32px 32px -32px rgb(0 0 0 / 5%);
        }

        .chat-box .text {
            position: absolute;
            top: 45%;
            left: 50%;
            width: calc(100% - 50px);
            text-align: center;
            transform: translate(-50%, -50%);
        }

        .chat-box .chat {
            margin: 15px 0;
        }

        .chat-box .chat p {
            word-wrap: break-word;
            padding: 8px 16px;
            box-shadow: 0 0 32px rgb(0 0 0 / 8%),
                0rem 16px 16px -16px rgb(0 0 0 / 10%);
        }

        .chat-box .outgoing {
            display: flex;
        }

        .chat-box .outgoing .details {
            margin-left: auto;
            max-width: calc(100% - 130px);
        }

        .outgoing .details p {
            background: #333;
            color: #fff;
            border-radius: 18px 18px 0 18px;
        }

        .chat-box .incoming {
            display: flex;
            align-items: flex-end;
        }

        .chat-box .incoming img {
            height: 35px;
            width: 35px;
        }

        .chat-box .incoming .details {
            margin-right: auto;
            margin-left: 10px;
            max-width: calc(100% - 130px);
        }

        .incoming .details p {
            background: #fff;
            color: #333;
            border-radius: 18px 18px 18px 0;
        }

        .typing-area {
            padding: 18px 30px;
            display: flex;
            justify-content: center;
        }

        .typing-area input {
            height: 60px;
            width: 800px;
            font-size: 16px;
            padding: 0 13px;
            border: 1px solid #e6e6e6;
            outline: none;
            border-radius: 5px 0 0 5px;
        }

        .typing-area button {
            color: #fff;
            width: 55px;
            border: none;
            outline: none;
            background: #333;
            font-size: 19px;
            cursor: pointer;
            opacity: 0.7;
            pointer-events: none;
            border-radius: 0 5px 5px 0;
            transition: all 0.3s ease;
        }

        .typing-area button.active {
            opacity: 1;
            pointer-events: auto;
        }

        .typing-area form input[type="submit"] {
            color: #fff;
            width: 10%;
            border: none;
            outline: none;
            background: #333;
            font-size: 19px;
            cursor: pointer;
            opacity: 0.7;
            pointer-events: none;
            border-radius: 0 5px 5px 0;
            transition: all 0.3s ease;
        }


        /* Responive media query */
        @media screen and (max-width: 450px) {

            .form,
            .users {
                padding: 20px;
            }

            .form header {
                text-align: center;
            }


            .form form .name-details {
                flex-direction: column;
            }

            .form .name-details .field:first-child {
                margin-right: 0px;
            }

            .form .name-details .field:last-child {
                margin-left: 0px;
            }

            .users header img {
                height: 45px;
                width: 45px;
            }

            .users header .logout {
                padding: 6px 10px;
                font-size: 16px;
            }

            :is(.users, .users-list) .content .details {
                margin-left: 15px;
            }

            .users-list a {
                padding-right: 10px;
            }

            .chat-area header {
                padding: 15px 20px;
            }

            .chat-box {
                min-height: 400px;
                padding: 10px 15px 15px 20px;
            }

            .chat-box .chat p {
                font-size: 15px;
            }

            .chat-box .outogoing .details {
                max-width: 230px;
            }

            .chat-box .incoming .details {
                max-width: 265px;
            }

            .incoming .details img {
                height: 30px;
                width: 30px;
            }

            .chat-area form {
                padding: 20px;
            }

            .chat-area form input {
                height: 40px;
                width: calc(100% - 48px);
            }

            .chat-area form button {
                width: 45px;
            }
        }
    </style>


</head>


<body style="<?php $color; ?>">

    <div class="wrapper">
        <section class="chat-area">
            <header>

                <a href="users.php" class="back-icon"><i class="fas fa-arrow-left"></i></a>
                <div class="content">
                    <img src="../ext-files/user/<?php echo $st_chat->pic; ?>" alt="">
                    <div class="details">
                        <span><?php echo $st_chat->name; ?></span>
                        <p><?php echo $st_chat->status; ?></p>
                        <!--<form action="#" method="POST">
                        <input type="submit" name="Clear" value="Clear">
                        <input type="submit" name="Dark Mode" value="Dark">
                    </form>-->

                    </div>
                </div>

                <a href="chat.php" class="logout">Back</a>


            </header>
            <div id="refresh">
                <div style="display: flex; flex-direction: column-reverse;" class="chat-box" id=out>
                    <?php echo $chatback->out; ?>

                </div>
            </div>
            <form action="chatback2.php" class="typing-area" method="GET">
                <!--<button type="button" class="emoji-btn"><i class="fas fa-grin"></i> Emojies <i class="fas fa-grin-beam"></i></button>-->
                <input type="text" class="incoming_id" name="incoming_id" value="<?php echo $st_chat->uid; ?>" hidden>
                <input type="text" name="message" class="input-field" placeholder="Type a message here..." autocomplete="off">
                <input type="submit" name="send_msg" value="Send">
                <!--<button><i class="fab fa-telegram-plane"></i></button>-->

            </form>
        </section>
    </div>




</body>
<script src="assets/emoji/vanillaEmojiPicker.js"></script>
<script>
    /*$(document).ready(function(){
        function getData(){
            $.ajax({
                type: 'GET',
                url: 'chatbackend.php',
                success: function(data){
                    $('#out').html(data);
                }
            });
        }
        getData();
        setInterval(function () {
            getData(); 
        }, 500);  // it will refresh your data every 1 sec

    });*/

    new EmojiPicker({
        trigger: [{
            selector: '.emoji-btn',
            insertInto: ['.one', '.two']
        }],
        closeButton: true,
    });
</script>

<script>
    function loadchat() {
        $("#refresh").load(location.href + " #refresh");
    }

    setInterval(function() {
        loadchat()
    }, 1000);
</script>

</html>