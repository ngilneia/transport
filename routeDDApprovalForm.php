<?php
require('db.php');
include("header.php");
$id = $_GET['id'];
$entrySql = "";
if (isset($_POST['approve'])) {
    $remarks = $_POST['remarksA'];

    $entrySql = "UPDATE `entry` set `dd`=1, `ddApproveDate`=now(),`ddRemarks`='$remarks' WHERE `entry_id`=$id";
    $updateSQL = $con->query($entrySql);
    if ($updateSQL == TRUE) {
        echo
        '<script>
        $(document).ready(function(){
                Swal.fire({
                title: "Application Approved",
                type: "success"
            }).then(function() {
                window.location = "routeInspectedList.php";
            })});
        </script>';
    } else {
        echo "Error:" . $updateSQL . "<br>" . $con->error;
    }
} else if (isset($_POST['reject'])) {
    $remarks = $_POST['remarksA'];
    $deletefromInspection = "DELETE from Inspection where entry_id=$id";
    $deleteStmt = $con->query($deletefromInspection);
    $rejectSql = "UPDATE `entry` set dd=2,ddRemarks='$remarks',mvi=NULL,inspection=NULL,inspectionPlace=NULL where entry_id=$id;";
    $reject = $con->query($rejectSql);
    if ($reject == TRUE) {
        echo
        '<script>
         $(document).ready(function(){
                Swal.fire({
                title: "Application Rejected",
                type: "success"
            }).then(function() {
                window.location = "routeInspectedList.php";
            })});
        </script>';
    } else {
        echo "Error:" . $entrySql . "<br>" . $con->error;
    }
}
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM `inspection` a join entry b on a.entry_id=b.entry_id WHERE b.entry_id='$id'";
    $result = $con->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $name = $row['name'];
            $address = $row['address'];
            $regNo = $row['regNo'];
            $vClass = $row['vClass'];
            $reason = $row['reason'];
            $phoneNo = $row['phoneNo'];
            $fromRoute = $row['fromRoute'];
            $toRoute = $row['toRoute'];
            $remarks = $row['remarks'];
            $dto = $row['dto'];
        }
?>
        <div class="row">
            <div class="col-4"></div>
            <div class="col-4">
                <table class="table">
                    <tr>
                        <td>Registration No</td>
                        <td><?php echo $regNo; ?></td>
                    </tr>
                    <tr>
                        <td>Vehicle Class</td>
                        <td><?php echo $vClass; ?></td>
                    </tr>
                    <tr>
                        <td>Applicant's Name</td>
                        <td><?php echo $name; ?></td>
                    </tr>
                    <tr>
                        <td>Address</td>
                        <td><?php echo $address; ?></td>
                    </tr>
                    <tr>
                        <td>Reason</td>
                        <td><?php echo $reason; ?></td>
                    </tr>
                    <tr>
                        <td>Phone Number</td>
                        <td><?php echo $phoneNo; ?></td>
                    </tr>
                    <tr>
                        <td>Route From</td>
                        <td><?php echo $fromRoute; ?></td>
                    </tr>
                    <tr>
                        <td>Route To</td>
                        <td><?php echo $toRoute; ?></td>
                    </tr>
                    <tr>
                        <td>District Transport Authority</td>
                        <td><?php echo $dto; ?></td>
                    </tr>
                    <tr>
                        <td>INSPECTION REMARKS</td>
                        <td><?php echo $remarks; ?></td>
                    </tr>
                </table>
            </div>
            <div class="col-4"></div>
            <form class="row g-3" method="post" enctype="multipart/form-data">
                <div class="form-check">
                    <label class="form-check-label" for="remarksA">
                        Remarks
                    </label>
                    <input type="text" name="remarksA" class="form-control" id="remarksA">
                </div>
                <div class="col text-center">
                    <button type="submit" name="approve" value="approve" class="btn btn-primary">Approve</button>
                    <button type="submit" name="reject" value="reject" class="btn btn-danger">Reject</button>
                </div>
            </form>

        </div>

<?php }
} ?>
<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/sweetalert2.all.min.js"></script>
</body>

</html>