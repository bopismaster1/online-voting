<?php
session_start();
include_once "connect.php";

if (isset($_SESSION["supervisorId"])) {
} else {
    //logout user
    header("location:login.php");
}
$sql = "select Count(*) as studentCount from studentlist";
$studentCount = select_info_multiple_key($sql);
$sql = "select Count(*) as registered from user where accountType='student'";
$registered = select_info_multiple_key($sql);
$sql = "select Count(*) as cc from candidates where status='active'";
$cc = select_info_multiple_key($sql);
$sql = "select * from votingDate";
$vd = select_info_multiple_key($sql);
$sql = "SELECT candidateId, COUNT(*) as 'voteCount' FROM votes GROUP BY candidateId";
$voteCountResult = select_info_multiple_key($sql);
$sql = "Select * from candidates";
$CandidateList = select_info_multiple_key($sql);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui" />
    <title>SBO - Online Voting Dashboard</title>
    <meta content="Admin Dashboard" name="description" />
    <meta content="Themesbrand" name="author" />
    <link rel="shortcut icon" href="assets/images/favicon.ico" />

    <link rel="stylesheet" href="../plugins/morris/morris.css" />

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
    </header>
    <!-- End Navigation Bar-->

    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-3 col-md-6">
                    <div class="card mini-stat bg-primary">
                        <div class="card-body mini-stat-img">
                            <div class="mini-stat-icon">
                                <i class="mdi mdi-cube-outline float-right"></i>
                            </div>
                            <div class="text-white">
                                <h6 class="text-uppercase mb-3">Students</h6>
                                <h4 class="mb-4"><?php echo $studentCount[0]["studentCount"]; ?></h4>
                                <br>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card mini-stat bg-primary">
                        <div class="card-body mini-stat-img">
                            <div class="mini-stat-icon">
                                <i class="mdi mdi-buffer float-right"></i>
                            </div>
                            <div class="text-white">
                                <h6 class="text-uppercase mb-3">Registered </h6>
                                <h4 class="mb-4"><?php echo $registered[0]["registered"]; ?></h4>
                                <br>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card mini-stat bg-primary">
                        <div class="card-body mini-stat-img">
                            <div class="mini-stat-icon">
                                <i class="mdi mdi-tag-text-outline float-right"></i>
                            </div>
                            <div class="text-white">
                                <h6 class="text-uppercase mb-3">Candidates</h6>
                                <h4 class="mb-4"><?php echo $cc[0]["cc"]; ?></h4>
                                <br>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card mini-stat bg-primary">
                        <div class="card-body mini-stat-img">
                            <div class="mini-stat-icon">
                                <i class="mdi mdi-briefcase-check float-right"></i>
                            </div>
                            <div class="text-white">
                                <h6 class="text-uppercase mb-3">Voting date</h6>
                                <h5 class="mb-4"><?php
                                                    $date_time = new DateTime($vd[0]["startDate"]);
                                                    $formated_date = $date_time->format('d/m/y H:i');
                                                    $date_time2 = new DateTime($vd[0]["endDate"]);
                                                    $formated_date2 = $date_time2->format('d/m/y H:i');
                                                    echo  $formated_date . " to " . $formated_date2; ?></h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->
            <div class="row">
                <div class="col-12">
                    <div class="card">

                        <div class="card-body" id="reportBody">
                            <div class="form-group row">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Category</label>
                                <div class="col-sm-10">
                                    <select class="form-control" id="category" onchange="selector()">
                                        <option>Select Position</option>
                                        <option>Provincial</option>
                                        <option>Municipal</option>
                                    </select>
                                </div>
                            </div>
                            <?php
                            $sql = "select * from positions";
                            $res   = select_info_multiple_key($sql);
                            $resPosition = [];
                            foreach ($res as $row) {
                                $temp = array("position" => $row["position"], "categ" => $row["type"], "id" => $row["id"]);
                                array_push($resPosition, $temp);
                            }
                            ?> <div class="form-group row">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Running for</label>
                                <div class="col-sm-10">
                                    <select class="form-control" id="position" onchange="updateReport()">
                                        <option>Select Position</option>
                                    </select>
                                </div>
                            </div>
                            <canvas id="myChart" height="100px"></canvas>

                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->
        </div>
        <!-- end container-fluid -->
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

    <script src="../plugins/jquery-sparkline/jquery.sparkline.min.js"></script>

    <!--Morris Chart-->
    <script src="plugins/morris/morris.min.js"></script>
    <script src="plugins/raphael/raphael-min.js"></script>
    <script src="assets/pages/dashboard.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.6.0/chart.min.js" integrity="sha512-GMGzUEevhWh8Tc/njS0bDpwgxdCJLQBWG3Z2Ct+JGOpVnEmjvNx6ts4v6A2XJf1HOrtOsfhv3hBKpK9kE5z8AQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- App js -->
    <script src="assets/js/app.js"></script>
