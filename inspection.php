<?php
require('db.php');
include("header.php");
if (isset($_POST['submit'])) {
    $vClass = $_POST['vehicleClass'];
    $mYear = $_POST['mYear'];
    $rTax = $_POST['rTax'];
    $pTax = $_POST['pTax'];
    $fc = $_POST['fc'];
    $fp = $_POST['fp'];
    $i = $_POST['i'];
    $p = $_POST['p'];
    $remarks = $_POST['remarks'];

    $sql = "INSERT INTO `inspection`(`regNo`,`address`,`vClass`,`mYear`,`rTax`,`pTax`,`fc`,`fp`,`i`,`p`,`remarks`) VALUES ('$regNo','$address','$vClass','$mYear','$rTax','$pTax','$fc','$fp','$i','$p','$remarks')";
    $result = $con->query($sql);
    if ($result == TRUE) {
        echo "<script type='text/javascript'>
        $(document).ready(function(){
                  Swal . fire(
            'Good job!',
            'Approved!',   
            'success'
        )});
        </script>";
    } else {
        echo    "<script type='text/javascript'>
        $(document).ready(function(){
                  Swal . fire(
            'Error!',
            'Not Approved!',   
            'error'
        )});
        </script>";
    }
}
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM `entry` WHERE id='$id'";
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
            <form class="row g-3">
                <div class="form-check col-3">
                    <label class="form-check-label" for="11">
                        1) Registration No
                    </label>
                    <input type="text" name="regNo" class="form-control" id="11" value="<?php echo $regNo; ?>">
                </div>
                <div class="form-check col-3">
                    <label class="form-check-label" for="12">
                        2) OWNER
                    </label>
                    <input type="text" name="address" class="form-control" id="12" value="<?php echo $address; ?>">
                </div>
                <div class="form-check col-3">
                    <label for="vehicleClass" class="form-label">3) Vehicle Class</label>
                    <input type="text" name="vehicleClass" class="form-control" id="vehicleClass" placeholder="Vehicle Class">
                </div>
                <div class="form-check col-3">
                    <label for="mYear" class="form-label">4) Year of Manufacture as printed in RC</label>
                    <input type="text" name="mYear" class="form-control" id="mYear" placeholder="Year of Manufacture as printed in RC">
                </div>
                <div class="form-check">
                    <label class="form-check-label" for="">
                        5) Validity of documents
                    </label>
                </div>
                <div class="form-check col-4">
                    <input class="form-check-input" type="checkbox" value="1" name="rTax" id="4">
                    <label class="form-check-label" for="4">
                        1) Road Tax
                    </label>
                </div>
                <div class="form-check col-4">
                    <input class="form-check-input" type="checkbox" value="1" name="pTax" id="5">
                    <label class="form-check-label" for="5">
                        2) P&G Tax
                    </label>
                </div>
                <div class="form-check col-4">
                    <input class="form-check-input" type="checkbox" value="1" name="fc" id="6">
                    <label class="form-check-label" for="6">
                        3) Fitness Certificate
                    </label>
                </div>
                <div class="form-check col-4">
                    <input class="form-check-input" type="checkbox" value="1" name="fp" id="7">
                    <label class="form-check-label" for="7">
                        4) Flying Permit
                    </label>
                </div>
                <div class="form-check col-4">
                    <input class="form-check-input" type="checkbox" value="1" name="i" id="8">
                    <label class="form-check-label" for="8">
                        5) Insurance
                    </label>
                </div>
                <div class="form-check col-4">
                    <input class="form-check-input" type="checkbox" value="1" name="p" id="9">
                    <label class="form-check-label" for="9">
                        6) Pollution
                    </label>
                </div>
                <div class="form-check">
                    <label class="form-check-label" for="remarks">
                        Remarks
                    </label>
                    <input type="text" class="form-control" id="remarks" name="remarks" placeholder="Remarks">
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
<?php }
} ?>
<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/sweetalert2.all.min.js"></script>
</body>

</html>