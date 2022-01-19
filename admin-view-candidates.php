<?php
session_start();
include_once "connect.php";

if (isset($_SESSION["supervisorId"])) {
} else {
    //logout user
    header("location:login.php");
}
$sql = "select * from positions";
$positionres = select_info_multiple_key($sql);
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
            <!-- sample modal content -->
            <div id="dataModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title mt-0" id="studentName"></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <div class="modal-body">
                            <div style="display: flex;justify-content: center;">
                                <img class="rounded-circle" height="200px" width="200px" alt="200x200" id="imagesPreview" src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/ac/No_image_available.svg/1024px-No_image_available.svg.png" data-holder-rendered="true">

                            </div>
                            <center>
                                <h5 id="positionModal" style="margin: 0;">Governor</h5>
                                <p id="categoryModal">Provencial</p>
                            </center>
                            <hr>
                            <div class="form-group row">
                                <label for="example-text-input" class="col-sm-2 col-form-label">New Images</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="file" accept="image/*" id="new-images">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Category</label>
                                <div class="col-sm-10">
                                    <select class="form-control" id="new-category" onchange="positionSelector()">
                                        <option>Select</option>
                                        <option>Provincial</option>
                                        <option>Municipal</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Position</label>
                                <div class="col-sm-10">
                                    <select class="form-control" id="new-position">
                                    </select>
                                </div>
                            </div>


                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary waves-effect waves-light" onclick="saveChanges()">Save changes</button>
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table mb-0">

                                    <thead class="thead-light">
                                        <tr>
                                            <th>Student Id</th>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Status</th>
                                            <th>action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $sql = "select * from candidates where status LIKE 'active'";
                                        $resCandidates = select_info_multiple_key($sql);
                                        foreach ($resCandidates as $row) {
                                            echo "<tr>
                                            <th scope=row'>" . $row["studentId"] . "</th>
                                            <td>" . $row["firstName"] . "</td>
                                            <td>" . $row["lastName"] . "</td>
                                            <td>" . $row["status"] . "</td>
                                            <td><i class='fas fa-edit mr-3' style='color:#00a9e6' onclick=viewStudent(" . $row["studentId"] . ")> Edit</i><i class='fas fa-trash-alt' style='color:#e6004c' onclick='removeCandidates(`" . $row["id"] . "`)'> Removed</i></td>
                                        </tr>";
                                        }
                                        ?>

                                    </tbody>
                                </table>
                            </div>
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
    var studentArray = <?php echo json_encode($resCandidates) ?>;
    var positionData = <?php echo json_encode($positionres) ?>;
    var currentSelectedId = "";
    console.log(studentArray);

    function viewStudent(id) {
        currentSelectedId = id;
        let obj = studentArray.find(o => o.studentId == id);
        $("#studentName").text(`${obj.firstName} ${obj.lastName}`);
        $("#positionModal").text(`${obj.runningFor.toUpperCase()}`);
        $("#categoryModal").text(`${obj.category.toUpperCase()}`);
        $("#imagesPreview").attr("src", obj.picturePath);
        $("#dataModal").modal("toggle");

    }

    function positionSelector() {
        var selectCategory = $("#new-category").val();
        document.getElementById("new-position").innerHTML = "";
        for (let i = 0; i < positionData.length; i++) {
            if (positionData[i].type == selectCategory.toLowerCase()) {
                var list = `<option style="text-transform:capitalized">${positionData[i].position.toUpperCase()}</option>`;
                document.getElementById("new-position").innerHTML += list;
            }
        }
    }

    function saveChanges() {
        var fd = new FormData();
        var files = $("#new-images")[0].files;
        var newPosition = $("#new-position").val();
        var category = $("#new-category").val();

        if (newPosition && category) {
            if (files.length > 0) {
                fd.append("newImages", files[0]);
            }
            fd.append("newPosition", newPosition);
            fd.append("category", category);
            fd.append("selectedId", currentSelectedId);
            $.ajax({
                url: "admin-view-camdidates-function.php",
                type: "POST",
                data: fd,
                contentType: false,
                processData: false,
                success: function(response) {
                    console.log("asdasd" + response);
                    var result = $.trim(response);
                    if (result === "success") {
                        // $("#pageloader").fadeOut();
                        // swal("Success!", "Login successfull. Please wait for redirection!", "success");
                        $("#pageloader").fadeOut();
                        swal("Data Updated", "Candidates data has been successfuly updated", "success");
                        // console.log("Error: " + result);
                    } else {
                        if (result == "no-data") {
                            swal("No Data", "Student data not found. Please refresh the browser.", "error");
                            // console.log("Error: " + result);
                        }


                    }
                },
                error: function(xhr, status, error) {
                    $("#pageloader").fadeOut();
                    alert(error.responseTextss);
                },
            });
        }
    }

    function removeCandidates(id) {
        var fd = new FormData();
        fd.append("deletionId", id);
        $.ajax({
            url: "admin-view-camdidates-function.php",
            type: "POST",
            data: fd,
            contentType: false,
            processData: false,
            success: function(response) {
                console.log("asdasd" + response);
                var result = $.trim(response);
                if (result === "success") {
                    // $("#pageloader").fadeOut();
                    // swal("Success!", "Login successfull. Please wait for redirection!", "success");
                    $("#pageloader").fadeOut();
                    swal("Data Deleted", "Candidates data has been successfuly Deleted", "success");
                    // console.log("Error: " + result);
                } else {
                    if (result == "no-data") {
                        swal("No Data", "Student data not found. Please refresh the browser.", "error");
                        // console.log("Error: " + result);
                    }


                }
            },
            error: function(xhr, status, error) {
                $("#pageloader").fadeOut();
                alert(error.responseTextss);
            },
        });
    }
</script>