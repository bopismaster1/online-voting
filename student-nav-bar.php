<?php
// if (!isset($_SESSION)) {
//     session_start();
// }
// include_once "connect.php";

if (isset($_SESSION["studentId"])) {
} else {
    //logout user
    //header("location:login.php");
    die("wow");
}
?>
<div class="navbar-custom">
    <div class="container-fluid">
        <div id="navigation">
            <!-- Navigation Menu-->
            <ul class="navigation-menu">
                <li class="has-submenu">
                    <a href="student-dashboard">
                        <i class="ti-dashboard"></i></i>
                        <span>HOME</span>
                    </a>
                </li>

                <li class="has-submenu">

                    <a href="student-voting-page"><i class="ti-user"></i></i>Vote!</a>

                </li>




                <!-- <li class="has-submenu">
                    <a href="admin-settings"><i class="ti-settings"></i>Settings</a>

                </li> -->
                <li class="has-submenu">
                    <a href="log-out"><i class="ti-plug"></i>Log out</a>

                </li>
            </ul>
            <!-- End navigation menu -->
        </div>
        <!-- end navigation -->
    </div>
    <!-- end container-fluid -->
</div>