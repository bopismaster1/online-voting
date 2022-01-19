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
                    <h4 class="text-muted font-18 m-b-5 text-center">Register now!</h4>
                    <p class="text-muted text-center">Use your student ID number for verification</p>

                    <form class="form-horizontal m-t-30" action="index.html">
                        <div class="form-group">
                            <label for="useremail">Student I.D Number</label>
                            <input type="number" class="form-control" id="userID" placeholder="xxxxxx">
                        </div>
                        <div class="form-group">
                            <label for="useremail">Contact Number (we will send code you will need to vote)</label>
                            <input type="number" class="form-control" id="userNumber" placeholder="09123456789" maxlength="10">
                        </div>
                        <div class="form-group">
                            <label for="useremail">Email</label>
                            <input type="email" class="form-control" id="useremail" placeholder="Enter email">
                        </div>
                        <div class="form-group">
                            <label for="userpassword">Password</label>
                            <input type="password" class="form-control" id="userpassword" placeholder="Enter password">
                        </div>

                        <div class="form-group row m-t-20">
                            <div class="col-12 text-right">
                                <button class="btn btn-primary w-md waves-effect waves-light" type="button" onclick="registerStudent()">Register</button>
                            </div>
                        </div>

                        <!-- <div class="form-group m-t-10 mb-0 row">
                            <div class="col-12 m-t-20">
                                <p class=" text-muted mb-0">By registering you agree to the Lexa <a href="#" class="text-primary">Terms of Use</a></p>
                            </div>
                        </div> -->
                    </form>
                </div>

            </div>
        </div>

        <div class="m-t-40 text-center">
            <p>Already have an account ? <a href="login" class=" text-primary"> Login </a> </p>
            <p>Online-Voting</p>
        </div>
    </div>


    <!-- jQuery  -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/jquery.slimscroll.js"></script>
    <script src="assets/js/waves.min.js"></script>

    <script src="../plugins/jquery-sparkline/jquery.sparkline.min.js"></script>

    <!-- App js -->
    <script src="assets/js/app.js"></script>

    <!-- seet alert -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

</body>

</html>
<script>
    function registerStudent() {
        var fd = new FormData();
        var studentId = $("#userID").val();
        var contactNo = $("#userNumber").val();
        var email = $("#useremail").val();
        var password = $("#userpassword").val();

        var testEmail = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
        //check if valid email
        if (testEmail.test(email)) {} else {
            swal("Error", "Email required!", "error");
            return;
        }

        if (contactNo.substring(0, 2) == "09" && contactNo.length == 11) {

        } else {
            swal("Error", "Contact number required!", "error");
            return;
        }
        if (studentId != "" && contactNo != "" && email != "" && password != "") {
            fd.append("studentId", studentId);
            fd.append("contactNo", contactNo);
            fd.append("email", email);
            fd.append("password", password);
            $.ajax({
                url: "registration-function.php",
                type: "POST",
                data: fd,
                contentType: false,
                processData: false,
                success: function(response) {
                    console.log(response);
                    var result = $.trim(response);
                    if (result === "no user") {
                        // $("#pageloader").fadeOut();
                        // swal("Success!", "Login successfull. Please wait for redirection!", "success");
                        $("#pageloader").fadeOut();
                        swal("Registration Failed!", "Student ID is not found. \nPlease contact the office for your ID)", "error");
                        console.log("Error: " + result);
                    } else {

                        if (result == "success") {
                            $("#pageloader").fadeOut();
                            swal("Registration successful!", "Please check your Phone for your voter CODE", "success");
                        } else if (result == "registered") {
                            $("#pageloader").fadeOut();
                            swal("Registration Failed!", "Student id is already registered!", "error");
                        } else if (result == "taken") {
                            $("#pageloader").fadeOut();
                            swal("Registration Failed!", "Email is already taken!", "error");
                        }

                    }
                },
                error: function(xhr, status, error) {
                    $("#pageloader").fadeOut();
                    alert(error.responseTextss);
                },
            });
        } else {
            swal("Error!", "Please fill up all required fields", "error");
        }
    }
</script>