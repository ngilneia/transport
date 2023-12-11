<?php
require('db.php');
include("header.php");
if (isset($_POST['update'])) {
    $id = $_GET['id'];
    $name = $_POST['name'];
    $fName = $_POST['fName'];
    $inputAddress = $_POST['inputAddress'];
    $regNo = $_POST['regNo'];
    $reason = $_POST['reason'];
    $currentOwner = $_POST['currentOwner'];
    $phoneNo = $_POST['phoneNo'];
    $VehicleType = $_POST['VehicleType'];
    $dto = $_POST['dto'];
    $sql = "UPDATE `entry` SET `name`='$name',`fname`='$fName', `address`='$inputAddress',`regNo`='$regNo',`reason`='$reason',`pHolder`='$currentOwner'
    ,`phoneNo`='$phoneNo',`typeOfVehicle`='$VehicleType',`dto`='$dto' WHERE `entry_id`='$id'";
    $result = $con->query($sql);
    if ($result == TRUE) {
        echo
        "<script type='text/javascript'>
        $(document).ready(function(){
                  Swal . fire(
            'Good job!',
            'Recorded Updated!',   
            'success'
        )});
        </script>";
        header('Location: dealingentryList.php');
    } else {
        echo "Error:" . $sql . "<br>" . $con->error;
    }
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM `entry` WHERE entry_id='$id'";
    $result = $con->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $name = $row['name'];
            $fName = $row['fname'];
            $address = $row['address'];
            $regNo = $row['regNo'];
            $reason = $row['reason'];
            $pHolder = $row['pHolder'];
            $phoneNo = $row['phoneNo'];
            $vehicleType = $row['typeOfVehicle'];
            $dto = $row['dto'];
        }
?>

        <form class="row g-3" method="post" enctype="multipart/form-data">
            <div class="col-md-6">
                <label for="name" class="form-label">Name of Applicant</label>
                <input type="text" name="name" class="form-control" id="name" value="<?php echo $name; ?>">
            </div>
            <div class="col-md-6">
                <label for="fName" class="form-label">S/o / D/o / W/o</label>
                <input type="text" name="fName" class="form-control" id="fName" value="<?php echo $fName; ?>">
            </div>
            <div class="col-12">
                <label for="inputAddress" class="form-label">Address</label>
                <input type="text" name="inputAddress" class="form-control" id="inputAddress" value="<?php echo $address; ?>">
            </div>
            <div class="col-6">
                <label for="regNo" class="form-label">Registration No</label>
                <input type="text" name="regNo" class="form-control" id="regNo" value="<?php echo $regNo; ?>">
            </div>
            <div class="col-6">
                <label for="reason" class="form-label">Reason</label>
                <input type="text" name="reason" class="form-control" id="reason" value="<?php echo $reason; ?>">
            </div>
            <div class="col-md-12">
                <label for="currentOwner" class="form-label">Name of Present Permit Holder with Full address</label>
                <input type="text" name="currentOwner" class="form-control" id="currentOwner" value="<?php echo $pHolder; ?>">
            </div>
            <div class="col-md-4">
                <label for="phoneNo" class="form-label">Phone No</label>
                <input type="text" name="phoneNo" class="form-control" id="phoneNo" value="<?php echo $phoneNo; ?>">
            </div>
            <div class=" col-md-4">
                <label for="VehicleType" class="form-label">Type of Vehicle</label>
                <input type="text" name="VehicleType" class="form-control" id="VehicleType" value="<?php echo $vehicleType; ?>">
            </div>
            <div class="col-md-4">
                <label for="dto" class="form-label">DTO</label>
                <input type="text" name="dto" class="form-control" id="dto" value="<?php echo $dto; ?>">
            </div>
            <div class="mb-3">
                <button type="update" name="update" value="update" class="btn btn-primary">Update</button>
            </div>
        </form>
        <script src="js/bootstrap.bundle.min.js"></script>
        <script src="DataTables/datatables.min.js"></script>
        <script type='text/javascript'>
            $(document).ready(function() {
                new DataTable('#example');
            });
        </script>

        </body>

        </html>


<?php
    } else {
        header('Location: dealingentryList.php');
    }
}
?>