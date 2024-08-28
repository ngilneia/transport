<?php
require('db.php');
include("header.php");
?>
<div>
    <p>Application</p>
    <a class="btn btn-info" href="RdealingentryApplication.php">Enter New Application</a>
    <hr />
    <table id="entry" class="table table-striped" style="width:100%">
        <thead>
            <tr>
                <th>Sl No</th>
                <th>Name</th>
                <th>Address</th>
                <th>Registration No</th>
                <th>Kum</th>
                <th>Phone No</th>
                <th>Type of Vehicle</th>
                <th>Detail of Permit</th>
                <th>Replace na tur Motor</th>
                <th>Documents</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>

            <?php
            $sql = "SELECT * FROM entry where RChasisNo is not null";
            $result = $con->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
            ?>
                    <tr>
                        <td><?php echo $row['entry_id']; ?></td>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['address']; ?></td>
                        <td><?php echo $row['regNo']; ?></td>
                        <td><?php echo $row['RKum']; ?></td>
                        <td><?php echo $row['phoneNo']; ?></td>
                        <td><?php echo $row['typeOfVehicle']; ?></td>
                        <td><?php echo $row['RDetailofPermit']; ?></td>
                        <td><?php echo $row['RMotorModel']; ?></td>
                        <td>
                            <?php echo '<a class="link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover" href="http://10.180.21.105/transport/' . $row['RRegCertificate'] . '">Registration Certificate</a><br/>'; ?>
                            <?php echo '<a class="link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover" href="http://10.180.21.105/transport/' . $row['ROtherDoc'] . '">Other Documents</a><br/>'; ?>
                            <?php echo '<a class="link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover" href="http://10.180.21.105/transport/' . $row['RMVIReport'] . '">MVI & Police Report</a><br/>'; ?>
                            <?php echo '<a class="link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover" href="http://10.180.21.105/transport/' . $row['voters'] . '">Voters ID</a><br/>'; ?>
                        </td>

                        <?php
                        if ($row['dd'] == 2 or $row['jd'] == 2 or $row['d'] == 2) {
                            echo '<td><a class="btn btn-danger" target="_blank" href="">Application Rejected<br/>' . $row['ddRemarks'] . $row['jdRemarks'] . $row['dRemarks'] . '</a><br/>
							<a class="btn btn-danger" href="RdealingdeleteList.php?id='.$row['entry_id'].'">Delete</a></td>';
                        } else if ($row['d'] == 1) {
                            if (is_null($row['RChasisNo'])) {
                        ?>
                                <td><a class="btn btn-success" target="_blank" href="approval.php?id=<?php echo $row['entry_id']; ?>">Download Approval Letter</a></td>
                            <?php
                            } else { ?>
                                <td><a class="btn btn-success" target="_blank" href="Rapproval.php?id=<?php echo $row['entry_id']; ?>">Download Approval Letter</a></td>
                            <?php }
                        } else {
                            ?>
                            <td><a class="btn btn-info" href="RdealingupdateList.php?id=<?php echo $row['entry_id']; ?>">Edit</a>
                                &nbsp;
                                <a class="btn btn-danger" href="RdealingdeleteList.php?id=<?php echo $row['entry_id']; ?>">Delete</a>
                            </td>
                    </tr>
        <?php       }
                    }
                }
        ?>
        </tbody>
    </table>

</div>

<?php include('footer.php') ?>