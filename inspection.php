<?php
require('db.php');
include("header.php");
$ids = $_GET['id'];
if (isset($_POST['submit'])) {
    $regNo = $_POST['regNo'];
    $name = $_POST['name'];
    $address = $_POST['address'];
    $vClass = $_POST['vClass'];
    $mYear = $_POST['mYear'];
    $rTax = $_POST['rTax'];
    $pTax = $_POST['pTax'];
    $fc = $_POST['fc'];
    $fp = $_POST['fp'];
    $i = $_POST['i'];
    $p = $_POST['p'];
    $remarks = $_POST['remarks'];

    $sql = "INSERT INTO `inspection`(`regNo`,`name`,`address`,`vClass`,`mYear`,`rTax`,`pTax`,`fc`,`fp`,`i`,`p`,`remarks`) 
    values ('$regNo','$name','$address','$vClass','$mYear','$rTax','$pTax','$fc','$fp','$i','$p','$remarks')";
    $insert = $con->query($sql);

    $updateSql = "UPDATE `entry` set inspection=now() where entry_id=$ids";
    $result = $con->query($updateSql);
    if ($result == TRUE && $insert == TRUE) {
        echo
        "<script type='text/javascript'>
        $(document).ready(function(){
                  Swal . fire(
            'Application Inspected and Assign to Assistant Director(MV & STA)',   
            'success'
        )});
        </script>";
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
            $name = $row['name'];
            $fName = $row['fname'];
            $address = $row['address'];
            $regNo = $row['regNo'];
            $reason = $row['reason'];
            $pHolder = $row['pHolder'];
        }
?>
        <div>
            <p>Inspection</p>
            <form class="row g-3" method="post" enctype="multipart/form-data">
                <div class="form-check col-2">
                    <label class="form-check-label" for="11">
                        1) Registration No
                    </label>
                    <input type="text" name="regNo" class="form-control" id="11" value="<?php echo $regNo; ?>" readonly="readonly">
                </div>
                <div class="form-check col-2">
                    <label class="form-check-label" for="12">
                        2) Owner's Name
                    </label>
                    <input type="text" name="name" class="form-control" id="12" value="<?php echo $name; ?>" readonly="readonly">
                </div>
                <div class="form-check col-4">
                    <label class="form-check-label" for="13">
                        3) Address
                    </label>
                    <input type="text" name="address" class="form-control" id="13" value="<?php echo $address; ?>" readonly="readonly">
                </div>
                <div class="form-check col-2">
                    <label for="vClass" class="form-check-label">4) Vehicle Class</label>
                    <input type="text" name="vClass" class="form-control" id="vClass">
                </div>
                <div class="form-check col-2">
                    <label for="mYear" class="form-check-label">5) Year of Manufacture as printed in RC</label>
                    <input type="date" name="mYear" class="form-control" id="mYear">
                </div>
                <div class="form-check">
                    <label class="form-check-label">
                        6) Validity of documents
                    </label>
                </div>
                <div class="form-check col-4">
                    <label class="form-check-label" for="4">1) Road Tax</label>
                    <input class="form-control" type="date" name="rTax" id="4">
                </div>
                <div class="form-check col-4">
                    <label class="form-check-label" for="5">2) P&amp;G TAX</label>
                    <input class="form-control" type="date" name="pTax" id="5">
                </div>
                <div class="form-check col-4">
                    <label class="form-check-label" for="6">3) Fitness Certificate</label>
                    <input class="form-control" type="date" name="fc" id="6">
                </div>
                <div class="form-check col-4">
                    <label class="form-check-label" for="7">4) Flying Permit</label>
                    <input class="form-control" type="date" name="fp" id="7">
                </div>
                <div class="form-check col-4">
                    <label class="form-check-label" for="8">5) Insurance</label>
                    <input class="form-control" type="date" name="i" id="8">
                </div>
                <div class="form-check col-4">
                    <label class="form-check-label" for="9">6) Pollution</label>
                    <input class="form-control" type="date" name="p" id="9">
                </div>

                <div class="form-check col-8">
                    <label class="form-check-label" for="remarks">
                        Remarks
                    </label>
                    <input type="text" class="form-control" id="remarks" name="remarks" placeholder="Remarks">
                </div>
                <div class="col-12">
                    <button type="submit" name="submit" value="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
<?php }
} ?>
<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/sweetalert2.all.min.js"></script>
</body>

</html>