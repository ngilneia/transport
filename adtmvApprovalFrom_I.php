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
        echo "Error:" . $updateSQL . "<br>" . $con->error;
    }
} else if (isset($_POST['reject'])) {
    $deletefromInspection = "DELETE from Inspection where entry_id=$id";
    $deleteStmt = $con->query($deletefromInspection);
    $rejectSql = "Update `entry` set ,dd=2,mvi=NULL,MVI=NULL,inspection=NULL,inspectionPlace=NULL where entry_id=$id;";
    $reject = $con->query($rejectSql);
    if ($result == TRUE) {
        echo
        '<script>
         $(document).ready(function(){
                Swal.fire({
                title: "Application Rejected",
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
    $sql = "SELECT * FROM `inspection` a join entry b on a.entry_id=b.entry_id WHERE b.entry_id='$id'";
    $result = $con->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $regNo = $row['regNo'];
            $name = $row['pHolderName'];
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
                <div class="col">
                    <h4>Documents</h4>

                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#voters">
                        Voters ID(Transferee)
                    </button>
                    <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#pVoters">
                        Voters ID(Transferer)
                    </button>
                    <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#saleLetter">
                        Sale Letter
                    </button>
                    <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#regCertf">
                        Registration Certificate
                    </button>
                    <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#plying">
                        Plying Permit
                    </button>
                    <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#pollution">
                        Pollution Certificate
                    </button>

                    <?php
                    $sql = "SELECT * FROM entry a inner join inspection b on a.entry_id=b.entry_id where a.entry_id='$id' ";
                    $result = $con->query($sql);
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                    ?>
                            <!-- Voter Modal -->
                            <div class="modal fade" id="voters" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-xl">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel"><?php echo $row['regNo']; ?></h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <?php echo '<embed frameborder="0" width="100%" height="400px" src="http://localhost/transport/' . $row['voters'] . '">Voters ID</embed><br/>'; ?>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Modal -->
                            <!-- Voter Modal -->
                            <div class="modal fade" id="pVoters" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-xl">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel"><?php echo $row['regNo']; ?></h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <?php echo '<embed frameborder="0" width="100%" height="400px" src="http://localhost/transport/' . $row['pVoters'] . '">Voters ID(Transferer)</embed><br/>'; ?>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Modal -->
                            <!-- Sale Letter Modal -->
                            <div class="modal fade" id="saleLetter" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-xl">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel"><?php echo $row['regNo']; ?></h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <?php echo '<embed frameborder="0" width="100%" height="400px" src="http://localhost/transport/' . $row['saleLetter'] . '">Sale Letter</embed><br/>'; ?>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Modal -->
                            <!-- Reg Certf Modal -->
                            <div class="modal fade" id="regCertf" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-xl">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel"><?php echo $row['regNo']; ?></h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <?php echo '<embed frameborder="0" width="100%" height="400px" src="http://localhost/transport/' . $row['regCertf'] . '">Registration Certificate</embed><br/>'; ?>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Modal -->
                            <!-- Plying Modal -->
                            <div class="modal fade" id="plying" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-xl">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel"><?php echo $row['regNo']; ?></h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <?php echo '<embed frameborder="0" width="100%" height="400px" src="http://localhost/transport/' . $row['plying'] . '">Plying Certificate</embed><br/>'; ?>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Modal -->
                            <!-- Pollution Modal -->
                            <div class="modal fade" id="pollution" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-xl">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel"><?php echo $row['regNo']; ?></h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <?php echo '<embed frameborder="0" width="100%" height="400px" src="http://localhost/transport/' . $row['pollution'] . '">Pollution Certificate</embed><br/>'; ?>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Modal -->



                    <?php       }
                    }
                    ?>
                </div>
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