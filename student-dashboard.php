<?php
session_start();
include_once "connect.php";

if (isset($_SESSION["studentId"])) {
} else {
    //logout user
    header("location:login.php");
}

$sql = "select * from votingdate where id=1";
$votingres = select_info_multiple_key($sql);

$startDate = $votingres[0]["startDate"];
$endDate = $votingres[0]["endDate"];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui" />
    <title>Online Voting - SBO</title>
    <meta content="Admin Dashboard" name="description" />
    <meta content="Themesbrand" name="author" />
    <link rel="shortcut icon" href="assets/images/favicon.ico" />

    <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/icons.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/style.css" rel="stylesheet" type="text/css" />
</head>

<body>
    <!-- Navigation Bar-->
    <header id="topnav">
        <div class="topbar-main">
            <div class="container-fluid">
                <!-- Logo container-->
                <div class="logo">
                    <a href="index.html" class="logo">
                        <img src="assets/images/logo-sm.png" alt="" class="logo-small" />
                        <img src="assets/images/logo.png" alt="" class="logo-large" />
                    </a>
                </div>
                <!-- End Logo container-->

                <div class="menu-extras topbar-custom">
                    <ul class="float-right list-unstyled mb-0">



                        <li class="menu-item">
                            <!-- Mobile menu toggle-->
                            <a class="navbar-toggle nav-link" id="mobileToggle">
                                <div class="lines">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </div>
                            </a>
                            <!-- End mobile menu toggle-->
                        </li>
                    </ul>
                </div>
                <!-- end menu-extras -->

                <div class="clearfix"></div>
            </div>
            <!-- end container -->
        </div>
        <!-- end topbar-main -->

        <div class="container-fluid">
            <!-- Page-Title -->
            <div class="row">
                <div class="col-sm-12">

                    <div class="page-title-box">
                        <h4 class="page-title">Dashboard </h4>

                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active">Welcome to SB O- Online Voting Dashboard</li>
                        </ol>
                        <!-- <div class="state-information">
                            <div class="state-graph">
                                <div id="header-chart-1"></div>
                                <div class="info">Balance $ 2,317</div>
                            </div>
                            <div class="state-graph">
                                <div id="header-chart-2"></div>
                                <div class="info">Item Sold 1230</div>
                            </div>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>

        <!-- MENU Start -->
        <?php include "student-nav-bar.php"; ?>
        <!-- end navbar-custom -->
    </header>>
    <!-- End Navigation Bar-->

    <div class="wrapper">
        <div class="container-fluid"></div>
        <div class="row justify-content-center">
            <div class="col-11">
                <div class="card">
                    <div class="card-body">
                        <div style='display: flex;justify-content: center;'>
                            <h4 class="page-title float-right" id="timer" style="color: red;">00:00:00</h4>
                        </div>
                        <div style='display: flex;justify-content: center;'>


                            <h5>CCS Online Voting System!</h5>
                        </div>
                        <div style='display: flex;justify-content: center;'>

                            <img src="assets/images/ccs.jpg" height="300px" width="300px" alt="ccs-log">
                        </div>
                        <div style='display: flex;justify-content: center;'>
                            <h5 style="color:#f79bbd">Vote using your mobile device or Computer</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end container -->
    </div>
    <!-- end wrapper -->

    <!-- Footer -->
    <footer class="footer">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <p>Online-Voting</p>
                </div>
            </div>
        </div>
    </footer>
    <!-- End Footer -->

    <!-- jQuery  -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/jquery.slimscroll.js"></script>
    <script src="assets/js/waves.min.js"></script>

    <script src="plugins/jquery-sparkline/jquery.sparkline.min.js"></script>

    <!-- App js -->
    <script src="assets/js/app.js"></script>
    <!-- sweet alert -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</body>

</html>

<script>
    console.log(new Date("<?= $startDate ?>"));

    function timer() {

        if (new Date() > new Date("<?= $startDate ?>")) {
            // Set the date we're counting down to
            var countDownDate = new Date(new Date("<?= $endDate ?>")).getTime();

            // Update the count down every 1 second
            var x = setInterval(function() {

                // Get today's date and time
                var now = new Date().getTime();

                // Find the distance between now and the count down date
                var distance = countDownDate - now;

                // Time calculations for days, hours, minutes and seconds
                var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                var seconds = Math.floor((distance % (1000 * 60)) / 1000);

                // Display the result in the element with id="demo"
                document.getElementById("timer").innerHTML = days + "d " + hours + "h " +
                    minutes + "m " + seconds + "s Remaining";

                // If the count down is finished, write some text
                if (distance < 0) {
                    clearInterval(x);
                    document.getElementById("timer").innerHTML = "EXPIRED";
                }
            }, 1000);
        } else {
            // Set the date we're counting down to
            var countDownDate = new Date(new Date("<?= $startDate ?>")).getTime();

            // Update the count down every 1 second
            var x = setInterval(function() {

                // Get today's date and time
                var now = new Date().getTime();

                // Find the distance between now and the count down date
                var distance = countDownDate - now;

                // Time calculations for days, hours, minutes and seconds
                var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                var seconds = Math.floor((distance % (1000 * 60)) / 1000);

                // Display the result in the element with id="demo"
                document.getElementById("timer").innerHTML = days + "d " + hours + "h " +
                    minutes + "m " + seconds + "s To go";

                // If the count down is finished, write some text
                if (distance < 0) {
                    clearInterval(x);
                    document.getElementById("timer").innerHTML = "Voting time is over.";
                }
            }, 1000);
        }

    }
    window.onload = timer;
</script>