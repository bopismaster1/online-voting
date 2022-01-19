<?php
session_start();
include_once "connect.php";
$mysql_date_now = date("Y-m-d H:i:s");
$sql = "select * from user where id=" . $_SESSION["supervisorId"];
$res = select_info_multiple_key($sql);

if (isset($_GET["function"])) {
    if ($_GET["function"] == "settings") { ?>
        <h5>Settings</h5>
        <div class="form-group row">
            <label for="example-text-input" class="col-sm-2 col-form-label">First Name</label>
            <div class="col-sm-10">
                <input class="form-control" type="text" value="<?php echo $res[0]["firstName"] ?>" id="firstName">
            </div>
        </div>
        <div class="form-group row">
            <label for="example-text-input" class="col-sm-2 col-form-label">Last Name</label>
            <div class="col-sm-10">
                <input class="form-control" type="text" value="<?php echo $res[0]["lastName"] ?>" id="lastName">
            </div>
        </div>
        <hr>
        <h5>Change Password </h5>

        <div class="form-group row">
            <label for="example-text-input" class="col-sm-2 col-form-label">Old Password</label>
            <div class="col-sm-10">
                (Leave blank if you don't want to change password)
                <input class="form-control" type="password" id="oldPassword">
            </div>
        </div>
        <div class="form-group row">
            <label for="example-text-input" class="col-sm-2 col-form-label">New Password</label>
            <div class="col-sm-10">
                <input class="form-control" type="password" id="newPassword">
            </div>
        </div>
        <button type="button" class="btn btn-primary btn-lg btn-block waves-effect waves-light" onclick="updateProfile()">Update profile</button>

    <?php } elseif ($_GET["function"] == "addSupervisor") {
        //add supervisor
    ?>
        <h5>Create Supervisor</h5>
        <hr>
        <div class="form-group row">
            <label for="example-text-input" class="col-sm-2 col-form-label">First Name</label>
            <div class="col-sm-10">
                <input class="form-control" type="text" id="adminFirstname">
            </div>
        </div>
        <div class="form-group row">
            <label for="example-text-input" class="col-sm-2 col-form-label">Last Name</label>
            <div class="col-sm-10">
                <input class="form-control" type="text" id="adminLastName">
            </div>
        </div>
        <div class="form-group row">
            <label for="example-text-input" class="col-sm-2 col-form-label">Email</label>
            <div class="col-sm-10">
                <input class="form-control" type="email" id="adminEmail">
            </div>
        </div>
        <div class="form-group row">
            <label for="example-text-input" class="col-sm-2 col-form-label">Contact Number</label>
            <div class="col-sm-10">
                <input class="form-control" type="number" id="adminNumber">
            </div>
        </div>
        <button type="button" class="btn btn-primary btn-lg btn-block waves-effect waves-light" onclick="createUser()">Create User</button>
    <?php } elseif ($_GET["function"] == "date") { ?>
        <h5>Set Voting Date</h5>
        <?php
        $sql = "select * from votingdate";
        $res = select_info_multiple_key($sql);
        echo "<p>current Voting Date(" . $res[0]["startDate"] . "/" . $res[0]["endDate"] . ")</p>";
        ?>

        <hr>
        <div class="form-group row">
            <label for="example-text-input" class="col-sm-2 col-form-label">Start Date</label>
            <div class="col-sm-10">
                <input class="form-control" type="datetime-local" id="startdate">
            </div>
        </div>
        <div class="form-group row">
            <label for="example-text-input" class="col-sm-2 col-form-label">End Date</label>
            <div class="col-sm-10">
                <input class="form-control" type="datetime-local" id="endDate">
            </div>
        </div>
        <button type="button" class="btn btn-primary btn-lg btn-block waves-effect waves-light" onclick="setVotingDate()">Set date</button>
<?php }
    //umpisa ng function
} elseif (isset($_POST["firstName"]) && isset($_POST["lastName"])) {
    //select current user
    $password = $res[0]["password"];

    //check if the old password is equal to current password in database
    if (isset($_POST["oldPassword"])) {
        if ($password == md5(base64_encode($_POST["oldPassword"]))) {
            //continue
            $sql = "UPDATE user SET firstName = '" . addslashes($_POST["firstName"]) . "', lastName = '" . addslashes($_POST["lastName"]) . "',password='" . addslashes(md5(base64_encode($_POST["newPassword"]))) . "' WHERE id=" . $_SESSION["supervisorId"] . "";
            $res = insert_update_delete($sql);
            echo "success";
        } else {
            echo "wrong" . $password;
        }
    } else {
        $sql = "UPDATE user SET firstName = '" . addslashes($_POST["firstName"]) . "', lastName = '" . addslashes($_POST["lastName"]) . "' WHERE id=" . $_SESSION["supervisorId"] . "";
        $res = insert_update_delete($sql);

        echo $res;
    }
} elseif (isset($_POST["adminFirstName"]) && isset($_POST["adminLastName"]) && isset($_POST["adminEmail"]) && isset($_POST["adminNumber"])) {
    //
    $sql = "insert into user (`firstName`,`lastName`,`email`,`contactNo`,`password`,`createdBy`,`dateCreated`,`accountType`) values('" . addslashes($_POST["adminFirstName"]) . "','" . addslashes($_POST["adminLastName"]) . "','" . addslashes($_POST["adminEmail"]) . "','" . addslashes($_POST["adminNumber"]) . "','" . md5(base64_encode("TaraAtBumoto!")) . "','" . $_SESSION["supervisorId"] . "','" . $mysql_date_now . "','supervisor')";
    $res = insert_update_delete($sql);
    echo $res;
} elseif (isset($_POST["startDate"]) && isset($_POST["endDate"])) {
    // echo "pasok";
    $sql = "update votingdate set startDate='" . addslashes($_POST["startDate"]) . "', endDate='" . addslashes($_POST["endDate"]) . "'";
    $res = insert_update_delete($sql);
    echo $res;
} else {
    header("location:log-out");
}
