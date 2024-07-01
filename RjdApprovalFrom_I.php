<?php
require('db.php');
$id = $_GET['id'];
include("header.php");
if (isset($_POST['approve'])) {
    $remarks = $_POST['remarksA'];
    $entrySql = "UPDATE `entry` set jd='1',jdApproveDate=now(),jdRemarks='$remarks' where entry_id=$id;";
    $result = $con->query($entrySql);
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
        echo "Error:" . $entrySql . "<br>" . $con->error;
    }
} else if (isset($_POST['reject'])) {
    header("Location: RjdApprovalList.php");
    exit;
}
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM `inspection` a INNER JOIN `entry` b ON a.inspection_id=b.entry_id WHERE inspection_id='$id'";
    $result = $con->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $regNo = $row['regNo'];
            $name = $row['name'];
            $address = $row['address'];
            $vClass = $row['vClass'];
            $mYear = date('d-m-Y', strtotime($row['mYear']));
            $rTax = date('d-m-Y', strtotime($row['rTax']));
            $pTax = date('d-m-Y', strtotime($row['pTax']));
            $fc = date('d-m-Y', strtotime($row['fc']));
            $fp = date('d-m-Y', strtotime($row['fp']));
            $i = date('d-m-Y', strtotime($row['i']));
            $today = date('d-m-Y');
            $remarks = $row['remarks'];
            $ddRemarks = $row['ddRemarks'];
            $approve = $row['adtmvApproveDate'];
            $currentDateTime = new DateTime('now');
            $currentDate = $currentDateTime->format('d-m-Y');
            $mYearD = date_diff(date_create($currentDate), date_create($mYear));
            $rTaxD = date_diff(date_create($currentDate), date_create($rTax));
            $pTaxD = date_diff(date_create($currentDate), date_create($pTax));
            $fcD = date_diff(date_create($currentDate), date_create($fc));
            $fpD = date_diff(date_create($currentDate), date_create($fp));
            $iD = date_diff(date_create($currentDate), date_create($i));
        }
?>
        <div class="container">
            <h3 class="text-center">APPLICATION FOR REPLACEMENT OF VEHICLE</h3>
            <?php echo $today; ?>
            <h4 class="text-center"><?php echo 'VEHICLE NUMBER : ' . $regNo; ?></h4>
            <table class="table">
                <tr>
                    <td>
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
                                <td colspan="3"><?php echo $mYear . ', ' . $mYearD->format("%d Days left for renewal"); ?></td>
                            </tr>
                            <tr>
                                <td colapan="4">Validity of Documents</td>
                            </tr>
                            <tr>
                                <td>1. MV Tax</td>
                                <td><?php echo $rTax . ', ' . $rTaxD->format("%d Days left for renewal"); ?></td>
                            </tr>
                            <tr>
                                <td>2. P&G Tax</td>
                                <td><?php echo $pTax . ', ' . $pTaxD->format("%d Days left for renewal"); ?></td>
                            </tr>
                            <tr>
                                <td>3. Fitness</td>
                                <td><?php echo $fc . ', ' . $fcD->format("%d Days left for renewal"); ?></td>
                            </tr>
                            <tr>
                                <td>4. Plying permit</td>
                                <td><?php echo $pTax . ', ' . $pTaxD->format("%d Days left for renewal"); ?></td>
                            </tr>
                            <tr>
                                <td>5. Insurance</td>
                                <td><?php echo $i . ', ' . $iD->format("%d Days left for renewal"); ?></td>
                            </tr>
                            <tr>
                                <td>Approved on</td>
                                <td><?php echo $approve; ?></td>
                            </tr>
                        </table>
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <td><strong>MVI Remarks :</strong> <?php echo $remarks; ?></td>
                    <td><strong>Deputy Director Remarks :</strong> <?php echo $ddRemarks; ?></td>
                </tr>
            </table>
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