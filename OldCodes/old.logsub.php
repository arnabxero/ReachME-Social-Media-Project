<?php

include('../include/connection.php');
session_start();

if (isset($_POST['submit'])) {
    $emailusername = $_POST['emailusername'];
    $password = $_POST['pass'];

    $emailusername = stripcslashes($emailusername);
    $password = stripcslashes($password);
    $emailusername = mysqli_real_escape_string($con, $emailusername);
    $password = mysqli_real_escape_string($con, $password);


    $sql = "SELECT * FROM users WHERE uname = '$emailusername' or email = '$emailusername' and pass = '$password'";

    $result = mysqli_query($con, $sql);

    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

    $count = mysqli_num_rows($result);

    if ($count == 1) {
        $_SESSION["logid"] = $row['id'];
        $_SESSION["logname"] = $row['fname'] . ' ' . $row['lname'];
        echo "<h1> Login Successful<br>Loading Your Profile</h1>";
        header('Location: ../index.php');
    } else {
        echo "<h1> Login failed<br>Invalid username or password<br>Please Try Again</h1>";
    }
}

?>
