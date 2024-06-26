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
    header("Location: inspectedList.php");
    exit;
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
            $mYear = date('d-m-Y', strtotime($row['mYear']));
            $rTax = date('d-m-Y', strtotime($row['rTax']));
            $pTax = date('d-m-Y', strtotime($row['pTax']));
            $fc = date('d-m-Y', strtotime($row['fc']));
            $fp = date('d-m-Y', strtotime($row['fp']));
            $i = date('d-m-Y', strtotime($row['i']));
            $p = date('d-m-Y', strtotime($row['p']));
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
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#I">
                    Application for Transfer of Permit - Part I
                </button>
                <!-- Modal -->
                <div class="modal fade" id="I" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Application for Transfer of Permit - Part I</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <?php
                                if (isset($_GET['id'])) {
                                    $id = $_GET['id'];
                                    $sql = "SELECT * FROM `entry` WHERE entry_id='$id'";
                                    $result = $con->query($sql);
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            $name = $row['name'];
                                            $fName = $row['fname'];
                                            $pHolderName = $row['pHolderName'];
                                            $address = $row['address'];
                                            $regNo = $row['regNo'];
                                            $reason = $row['reason'];
                                            $pHolder = $row['pHolder'];
                                            $dot = $row['dot'];
                                            $pno = $row['pNo'];
                                        }
                                ?>
                                        <p>I, <?php echo $name; ?> apply for transfer of the above mentioned permit from <?php echo $pHolderName; ?>(Transfer) to <?php echo $name; ?>(Transferee).</p>
                                        <p>We hereby declare that the price agreed to be paid for each vehicle is stated below:-</p>
                                        <p>We hereby declare that the following agreement is made for transfer of the permit:</p>
                                        <p>The Transfer is to be effective from <?php echo $dot; ?></p>
                                        <div>
                                            <div class="row">
                                                <div class="col-6 col-md-4">
                                                    <p><?php echo $pHolderName; ?></p>
                                                    <p>(Transferer)(Hralhtu)</p>
                                                    <p>Date:<?php echo $dot; ?></p>
                                                </div>
                                                <div class="col-6 col-md-4"></div>
                                                <div class=" col-6 col-md-4">
                                                    <p><?php echo $name; ?></p>
                                                    <p>(Transferee)(Leitu)</p>
                                                    <p><?php echo $pno; ?></p>
                                                </div>
                                            </div>
                                        </div>
                                <?php }
                                } ?>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Modal -->
                <br />
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#II">
                    Application for Transfer of Permit - Part II
                </button>
                <!-- Modal -->
                <div class="modal fade" id="II" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Application for Transfer of Permit - Part II</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <?php
                                $sql = "SELECT * FROM `entry` WHERE entry_id='$id'";
                                $result = $con->query($sql);
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        $name = $row['name'];
                                        $fName = $row['fname'];
                                        $pHolderName = $row['pHolderName'];
                                        $address = $row['address'];
                                        $regNo = $row['regNo'];
                                        $reason = $row['reason'];
                                        $pHolder = $row['pHolder'];
                                        $decease = $row['deceased'];
                                        $relation = $row['relation'];
                                        $news = $row['news'];
                                        $place = $row['place'];
                                        $dot = $row['dot'];
                                    }
                                ?>

                                    <p>I, <?php echo $name; ?> apply for transfer of the above mentioned permit which was held by Sri <?php echo $pHolderName; ?> who died on <?php echo $decease; ?> at<?php echo $place; ?>(Death Certificate Attached) </p>
                                    <p>My relation to the demise permit holder is on <?php echo $relation; ?> the said vehicle is in my pocession.</p>
                                    <p>I hereby declare that I have published a notice in __________ a local newspaper(<?php echo $news; ?> in its edition dated ______</p>
                                    <p>A copy of the above mentioned edition of the said newspaper is attached herewith.</p>
                                    <div>
                                        <div class="row">
                                            <div class="col-6 col-md-4">
                                            </div>
                                            <div class="col-6 col-md-4"></div>
                                            <div class=" col-6 col-md-4">
                                                <p><?php echo $name; ?></p>
                                                <p>Name of Applicant</p>
                                                <p><?php echo ''; ?></p>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        <?php }
                        ?>
                        </div>
                    </div>
                </div>
                <!-- End Modal -->
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