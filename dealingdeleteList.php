<?php
require('db.php');
include("header.php");
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM `entry` WHERE `entry_id` ='$id'";
    $result = $con->query($sql);
    if ($result == TRUE) {
        echo '<script>
         $(document).ready(function(){
                Swal.fire({
                title: "Application Deleted",
                type: "success"
            }).then(function() {
                window.location = "dealingentryList.php";
            })});
        </script>';
    } else {
        echo "Error:" . $sql . "<br>" . $con->error;
    }
} else {
    header('Location: dealingentryList.php');
}
?>


<?php include('footer.php') ?>