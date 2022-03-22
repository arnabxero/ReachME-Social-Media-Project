<?php
class chatting{

    public $out_going_msg;
    public $in_coming_msg;
    public $out;

    function get_msg(){
        //session_start();

        if (isset($_SESSION['logid'])) {

            include('../include/connection.php');

            $sender_id = $_SESSION['logid'];
            //$_POST['incoming_id']
            $receiver_id = mysqli_real_escape_string($con, $_GET['user_id'] );
            $output = "";
            $sql = "SELECT * FROM messages LEFT JOIN users ON users.id = messages.sender WHERE (sender = '$sender_id' AND receiver = '$receiver_id') OR (sender = '$receiver_id' AND receiver = '$sender_id') ORDER BY msg_id DESC";
            $query = mysqli_query($con, $sql);

            if (mysqli_num_rows($query) > 0) {
                while ($row = mysqli_fetch_assoc($query)) {
                    if ($row['sender'] === $sender_id) {
                        
                        $output .= '<div class="chat outgoing">
                                <div class="details">
                                    <p>' . $row['msg'] . '</p>
                                </div>
                                </div>';
                    } else {
                        $cheakpic;
                        if($row['pro_pic']!=NULL){
                            $cheakpic = $row['pro_pic'];
                        }else{
                            $cheakpic = 'default.jpg';
                        } 
                        $output .= '<div class="chat incoming">
                                <img src="../ext-files/user/' . $cheakpic . '" alt="">
                                <div class="details">
                                    <p>' . $row['msg'] . '</p>
                                </div>
                                </div>';
                    }
                }
            } else {
                $output .= '<div class="text">No messages are available. Once you send message they will appear here.</div>';
            }
           $this->out = $output;
          
        } else {
            header("location: ../chat/chat.php");
        }


    }



    
}
$chatback = new chatting();
$chatback->get_msg();


?>