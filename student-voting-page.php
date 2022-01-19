<?php
if (!isset($_SESSION)) {
    session_start();
}
include_once "connect.php";

if (isset($_SESSION["studentId"])) {
} else {
    //logout user
    header("location:login.php");
    echo "ngek";
}
$sql = "select * from positions";
$positions = select_info_multiple_key($sql);
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
        <?php include_once "student-nav-bar.php"; ?>
        <!-- end navbar-custom -->
    </header>>
    <!-- End Navigation Bar-->
    <?php
    $sql = "select * from candidates";
    $studentList = select_info_multiple_key($sql);

    ?>
    <div class="wrapper">
        <div id="submitModal" class="modal" tabindex="-1" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="myModalLabel">Code Authentication</h5>
                        <a type="button" class="btn-close" href="student-dashboard" aria-hidden="true"></a>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label" for="Code-input">Please enter your Voting Authentication Code:</label>
                            <input type="text" class="form-control" id="Code-input">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a class="btn btn-secondary waves-effect" href="student-dashboard">Close</a>
                        <button type="button" class="btn btn-primary waves-effect waves-light" onclick="submitCode()">Cast Vote!</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <div class="container-fluid">
            <h5 id="position" style="text-transform: capitalize;">Position</h5>
            <div class="row justify-content-center" id="displayBody">

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
    var candidateList = <?php echo json_encode($studentList); ?>;
    var positions = <?php echo json_encode($positions); ?>;
    var nextPosition = 0;
    var vote = [];
    console.log(candidateList);

    function displayCandidates(posId, candId) {
        if (positions.length > posId) {
            var pos = positions[posId].position;
            var categ = positions[posId].type;
            var mayLaman = false;
            document.getElementById("displayBody").innerHTML = "";


            if (posId != 0) {
                vote.push(candId);
            }
            nextPosition += 1;
            $("#position").text(`Position: ${pos}`);




            for (var i = 0; i < candidateList.length; i++) {
                if (candidateList[i].runningFor == pos && candidateList[i].category == categ) {
                    mayLaman = true;
                    var list = `<div class="col-4">
                    <div class="card">
                        <div class="card-body">
                            <center>
                                <img src="${candidateList[i].picturePath}" alt="Cat" class="wdn-stretch" style="border-radius: 50px;" height="100px">
                                <h4 style="text-transform: capitalize;">${candidateList[i].firstName} ${candidateList[i].lastName}</h4>
                                <p style="margin: 0;text-transform: capitalize;">${pos}</p>
                                <button type="button" class="btn btn-primary btn-sm waves-effect" onclick='displayCandidates(${nextPosition},${candidateList[i].id})'>Select</button>
                            </center>
                        </div>
                    </div>
                </div>`;
                    document.getElementById("displayBody").innerHTML += list;
                }
            }



            if (!mayLaman) {
                // document.getElementById("displayBody").innerHTML += "Ilabas na dito ung submit vote";
                // console.log("toggle modal");
                $("#submitModal").modal("toggle");
            }
        } else {
            $("#submitModal").modal("toggle");
        }
    }

    function submitCode() {
        var code = $("#Code-input").val();
        var fd = new FormData;
        // console.log(code);
        // console.log(vote);
        fd.append("code", code);
        fd.append("voteList", JSON.stringify(vote));
        $.ajax({
            url: "casting-vote.php",
            type: "POST",
            data: fd,
            contentType: false,
            processData: false,
            success: function(response) {
                // console.log(response);
                var result = $.trim(response);
                if (result === "success") {
                    // $("#pageloader").fadeOut();
                    // swal("Success!", "Login successfull. Please wait for redirection!", "success");
                    $("#pageloader").fadeOut();
                    swal("Success", "Your vote has been casted!", "success");
                } else {
                    if (result == "used") {
                        swal("Oops", "You can only vote once.", "info");
                    } else if (result == "invalid-code") {
                        swal("Invalid Code", "You enter the wrong code. Please check the SMS you received", "error");
                    } else if (result == "too-early") {
                        swal("Oops", "Your too early to vote. please come back later", "info");
                    } else if (result == "too-late") {
                        swal("Oops", "Your too late. Voting already ended. Your vote is not counted", "info");
                    }
                }
            },
            error: function(xhr, status, error) {
                $("#pageloader").fadeOut();
                alert(error.responseTextss);
            },
        });
    }

    window.onload = displayCandidates(0, 0);
</script>