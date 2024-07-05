<?php
require('db.php');
include("header.php");
$id = $_GET['id'];
if (isset($_POST['approve'])) {
    $remarks = $_POST['remarksA'];

    $entrySql = "UPDATE `entry` set `dd`=1, `ddApproveDate`=now(),`ddRemarks`='$remarks' WHERE `entry_id`=$id";
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
} else if (isset($_POST['reject'])) {
    $deletefromInspection = "DELETE from Inspection where entry_id=$id";
    $deleteStmt = $con->query($deletefromInspection);
    $rejectSql = "UPDATE `entry` set ,dd=2,mvi=NULL,MVI=NULL,inspection=NULL,inspectionPlace=NULL where entry_id=$id;";
    $reject = $con->query($rejectSql);
    if ($result == TRUE) {
        echo
        '<script>
        $(document).ready(function(){
                Swal.fire({
                title: "Application Approved",
                type: "success"
            }).then(function() {
                window.location = "inspectedList.php";
            })});
        </script>';
    } else {
        echo "Error:" . $entrySql . "<br>" . $con->error;
    }
}
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM `inspection` WHERE entry_id='$id'";
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
            $p = date('d-m-Y', strtotime($row['p']));
            $remarks = $row['remarks'];
            $currentDateTime = new DateTime('now');
            $currentDate = $currentDateTime->format('d-m-Y');
            $mYearD = date_diff(date_create($currentDate), date_create($mYear));
            $rTaxD = date_diff(date_create($currentDate), date_create($rTax));
            $pTaxD = date_diff(date_create($currentDate), date_create($pTax));
            $fcD = date_diff(date_create($currentDate), date_create($fc));
            $fpD = date_diff(date_create($currentDate), date_create($fp));
            $iD = date_diff(date_create($currentDate), date_create($i));
            $pD = date_diff(date_create($currentDate), date_create($p));
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
                        <td><?php echo $rTax . ', ' . $rTaxD->format("%R%a Days left for renewal"); ?></td>
                    </tr>
                    <tr>
                        <td>2. P&G Tax</td>
                        <td><?php echo $p . ', ' . $pD->format("%R%a Days left for renewal"); ?></td>
                    </tr>
                    <tr>
                        <td>3. Fitness</td>
                        <td><?php echo $fc . ', ' . $fcD->format("%R%a Days left for renewal"); ?></td>
                    </tr>
                    <tr>
                        <td>4. Plying permit</td>
                        <td><?php echo $pTax . ', ' . $pTaxD->format("%R%a Days left for renewal"); ?></td>
                    </tr>
                    <tr>
                        <td>5. Insurance</td>
                        <td><?php echo $i . ', ' . $iD->format("%R%a Days left for renewal"); ?></td>
                    </tr>
                    <tr>
                        <td>6. PUCC</td>
                        <td><?php echo $fp . ', ' . $fpD->format("%R%a Days left for renewal"); ?></td>
                    </tr>
                </table>
            </div>
            <div class="col">
                <h4>Documents</h4>
                <?php
                $sql = "SELECT * FROM entry a inner join inspection b on a.entry_id=b.entry_id where a.entry_id='$id' ";
                $result = $con->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                ?>

                        <?php echo '<embed frameborder="0" width="100%" height="400px" src="http://localhost/transport/' . $row['voters'] . '">Voters ID</embed><br/>'; ?>
                        <?php echo '<embed frameborder="0" width="100%" height="400px" src="http://localhost/transport/' . $row['RRegCertificate'] . '">Registration Certificate</embed><br/>'; ?>
                        <?php echo '<embed frameborder="0" width="100%" height="400px" src="http://localhost/transport/' . $row['ROtherDoc'] . '">Other Document</embed><br/>'; ?>
                        <?php echo '<embed frameborder="0" width="100%" height="400px" src="http://localhost/transport/' . $row['RMVIReport'] . '">MVI & Police Report</embed><br/>'; ?>

                <?php       }
                }
                ?>
            </div>
            <form class="row g-3" method="post" enctype="multipart/form-data">

                <p>I, the udersigned hereby declare the above validity of documents shown are true and correct</p>
                <div class="form-check">
                    <label class="form-check-label" for="remarksA">
                        Remarks of Inspecting Authority
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