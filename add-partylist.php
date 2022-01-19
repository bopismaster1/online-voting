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
    </header>
    <!-- End Navigation Bar-->

    <div class="wrapper">
        <div class="container-fluid"></div>


        <!-- end container -->
    </div>
    <!-- end wrapper -->
    <div class="row justify-content-center">
        <div class="col-xl-4">
            <div class="card">
                <div class="card-body">
                    <h5>List of Parylist</h5>
                    <div class="table-responsive">
                        <table class="table table-striped mb-0">

                            <thead>
                                <tr>
                                    <th>Logo</th>
                                    <th>Patylist Name</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sql = "select * from partylist";
                                $res = select_info_multiple_key($sql);

                                if (count($res) > 0) {

                                    foreach ($res as $row) {
                                        $status = "Active";
                                        if ($row["active"] == 0) {
                                            $status = "In-Active";
                                        }
                                        echo "
                                        <tr>
                                    <th><img src='" . $row["logoPath"] . "' class='thumb-md rounded-circle' alt='partylistLogo'></th>
                                    <td>" . $row["partyListName"] . "</td>
                                    <td>" . $status . "</td>
                                    <td><button type='button' class='btn btn-primary' data-toggle='modal' data-target='.bs-example-modal-center" . $row["id"] . "' waves-effect waves-light'><i class='fas fa-edit'></i> Edit</button></i></td>
                                </tr>

                                <div class='modal fade bs-example-modal-center" . $row["id"] . "' tabindex='-1' role='dialog' aria-labelledby='mySmallModalLabel' aria-hidden='true'>
                                            <div class='modal-dialog modal-dialog-centered'>
                                                <div class='modal-content'>
                                                    <div class='modal-header'>
                                                        <h5 class='modal-title mt-0'>Edit " . $row["partyListName"] . "</h5>
                                                        <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>×</button>
                                                    </div>
                                                    <div class='modal-body'>
                                                        <div style='display: flex;justify-content: center;'>
                                                        <img class='rounded-circle' height='200px' width='200px' alt='200x200' id='selectedimgLogo" . $row["id"] . "' src='" . $row["logoPath"] . "' data-holder-rendered='true'></div>

                                                        <div class='form-group row'>
                                                            <label for='example-text-input' class='col-sm-2 col-form-label'>Partylist Logo</label>
                                                            <div class='col-sm-10'>
                                                                <input class='form-control' type='file' accept='image/*' onchange='PreviewImage(" . $row["id"] . ")' id='partyListLogo" . $row["id"] . "'>
                                                            </div>
                                                        </div>
                                                        <div class='form-group row'>
                                                            <label for='example-text-input' class='col-sm-2 col-form-label'>Patylist Name</label>
                                                            <div class='col-sm-10'>
                                                                <input class='form-control' type='text' value='" . $row["partyListName"] . "' id='selectedPatyname" . $row["id"] . "'>
                                                            </div>
                                                        </div>

                                                        <div class='form-group row'>
                                                            <label for='example-text-input' class='col-sm-2 col-form-label'>Status</label>
                                                            <div class='col-sm-10'>
                                                                <select class='form-control' id='selectedPartyStatus" . $row["id"] . "'>
                                                                <option value='" . $status . "'>" . $status . "</option>
                                                                <option value='Active'>Active</option>
                                                                <option value='In-Active'>In-Active</option>
                                                            </select>
                                                            </div>
                                                        </div>
                                                        <div class='form-group'>
                                                            <button type='button' class='btn btn-success btn-lg btn-block  waves-effect waves-light' onclick='updatePartyList(" . $row["id"] . ")'>Update Partylist</button>
                                                            <button type='button' class='btn btn-primary btn-lg btn-block  waves-effect waves-light' onclick='removePartylist(" . $row["id"] . ")'>Remove Partylist</button>
                                                            </div>
                                                    </div>
                                                </div><!-- /.modal-content -->
                                            </div><!-- /.modal-dialog -->
                                        </div><!-- /.modal -->
                                    ";
                                    }
                                }
                                ?>


                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-7">
            <div class="card">
                <div class="card-body">
                    <h5>Add Partylist</h5>
                    <div style="display: flex;justify-content: center;"><img class="rounded-circle" height="200px" width="200px" alt="200x200" id="imgLogo" src="data:image/jpeg;base64,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" data-holder-rendered="true"></div>
                    <br>
                    <div class="form-group row">
                        <label for="example-text-input" class="col-sm-2 col-form-label">Partylist Logo</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="file" accept="image/*" onchange="PreviewImage(0)" id="partyListLogo">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="example-text-input" class="col-sm-2 col-form-label">Partylist Name</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" id="partyListName" placeholder="Kabataan Partylist">
                        </div>
                    </div>
                    <button type="button" class="btn btn-primary btn-lg btn-block waves-effect waves-light" onclick="savePartyList()">Add Partylist</button>
                </div>
            </div>
        </div>
    </div>
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
    function PreviewImage(id) {
        var oFReader = new FileReader();
        if (id > 0) {
            oFReader.readAsDataURL(document.getElementById("partyListLogo" + id).files[0]);

            oFReader.onload = function(oFREvent) {
                document.getElementById("selectedimgLogo" + id).src = oFREvent.target.result;
            };
        } else {
            oFReader.readAsDataURL(document.getElementById("partyListLogo").files[0]);

            oFReader.onload = function(oFREvent) {
                document.getElementById("imgLogo").src = oFREvent.target.result;
            };
        }
    };

    function savePartyList() {
        var fd = new FormData();
        var files = $("#partyListLogo")[0].files;
        var partyListName = $("#partyListName").val();
        console.log(files);
        if (files.length > 0 && partyListName != "") {
            fd.append("logo", files[0]);
            fd.append("name", partyListName);
            $.ajax({
                url: "add-partylist-function.php",
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
                        swal("Partylist Added!", partyListName + " Has been added to the list", "success");
                        console.log("Error: " + result);
                    } else {

                        swal("Failed to add partylist", "Failed to add " + partyListName + " into the list.", "error");

                    }
                },
                error: function(xhr, status, error) {
                    $("#pageloader").fadeOut();
                    alert(error.responseTextss);
                },
            });
        } else {
            swal("Finish the form first", "Please fill upp all fields", "error");
        }
    }

    function updatePartyList(id) {
        var fd = new FormData();
        var files = $("#partyListLogo" + id)[0].files;
        var selectedParyName = $("#selectedPatyname" + id).val();
        var selectedStatus = $("#selectedPartyStatus" + id).val();
        if (selectedParyName != "") {
            if (files.length > 0) {
                fd.append("updatedLogo", files[0]);
            }
            fd.append("selectedName", selectedParyName);
            fd.append("selectedStatus", selectedStatus);
            fd.append("selectedId", id);
            $.ajax({
                url: "add-partylist-function.php",
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
                        swal("Partylist has been Updated", selectedParyName + " information has been added!", "success");
                        console.log("Error: " + result);
                    } else {

                        swal("Failed to update Partylist", "Failed to update " + selectedParyName + " information", "error");
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

    function removePartylist(id) {
        var fd = new FormData();
        fd.append("deletingId", id);
        $.ajax({
            url: "add-partylist-function.php",
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
                    swal("Success", "Partylist has been removed", "success");
                    console.log("Error: " + result);
                } else {

                    swal("Failed to remove Partylist", "Failed to remove the partylist", "error");
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