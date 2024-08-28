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
                <th>Download</th>
            </tr>
        </thead>
        <tbody>

            <?php
            $sql = "SELECT * FROM entry a inner join inspection b on a.entry_id=b.entry_id where jd<2 and dd<2 order by jdApproveDate desc";
            $result = $con->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
            ?>
                    <?php if (!is_null($row['d'])) { ?>
                        <tr>
                            <td><?php echo $row['regNo']; ?></td>
                            <td><?php echo $row['remarks'] . '-' . date('d-m-Y', strtotime($row['inspection'])); ?></td>
                            <td><?php echo $row['ddRemarks'] . '-' . date('d-m-Y', strtotime($row['ddApproveDate'])); ?></td>
                            <td><?php echo $row['jdRemarks'] . '-' . date('d-m-Y', strtotime($row['jdApproveDate'])); ?></td>
                            <?php
                            if ($row['d'] == 1) {

                                if (is_null($row['RChasisNo']) && is_null($row['fromRoute'])) {
                                    echo '<td><a class="btn btn-success" target="_blank" href="approval.php?id=' . $row["entry_id"] . '">Transfer Letter</a></td>';
                                } else if (!is_null($row['RChasisNo']) && is_null($row['fromRoute'])) {
                                    echo '<td><a class="btn btn-success" target="_blank" href="Rapproval.php?id=' . $row["entry_id"] . '">Replacement Letter</a></td>';
                                } else {
                                    echo '<td><a class="btn btn-success" target="_blank" href="routeApproval.php?id=' . $row["entry_id"] . '">Route Transfer Letter</a></td>';
                                }
                            } else {
                                if (is_null($row['RChasisNo']) && is_null($row['fromRoute'])) {
                                    echo '<td><a class="btn btn-info" href="dApprovalFrom_I.php?id=' . $row["entry_id"] . ';" ?>Approve Transfer</a></td>';
                                } else if (!is_null($row['RChasisNo']) && is_null($row['fromRoute'])) {
                                    echo '<td><a class="btn btn-info" href="dApprovalFrom_I.php?id=' . $row["entry_id"] . ';" ?>Approve Replacement</a></td>';
                                } else if (!is_null($row['fromRoute'])) {
                                    echo '<td><a class="btn btn-info" href="routeDApprovalForm.php?id=' . $row["entry_id"] . ';" ?>Approve Route Transfer</a></td>';
                                }
                            }
                            ?>
                        </tr>
                    <?php } ?>
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