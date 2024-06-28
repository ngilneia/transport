<?php
require('db.php');
include("header.php");
?>
<div>
    <hr />
    <table id="entry" class="table table-striped" style="width:100%">
        <thead>
            <tr>
                <th>Registration Number</th>
                <th>MVI Remarks and date</th>
                <th>DD Remarks and date</th>
                <th>JD Remarks and date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>

            <?php
            $sql = "SELECT * FROM entry a inner join inspection b on a.entry_id=b.entry_id where chasis is not null";
            $result = $con->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
            ?>
                    <tr>
                        <td><?php echo $row['regNo']; ?></td>
                        <td><?php echo $row['remarks'] . '-' . $row['inspection']; ?></td>
                        <td><?php echo $row['ddRemarks'] . '-' . $row['ddApproveDate']; ?></td>
                        <td><?php echo $row['jdRemarks'] . '-' . $row['jdApproveDate']; ?></td>
                        <?php
                        if ($row['d'] != 0) {
                            echo '<td><a class="btn btn-success" target="_blank" href="approval.php?id=' . $row["entry_id"] . '">Download Approval Letter</a></td>';
                        } else if (is_null($row['RChasisNo'])) {
                            echo '<td><a class="btn btn-info" href="dApprovalFrom_I.php?id=' . $row["entry_id"] . ';" ?>Approve Transfer</a></td>';
                        } else {
                            echo '<td><a class="btn btn-info" href="dApprovalFrom_I.php?id=' . $row["entry_id"] . ';" ?>Approve Replacement</a></td>';
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