</body>

</html>
<script>
    var votesObject = <?php echo json_encode($voteCountResult) ?>;
    var candidateList = <?php echo json_encode($CandidateList) ?>;
    var positionObject = <?php echo json_encode($resPosition) ?>;
    var finalName = [];
    var finalVote = [];
    console.log(positionObject);

    function selector() {
        document.getElementById("position").innerHTML = `<option>Select Position</option>`;
        var category = $("#category").val();
        if (category == "Provincial") {
            for (let x = 0; x < positionObject.length; x++) {
                var currentPosition = positionObject[x];
                if (currentPosition.categ == "provincial") {
                    var list = `<option value="${currentPosition.id}">${currentPosition.position.toLowerCase()}</option>`;
                    document.getElementById("position").innerHTML += list;
                }
            }
        } else if (category == "Municipal") {
            console.log("pasok");
            for (let x = 0; x < positionObject.length; x++) {
                var currentPosition = positionObject[x];
                console.log(currentPosition);
                if (currentPosition.categ == "municipal") {
                    var list = `<option value="${currentPosition.id}">${currentPosition.position.toLowerCase()}</option>`;
                    document.getElementById("position").innerHTML += list;
                }
            }
        }
    }
    // const ctx = document.getElementById('myChart').getContext('2d');
    var varChart = new Chart("myChart", {
        type: 'line',
        data: {
            labels: [],
            datasets: [],
        },
        options: {}
    });

    function updateReport() {
        var posId = $("#position").val();
        var selectedPosition = "";
        var temp = [];
        var name = [];
        var vote = [];
        var kolor = [];
        for (let i = 0; i < positionObject.length; i++) {
            if (positionObject[i].id == posId) {
                selectedPosition = positionObject[i].position
            }
        }
        console.log(selectedPosition);
        //select all candidate belong to position
        // var votesObject = <?php echo json_encode($voteCountResult) ?>;
        // var candidateList = <?php echo json_encode($CandidateList) ?>;
        for (let i = 0; i < candidateList.length; i++) {
            if (candidateList[i].categoryId == posId) {
                var currentcandidate = candidateList[i];
                for (let v = 0; v < votesObject.length; v++) {

                    var currentVote = votesObject[v];
                    if (currentcandidate.id == currentVote.candidateId) {

                        name.push(`${currentcandidate.firstName} ${currentcandidate.lastName}`);
                        vote.push(currentVote.voteCount);
                        const randomNum = () => Math.floor(Math.random() * (235 - 52 + 1) + 52);

                        const randomRGB = `rgb(${randomNum()}, ${randomNum()}, ${randomNum()})`;
                        kolor.push(randomRGB);
                        console.log(randomRGB);

                    }

                }
            }
        }
        finalVote = vote;
        finalName = name;
        console.log(vote);
        console.log(name);
        varChart.destroy();
        varChart = new Chart("myChart", {
            type: 'pie',
            data: {
                labels: name,
                datasets: [{
                    data: vote,
                    backgroundColor: kolor,
                    borderColor: kolor,
                    tension: 0.1
                }],
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: ""
                    }
                }
            }
        });
    }
</script>