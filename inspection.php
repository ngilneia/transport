<?php
require('db.php');
include("header.php");
$ids = $_GET['id'];
if (isset($_POST['submit'])) {
    $entry_id = $ids;
    $regNo = $_POST['regNo'];
    $name = $_POST['name'];
    $address = $_POST['address'];
    $vClass = $_POST['vClass'];
    $mYear = $_POST['mYear'];
    $rTax = date('Y-m-d', strtotime($_POST['rTax']));
    $pTax = date('Y-m-d', strtotime($_POST['pTax']));
    $fc = date('Y-m-d', strtotime($_POST['fc']));
    $fp = date('Y-m-d', strtotime($_POST['fp']));
    $i = date('Y-m-d', strtotime($_POST['i']));
    $p = date('Y-m-d', strtotime($_POST['p']));
    $remarks = $_POST['remarks'];
    $chasis = $_POST['chasis'];
    $place = $_POST['place'];

    $sql = "INSERT INTO `inspection`(`entry_id`,`regNo`,`name`,`address`,`vClass`,`mYear`,`rTax`,`pTax`,`fc`,`fp`,`i`,`p`,`remarks`) 
    values ('$entry_id','$regNo','$name','$address','$vClass','$mYear','$rTax','$pTax','$fc','$fp','$i','$p','$remarks')";
    $insert = $con->query($sql);

    $updateSql = "UPDATE `entry` set `mvi`=1,`adtsta`=NULL, inspection=now(),`chasis`='$chasis', `inspectionPlace`='$place' where entry_id=$ids";
    $result = $con->query($updateSql);
    if ($result == TRUE && $insert == TRUE) {

        echo '<script>
        $(document).ready(function(){
                Swal.fire({
                title: "Application Approved",
                type: "success"
            }).then(function() {
                window.location = "inspectionList.php";
                
            })});
        </script>';
    } else {
        echo "Error:" . $updateSql . "<br>" . $con->error;
        echo "Error:" . $sql . "<br>" . $con->error;
    }
}
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT a.*,b.name as vClass FROM `entry` a INNER JOIN  class b on a.typeOfVehicle = b.id WHERE entry_id='$id'";
    $result = $con->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $entry_id = $row['entry_id'];
            $name = $row['name'];
            $fName = $row['fname'];
            $address = $row['address'];
            $regNo = $row['regNo'];
            $reason = $row['reason'];
            $pHolder = $row['pHolder'];
            $vClass = $row['vClass'];
        }
?>
        <div>
            <p>Inspection</p>
            <form class="row g-3" method="post" enctype="multipart/form-data">
                <div class="form-check col-2">
                    <label class="form-check-label" for="regNo">
                        1) Registration No
                    </label>
                    <input type="text" name="regNo" class="form-control" id="regNo" value="<?php echo $regNo; ?>" readonly="readonly">
                </div>
                <div class="form-check col-2">
                    <label class="form-check-label" for="name">
                        2) Owner's Name
                    </label>
                    <input type="text" name="name" class="form-control" id="name" value="<?php echo $name; ?>" readonly="readonly">
                </div>
                <div class="form-check col-4">
                    <label class="form-check-label" for="address">
                        3) Address
                    </label>
                    <input type="text" name="address" class="form-control" id="address" value="<?php echo $address; ?>" readonly="readonly">
                </div>
                <div class="form-check col-2">
                    <label for="vClass" class="form-check-label">4) Vehicle Class</label>
                    <input type="text" name="vClass" class="form-control" id="vClass" value="<?php echo $vClass; ?>" readonly="readonly">
                </div>
                <div class="form-check col-2">
                    <label for="mYear" class="form-check-label">5) Year of Manufacture as printed in RC</label>
                    <input type="text" name="mYear" class="form-control" id="mYear" autocomplete="off">
                </div>
                <div class="form-check">
                    <label class="form-check-label">
                        6) Validity of documents
                    </label>
                </div>
                <div class="form-check col-4">
                    <label class="form-check-label" for="4">1) Road Tax</label>
                    <input class="form-control" type="date" name="rTax" id="4" autocomplete="off">
                </div>
                <div class="form-check col-4">
                    <label class="form-check-label" for="5">2) P&amp;G TAX</label>
                    <input class="form-control" type="date" name="pTax" id="5" autocomplete="off">
                </div>
                <div class="form-check col-4">
                    <label class="form-check-label" for="6">3) Fitness Certificate</label>
                    <input class="form-control" type="date" name="fc" id="6" autocomplete="off">
                </div>
                <div class="form-check col-4">
                    <label class="form-check-label" for="7">4) Plying Permit</label>
                    <input class="form-control" type="date" name="fp" id="7" autocomplete="off">
                </div>
                <div class="form-check col-4">
                    <label class="form-check-label" for="8">5) Insurance</label>
                    <input class="form-control" type="date" name="i" id="8" autocomplete="off">
                </div>
                <div class="form-check col-4">
                    <label class="form-check-label" for="9">6) Pollution</label>
                    <input class="form-control" type="date" name="p" id="9" autocomplete="off">
                </div>

        </div>
        <hr />
        <div class="col">
            <p>I, the udersigned hereby declare the above validity of documents shown are true and correct</p>
            <div class="row">
                <div class="form-check col-6">
                    <label class="form-check-label" for="chasis">Chasis No. Pencil Print enclosed</label>
                    <select name="chasis" class="form-select" id="chasis">
                        <option value="YES">YES</option>
                        <option value="NO">NO</option>
                    </select>
                </div>
                <div class="form-check col-6">
                    <label class="form-check-label" for="place">
                        Place of Inspection
                    </label>
                    <input type="text" name="place" class="form-control" id="place">
                </div>
            </div>
            <div class="form-check col-8">
                <label class="form-check-label" for="remarks">
                    Remarks
                </label>
                <input type="text" class="form-control" id="remarks" name="remarks" placeholder="Remarks">
            </div>
            <div class="col-12  text-center">
                <button type="submit" name="submit" value="submit" class="btn btn-primary"> Submit </button>
            </div>
            </form>
        </div>
        </div>
<?php }
} ?>

</body>

</html>