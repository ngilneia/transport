<?php
require('db.php');
include("header.php");
$statusMsg = '';
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $fname = $_POST['fname'];
    $address = $_POST['inputAddress'];
    $regNo = $_POST['regNo'];
    $reason = $_POST['reason'];
    $phoneNo = $_POST['phoneNo'];
    $typeOfVehicle = $_POST['vClass'];
    $dto = $_POST['dto'];
    $routeFrom = $_POST['routeFrom'];
    $routeTo = $_POST['routeTo'];

    $sqlFile = "SELECT * from fileno where class_id=$typeOfVehicle";
    $fileResult  = $con->query($sqlFile);
    $rowfile = $fileResult->fetch_assoc();
    $fileNo = $rowfile['rFile_no'];

    $sql = "INSERT INTO `entry`(`name`, `fname`,`address`, `regNo`, `reason`, `phoneNo`,`typeOfVehicle`,`dto`,`fromRoute`,`toRoute`,`eFileNo`) 
    VALUES ('$name','$fname','$address','$regNo','$reason','$phoneNo','$typeOfVehicle','$dto','$routeFrom','$routeTo','$fileNo')";
    if ($result = $con->query($sql)) {
        echo
        '<script>
        $(document).ready(function(){
                Swal.fire({
                title: "Application Entered",
                type: "success"
            }).then(function() {
                window.location = "index.php";
            })});
        </script>';
    } else {
        echo "Error:" . $sql . "<br>" . $con->error;
    }
    $con->close();
}
?>
<div class="container ">
    <h3>Route Transfer</h3>
    <form class="row g-3" method="post" enctype="multipart/form-data">
        <div class="row">
            <div class="col-md-4">
                <label for="name" class="form-label ">Name of Applicant</label>
                <input type="text" name="name" class="form-control border-primary" id="name" placeholder="Name">
            </div>
            <div class="col-md-4">
                <label for="fname" class="form-label ">Fathers Name</label>
                <input type="text" name="fname" class="form-control border-primary" id="fname" placeholder="Fathers Name">
            </div>
            <div class="col-md-4">
                <label for="regNo" class="form-label">Registration No</label>
                <input type="text" name="regNo" class="form-control border-primary" id="regNo" placeholder="MZ0XXX1234">
            </div>

        </div>
        <div class="row">
            <div class="col-md-6">
                <label for="inputAddress" class="form-label">Address</label>
                <input type="text" name="inputAddress" class="form-control border-primary" id="inputAddress" placeholder="Proof of address to be enclosed">
            </div>

            <div class="col-md-6">
                <label for="phoneNo" class="form-label">Phone No</label>
                <input type="text" name="phoneNo" class="form-control border-primary" id="phoneNo" placeholder="Phone No">
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <label for="reason" class="form-label">Reason</label>
                <input type="text" name="reason" class="form-control border-primary" id="reason" placeholder="Reason">
            </div>

        </div>
        <hr />
        <div class="row">
            <div class="col-md-6">
                <label for="routeFrom" class="form-label">From Route</label>
                <input type="text" name="routeFrom" class="form-control border-primary" id="routeFrom" placeholder="From">
            </div>
            <div class="col-md-6">
                <label for="routeTo" class="form-label">To Route</label>
                <input type="text" name="routeTo" class="form-control border-primary" id="routeTo" placeholder="To">
            </div>
        </div>
        <hr />
        <div class="col-6">
            <label for="vClass" class="form-check-label">Vehicle Class</label>
            <select name="vClass" class="form-control border-primary" id="vClass">
                <?php
                $run = 'SELECT * from class';
                $queryt = $con->query($run);
                if ($queryt->num_rows > 0) {
                    while ($row = $queryt->fetch_assoc()) {
                        echo '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
                    }
                }
                ?>
            </select>
        </div>
        <div class="col-6">
            <label for="dto" class="form-check-label">DTO</label>
            <select name="dto" class="form-control border-primary" id="dto">
                <?php
                $run = 'SELECT * from dto';
                $queryt = $con->query($run);
                if ($queryt->num_rows > 0) {
                    while ($row = $queryt->fetch_assoc()) {
                        echo '<option value="' . $row['dto_name'] . '">' . $row['dto_name'] . '</option>';
                    }
                }
                ?>
            </select>
        </div>
        <hr />
        <div class="row">
            <div class="mb-3">
                <button type="submit" name="submit" value="submit" class="btn btn-primary">Submit</button>
            </div>
    </form>
</div>

<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/sweetalert2.all.min.js"></script>
</body>

</html>