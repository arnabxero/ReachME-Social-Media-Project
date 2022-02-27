








        $slq_pro = "SELECT * FROM users";

$class_result_pro = mysqli_query($this->class_con, $slq_pro);

while ($class_row_pro = mysqli_fetch_assoc($class_result_pro)) {

    $propicid = $class_row_pro['id'];

    $show_or_not = $this->check_friendlist($uid, $propicid);

    $propic_link_prores = $this->get_author_propic($propicid);

    if ($show_or_not) {
        echo '<div class="card-main">
        <a title="View User Profile" class="unformatted-link homepage-poster-name" href="view_user.php?uid=' . $class_row_pro['id'] . '">
            <img class="profile-pic-home-post" src="' . $propic_link_prores . '">
        &nbsp' . $class_row_pro['fname'] . ' ' . $class_row_pro['lname'] . '</a>
    </div>';
    }
}







function check_friendlist($lid, $pid)
    {
        $return_value = false;

        $fsql = "SELECT * FROM friend_list WHERE sid = '$lid' AND rid = '$pid' AND stat = 'a'";
        $fresult = mysqli_query($this->class_con, $fsql);
        $fcount = mysqli_num_rows($fresult);
        if ($fcount > 0) {
            $return_value = true;
        }


        $f2sql = "SELECT * FROM friend_list WHERE sid = '$pid' AND rid = '$lid' AND stat = 'a'";
        $f2result = mysqli_query($this->class_con, $f2sql);
        $f2count = mysqli_num_rows($f2result);
        if ($f2count > 0) {
            $return_value = true;
        }

        return $return_value;
    }

    function get_author_propic($aid)
    {
        $apic = "ext-files/user/default.jpg";

        $asql = "SELECT * FROM users WHERE id = '$aid'";

        $ares = mysqli_query($this->class_con, $asql);

        while ($class_arow = mysqli_fetch_assoc($ares)) {
            if (!(empty($class_arow['pro_pic']))) {
                $apic = "ext-files/user/" . $class_arow['pro_pic'];
            }
        }

        return $apic;
    }