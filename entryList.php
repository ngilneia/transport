<?php
require('db.php');
include("header.php");
?>
<div>
    <p>Application</p>
    <a class="btn btn-info" href="entryApplication.php">Enter New Application</a>
    <hr />
    <table id="example" class="table table-striped" style="width:100%">
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
            $sql = "SELECT * FROM entry";
            $result = $con->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
            ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['fname']; ?></td>
                        <td><?php echo $row['address']; ?></td>
                        <td><?php echo $row['regNo']; ?></td>
                        <td><?php echo $row['reason']; ?></td>
                        <td><?php echo $row['pHolder']; ?></td>
                        <td><?php echo '<a href="http://localhost/transport/' . $row['file'] . '">View Document</a>'; ?></td>
                        <td><a class="btn btn-info" href="updateList.php?id=<?php echo $row['id']; ?>">Edit</a>
                            &nbsp;
                            <a class="btn btn-danger" href="deleteList.php?id=<?php echo $row['id']; ?>">Delete</a>
                        </td>
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
        new DataTable('#example');
    });
</script>

</body>

</html>