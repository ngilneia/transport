<?php
require('db.php');
include("header.php");
$ids = $_GET['id'];
if (isset($_POST['submit'])) {
    $entry_id = $ids;
    $regNo = $_POST['regNo'];
    $name = $_POST['name'];
    $address = $_POST['address'];
    $remarks = $_POST['remarks'];
    $vClass = $_POST['vClass'];
    $place = $_POST['place'];



    $sql = "INSERT INTO `inspection`(`entry_id`,`regNo`,`name`,`address`,`vClass`,`remarks`) 
    values ('$entry_id','$regNo','$name','$address','$vClass','$remarks')";
    $insert = $con->query($sql);

    $updateSql = "UPDATE `entry` set `mvi`=1,`adtsta`=NULL, inspection=now(),`inspectionPlace`='$place' where entry_id=$ids";
    $result = $con->query($updateSql);
    if ($result == TRUE && $insert == TRUE) {
        echo '<script>
        $(document).ready(function(){
                Swal.fire({
                title: "Application Approved",
                type: "success"
            }).then(function() {
                window.location = "routeInspectionList.php";
            })});
        </scrip>';
    } else {
        echo "Error:" . $updateSql . "<br>" . $con->error;
        echo "Error:" . $sql . "<br>" . $con->error;
    }
}
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM `entry` WHERE entry_id='$id'";
    $result = $con->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $entry_id = $row['entry_id'];
            $name = $row['name'];
            $fname = $row['fname'];
            $address = $row['address'];
            $regNo = $row['regNo'];
            $reason = $row['reason'];
            $fromRoute = $row['fromRoute'];
            $toRoute = $row['toRoute'];
            $phoneNo = $row['phoneNo'];
            $reason = $row['reason'];
            $typeOfVehicle = $row['typeOfVehicle'];
            $dto = $row['dto'];
            $sql = "SELECT name FROM class where id=$typeOfVehicle";
            $result = $con->query($sql);
            $rows = $result->fetch_assoc();
            $vClass = $rows['name'];
        }
?>
        <div>
            <p>Inspection</p>
            <form class="row g-3" method="post" enctype="multipart/form-data">
                <div class="form-check col-3">
                    <label class="form-check-label" for="regNo">
                        1) Registration No
                    </label>
                    <input type="text" name="regNo" class="form-control" id="regNo" value="<?php echo $regNo; ?>" readonly="readonly">
                </div>
                <div class="form-check col-3">
                    <label class="form-check-label" for="name">
                        2) Owner's Name
                    </label>
                    <input type="text" name="name" class="form-control" id="name" value="<?php echo $name; ?>" readonly="readonly">
                </div>
                <div class="form-check col-3">
                    <label class="form-check-label" for="fname">
                        3) Fathers Name
                    </label>
                    <input type="text" name="fname" class="form-control" id="fname" value="<?php echo $fname; ?>" readonly="readonly">
                </div>
                <div class="form-check col-3">
                    <label class="form-check-label" for="address">
                        4) Address
                    </label>
                    <input type="text" name="address" class="form-control" id="address" value="<?php echo $address; ?>" readonly="readonly">
                </div>
                <div class="form-check col-3">
                    <label class="form-check-label" for="phoneNo">
                        5) Phone Number
                    </label>
                    <input type="text" name="phoneNo" class="form-control" id="phoneNo" value="<?php echo $phoneNo; ?>" readonly="readonly">
                </div>
                <div class="form-check col-3">
                    <label class="form-check-label" for="fromRoute">
                        6) Route From
                    </label>
                    <input type="text" name="fromRoute" class="form-control" id="fromRoute" value="<?php echo $fromRoute; ?>" readonly="readonly">
                </div>
                <div class="form-check col-3">
                    <label class="form-check-label" for="toRoute">
                        7) Route To
                    </label>
                    <input type="text" name="toRoute" class="form-control" id="toRoute" value="<?php echo $toRoute; ?>" readonly="readonly">
                </div>
                <div class="form-check col-3">
                    <label class="form-check-label" for="reason">
                        8) Reason
                    </label>
                    <input type="text" name="reason" class="form-control" id="reason" value="<?php echo $reason; ?>" readonly="readonly">
                </div>
                <div class="form-check col-3 ">
                    <label for="vClass" class="form-check-label">9) Vehicle Class</label>
                    <input type="text" name="vClass" class="form-control" id="vClass" value="<?php echo $vClass; ?>" readonly="readonly">
                </div>
                <div class="form-check col-3 ">
                    <label for="dto" class="form-check-label">10) DTO</label>
                    <input type="text" name="dto" class="form-control" id="dto" value="<?php echo $dto; ?>" readonly="readonly">
                </div>

        </div>
        <hr />
        <div class="col">
            <p>I, the udersigned hereby declare the above validity of documents shown are true and correct</p>
            <div class="row">
                <div class="form-check col-4">
                    <label class="form-check-label" for="place">
                        Place of Inspection
                    </label>
                    <input type="text" name="place" class="form-control" id="place">
                </div>
                <div class="form-check col-8">
                    <label class="form-check-label" for="remarks">
                        Remarks
                    </label>
                    <input type="text" class="form-control" id="remarks" name="remarks" placeholder="VC Lehkha a nei em. NOC nen">
                </div>
                <div class="col-12  text-center">
                    <button type="submit" name="submit" value="submit" class="btn btn-primary" id="addbtn"> Submit </button>
                </div>
                </form>
            </div>
        </div>
<?php }
} ?>
<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/sweetalert2.all.min.js"></script>

</body>

</html>