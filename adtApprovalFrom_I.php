<?php
require('db.php');
include("header.php");
if (isset($_POST['submit'])) {
    $regNo = $_POST['regNo'];
    $p = $_POST['p'];
    $remarks = $_POST['remarks'];

    $sql = "INSERT INTO `inspection`(`regNo`,`name`,`address`,`vClass`,`mYear`,`rTax`,`pTax`,`fc`,`fp`,`i`,`p`,`remarks`) VALUES ('$regNo','$name','$address','$vClass','$mYear','$rTax','$pTax','$fc','$fp','$i','$p','$remarks')";
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
                        <p>Date:<?php echo ''; ?></p>
                    </div>
                    <div class="col-6 col-md-4"></div>
                    <div class=" col-6 col-md-4">
                        <p><?php echo $name; ?></p>
                        <p>(Transferee)(Leitu)</p>
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