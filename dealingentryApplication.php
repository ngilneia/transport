<?php
require('db.php');
include("header.php");
$targetDir = "uploads";
$statusMsg = '';
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $fName = $_POST['fName'];
    $address = $_POST['inputAddress'];
    $regNo = $_POST['regNo'];
    $reason = $_POST['reason'];
    $currentOwnerName = $_POST['currentOwnerName'];
    $currentOwner = $_POST['currentOwner'];
    $phoneNo = $_POST['phoneNo'];
    $VehicleType = $_POST['VehicleType'];
    $dto = $_POST['dto'];
    $dot = date('Y-m-d', strtotime($_POST['dot']));
    $deceased = $_POST['deceased'];
    $place = $_POST['place'];
    $relation = $_POST['relation'];
    $news = $_POST['news'];
    $newsDate = $_POST['newsDate'];
    $transferDate = $_POST['transferDate'];
    $appName = $_POST['appName'];
    $pNo = $_POST['pNo'];
    $domain = $_POST['domain'];

    $voters = $_FILES["voters"]["name"];
    $pVoters = $_FILES["pVoters"]["name"];
    $saleLetter = $_FILES["saleLetter"]["name"];
    $regCertf = $_FILES["regCertf"]["name"];
    $plying = $_FILES["plying"]["name"];
    $pollution = $_FILES["pollution"]["name"];
	
	if(!file_exists($targetDir = $targetDir . '/' . $regNo . '/')){
		mkdir($targetDir . '/' . $regNo . '/', 0777, true);
	}

    $voters = basename($_FILES["voters"]["name"]);
    $votersFilePath = $targetDir . $voters;

    $pVoters = basename($_FILES["pVoters"]["name"]);
    $pVotersFilePath = $targetDir . $pVoters;

    $saleLetter = basename($_FILES["saleLetter"]["name"]);
    $saleLetterFilePath = $targetDir . $saleLetter;

    $regCertf = basename($_FILES["regCertf"]["name"]);
    $regCertfFilePath = $targetDir . $regCertf;

    $plying = basename($_FILES["plying"]["name"]);
    $plyingFilePath = $targetDir . $plying;

    $pollution = basename($_FILES["pollution"]["name"]);
    $pollutionFilePath = $targetDir . $pollution;

    $fileType = pathinfo($votersFilePath, PATHINFO_EXTENSION);

    if (
        isset($_POST["submit"]) && !empty($_FILES["voters"]["name"]) && !empty($_FILES["pVoters"]["name"]) && !empty($_FILES["saleLetter"]["name"]) && !empty($_FILES["regCertf"]["name"])
        && !empty($_FILES["plying"]["name"]) && !empty($_FILES["pollution"]["name"])
    ) {

        //allow certain file formats
        $allowTypes = array('jpg', 'png', 'jpeg', 'pdf');
        if (in_array($fileType, $allowTypes)) {
            //upload file to server
            if (move_uploaded_file($_FILES["voters"]["tmp_name"], $votersFilePath)) {
                $statusMsg1 = "The file " . $voters . " has been uploaded.";
            } else {
                $statusMsg2 = "Sorry, there was an error uploading your file.";
            }
            if (move_uploaded_file($_FILES["pVoters"]["tmp_name"], $pVotersFilePath)) {
                $statusMsgp = "The file " . $pVoters . " has been uploaded.";
            } else {
                $statusMsg2 = "Sorry, there was an error uploading your file.";
            }
            if (move_uploaded_file($_FILES["saleLetter"]["tmp_name"], $saleLetterFilePath)) {
                $statusMsg3 = "The file " . $saleLetter . " has been uploaded.";
            } else {
                $statusMsg4 = "Sorry, there was an error uploading your file.";
            }
            if (move_uploaded_file($_FILES["regCertf"]["tmp_name"], $regCertfFilePath)) {
                $statusMsg6 = "The file " . $regCertf . " has been uploaded.";
            } else {
                $statusMsg6 = "Sorry, there was an error uploading your file.";
            }
            if (move_uploaded_file($_FILES["plying"]["tmp_name"], $plyingFilePath)) {
                $statusMsg7 = "The file " . $plying . " has been uploaded.";
            } else {
                $statusMsg8 = "Sorry, there was an error uploading your file.";
            }
            if (move_uploaded_file($_FILES["pollution"]["tmp_name"], $pollutionFilePath)) {
                $statusMsg9 = "The file " . $pollution . " has been uploaded.";
            } else {
                $statusMsg10 = "Sorry, there was an error uploading your file.";
            }
        } else {
            $statusMsg = 'Sorry, only JPG, JPEG, PNG & PDF files are allowed to upload.';
        }
    } else {
        $statusMsg = 'Please select a file to upload.';
    }

    $sql = "INSERT INTO `entry`(`name`, `fName`, `address`, `regNo`, `reason`,`pHolderName`, `pHolder`, `phoneNo`,`typeOfVehicle`,`dto`,`domain`,`dot`,`deceased`,`place`,
    `relation`,`news`,`newsDate`,`transferDate`,`appName`,`pNo`,`voters`,`pVoters`,`saleLetter`,`regCertf`,`plying`,`pollution`,`adtsta`) 
    VALUES ('$name','$fName','$address','$regNo','$reason','$currentOwnerName','$currentOwner','$phoneNo','$VehicleType','$dto','$domain','$dot','$deceased','$place',
    '$relation','$news','$newsDate','$transferDate','$appName','$pNo','$votersFilePath','$pVotersFilePath','$saleLetterFilePath','$regCertfFilePath','$plyingFilePath','$pollutionFilePath',1)";
    if ($result = $con->query($sql)) {
        echo '<script>
         $(document).ready(function(){
                Swal.fire({
                title: "Application Entered",
                type: "success"
            }).then(function() {
                window.location = "index.php";
            })});
        </script>';
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
    <h3>Transfer of Ownership</h3>
    <form class="row g-3" method="post" enctype="multipart/form-data">
        <div class="col-md-4">
            <label for="name" class="form-label">Name of Applicant</label>
            <input type="text" name="name" class="form-control" id="name" placeholder="Name">
        </div>
        <div class="col-md-4">
            <label for="fName" class="form-label">S/o / D/o / W/o</label>
            <input type="text" name="fName" class="form-control" id="fName" placeholder="S/o / D/o / W/o Name">
        </div>
        <div class="col-md-4">
            <label for="inputAddress" class="form-label">Address</label>
            <input type="text" name="inputAddress" class="form-control" id="inputAddress" placeholder="Proof of address to be enclosed">
        </div>
        <div class="col-md-4">
            <label for="regNo" class="form-label">Registration No</label>
            <input type="text" name="regNo" class="form-control" id="regNo" placeholder="MZ0XXX1234">
        </div>
        <div class="col-md-4">
            <label for="reason" class="form-label">Reason</label>
            <input type="text" name="reason" class="form-control" id="reason" placeholder="Reason">
        </div>
        <div class="col-md-4">
            <label for="currentOwnerName" class="form-label">Present Permit Holder Name</label>
            <input type="text" name="currentOwnerName" class="form-control" id="currentOwnerName" placeholder="Present Permit Holder Name">
        </div>
        <div class="col-md-4">
            <label for="currentOwnerAddress" class="form-label">Present Permit Holder Full address</label>
            <input type="text" name="currentOwner" class="form-control" id="currentOwnerAddress" placeholder="Present Permit Holder Full address">
        </div>
        <div class="col-md-4">
            <label for="phoneNo" class="form-label">Phone No</label>
            <input type="text" name="phoneNo" class="form-control" id="phoneNo" placeholder="Phone No">
        </div>
        <div class="col-md-4">
            <label for="VehicleType" class="form-label">Type of Vehicle</label>
            <select name="VehicleType" class="form-control" id="VehicleType">
                <option value="">----SELECT-----</option>
                <?php
                $query = "SELECT * from class";
                $result = $con->query($query);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
                    }
                }
                ?>
            </select>
        </div>
        <div class="col-md-4">
            <label for="dto" class="form-label">DTO</label>
            <select name="dto" class="form-control" id="dto">
                <option value="">---SELECT---</option>
                <?php
                $sql = "SELECT * FROM dto";
                $result1 = $con->query($sql);
                if ($result1->num_rows > 0) {
                    while ($row = $result1->fetch_assoc()) {
                        echo
                        '<option value="' . $row['dto_name'] . '">' . $row['dto_code'] . '-' . $row['dto_name'] . '</option>';
                    }
                }

                ?>
            </select>
        </div>
        <div class="col-md-4">
            <label for="dot" class="form-label">Date of Transfer</label>
            <input type="date" name="dot" class="form-control" id="dot" placeholder="Date of Transfer" autocomplete="off">
        </div>
        <div class="col-md-4">
            <label for="domain" class="form-label">Domain</label>
            <input type="text" name="domain" class="form-control" id="domain" placeholder="Domain">
        </div>
        <hr />
        <h5>APPLICATION WITH DEATH CERTIFICATE</h5>
        <hr />
        <div class="col-md-4">
            <label for="deceased" class="form-label">Date of Deceased</label>
            <input type="date" name="deceased" class="form-control" id="deceased" placeholder="Date of Deceased">
        </div>
        <div class="col-md-4">
            <label for="place" class="form-label">Place of Deceased</label>
            <input type="text" name="place" class="form-control" id="place" placeholder="Place of Deceased">
        </div>
        <div class="col-md-4">
            <label for="relation" class="form-label">Relation with the deceased person</label>
            <input type="text" name="relation" class="form-control" id="relation" placeholder="Relation">
        </div>
        <div class="col-md-4">
            <label for="news" class="form-label">Name of News Paper in which notice is published</label>
            <input type="text" name="news" class="form-control" id="news" placeholder="News Paper">
        </div>
        <div class="col-md-4">
            <label for="newsDate" class="form-label">Date of News Paper in which notice is published</label>
            <input type="date" name="newsDate" class="form-control" id="newsDate" autocomplete="off">
        </div>
        <div class="col-md-4">
            <label for="transferDate" class="form-label">Effective date of Transfer of Permit</label>
            <input type="date" name="transferDate" class="form-control" id="transferDate" placeholder="Transfer Date" autocomplete="off">
        </div>
        <div class="col-md-4">
            <label for="appName" class="form-label">Name of Applicant</label>
            <input type="text" name="appName" class="form-control" id="appName" placeholder="Applicant Name">
        </div>
        <div class="col-md-4">
            <label for="pNo" class="form-label">Phone Number</label>
            <input type="text" name="pNo" class="form-control" id="pNo" placeholder="Phone No">
        </div>
        <div class="col-md-8">

        </div>
        <div class="col-6">
            <hr />
            <h5>Documents</h5>
            <hr />
            <label for="formFile" class="form-label">Voters ID(Transferee)</label>
            <input class="form-control" name="voters" type="file" id="formFile">
            <label for="formFilev" class="form-label">Voters ID(Transferer)</label>
            <input class="form-control" name="pVoters" type="file" id="formFilev">
            <label for="formFile1" class="form-label">Sales Letter</label>
            <input class="form-control" name="saleLetter" type="file" id="formFile1">
            <label for="formFile2" class="form-label">Registration Certificate</label>
            <input class="form-control" name="regCertf" type="file" id="formFile2">
            <label for="formFile3" class="form-label">Plying permit</label>
            <input class="form-control" name="plying" type="file" id="formFile3">
            <label for="formFile4" class="form-label">Pollution Certificate</label>
            <input class="form-control" name="pollution" type="file" id="formFile4">
        </div>
        <div class="col-6">
            <hr />
            <h5>In Case of Accident Vehicle</h5>
            <hr />
            <label for="formFil5e" class="form-label">Police Report</label>
            <input class="form-control" name="policeReport" type="file" id="formFil5e">
            <label for="formFile6" class="form-label">MVI Inspection Report</label>
            <input class="form-control" name="mvi" type="file" id="formFile6">
            <label for="formFile7" class="form-label">Death Certificate</label>
            <input class="form-control" name="death" type="file" id="formFile7">
        </div>
        <div class="mb-3">
            <button type="submit" name="submit" value="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
</div>

<?php include('footer.php') ?>