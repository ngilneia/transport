<?php
require('db.php');
include("header.php");
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM `entry` WHERE `id` ='$id'";
    $result = $con->query($sql);
    if ($result == TRUE) {
        echo "Record deleted successfully.";
        header('Location: entryList.php');
    } else {
        echo "Error:" . $sql . "<br>" . $con->error;
    }
} else {
    header('Location: dealingentryList.php');
}
?>


<?php include('footer.php') ?>