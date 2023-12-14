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
                <th>Name</th>
                <th>Address</th>
                <th>Registration No</th>
                <th>Reason</th>
                <th>Current Holder</th>
                <th>Inspection Date</th>
                <th>File</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>

            <?php
            $sql = "SELECT * FROM entry where `deceased` IS NULL";
            $result = $con->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
            ?>
                    <tr>
                        <td><?php echo $row['entry_id']; ?></td>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['address']; ?></td>
                        <td><?php echo $row['regNo']; ?></td>
                        <td><?php echo $row['reason']; ?></td>
                        <td><?php echo $row['pHolder']; ?></td>
                        <td><?php echo $row['inspection']; ?></td>
                        <td>
                            <?php echo '<a class="link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover" href="http://localhost/transport/' . $row['voters'] . '">Voters ID</a><br/>'; ?>
                            <?php echo '<a class="link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover" href="http://localhost/transport/' . $row['saleLetter'] . '">Sales Letter</a><br/>'; ?>
                            <?php echo '<a class="link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover" href="http://localhost/transport/' . $row['regCertf'] . '">Registration Certificate</a><br/>'; ?>
                            <?php echo '<a class="link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover" href="http://localhost/transport/' . $row['plying'] . '">Plying Permit</a><br/>'; ?>
                            <?php echo '<a class="link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover" href="http://localhost/transport/' . $row['pollution'] . '">Pollution Certificate</a>'; ?>
                        </td>
                        <?php
                        if ($row['adtsta'] > 0) {
                            echo '<td><a class="btn btn-success" href="">Approved</a></td>';
                        } else {
                            echo '<td><a class="btn btn-info" href="adtApprovalFrom_I.php?id=' . $row["entry_id"] . ';" ?>Approve</a></td>';
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