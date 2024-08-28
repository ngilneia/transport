<?php
require('db.php');
include("header.php");
?>
<div>
    <hr />
    <table id="entry" class="table table-striped" style="width:100%">
        <thead>
            <tr>
                <th>Sl No</th>
                <th>Applicant Detail</th>
                <th>Registration No</th>
                <th>Phone No</th>
                <th>Secretary Remarks and date</th>
                <th>Download</th>
            </tr>
        </thead>
        <tbody>

            <?php
            $sql = "SELECT * FROM entry a inner join inspection b on a.entry_id=b.entry_id where jd<2 and dd<2 order by jdApproveDate desc";
            $result = $con->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $i = 1;
            ?>
                    <?php if (!is_null($row['d'])) { ?>
                        <tr>
                            <td><?php echo $i++; ?></td>
                            <td><?php echo $row['name'] . '<br/>' . $row['fname'] ?></td>
                            <td><?php echo $row['regNo']; ?></td>
                            <td><?php echo $row['phoneNo']; ?></td>
                            <td><?php echo $row['dRemarks']; ?></td>
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
                                    echo '<td><a class="btn btn-info" href="#" ?>Pending at Director</a></td>';
                                } else if (!is_null($row['RChasisNo']) && is_null($row['fromRoute'])) {
                                    echo '<td><a class="btn btn-info" href="#" ?>Pending at Director</a></td>';
                                } else if (!is_null($row['fromRoute'])) {
                                    echo '<td><a class="btn btn-info" href="#" ?>Pending at Director</a></td>';
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