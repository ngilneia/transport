<?php
require('db.php');
include("header.php");
$id = $_GET['id'];
if (isset($_POST['approve'])) {
    $remarks = $_POST['remarksA'];

    $entrySql = "UPDATE `entry` set `adtmv`=1, `adtmvApproveDate`=now(),`adtmvRemarks`='$remarks' WHERE `entry_id`=$id";
    $updateSQL = $con->query($entrySql);
    if ($updateSQL == TRUE) {
        echo
        "<script type='text/javascript'>
        $(document).ready(function(){
                  Swal . fire(
            'Application Approved!',   
            'success'
        )});
        </script>";
    } else {
        echo "Error:" . $updateSQL . "<br>" . $con->error;
    }
}
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM `inspection` WHERE inspection_id='$id'";
    $result = $con->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $regNo = $row['regNo'];
            $name = $row['name'];
            $address = $row['address'];
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
        <div class="row">
            <div class="col">
                <table class="table">
                    <tr>
                        <td>Registration No</td>
                        <td colspan="3"><?php echo $regNo; ?></td>
                    </tr>
                    <tr>
                        <td>Owner's Name</td>
                        <td colspan="3"><?php echo $name; ?></td>
                    </tr>
                    <tr>
                        <td>Address</td>
                        <td colspan="3"><?php echo $address; ?></td>
                    </tr>
                    <tr>
                        <td>Year of Manufacture<br />(As printed in RC)</td>
                        <td colspan="3"><?php echo $mYear; ?></td>
                    </tr>
                    <tr>
                        <td colapan="4">Validity of Documents</td>
                    </tr>
                    <tr>
                        <td>1. MV Tax</td>
                        <td><?php echo $rTax;  ?></td>
                    </tr>
                    <tr>
                        <td>2. P&G Tax</td>
                        <td><?php echo $p; ?></td>
                    </tr>
                    <tr>
                        <td>3. Fitness</td>
                        <td><?php echo $fc; ?></td>
                    </tr>
                    <tr>
                        <td>4. Plying permit</td>
                        <td><?php echo $pTax; ?></td>
                    </tr>
                    <tr>
                        <td>5. Insuarance</td>
                        <td><?php echo $i; ?></td>
                    </tr>
                    <tr>
                        <td>6. PUCC</td>
                        <td><?php echo $fp; ?></td>
                    </tr>
                </table>
            </div>
            <div class="col">
                <form class="row g-3" method="post" enctype="multipart/form-data">
                    <p>I, the udersigned hereby declare the above validity of documents shown are true and correct</p>
                    <div class="form-check">
                        <label class="form-check-label" for="remarksA">
                            Remarks of Inspecting Authority
                        </label>
                        <input type="text" name="remarksA" class="form-control" id="remarksA">
                    </div>
                    <div class="col">
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