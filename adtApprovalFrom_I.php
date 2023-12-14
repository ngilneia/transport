<?php
require('db.php');
$id = $_GET['id'];
include("header.php");
if (isset($_POST['approve'])) {
    $remarks = $_POST['remarksA'];

    $sql = "UPDATE `entry` set adtsta='1',adtstaApproveDate=now(),adtstaRemarks='$remarks' where entry_id=$id;";
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
        <div class="container text-center">
            <p>Application for Transfer of Permit - Part I</p>
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


            <form class="row g-3" method="post" enctype="multipart/form-data">
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