<?php
require("header.php");
include("db.php");
$mvicount = 0;
$Rmvicount = 0;
$ddcount = 0;
$Rddcount = 0;
$jdcount = 0;
$Rjdcount = 0;


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

$sql = "SELECT SUM(CASE WHEN mvi is null AND dd is null AND jd is null AND d is null THEN 1 ELSE 0 END) AS mvi_null FROM entry WHERE RChasisNo is null and fromRoute is null; ";
$result = $con->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $mvicount = $row['mvi_null'];
    }
}
$sql = "SELECT SUM(CASE WHEN mvi is null AND  dd is null AND jd is null AND d is null THEN 1 ELSE 0 END) AS Rmvi_null FROM entry WHERE RChasisNo is not null and fromRoute is null; ";
$result = $con->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $Rmvicount = $row['Rmvi_null'];
    }
}
$sql = "SELECT SUM(CASE WHEN mvi is null AND  dd is null AND jd is null AND d is null THEN 1 ELSE 0 END) AS routemvi_null FROM entry WHERE fromRoute is not null; ";
$result = $con->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $routemvicount = $row['routemvi_null'];
    }
}
$sql = "SELECT SUM(CASE WHEN dd is null AND mvi is NOT NULL THEN 1 ELSE 0 END) AS dd_null FROM entry WHERE RChasisNo is null; ";
$result = $con->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $ddcount = $row['dd_null'];
    }
}
$sql = "SELECT SUM(CASE WHEN dd is null AND mvi is not NULL THEN 1 ELSE 0 END) AS Rdd_null FROM entry WHERE RChasisNo is not null; ";
$result = $con->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $Rddcount = $row['Rdd_null'];
    }
}
$sql = "SELECT SUM(CASE WHEN dd is null AND mvi is not NULL THEN 1 ELSE 0 END) AS Rdd_null FROM entry WHERE fromRoute is not null; ";
$result = $con->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $Rddcount = $row['Rdd_null'];
    }
}
$sql = "SELECT SUM(CASE WHEN jd is null AND mvi is not NULL AND dd is not null THEN 1 ELSE 0 END) AS jd_null FROM entry WHERE RChasisNo is null; ";
$result = $con->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $jdcount = $row['jd_null'];
    }
}
$sql = "SELECT SUM(CASE WHEN jd is null AND mvi is not NULL AND dd is not null THEN 1 ELSE 0 END) AS Rjd_null FROM entry WHERE RChasisNo is not null; ";
$result = $con->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $Rjdcount = $row['Rjd_null'];
    }
}
$sql = "SELECT regNo from entry where adtsta=1 and RChasisNo is null and fromRoute is NULL";
$result = $con->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $r[] = $row['regNo'];
        $uninspected = implode(',', $r);
    }
}
$sql = "SELECT regNo from entry where adtsta=1 AND RChasisNo is not null and fromRoute is NULL";
$rresult = $con->query($sql);
if ($rresult->num_rows > 0) {
    while ($rrow = $rresult->fetch_assoc()) {
        $rr[] = $rrow['regNo'];
        $Runinspected = implode(',', $rr);
    }
}

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
                <h5 class="card-title"><a href="ApprovedList.php" class="btn btn-success">Click here to see Approved List</a></h5>
            </div>
        </div>
    </div>
