<?php
require('db.php');
include("header.php");

$replacement = "SELECT COUNT(*) as replacementCount from entry where d=1 and  RChasisNo is not null and fromRoute is null";
$replacementResult = $con->query($replacement);
$row = $replacementResult->fetch_assoc();
$replacementNo = $row['replacementCount'] ? $row['replacementCount'] : '0';

$sql = "SELECT COUNT(*) as transferCount from entry where d=1 and RChasisNo is null and fromRoute is null";
$transferResult = $con->query($sql);
$row2 = $transferResult->fetch_assoc();
$transferNo = $row2['transferCount'] ? $row2['transferCount'] : '0';

$sql2 = "SELECT COUNT(*) as routeCount from entry where fromRoute is not null and d=1";
$routeResult = $con->query($sql2);
$row3 = $routeResult->fetch_assoc();
$routeNo = $row3['routeCount'] ? $row3['routeCount'] : '0';

?>
<div class="row">
    <div class="col-3">
        <div class="card">
            <div class="card-header  text-center text-bg-info">
                No. of Approved Replacement
            </div>
            <div class="card-body  text-center">
                <h5 class="card-title"><?php echo $replacementNo; ?></h5>
            </div>
        </div>
    </div>
    <div class="col-3">
        <div class="card">
            <div class="card-header  text-center text-bg-warning">
                No. of Approved Transfer
            </div>
            <div class="card-body text-center">
                <h5 class="card-title"><?php echo $transferNo; ?></h5>
            </div>
        </div>
    </div>
    <div class="col-3">
        <div class="card">
            <div class="card-header  text-center text-bg-danger">
                No. of Approved Route Transfer
            </div>
            <div class="card-body text-center">
                <h5 class="card-title"><?php echo $routeNo; ?></h5>
            </div>
        </div>
    </div>
    <div class="col-3">
        <div class="card">
            <div class="card-header  text-center text-bg-success">
                Approved List
            </div>
            <div class="card-body text-center">
                <h5 class="card-title"><a href="dApprovedList.php" class="btn btn-success">Click here to see Approved List</a></h5>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
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
                $sql = "SELECT * FROM entry a inner join inspection b on a.entry_id=b.entry_id where jd<2 and dd<2 order by jdApproveDate desc";
                $result = $con->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                ?>
                        <?php if (is_null($row['d'])) { ?>
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
</div>
<div class="row">
    <div class="col-4"></div>
    <div class="col-4"></div>
    <div class=" col-4"></div>
</div>
<script src="js/bootstrap.bundle.min.js"></script>
<script src="DataTables/datatables.min.js"></script>
<script type='text/javascript'>
    $(document).ready(function() {
        new DataTable('#entry', {
            pageLength: 50,
            order: [
                [54, 'desc']
            ]
        });
    });
</script>
</body>

</html>