<?php
require('db.php');
include("header.php");
?>
<div>
    <p>Application</p>
    <a class="btn btn-info" href="dealingentryApplication.php">Enter New Application</a>
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
                <th>Phone No</th>
                <th>Type of Vehicle</th>
                <th>DTO</th>
                <th>Documents</th>
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
                        <td><?php echo $row['entry_id']; ?></td>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['fname']; ?></td>
                        <td><?php echo $row['address']; ?></td>
                        <td><?php echo $row['regNo']; ?></td>
                        <td><?php echo $row['reason']; ?></td>
                        <td><?php echo $row['pHolder']; ?></td>
                        <td><?php echo $row['phoneNo']; ?></td>
                        <td><?php echo $row['typeOfVehicle']; ?></td>
                        <td><?php echo $row['dto']; ?></td>
                        <td>
                            <?php echo '<a class="link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover" href="http://localhost/transport/' . $row['voters'] . '">Voters ID</a><br/>'; ?>
                            <?php echo '<a class="link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover" href="http://localhost/transport/' . $row['saleLetter'] . '">Sales Letter</a><br/>'; ?>
                            <?php echo '<a class="link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover" href="http://localhost/transport/' . $row['regCertf'] . '">Registration Certificate</a><br/>'; ?>
                            <?php echo '<a class="link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover" href="http://localhost/transport/' . $row['plying'] . '">Plying Permit</a><br/>'; ?>
                            <?php echo '<a class="link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover" href="http://localhost/transport/' . $row['pollution'] . '">Pollution Certificate</a>'; ?>
                        </td>
                        <td><a class="btn btn-info" href="dealingupdateList.php?id=<?php echo $row['entry_id']; ?>">Edit</a>
                            &nbsp;
                            <a class="btn btn-danger" href="dealingdeleteList.php?id=<?php echo $row['entry_id']; ?>">Delete</a>
                        </td>
                    </tr>
            <?php       }
            }
            ?>
        </tbody>
    </table>

</div>

<?php include('footer.php') ?>