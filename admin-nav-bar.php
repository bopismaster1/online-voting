<?php
if (!isset($_SESSION)) {
    session_start();
}
include_once "connect.php";

if (isset($_SESSION["supervisorId"])) {
} else {
    //logout user
    header("location:login.php");
}
?>
<div class="navbar-custom">
    <div class="container-fluid">
        <div id="navigation">
            <!-- Navigation Menu-->
            <ul class="navigation-menu">
                <li class="has-submenu">
                    <a href="admin-dashboard">
                        <i class="ti-dashboard"></i></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li class="has-submenu">

                    <a href="admin-add-candidates"><i class="ti-user"></i></i> Candidates</a>
                    <!-- <ul class="submenu">
                        <li><a href="email-inbox.html">Inbox</a></li>
                        <li><a href="email-read.html">Email Read</a></li>
                        <li><a href="email-compose.html">Email Compose</a></li>
                    </ul> -->
                </li>

                <li class="has-submenu">
                    <a href="add-partylist"><i class="ti-flag-alt"></i>Add Partylist</a>
                    <!-- <ul class="submenu megamenu">
                        <li>
                            <ul>
                                <li><a href="ui-alerts.html">Alerts</a></li>
                                <li><a href="ui-buttons.html">Buttons</a></li>
                                <li><a href="ui-badge.html">Badge</a></li>
                                <li><a href="ui-cards.html">Cards</a></li>
                                <li><a href="ui-carousel.html">Carousel</a></li>
                                <li><a href="ui-dropdowns.html">Dropdowns</a></li>
                            </ul>
                        </li>
                        <li>
                            <ul>
                                <li><a href="ui-grid.html">Grid</a></li>
                                <li><a href="ui-images.html">Images</a></li>
                                <li><a href="ui-lightbox.html">Lightbox</a></li>
                                <li><a href="ui-modals.html">Modals</a></li>
                                <li><a href="ui-pagination.html">Pagination</a></li>
                                <li><a href="ui-popover-tooltips.html">Popover & Tooltips</a></li>
                            </ul>
                        </li>
                        <li>
                            <ul>
                                <li><a href="ui-progressbars.html">Progress Bars</a></li>
                                <li><a href="ui-sweet-alert.html">Sweet-Alert</a></li>
                                <li><a href="ui-tabs-accordions.html">Tabs &amp; Accordions</a></li>
                                <li><a href="ui-typography.html">Typography</a></li>
                                <li><a href="ui-video.html">Video</a></li>
                            </ul>
                        </li>
                    </ul> -->
                </li>



                <!-- <li class="has-submenu">
                    <a href="#"><i class="ti-menu-alt"></i>More</a>
                    <ul class="submenu">
                        <li>
                            <a href="calendar.html">Calendar</a>
                        </li>
                        <li class="has-submenu">
                            <a href="#">Icons</a>
                            <ul class="submenu">
                                <li><a href="icons-material.html">Material Design</a></li>
                                <li><a href="icons-ion.html">Ion Icons</a></li>
                                <li><a href="icons-fontawesome.html">Font Awesome</a></li>
                                <li><a href="icons-themify.html">Themify Icons</a></li>
                                <li><a href="icons-dripicons.html">Dripicons</a></li>
                                <li><a href="icons-typicons.html">Typicons Icons</a></li>
                            </ul>
                        </li>
                        <li class="has-submenu">
                            <a href="#">Tables </a>
                            <ul class="submenu">
                                <li><a href="tables-basic.html">Basic Tables</a></li>
                                <li><a href="tables-datatable.html">Data Table</a></li>
                                <li><a href="tables-responsive.html">Responsive Table</a></li>
                                <li><a href="tables-editable.html">Editable Table</a></li>
                            </ul>
                        </li>
                        <li class="has-submenu">
                            <a href="#">Maps</a>
                            <ul class="submenu">
                                <li><a href="maps-google.html"> Google Map</a></li>
                                <li><a href="maps-vector.html"> Vector Map</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="rangeslider.html">Range Slider</a>
                        </li>
                        <li>
                            <a href="session-timeout.html">Session Timeout</a>
                        </li>
                    </ul>
                </li>

                <li class="has-submenu">
                    <a href="#"><i class="ti-pie-chart"></i>Charts</a>
                    <ul class="submenu">
                        <li><a href="charts-morris.html">Morris Chart</a></li>
                        <li><a href="charts-chartist.html">Chartist Chart</a></li>
                        <li><a href="charts-chartjs.html">Chartjs Chart</a></li>
                        <li><a href="charts-flot.html">Flot Chart</a></li>
                        <li><a href="charts-c3.html">C3 Chart</a></li>
                        <li><a href="charts-other.html">Jquery Knob Chart</a></li>
                    </ul>
                </li> -->
                <li class="has-submenu">
                    <a href="admin-settings"><i class="ti-settings"></i>Settings</a>

                </li>
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