<?php
require('db.php');
include("header.php");
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM `entry` WHERE entry_id='$id'";
    $result = $con->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $name = $row['name'];
            $fName = $row['fname'];
            $address = $row['address'];
            $regNo = $row['regNo'];
            $reason = $row['reason'];
            $pHolder = $row['pHolder'];
        }
    }
}
?>
<div>
    <p>Inspection</p>
    <hr />
    <table id="entry" class="table table-striped" style="width:100%">
        <thead>
            <tr>
                <th>Sl No</th>
                <th>Name</th>
                <th>Address</th>
                <th>Registration No</th>
                <th>MVI Remarks</th>
                <th>File</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>

            <?php
            $sql = "SELECT * FROM entry a inner join inspection b on a.entry_id=b.entry_id where a.RChasisNo is not null and dd is null order by a.entry_id desc  ";
            $result = $con->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
            ?>
                    <tr>
                        <td><?php echo $row['entry_id']; ?></td>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['address']; ?></td>
                        <td><?php echo $row['regNo']; ?></td>
                        <td><?php echo $row['remarks']; ?></td>
                        <td>
                            <?php echo '<a class="link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover" href="http://10.180.21.99/transport/' . $row['voters'] . '">Voters ID</a><br/>'; ?>
                            <?php echo '<a class="link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover" href="http://10.180.21.99/transport/' . $row['RRegCertificate'] . '">Registration Certificate</a><br/>'; ?>
                            <?php echo '<a class="link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover" href="http://10.180.21.99/transport/' . $row['ROtherDoc'] . '">Other Documents</a><br/>'; ?>
                            <?php echo '<a class="link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover" href="http://10.180.21.99/transport/' . $row['RMVIReport'] . '">MVI or Police Report</a><br/>'; ?>
                        </td>
                        <?php
                        if ($row['dd'] > 0) {
                            echo '<td><a class="btn btn-success" href="">Approved</a></td>';
                        } else {
                            echo '<td><a class="btn btn-info" href="RadtmvApprovalFrom_I.php?id=' . $row["entry_id"] . '" ?>Approve</a></td>';
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