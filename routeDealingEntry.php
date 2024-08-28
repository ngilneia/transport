<?php
require('db.php');
include("header.php");
$statusMsg = '';
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $address = $_POST['inputAddress'];
    $regNo = $_POST['regNo'];
    $reason = $_POST['reason'];
    $phoneNo = $_POST['phoneNo'];
    $routeFrom = $_POST['routeFrom'];
    $routeTo = $_POST['routeTo'];

    $sql = "INSERT INTO `entry`(`name`, `address`, `regNo`, `reason`, `phoneNo`,`fromRoute`,`toRoute`) 
    VALUES ('$name','$address','$regNo','$reason','$phoneNo','$routeFrom','$routeTo')";
    if ($result = $con->query($sql)) {
        echo '<script>
         $(document).ready(function(){
                Swal.fire({
                title: "Application Entered",
                type: "success"
            }).then(function() {
                window.location = "index.php";
            })});
        </script>';
    } else {
        echo    "<script type='text/javascript'>
        $(document).ready(function(){
                  Swal . fire(
            'Error!',
            'Not Recorded!',   
            'error'
        )});
        </script>";
    }
    $con->close();
}
?>
<div class="container ">
    <h3>Transfer of Ownership</h3>
    <form class="row g-3" method="post" enctype="multipart/form-data">
        <div class="row">
            <div class="col-md-6">
                <label for="name" class="form-label ">Name of Applicant</label>
                <input type="text" name="name" class="form-control border-primary" id="name" placeholder="Name">
            </div>
            <div class="col-md-6">
                <label for="regNo" class="form-label">Registration No</label>
                <input type="text" name="regNo" class="form-control border-primary" id="regNo" placeholder="MZ0XXX1234">
            </div>

        </div>
        <div class="row">
            <div class="col-md-6">
                <label for="inputAddress" class="form-label">Address</label>
                <input type="text" name="inputAddress" class="form-control border-primary" id="inputAddress" placeholder="Proof of address to be enclosed">
            </div>

            <div class="col-md-6">
                <label for="phoneNo" class="form-label">Phone No</label>
                <input type="text" name="phoneNo" class="form-control border-primary" id="phoneNo" placeholder="Phone No">
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <label for="reason" class="form-label">Reason</label>
                <input type="text" name="reason" class="form-control border-primary" id="reason" placeholder="Reason">
            </div>

        </div>
        <hr />
        <div class="row">
            <div class="col-md-6">
                <label for="routeFrom" class="form-label">From Route</label>
                <input type="text" name="routeFrom" class="form-control border-primary" id="routeFrom" placeholder="From">
            </div>
            <div class="col-md-6">
                <label for="routeTo" class="form-label">To Route</label>
                <input type="text" name="routeTo" class="form-control border-primary" id="routeTo" placeholder="To">
            </div>
        </div>
        <hr />
        <div class="row">
            <div class="mb-3">
                <button type="submit" name="submit" value="submit" class="btn btn-primary">Submit</button>
            </div>
    </form>
</div>



<?php include('footer.php') ?>