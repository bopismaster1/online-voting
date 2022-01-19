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
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h5>Add Candidate</h5>
                            <p>(Click <a href="admin-view-candidates" style="color:pink">here</a> to view list of Candidates)</p>
                            <form>
                                <div style="display: flex;justify-content: center;"><img class="rounded-circle" height="200px" width="200px" alt="200x200" id="imagesPreview" src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/ac/No_image_available.svg/1024px-No_image_available.svg.png" data-holder-rendered="true"></div>

                                <div class="form-group row">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Select Images</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="file" id="images" onchange="PreviewImage()">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">I.D Number</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="number" id="idNumber">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Partylist</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" id="partylist">
                                            <option>Independent</option>

                                            <?php
                                            $sql = "select * from partylist where active='1'";
                                            $res = select_info_multiple_key($sql);

                                            foreach ($res as $row) {
                                                echo "<option>" . $row["partyListName"] . "</option>";
                                            }
                                            ?>

                                        </select>
                                    </div>
                                </div>
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
                                    $temp = array("position" => $row["position"], "categ" => $row["type"]);
                                    array_push($resPosition, $temp);
                                }
                                ?> <div class="form-group row">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Running for</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" id="position">
                                            <option>Select Position</option>
                                        </select>
                                    </div>
                                </div>

                                <button type="button" class="btn btn-primary btn-lg btn-block waves-effect waves-light" onclick="addCadidate()">Add Cadidate</button>
                            </form>
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
    var obj = <?php echo json_encode($resPosition) ?>;
    console.log(obj);

    function selector() {
        document.getElementById("position").innerHTML = `<option>Select Position</option>`;
        var category = $("#category").val();
        if (category == "Provincial") {
            console.log("pasok");
            for (let x = 0; x < obj.length; x++) {
                var currentPosition = obj[x];
                console.log(currentPosition);
                console.log(currentPosition.categ + " == provincial ");
                if (currentPosition.categ == "provincial") {
                    var list = `<option>${currentPosition.position.toLowerCase()}</option>`;
                    document.getElementById("position").innerHTML += list;
                }
            }
        } else if (category == "Municipal") {
            console.log("pasok");
            for (let x = 0; x < obj.length; x++) {
                var currentPosition = obj[x];
                console.log(currentPosition);
                console.log(currentPosition.categ + " == provincial");
                if (currentPosition.categ == "municipal") {
                    var list = `<option>${currentPosition.position.toLowerCase()}</option>`;
                    document.getElementById("position").innerHTML += list;
                }
            }
        }
    }

    function PreviewImage() {
        var oFReader = new FileReader();

        oFReader.readAsDataURL(document.getElementById("images").files[0]);

        oFReader.onload = function(oFREvent) {
            document.getElementById("imagesPreview").src = oFREvent.target.result;
        };

    };

    function addCadidate() {
        var idNumber = $("#idNumber").val();
        var partylist = $("#partylist").val();
        var runningFor = $("#position").val();
        var category = $("#category").val();
        var files = $("#images")[0].files;
        // console.log(idNumber);
        // console.log(firstName);
        // console.log(lastName);
        // console.log(runningFor);
        // console.log(category);
        console.log(files);
        // return
        if (files.length > 0 && idNumber != "" && runningFor != "" && runningFor != "" && partylist != "" && category != "") {
            var fd = new FormData();
            fd.append("idNumber", idNumber);
            fd.append("runningFor", runningFor);
            fd.append("partylist", partylist);
            fd.append("category", category);
            fd.append("files", files[0]);
            $.ajax({
                url: "admin-add-candidates-function.php",
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
                        swal("Candidates added", "Candidates has been added to the list", "success");
                        console.log("Error: " + result);
                    } else {
                        if (result === "student is registered") {
                            swal("Failed to add candidate", "Failed to add  Candidates into the list. user is already registered as candidate", "error");
                            console.log("Error: " + result);
                        }


                    }
                },
                error: function(xhr, status, error) {
                    $("#pageloader").fadeOut();
                    alert(error.responseTextss);
                },
            });
        } else {
            console.log("kulang");
        }

    }
</script>