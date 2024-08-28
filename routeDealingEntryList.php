<?php
require('db.php');
include("header.php");
?>
<div>
    <p>Application</p>
    <a class="btn btn-info" href="routeDealingEntry.php">Enter New Application</a>
    <hr />
    <table id="entry" class="table table-striped" style="width:100%">
        <thead>
            <tr>
                <th>Sl No</th>
                <th>Name</th>
                <th>Address</th>
                <th>Registration No</th>
                <th>Route From</th>
                <th>RouteTo</th>
                <th>Phone No</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>

            <?php
            $sql = "SELECT * FROM entry where fromRoute is not null and d is null";
            $result = $con->query($sql);
            if ($result->num_rows > 0) {
                $i = 1;
                while ($row = $result->fetch_assoc()) {
                    $id = $row['entry_id'];
            ?>
                    <tr>
                        <td><?php echo $i++; ?></td>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['address']; ?></td>
                        <td><?php echo $row['regNo']; ?></td>
                        <td><?php echo $row['fromRoute']; ?></td>
                        <td><?php echo $row['toRoute']; ?></td>
                        <td><?php echo $row['phoneNo']; ?></td>
                        <td>
                            <?php
                            $sqldd = "SELECT dd,jd,d FROM entry WHERE entry_id=$id";
                            $result9 = $con->query($sqldd);
                            while ($row9 = $result9->fetch_assoc()) {
                                if (empty($row9['dd']) && empty($row9['jd']) && empty($row9['d'])) {
                                    echo '<button class="btn btn-warning">DD</button>';
                                } else if (!empty($row9['dd']) && empty($row9['jd']) && empty($row9['d'])) {
                                    echo '<button class="btn btn-warning">JD</button>';
                                } else if (!empty($row9['dd']) && !empty($row9['jd']) && empty($row9['d'])) {
                                    echo '<button class="btn btn-warning">DIRECTOR</button>';
                                } else {
                                    echo 'Approved';
                                }
                            }
                            ?>
                        </td>
                        <?php
                        if ($row['dd'] == 2 or $row['jd'] == 2 or $row['d'] == 2) {
                            echo '<td><a class="btn btn-danger" target="_blank" href="">Application Rejected<br/>' . $row['ddRemarks'] . $row['jdRemarks'] . $row['dRemarks'] . '</a></td>';
                        } else if ($row['d'] == 1) {
                            if (is_null($row['RChasisNo'])) {
                        ?>
                                <td><a class="btn btn-success" target="_blank" href="routeApproval.php?id=<?php echo $row['entry_id']; ?>">Route Transfer Letter</a></td>
                            <?php
                            } else { ?>

                            <?php }
                        } else {
                            ?>
                            <td><a class="btn btn-info" href="routedealingupdateList.php?id=<?php echo $row['entry_id']; ?>">Edit</a>
                                &nbsp;
                                <a class="btn btn-danger" href="dealingdeleteList.php?id=<?php echo $row['entry_id']; ?>">Delete</a>
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