</div>
<div class="form">
    <p>Welcome
        <!-- <?php
                if (isset($_SESSION['id'])) {
                    echo  $users;
                    $s = $_SESSION['id'];
                ?> -->

    </p>

    <div class="container">
        <?php if ($s == 1) {
                        echo '
        <div class="row">
        
                <div class="col-4">
                    <div class="card">
                                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                            ' . $mvicount . '</span>
                        <div class="card-header  text-center text-bg-info">
                            <strong>Transfer of Permit</strong>
                        </div>
                        <div class="card-body  text-center">
                        <div class="list-group">                            
                            <a href="dealingentryApplication.php" class="list-group-item list-group-item-action list-group-item-primary">Enter New Application</a>
                            <a href="inspectionList.php" class="list-group-item list-group-item-action list-group-item-warning">Inspection List</a>
                            <a href="dealingentryList.php" class="list-group-item list-group-item-action list-group-item-success">Entry List</a>
                        </div>
                        </div>
                    </div>
                </div>
                <div class="col-4">
                <div class="card">
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                            ' . $Rmvicount . '</span>
                    <div class="card-header  text-center text-bg-info">
                         <strong>Replacement of Vehicle</strong>
                    </div>
                    <div class="card-body  text-center">
                        <div class="list-group">                            
                            <a href="RdealingentryApplication.php" class="list-group-item list-group-item-action list-group-item-primary">Enter New Application</a>
                            <a href="RinspectionList.php" class="list-group-item list-group-item-action list-group-item-warning">Inspection List</a>
                            <a href="RdealingentryList.php" class="list-group-item list-group-item-action list-group-item-success">Entry List</a>
                        </div>
                    </div>
                </div>
                </div>
                <div class="col-4">
                    <div class="card">
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                            ' . $routemvicount . '</span>
                        <div class="card-header  text-center text-bg-info">
                           <strong>Route Transfer</strong>
                        </div>
                        <div class="card-body  text-center">
                        <div class="list-group">  
                            <a href="routeDealingEntry.php" class="list-group-item list-group-item-action list-group-item-primary">Enter New Application</a>
                            <a href="routeInspectionList.php" class="list-group-item list-group-item-action list-group-item-warning">Inspection List</a>
                            <a href="routeDealingEntryList.php" class="list-group-item list-group-item-action list-group-item-success">Entry List</a>
                        </div>
                    </div>
                </div>
            
        </div>
        ';
                    } else if ($s == 2) {
                        echo '
        <div class="col">
                <h4>INSPECTING AUTHORITY</h4>
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Transfer of Permit</h5>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                            ' . $mvicount . '</span>
                        <a href="inspectionList.php" class="btn btn-primary">List of Applications</a><br />
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Replacement of Vehicle</h5>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                            ' . $Rmvicount .
                            '</span>
                        <a href="RinspectionList.php" class="btn btn-info">List of Applications</a><br />
                    </div>
                </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Replacement of Vehicle</h5>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                            ' . $Rmvicount . '</span>
                        <a href="routeInspectionList.php" class="btn btn-info">List of Applications</a><br />
                    </div>
                </div>
';
                    } else if ($s == 3) {
                        echo '
            
        <div class="row">
            <div class="col">
                <h4>DEPUTY DIRECTOR</h4>
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Transfer of Permit</h5>
                       ';
                        if (!empty($uninspected)) {
                            echo ' <h5 class="text-warning">' . $uninspected . '</h5>';
                        }
                        echo '
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                            ' . $ddcount . '
                        </span>
                        <a href="inspectedList.php" class="btn btn-primary">LIST OF INSPECTED APPLICATIONS</a>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Replacement of Vehicle</h5>';
                        if (!empty($Runinspected)) {
                            echo ' <h5 class="text-danger">' . $Runinspected . '</h5>';
                        }
                        echo '<span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                            ' . $Rddcount .
                            '
                        </span>
                        <a href="RinspectedList.php" class="btn btn-info">LIST OF INSPECTED APPLICATIONS</a>
                    </div>
                </div>


                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Route Transfer</h5>';
                        if (!empty($Runinspected)) {
                            echo ' <h5 class="text-danger">' . $Runinspected . '</h5>';
                        }
                        echo '<span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                            ' . $Rddcount .
                            '
                        </span>
                        <a href="routeInspectedList.php" class="btn btn-warning">LIST OF INSPECTED APPLICATIONS</a>
                    </div>
                </div>
            </div>
            ';
                    } else if ($s == 4) {
                        echo '
            <div class="col">
                <h4>JOINT DIRECTOR</h4>
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Transfer of Permit</h5>
                        <a href="jdApprovalList.php" class="btn btn-primary">List of Applications
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                ' . $jdcount . '
                            </span></a><br />
                        </a><br />
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Replacement of Vehicle</h5>
                        <a href="RjdApprovalList.php" class="btn btn-info">List of Applications
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                ' . $Rjdcount . '
                            </span></a><br />
                        </a><br />
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Route Transfer</h5>
                        <a href="routeJdApprovalList.php" class="btn btn-warning">List of Applications
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                ' . $Rjdcount . '
                            </span></a><br />
                        </a><br />
                    </div>
                </div>
            </div>';
                    } else if ($s == 5) {
                        header("Location: dApprovalList.php");
                    }
        ?>
    </div>
</div>
<?php
                }

?>
</div>
</body>
<script src="js/bootstrap.bundle.min.js"></script>

</html>