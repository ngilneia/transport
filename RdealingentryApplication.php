<?php
require('db.php');
include("header.php");

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$targetDir = "uploads";
$statusMsg = '';
if (isset($_POST['submit'])) {
    $Rname = $_POST['Rname'];
    $Raddress = $_POST['Raddress'];
    $RregNo = $_POST['RregNo'];
    $RCurrentOwnerName = $_POST['RCurrentOwnerName'];
    $RKum = $_POST['RKum'];
    $RphoneNo = $_POST['RphoneNo'];
    $RVehicleType = $_POST['RVehicleType'];
    $RYearofManufacture = $_POST['RYearofManufacture'];
    $RChasisNo = $_POST['RChasisNo'];
    $REngineNo = $_POST['REngineNo'];
    $RLoan = $_POST['RLoan'];
    $RDetailofPermit = $_POST['RDetailofPermit'];
    $RMotorModel = $_POST['RMotorModel'];

    $Rvoters = $_FILES["Rvoters"]["name"];
    $RRegCertf = $_FILES["RRegCertf"]["name"];
    $ROtherDoc = $_FILES["ROtherDoc"]["name"];
    $RMVIReport = $_FILES["RMVIReport"]["name"];

    $targetDir = $targetDir . '/' . $RregNo . '/';
    mkdir($targetDir . '/' . $RregNo . '/', 0666, true);

    $Rvoters = basename($_FILES["Rvoters"]["name"]);
    $RvotersFilePath = $targetDir . $Rvoters;

    $RRegCertf = basename($_FILES["RRegCertf"]["name"]);
    $RRegCertfFilePath = $targetDir . $RRegCertf;

    $ROtherDoc = basename($_FILES["ROtherDoc"]["name"]);
    $ROtherDocFilePath = $targetDir . $ROtherDoc;

    $RMVIReport = basename($_FILES["RMVIReport"]["name"]);
    $RMVIReportFilePath = $targetDir . $RMVIReport;

    $fileType = pathinfo($RvotersFilePath, PATHINFO_EXTENSION);

    if (isset($_POST["submit"]) && !empty($_FILES["Rvoters"]["name"]) && !empty($_FILES["RRegCertf"]["name"]) && !empty($_FILES["ROtherDoc"]["name"]) && !empty($_FILES["RMVIReport"]["name"])) {
        //allow certain file formats
        $allowTypes = array('jpg', 'png', 'jpeg', 'pdf');
        if (in_array($fileType, $allowTypes)) {
            //upload file to server
            if (move_uploaded_file($_FILES["Rvoters"]["tmp_name"], $RvotersFilePath)) {
                $statusMsg1 = "The file " . $Rvoters . " has been uploaded.";
            } else {
                $statusMsg2 = "Sorry, there was an error uploading your file.";
            }
            if (move_uploaded_file($_FILES["RRegCertf"]["tmp_name"], $RRegCertfFilePath)) {
                $statusMsgp = "The file " . $RRegCertf . " has been uploaded.";
            } else {
                $statusMsg3 = "Sorry, there was an error uploading your file.";
            }
            if (move_uploaded_file($_FILES["ROtherDoc"]["tmp_name"], $ROtherDocFilePath)) {
                $statusMsg7 = "The file " . $ROtherDoc . " has been uploaded.";
            } else {
                $statusMsg4 = "Sorry, there was an error uploading your file.";
            }
            if (move_uploaded_file($_FILES["RMVIReport"]["tmp_name"], $RMVIReportFilePath)) {
                $statusMsg9 = "The file " . $RMVIReport . " has been uploaded.";
            } else {
                $statusMsg5 = "Sorry, there was an error uploading your file.";
            }
        } else {
            $statusMsg = 'Sorry, only JPG, JPEG, PNG & PDF files are allowed to upload.';
        }
    } else {
        $statusMsg = 'Please select a file to upload.';
    }
    $sql = "INSERT INTO `entry`(
    `name`, `address`, `regNo`, `pHolderName`, `phoneNo`,
    `typeOfVehicle`,`voters`,`RYearofManufacture`,`RKum`,
    `RChasisNo`,`REngineNo`,`RLoan`,`RDetailofPermit`,
    `RMotorModel`,`RRegCertificate`,`ROtherDoc`,`RMVIReport`
    ) 
    VALUES (
    '$Rname','$Raddress','$RregNo','$RCurrentOwnerName','$RphoneNo',
    '$RVehicleType','$RvotersFilePath','$RYearofManufacture',
    '$RKum','$RChasisNo','$REngineNo','$RLoan','$RDetailofPermit',
    '$RMotorModel','$RRegCertfFilePath','$ROtherDocFilePath','$RMVIReportFilePath')";
    if ($result = $con->query($sql)) {
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
    <h3>Replacement of Vehicle</h3>
    <form class="row g-3" method="post" enctype="multipart/form-data">
        <div class="col-md-4">
            <label for="name" class="form-label">Name of Applicant</label>
            <input type="text" name="Rname" class="form-control" id="name" placeholder="Name">
        </div>
        <div class="col-md-4">
            <label for="Raddress" class="form-label">Address</label>
            <input type="text" name="Raddress" class="form-control" id="Raddress" placeholder="Proof of address to be enclosed">
        </div>
        <div class="col-md-4">
            <label for="RphoneNo" class="form-label">Phone No</label>
            <input type="text" name="RphoneNo" class="form-control" id="RphoneNo" placeholder="Phone No">
        </div>
        <div class="col-md-4">
            <label for="RKum" class="form-label">Kum</label>
            <input type="text" name="RKum" class="form-control" id="RKum" placeholder="Kum">
        </div>
        <div class="col-md-4">
            <label for="regNo" class="form-label">Registration No</label>
            <input type="text" name="RregNo" class="form-control" id="regNo" placeholder="MZ0XXX1234">
        </div>
        <div class="col-md-4">
            <label for="VehicleType" class="form-label">Type of Vehicle</label>
            <select name="RVehicleType" class="form-control" id="VehicleType">
                <option value="">----SELECT-----</option>
                <?php
                $query = "SELECT * from class";
                $result = $con->query($query);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo '<option value="' . $row['name'] . '">' . $row['name'] . '</option>';
                    }
                }
                ?>
            </select>
        </div>
        <div class="col-md-4">
            <label for="RYearofManufacture" class="form-label">Year of Manufacture</label>
            <input type="date" name="RYearofManufacture" class="form-control" id="RYearofManufacture" placeholder="Year of Manufacture">
        </div>
        <div class="col-md-4">
            <label for="RChasisNo" class="form-label">Chasis No</label>
            <input type="text" name="RChasisNo" class="form-control" id="RChasisNo" placeholder="Chasis No">
        </div>
        <div class="col-md-4">
            <label for="REngineNo" class="form-label">Engine No</label>
            <input type="text" name="REngineNo" class="form-control" id="REngineNo" placeholder="Engine No">
        </div>
        <div class="col-md-4">
            <label for="RCurrentOwnerName" class="form-label">Current Owner Name</label>
            <input type="text" name="RCurrentOwnerName" class="form-control" id="RCurrentOwnerName" placeholder="Current Owner Name">
        </div>
        <div class="col-md-4">
            <label for="RLoan" class="form-label">Loan hmang a lei a ni em</label>
            <select name="RLoan" class="form-control" id="RLoan">
                <option value="">----SELECT---</option>
                <option value="YES">YES</option>
                <option value="NO">NO</option>
            </select>
        </div>
        <div class="col-md-4">
            <label for="RDetailofPermit" class="form-label">Detail of Permit</label>
            <input type="text" name="RDetailofPermit" class="form-control" id="RDetailofPermit" placeholder="Detail of Permit">
        </div>
        <div class="col-md-4">
            <label for="RMotorModel" class="form-label">Replace na tur Motor hming leh Model</label>
            <input type="text" name="RMotorModel" class="form-control" id="RMotorModel" placeholder="Motor Model">
        </div>
        <div class="col-md-8">

        </div>
        <div class="col-6">
            <hr />
            <h5>Documents</h5>
            <hr />

            <label for="formFilev" class="form-label">1. Duplicate copy of Registration Certificate</label>
            <input class="form-control" name="RRegCertf" type="file" id="formFilev">
            <label for="formFile1" class="form-label">2. Duplicate Copy of Other Documents</label>
            <input class="form-control" name="ROtherDoc" type="file" id="formFile1">
            <label for="formFile2" class="form-label">3. MVI and Police Report(Accident Case Bikah)</label>
            <input class="form-control" name="RMVIReport" type="file" id="formFile2">
            <label for="formFile" class="form-label">4. Motor neitu Voter ID</label>
            <input class="form-control" name="Rvoters" type="file" id="formFile">
        </div>

        <div class="mb-3">
            <button type="submit" name="submit" value="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
</div>

<?php include('footer.php') ?>