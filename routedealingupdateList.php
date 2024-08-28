<?php
require('db.php');
include("header.php");
if (isset($_POST['update'])) {
    $id = $_GET['id'];
    $name = $_POST['name'];
    $inputAddress = $_POST['inputAddress'];
    $regNo = $_POST['regNo'];
    $reason = $_POST['reason'];
    $phoneNo = $_POST['phoneNo'];
    $fromRoute = $_POST['fromRoute'];
    $toRoute = $_POST['toRoute'];
    $sql = "UPDATE `entry` SET `name`='$name',`address`='$inputAddress',`regNo`='$regNo',`reason`='$reason'
    ,`phoneNo`='$phoneNo',`fromRoute`='$fromRoute',`toRoute`='$toRoute' WHERE `entry_id`='$id'";
    $result = $con->query($sql);
    if ($result == TRUE) {
        echo '<script>
         $(document).ready(function(){
                Swal.fire({
                title: "Application Updated",
                type: "success"
            }).then(function() {
                window.location = "routeDealingEntryList.php";
            })});
        </script>';
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
            $address = $row['address'];
            $regNo = $row['regNo'];
            $reason = $row['reason'];
            $phoneNo = $row['phoneNo'];
            $fromRoute = $row['fromRoute'];
            $toRoute = $row['toRoute'];
        }
?>

        <form class="row g-3" method="post" enctype="multipart/form-data">
            <div class="col-4">
                <label for="name" class="form-label">Name of Applicant</label>
                <input type="text" name="name" class="form-control" id="name" value="<?php echo $name; ?>">
            </div>
            <div class="col-4">
                <label for="inputAddress" class="form-label">Address</label>
                <input type="text" name="inputAddress" class="form-control" id="inputAddress" value="<?php echo $address; ?>">
            </div>
            <div class="col-4">
                <label for="regNo" class="form-label">Registration No</label>
                <input type="text" name="regNo" class="form-control" id="regNo" value="<?php echo $regNo; ?>">
            </div>
            <div class="col-4">
                <label for="reason" class="form-label">Reason</label>
                <input type="text" name="reason" class="form-control" id="reason" value="<?php echo $reason; ?>">
            </div>
            <div class="col-4">
                <label for="phoneNo" class="form-label">Phone No</label>
                <input type="text" name="phoneNo" class="form-control" id="phoneNo" value="<?php echo $phoneNo; ?>">
            </div>
            <div class=" col-4">
                <label for="fromRoute" class="form-label">From Route</label>
                <input type="text" name="fromRoute" class="form-control" id="fromRoute" value="<?php echo $fromRoute; ?>">
            </div>
            <div class="col-4">
                <label for="toRoute" class="form-label">Route To</label>
                <input type="text" name="toRoute" class="form-control" id="toRoute" value="<?php echo $toRoute; ?>">
            </div>
            <div class="mb-3">
                <button type="update" name="update" value="update" class="btn btn-primary">Update</button>
            </div>
        </form>
        <script src="js/bootstrap.bundle.min.js"></script>
        <script src="DataTables/datatables.min.js"></script>
        </body>

        </html>


<?php
    } else {
        header('Location: routeDealingentryList.php');
    }
}
include("footer.php");
?>