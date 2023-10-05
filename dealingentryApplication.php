<?php
require('db.php');
include("header.php");
$targetDir = "uploads/";
$statusMsg = '';
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $fName = $_POST['fName'];
    $address = $_POST['inputAddress'];
    $regNo = $_POST['regNo'];
    $reason = $_POST['reason'];
    $currentOwner = $_POST['currentOwner'];
    $phoneNo = $_POST['phoneNo'];
    $VehicleType = $_POST['VehicleType'];
    $dto = $_POST['dto'];
    $file = $_FILES["file"]["name"];
    $fileName = basename($_FILES["file"]["name"]);
    $targetFilePath = $targetDir . $fileName;
    $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

    if (isset($_POST["submit"]) && !empty($_FILES["file"]["name"])) {
        //allow certain file formats
        $allowTypes = array('jpg', 'png', 'jpeg', 'gif', 'pdf');
        if (in_array($fileType, $allowTypes)) {
            //upload file to server
            if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)) {
                $statusMsg = "The file " . $fileName . " has been uploaded.";
            } else {
                $statusMsg = "Sorry, there was an error uploading your file.";
            }
        } else {
            $statusMsg = 'Sorry, only JPG, JPEG, PNG, GIF, & PDF files are allowed to upload.';
        }
    } else {
        $statusMsg = 'Please select a file to upload.';
    }

    $sql = "INSERT INTO `entry`(`name`, `fName`, `address`, `regNo`, `reason`, `pHolder`, `phoneNo`,`typeOfVehicle`,`dto`,`file`) 
    VALUES ('$name','$fName','$address','$regNo','$reason','$currentOwner','$phoneNo','$VehicleType','$dto','$targetFilePath')";
    $result = $con->query($sql);
    if ($result == TRUE) {
        echo "<script type='text/javascript'>
        $(document).ready(function(){
                  Swal . fire(
            'Application Submitted!',   
            'success'
        )});
        </script>";
    } else {
        echo    "<script type='text/javascript'>
        $(document).ready(function(){
                  Swal . fire(
            'Error!',
            'Not Recorded!',   
            'error'
        )});
        </script>";
    }

    $con->close();
}
?>
<div class="container">
    <p>Entry Application</p>
    <form class="row g-3" method="post" enctype="multipart/form-data">
        <div class="col-md-6">
            <label for="name" class="form-label">Name of Applicant</label>
            <input type="text" name="name" class="form-control" id="name" placeholder="Name">
        </div>
        <div class="col-md-6">
            <label for="fName" class="form-label">S/o / D/o / W/o</label>
            <input type="text" name="fName" class="form-control" id="fName" placeholder="S/o / D/o / W/o Name">
        </div>
        <div class="col-12">
            <label for="inputAddress" class="form-label">Address</label>
            <input type="text" name="inputAddress" class="form-control" id="inputAddress" placeholder="Proof of address to be enclosed">
        </div>
        <div class="col-6">
            <label for="regNo" class="form-label">Registration No</label>
            <input type="text" name="regNo" class="form-control" id="regNo" placeholder="MZ0XXX1234">
        </div>
        <div class="col-6">
            <label for="reason" class="form-label">Reason</label>
            <input type="text" name="reason" class="form-control" id="reason" placeholder="Reason">
        </div>
        <div class="col-md-12">
            <label for="currentOwner" class="form-label">Name of Present Permit Holder with Full address</label>
            <input type="text" name="currentOwner" class="form-control" id="currentOwner" placeholder="Name of Present Permit Holder with Full address">
        </div>
        <div class="col-md-4">
            <label for="phoneNo" class="form-label">Phone No</label>
            <input type="text" name="phoneNo" class="form-control" id="phoneNo" placeholder="Phone No">
        </div>
        <div class="col-md-4">
            <label for="VehicleType" class="form-label">Type of Vehicle</label>
            <input type="text" name="VehicleType" class="form-control" id="VehicleType" placeholder="Type of Vehicle">
        </div>
        <div class="col-md-4">
            <label for="dto" class="form-label">DTO</label>
            <input type="text" name="dto" class="form-control" id="dto" placeholder="DTO">
        </div>
        <div class="mb-3">
            <label for="formFile" class="form-label">Voters ID(Present Holder)</label>
            <input class="form-control" name="file" type="file" id="formFile">
            <label for="formFile1" class="form-label">Sales Letter</label>
            <input class="form-control" name="file1" type="file" id="formFile1">
            <label for="formFile2" class="form-label">REgistration Certificate</label>
            <input class="form-control" name="file2" type="file" id="formFile2">
            <label for="formFile3" class="form-label">Plying permit</label>
            <input class="form-control" name="file3" type="file" id="formFile3">
            <label for="formFile4" class="form-label">Pollution Certificate</label>
            <input class="form-control" name="file4" type="file" id="formFile4">
        </div>
        <hr />
        <h4>In Case of Accident Vehicle</h4>
        <hr />
        <div class="mb-3">
            <label for="formFil5e" class="form-label">Police Report</label>
            <input class="form-control" name="file5" type="file" id="formFile5">
        </div>
        <div class="mb-3">
            <label for="formFile6" class="form-label">MVI Inspection Report</label>
            <input class="form-control" name="file6" type="file" id="formFile6">
        </div>
        <div class="mb-3">
            <label for="formFile7" class="form-label">Death Certificate</label>
            <input class="form-control" name="file7" type="file" id="formFile7">
        </div>
        <div class="mb-3">
            <button type="submit" name="submit" value="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
</div>

<?php include('footer.php') ?>