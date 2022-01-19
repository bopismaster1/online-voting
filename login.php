<?php
session_start();
if (isset($_SESSION["supervisorId"])) {
    header("loaction:admin-dashboard");
} elseif (isset($_SESSION["studentId"])) {
    header("location:student-dashboard");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title>Lexa - Responsive Bootstrap 4 Admin Dashboard</title>
    <meta content="Admin Dashboard" name="description" />
    <meta content="Themesbrand" name="author" />
    <link rel="shortcut icon" href="assets/images/favicon.ico">

    <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="assets/css/icons.css" rel="stylesheet" type="text/css">
    <link href="assets/css/style.css" rel="stylesheet" type="text/css">
</head>

<body>

    <!-- Begin page -->
    <div class="wrapper-page">

        <div class="card">
            <div class="card-body">

                <h3 class="text-center m-0">
                    <a href="index.html" class="logo logo-admin"><img src="assets/images/logo.png" height="30" alt="logo"></a>
                </h3>

                <div class="p-3">
                    <h4 class="text-muted font-18 m-b-5 text-center">Welcome Back !</h4>
                    <p class="text-muted text-center">Your vote, Your Voice.</p>

                    <form class="form-horizontal m-t-30">

                        <div class="form-group">
                            <label for="username">Email</label>
                            <input type="email" class="form-control" id="email" placeholder="Enter username">
                        </div>

                        <div class="form-group">
                            <label for="userpassword">Password</label>
                            <input type="password" class="form-control" id="password" placeholder="Enter password">
                        </div>

                        <div class="form-group row m-t-20">
                            <div class="col-6">
                                <!-- <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="customControlInline">
                                    <label class="custom-control-label" for="customControlInline">Remember me</label>
                                </div> -->
                            </div>
                            <div class="col-6 text-right">
                                <button class="btn btn-primary w-md waves-effect waves-light" onclick="loginUser()" type="button">Log In</button>
                            </div>
                        </div>

                        <!-- <div class="form-group m-t-10 mb-0 row">
                            <div class="col-12 m-t-20">
                                <a href="pages-recoverpw.html" class="text-muted"><i class="mdi mdi-lock"></i> Forgot your password?</a>
                            </div>
                        </div> -->
                    </form>
                </div>

            </div>
        </div>

        <div class="m-t-40 text-center">
            <p>Don't have an account ? <a href="register" class="text-primary"> Signup Now </a> </p>
            <!-- <p>© Your vote count! SO VOTE WISELY</p> -->
        </div>

    </div>


    <!-- jQuery  -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/jquery.slimscroll.js"></script>
    <script src="assets/js/waves.min.js"></script>

    <script src="plugins/jquery-sparkline/jquery.sparkline.min.js"></script>

    <!-- App js -->
    <script src="assets/js/app.js"></script>

    <!-- seet alert -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

</body>

</html>
<script>
    function loginUser() {
        var fd = new FormData();
        var username = $("#email").val();
        var password = $("#password").val();

        if (username != "" && password != "") {
            fd.append("userEmail", username);
            fd.append("userPassword", password);
            fd.append("loginBtn", "login");
            $.ajax({
                url: "login-function.php",
                type: "POST",
                data: fd,
                contentType: false,
                processData: false,
                success: function(response) {

                    var result = $.trim(response);
                    if (result === "no user") {
                        // $("#pageloader").fadeOut();
                        // swal("Success!", "Login successfull. Please wait for redirection!", "success");
                        $("#pageloader").fadeOut();
                        swal("Login Failed!", "Invalid Email or Password Please contact the Administrator", "error");
                        console.log("Error: " + result);
                    } else {

                        if (result == "student") {
                            $("#pageloader").fadeOut();
                            swal("Student!", "Login successfull. Please wait for redirection!", "success");
                            console.log("asdasd");
                            window.open("student-dashboard", "_self");
                        } else if (result == "supervisor") {
                            $("#pageloader").fadeOut();
                            swal("Supervisor!", "Login successfull. Please wait for redirection!", "success");
                            window.open("admin-dashboard", "_self");
                        }

                    }
                },

            });
        } else {
            $("#pageloader").fadeOut();
            toastNotifiation("please Select a file", "error");
        }
    }
</script>