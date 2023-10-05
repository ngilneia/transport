<?php
require('db.php');
include("header.php");

?>
<div>
    <p>Application List</p>
    <hr />
    <table id="entry" class="table table-striped" style="width:100%">
        <thead>
            <tr>
                <th>Sl No</th>
                <th>Name</th>
                <th>Fathers Name</th>
                <th>Address</th>
                <th>Registration No</th>
                <th>Reason</th>
                <th>Current Holder</th>
                <th>Remarks</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>

            <?php
            $sql = "SELECT * FROM `entry` JOIN `inspection` on entry.regNo=inspection.regNo";
            $result = $con->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
            ?>
                    <tr>
                        <td><?php echo $row['entry_id']; ?></td>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['fname']; ?></td>
                        <td><?php echo $row['address']; ?></td>
                        <td><?php echo $row['regNo']; ?></td>
                        <td><?php echo $row['reason']; ?></td>
                        <td><?php echo $row['pHolder']; ?></td>
                        <td><?php echo $row['remarks']; ?></td>
                        <?php
                        if ($row['jd_approve'] > 0) {
                            echo '<td><a class="btn btn-success" href="">Approved</a></td>';
                        } else {
                            echo '<td><a class="btn btn-info" href="approve.php?id=' . $row["inspection_id"] . ' "?>Approve</a></td>';
                        }
                        ?>

                    </tr>
            <?php       }
            }
            ?>
        </tbody>
    </table>

</div>

<script src="js/bootstrap.min.js"></script>
<script src="DataTables/datatables.min.js"></script>
<script type='text/javascript'>
    $(document).ready(function() {
        new DataTable('#entry');
    });
</script>

</body>

</html>