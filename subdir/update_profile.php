<?php
include('../include/connection.php');
session_start();

class edit_profile
{
    
    function filter_sql_injection($var)
    {
        include('../include/connection.php');

        $return_var = $var;

        $return_var = stripcslashes($var);

        $return_var = mysqli_real_escape_string($con, $return_var);
        echo $var;

        return $return_var;
    }

    function updating()
    {

        include('../include/connection.php');

        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $uname = $_POST['uname'];
        $phone = $_POST['mobile'];
        $address = $_POST['add'];
        $job = $_POST['job'];
        $dob = $_POST['dob'];
        $religion = $_POST['rel'];
        $language = $_POST['lan'];
        $nationality = $_POST['nat'];
        $politics = $_POST['pol'];
        $relation = $_POST['relation'];
        $blood = $_POST['blood'];
        $gen = $_POST['gen'];
        $sports = $_POST['sports'];
        $hobby = $_POST['hobby'];
        $bio = $_POST['about'];


        $fname = $this->filter_sql_injection($fname);
        $lname = $this->filter_sql_injection($lname);
        $uname = $this->filter_sql_injection($uname);
        $phone = $this->filter_sql_injection($phone);
        $address  = $this->filter_sql_injection($address);
        $job  = $this->filter_sql_injection($job);
        $dob  = $this->filter_sql_injection($dob);
        $religion  = $this->filter_sql_injection($religion);
        $language  = $this->filter_sql_injection($language);
        $nationality  = $this->filter_sql_injection($nationality);
        $politics  = $this->filter_sql_injection($politics);
        $relation  = $this->filter_sql_injection($relation);
        $blood  = $this->filter_sql_injection($blood);
        $gen  = $this->filter_sql_injection($gen);
        $sports  = $this->filter_sql_injection($sports);
        $hobby  = $this->filter_sql_injection($hobby);
        $bio  = $this->filter_sql_injection($bio);



        $loguser = $_SESSION["logUname"];
        $logemail = $_SESSION["logEmail"];



        $sql1 = "UPDATE users SET fname = '$fname', lname = '$lname', uname = '$uname',
                                    phone = '$phone', address = '$address', job = '$job',
                                    date_of_birth = '$dob', religion = '$religion',
                                    language = '$language', nation = '$nationality',
                                    politics = '$politics', relation = '$relation',
                                    blood = '$blood', gender = '$gen',
                                    sports = '$sports', hobby = '$hobby',
                                    about = '$bio' WHERE uname = '$loguser' AND email = '$logemail'";

        $res = mysqli_query($con, $sql1);

        if ($res) {
            header('Location: success.php');
        } else {
            header('Location: failed.php');
        }
    }
}


if (isset($_SESSION['logid'])) {

    if (isset($_POST['submit'])) {

        $edit_profile = new edit_profile();
        $edit_profile->updating();

        header("Location: ../profile.php");
    }
} else {
    header('Location: ../logreg.php');
}
