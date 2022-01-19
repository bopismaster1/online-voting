<?php
session_start();
include_once "connect.php";

if (isset($_SESSION["supervisorId"])) {
} else {
    //logout user
    header("location:login.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui" />
    <title>Lexa - Responsive Bootstrap 4 Admin Dashboard</title>
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
                        <h4 class="page-title">Dashboard</h4>
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
        <?php include_once "admin-nav-bar.php"; ?>
        <!-- end navbar-custom -->
    </header>>
    <!-- End Navigation Bar-->

    <div class="wrapper">
        <div class="container-fluid"></div>

        <div class="row justify-content-center">
            <div class="col-2">
                <div class="card">
                    <div class="card-body">
                        <h5><i class="ti-settings"></i> Settings</h5>
                        <br>
                        <h6 onclick="loadXMLDoc('settings')"><i class="fas fa-user-edit"></i> Edit Profile</h6>
                        <hr>
                        <h6 onclick="loadXMLDoc('addSupervisor')"><i class="fas fa-user-plus"></i> Add Supervisor</h6>
                        <hr>
                        <h6 onclick="loadXMLDoc('date')"><i class="mdi mdi-calendar-clock"></i> Set Voting Date</h6>
                    </div>
                </div>
            </div>
            <div class="col-7">
                <div class="card">
                    <div class="card-body" id="returnBody">
                        <div style='display: flex;justify-content: center;'> <img src="assets/images/ccs.jpg" height="300px" width="300px" alt="ccs-log"></div>
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
    function loadXMLDoc(functionName) {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("returnBody").innerHTML =
                    this.responseText;
            }
        };
        xhttp.open("GET", "admin-setting-function?function=" + functionName, true);
        xhttp.send();
    }

    function updateProfile() {
        var fd = new FormData();
        var firstname = $("#firstName").val();
        var lastName = $("#lastName").val();
        var oldPassword = $("#oldPassword").val();
        var newPassword = $("#newPassword").val();


        if (oldPassword != "") {
            fd.append("oldPassword", oldPassword);
            fd.append("newPassword", newPassword);
        }

        if (firstname != "" && lastName != "") {
            fd.append("firstName", firstname);
            fd.append("lastName", lastName);
            $.ajax({
                url: "admin-setting-function.php",
                type: "POST",
                data: fd,
                contentType: false,
                processData: false,
                success: function(response) {
                    console.log(response);
                    var result = $.trim(response);
                    if (result === "success") {
                        // $("#pageloader").fadeOut();
                        // swal("Success!", "Login successfull. Please wait for redirection!", "success");
                        $("#pageloader").fadeOut();
                        swal("Successful update", "User profile has been updated (auto reload)", "success");
                        // location.reload();
                        setTimeout(function() {
                            location.reload()
                        }, 2000);
                        console.log("Error: " + result);
                    } else if (result === "wrong") {

                        swal("Update Failed!", "Invalid old password!", "error");

                    } else {
                        console.log("Error: " + result);
                    }
                },
                error: function(xhr, status, error) {
                    $("#pageloader").fadeOut();
                    alert(error.responseTextss);
                },
            });
        }

    }

    function createUser() {
        var fd = new FormData();
        var adminFirstName = $("#adminFirstname").val();
        var adminLastName = $("#adminLastName").val();
        var adminEmail = $("#adminEmail").val();
        var adminNumber = $("#adminNumber").val();

        var testEmail = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
        if (testEmail.test(adminEmail)) {}
        // Do whatever if it passes.
        else {
            swal("Error", "Email required!", "error");
            return;
        }
        if (adminFirstName != "" && adminLastName != "" && adminEmail != "" && adminNumber != "") {
            fd.append("adminFirstName", adminFirstName);
            fd.append("adminLastName", adminLastName);
            fd.append("adminEmail", adminEmail);
            fd.append("adminNumber", adminNumber);
            $.ajax({
                url: "admin-setting-function.php",
                type: "POST",
                data: fd,
                contentType: false,
                processData: false,
                success: function(response) {
                    console.log(response);
                    var result = $.trim(response);
                    if (result === "success") {
                        // $("#pageloader").fadeOut();
                        // swal("Success!", "Login successfull. Please wait for redirection!", "success");
                        $("#pageloader").fadeOut();
                        swal("User Created", "user has been registered", "success");
                        // location.reload();
                        setTimeout(function() {
                            location.reload()
                        }, 2000);
                        console.log("Error: " + result);
                    } else if (result === "wrong") {

                        swal("Faile to create user!", "Unable to add user", "error");

                    } else {
                        console.log("Error: " + result);
                    }
                },
                error: function(xhr, status, error) {
                    $("#pageloader").fadeOut();
                    alert(error.responseTextss);
                },
            });

        }
    }

    function setVotingDate() {
        var startDate = $("#startdate").val();
        var endDate = $("#endDate").val();
        console.log(endDate);
        if (endDate == "" || startDate == "") {
            swal("Please fill up all fields!", "Please fill up all fields!", "error");
            return
        }
        var fd = new FormData();
        fd.append("startDate", startDate);
        fd.append("endDate", endDate);
        $.ajax({
            url: "admin-setting-function.php",
            type: "POST",
            data: fd,
            contentType: false,
            processData: false,
            success: function(response) {
                console.log(response);
                var result = $.trim(response);
                if (result === "success") {
                    // $("#pageloader").fadeOut();
                    // swal("Success!", "Login successfull. Please wait for redirection!", "success");
                    $("#pageloader").fadeOut();
                    swal("Successful update", "User profile has been updated (auto reload)", "success");
                    // location.reload();
                    setTimeout(function() {
                        location.reload()
                    }, 2000);
                    console.log("Error: " + result);
                } else if (result === "wrong") {

                    swal("Update Failed!", "Invalid old password!", "error");

                } else {
                    console.log("Error: " + result);
                }
            },
            error: function(xhr, status, error) {
                $("#pageloader").fadeOut();
                alert(error.responseTextss);
            },
        });
    }
</script>