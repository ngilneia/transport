<?php
require('db.php');
include("header.php");
if (isset($_POST['submit'])) {
    $sql = "UPDATE `entry` SET jd_approve = " . $_GET['id'];
    $sql1 =    "UPDATE `inspection` SET jd_approve = " . $_GET['id'];
    $result = $con->query($sql);
    if ($result == TRUE) {
        echo
        "<script type='text/javascript'>
        $(document).ready(function(){
                  Swal . fire(
            'Application Approved!',   
            'success'
        )});
        </script>";
    } else {
        echo "Error:" . $sql . "<br>" . $con->error;
    }
}
if (isset($_GET['id'])) {
    $sql = "SELECT * FROM `inspection` JOIN `entry` on inspection.regNo = entry.regNo WHERE inspection_id=" . $_GET['id'];
    $result = $con->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $name = $row['name'];
            $fName = $row['fname'];
            $address = $row['address'];
            $regNo = $row['regNo'];
            $reason = $row['reason'];
            $pHolder = $row['pHolder'];
            $vClass = $row['vClass'];
            $mYear = $row['mYear'];
            $rTax = $row['rTax'];
            $pTax = $row['pTax'];
            $fc = $row['fc'];
            $fp = $row['fp'];
            $i = $row['i'];
            $p = $row['p'];
            $remarks = $row['remarks'];
        }

?>
        <div>
            <p>Approve</p>
            <table class="table">
                <tr>
                    <td>Name</td>
                    <td><?php echo $name; ?></td>
                </tr>
                <tr>
                    <td>S/o W/o H/o Name</td>
                    <td><?php echo $fName; ?></td>
                </tr>
                <tr>
                    <td>Address</td>
                    <td><?php echo $address; ?></td>
                </tr>
                <tr>
                    <td>Registration Number</td>
                    <td><?php echo $regNo; ?></td>
                </tr>
                <tr>
                    <td>Reason for necessity of Transfer</td>
                    <td><?php echo $reason; ?></td>
                </tr>
                <tr>
                    <td>Name of present permit holder with full address</td>
                    <td><?php echo $pHolder; ?></td>
                </tr>
                <tr>
                    <td>Type and Class of Vehicle</td>
                    <td><?php echo $vClass; ?></td>
                </tr>
                <tr>
                    <td>Year of Manufacture as printed in RC</td>
                    <td><?php echo $mYear; ?></td>
                </tr>
                <tr>
                    <td>Road Tax</td>
                    <td><?php echo $rTax; ?></td>
                </tr>
                <tr>
                    <td>P&G Tax</td>
                    <td><?php echo $pTax; ?></td>
                </tr>
                <tr>
                    <td>Fitness Certificate</td>
                    <td><?php echo $fc; ?></td>
                </tr>
                <tr>
                    <td>Plying permit</td>
                    <td><?php echo $fp; ?></td>
                </tr>
                <tr>
                    <td>Insuarance</td>
                    <td><?php echo $i; ?></td>
                </tr>
                <tr>
                    <td>Pollution</td>
                    <td><?php echo $p; ?></td>
                </tr>
                <tr>
                    <td>Remarks</td>
                    <td><?php echo $remarks; ?></td>
                </tr>
            </table>
            <form class="row g-3" method="post">
                <div class="form-check col-12">
                    <label class="form-check-label" for="5">Remarks</label>
                    <input class="form-control" type="text" name="jdApprove" id="5" required>
                </div>
                <div class="mb-3">
                    <button type="submit" name="submit" value="submit" class="btn btn-primary">Approve</button>
                    <button type="" name="" value="" class="btn btn-danger">Reject</button>
                </div>
            </form>
        </div>
<?php }
} ?>
<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/sweetalert2.all.min.js"></script>
</body>

</html>