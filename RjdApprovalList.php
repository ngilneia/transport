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
                <th>Registration Number</th>
                <th>Chasis Verified or not</th>
                <th>MVI Inspection date</th>
                <th>DD Remarks and date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>

            <?php
            $sql = "SELECT * FROM entry where dd<2 and RChasisNo is not null and jd is null";
            $result = $con->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
            ?>
                    <tr>
                        <td><?php echo $row['regNo']; ?></td>
                        <td><?php echo $row['chasis']; ?></td>
                        <td><?php echo $row['inspection']; ?></td>
                        <td><?php echo $row['ddRemarks'] . '-' . $row['ddApproveDate']; ?></td>
                        <?php
                        if ($row['jd'] > 0) {
                            echo '<td><a class="btn btn-success" href="">Approved</a></td>';
                        } else {
                            echo '<td><a class="btn btn-info" href="RjdApprovalFrom_I.php?id=' . $row["entry_id"] . ';" ?>Approve</a></td>';
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
    $('#entry').DataTable({
        order: [
            [0, 'desc']
        ]
    });
</script>
</body>

</html>