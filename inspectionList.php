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
                <th>Fathers Name</th>
                <th>Address</th>
                <th>Registration No</th>
                <th>Reason</th>
                <th>Current Holder</th>
                <th>File</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>

            <?php
            $sql = "SELECT * FROM entry where RChasisNo is null and fromRoute is null and mvi is null";
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
                        <td>
                            <?php echo '<a class="link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover" href="http://10.180.21.99/transport/' . $row['voters'] . '">Voters ID</a><br/>'; ?>
                            <?php echo '<a class="link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover" href="http://10.180.21.99/transport/' . $row['pVoters'] . '">Voters ID(Transferer)</a><br/>'; ?>
                            <?php echo '<a class="link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover" href="http://10.180.21.99/transport/' . $row['saleLetter'] . '">Sales Letter</a><br/>'; ?>
                            <?php echo '<a class="link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover" href="http://10.180.21.99/transport/' . $row['regCertf'] . '">Registration Certificate</a><br/>'; ?>
                            <?php echo '<a class="link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover" href="http://10.180.21.99/transport/' . $row['plying'] . '">Plying Permit</a><br/>'; ?>
                            <?php echo '<a class="link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover" href="http://10.180.21.99/transport/' . $row['pollution'] . '">Pollution Certificate</a>'; ?>
                        </td>
                        <?php
                        if (!is_null($row['inspection'])) {
                            echo '<td><a class="btn btn-success" href="">Inspected</a></td>';
                        } else if ($row['dd'] == 2 or $row['jd'] == 2 or $row['d'] == 2) {
                            echo '<td><a class="btn btn-danger" href="inspection.php?id=' . $row["entry_id"] . ';" ?>Rejected<br/>' . $row['ddRemarks'] . $row['jdRemarks'] . $row['dRemarks'] . '</a></td>';
                        } else {
                            echo '<td><a class="btn btn-info" href="inspection.php?id=' . $row["entry_id"] . ';" ?>Inspect</a></td>';
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