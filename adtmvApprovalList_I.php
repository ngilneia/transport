<?php
require('db.php');
include("header.php");
?>
<div>
    <p>Inspection</p>
    <hr />
    <table id="entry" class="table table-striped" style="width:100%">
        <thead>
            <tr>
                <th>Sl No</th>
                <th>Registration No</th>
                <th>Name</th>
                <th>Address</th>
                <th>Inspection</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>

            <?php
            $sql = "SELECT * FROM entry where inspection is not null";
            $result = $con->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
            ?>
                    <tr>
                        <td>#</td>
                        <td><?php echo $row['regNo']; ?></td>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['address']; ?></td>
                        <td><?php echo $row['inspection']; ?></td>
                        <?php
                        if ($row['adtmv'] > 0) {
                            echo '<td><a class="btn btn-success" href="">Approved</a></td>';
                        } else {
                            echo '<td><a class="btn btn-info" href="adtmvApprovalFrom_I.php?id=' . $row["entry_id"] . '" ?>Approve</a></td>';
                        }
                        ?>
                    </tr>
            <?php       }
            }
            ?>
        </tbody>
    </table>

</div>

<script src="js/bootstrap.bundle.min.js"></script>
<script src="DataTables/datatables.min.js"></script>
<script type='text/javascript'>
    $(document).ready(function() {
        new DataTable('#entry');
    });
</script>

</body>

</html>