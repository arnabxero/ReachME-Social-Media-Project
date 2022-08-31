<?php

session_start();

if($_SESSION["admin"]!="YES"){
    header('Location: ../logreg.php');
}

class admin
{
    public $name;
    public $id;
    public $pic;
    public $ss;
    public $stat;


    function adm()
    {

        include('../include/connection.php');

        $sql = mysqli_query($con, "SELECT * FROM users WHERE id = {$_SESSION['logid']}");
        if (mysqli_num_rows($sql) > 0) {
            $row = mysqli_fetch_assoc($sql);
            $this->name =  $row['fname'] . ' ' . $row['lname'];
            $this->id =  $row['id'];
            $this->stat = $row['status'];
            $cheakpic;
            if ($row['pro_pic'] != NULL) {
                $cheakpic = $row['pro_pic'];
            } else {
                $cheakpic = 'default.jpg';
            }
            $this->pic = $cheakpic;
        }
    }
}



$uchat = new admin();

$uchat->adm();
include('../Admin/user.php');
include('../Admin/verified_list.php');
include('../Admin/approval_queue.php');





?>

<html>

<head>
    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">

    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.1/dist/chart.min.js"></script>
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="../css/admin_style.css?v=<?php echo time(); ?>">


    <link rel="stylesheet" href="../css/style.css?v=<?php echo time(); ?>">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
    <title></title>
    <style>

    </style>
</head>

<body>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <!-- Popper.JS-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!--Bootstrap JS-->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>

    <div class="wrapper">
        <header>

        </header>


        <nav id="sidebar">
            <div class="sidebar-header">
                <h3>Admin</h3>
            </div>

            <ul class="list-unstyled components">
                <p>Dashboard</p>

                <li class="active">
                    <a href="#" id="userlist1">User Graph</a>

                </li>
                <li>
                    <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Verify ID</a>
                    <ul class="collapse list-unstyled" id="homeSubmenu">
                        <li>
                            <a href="#" id="verlist1">Approve ID</a>
                        </li>
                        <li>
                            <a href="#">Verfied ID List</a>
                        </li>
                        <li>
                            <a href="#">Rejected & Removed List</a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Notification</a>
                    <ul class="collapse list-unstyled" id="pageSubmenu">
                        <li>
                            <a href="#">Judgement Token</a>
                        </li>
                        <li>
                            <a href="#">Posts Edit list</a>
                        </li>
                        <li>
                            <a href="#">Super Admin Request</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#modSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Modaretors</a>
                    <ul class="collapse list-unstyled" id="modSubmenu">
                        <li>
                            <a href="#">Modaretors</a>
                        </li>
                        <li>
                            <a href="#">New Modaretor</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#">Edit Admin ID</a>
                </li>
                <li>
                    <a href="#"> Settings</a>
                </li>
                <li>
                    <a href="#"> Logout</a>
                </li>
            </ul>

        </nav>

        <div class="user-list" id="content">
            <nav class="navbar navbar-default" style="position: absolute;">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <button type="button" id="sidebarCollapse" class="navbar-btn">
                            <span></span>
                            <span></span>
                            <span></span>
                        </button>
                    </div>
                    <ul class="nav navbar-nav">




                    </ul>
                </div>
            </nav>
            <div>

            </div>

        </div>

        <div class="users-list" style="display: none;">
            <?php echo $chat->out; ?>
        </div>

        <nav class="ver-list1" id="list" style="display: none;">

        </nav>


        <div class="ver-list" style="display: none; margin-left: -1154px;">

            <?php echo $ver_approve->out ?>

        </div>

        <div class="verified_id" style="display: none;">

            <?php echo $verfied->out ?>

        </div>
        <div class="chart" id="chartlist">
            <div class="box">
                <canvas id="myChart" width="400" height="400"></canvas>
            </div>
            <div class="box">
                <div>
                    <h3 style="padding-left: 150px;">User List</h3>

                </div>
                <div class="users-list" style="display: block;">
                    <?php echo $chat->out; ?>
                </div>
            </div>
            <div class="box">
                <div>
                    <h3 style="padding-left: 120px;"> Verified User List</h3>

                </div>
                <div class="users-list" style="display: block;">
                    <?php echo $verfied->out ?>
                </div>
            </div>
            <div class="box">
                <canvas id="mychart" width="400" height="400"></canvas>
            </div>



        </div>

    </div>


    </div>



</body>
<script>
    $(document).ready(function() {
        $('#sidebarCollapse').on('click', function() {
            $('#sidebar').toggleClass('active');
            $(this).toggleClass('active');
        });
        $('#userlist1').click(function() {
            $('.ver-list').hide();
            $('.ver-list1').hide();
            $('.chart').toggle("slide");
        });

        $('#verlist1').click(function() {
            $('.chart').hide();
            $('.ver-list').toggle("slide");
        });
        $('#verlist1').click(function() {
            $('.chart').hide();
            $('.ver-list1').toggle("slide");
        });
    });
</script>
<script>
    var x = <?php echo $chat->count; ?>;
    var y = <?php echo $verfied->count ?>;
    const ctx = document.getElementById('myChart').getContext('2d');
    const myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Users', 'Verified Users'],
            datasets: [{
                label: '# of Votes',
                data: [x, y],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',

                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',

                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
<script>
    var x = <?php echo $chat->count; ?>;
    var y = <?php echo $verfied->count ?>;
    const rtx = document.getElementById('mychart').getContext('2d');
    const mychart = new Chart(rtx, {
        type: 'doughnut',
        data: {
            labels: [
                'Users',
                'Verified Users'
            ],
            datasets: [{
                label: 'My First Dataset',
                data: [x, y],
                backgroundColor: [
                    'rgb(255, 99, 132)',
                    'rgb(54, 162, 235)'

                ],
                hoverOffset: 4
            }]
        },
    });
</script>


</html>