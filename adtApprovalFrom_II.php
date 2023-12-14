<?php
require('db.php');
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
            $decease = $row['deceased'];
            $relation = $row['relation'];
            $news = $row['news'];
            $place = $row['place'];
            $dot = $row['dot'];
        }
?>
        <div class="container text-center">
            <p>Application for Transfer of Permit - Part II</p>
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
<?php }
} ?>
<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/sweetalert2.all.min.js"></script>
</body>

</html>