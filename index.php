<?php
require("header.php");
include("db.php");
$mvicount = 0;
$Rmvicount = 0;
$ddcount = 0;
$Rddcount = 0;
$jdcount = 0;
$Rjdcount = 0;
$sql = "SELECT SUM(CASE WHEN mvi is null AND dd is null AND jd is null AND d is null THEN 1 ELSE 0 END) AS mvi_null FROM entry WHERE RChasisNo is null; ";
$result = $con->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $mvicount = $row['mvi_null'];
    }
}
$sql = "SELECT SUM(CASE WHEN mvi is null AND  dd is null AND jd is null AND d is null THEN 1 ELSE 0 END) AS Rmvi_null FROM entry WHERE RChasisNo is not null; ";
$result = $con->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $Rmvicount = $row['Rmvi_null'];
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
$sql = "SELECT regNo from entry where adtsta=1";
$result = $con->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $r[] = $row['regNo'];
        $uninspected = implode(',', $r);
    }
}

?>
<div class="form">
    <p>Welcome <?php
                if (isset($_SESSION['id'])) {
                    echo  $users;
                    $s = $_SESSION['id'];
                ?></p>

    <div class="container">
        <?php if ($s == 1) {
                        echo '
        <div class="row">
            <div class="col">
                <h4>DEALING</h4>
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Transfer of Permit</h5>
                        <a href="dealingentryApplication.php" class="btn btn-primary">Enter New Application</a><br />
                        <a href="dealingentryList.php" class="btn btn-success">Entry List</a>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Replacement of Vehicle</h5>
                        <a href="RdealingentryApplication.php" class="btn btn-info">Enter New Application</a><br />
                        <a href="RdealingentryList.php" class="btn btn-success">Entry List</a>
                    </div>
                </div>

            </div>
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
                            ' . $Rmvicount . '</span>
                        <a href="RinspectionList.php" class="btn btn-info">List of Applications</a><br />
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
';
                    } else if ($s == 3) {
                        echo '
            
        <div class="row">
            <div class="col">
                <h4>DEPUTY DIRECTOR</h4>
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Transfer of Permit</h5>
                        <h5>' . $uninspected . '</h5>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                            ' . $ddcount . '
                        </span>
                        <a href="inspectedList.php" class="btn btn-primary">LIST OF INSPECTED APPLICATIONS</a>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Replacement of Vehicle</h5>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                            ' . $Rddcount .
                            '
                        </span>
                        <a href="RinspectedList.php" class="btn btn-info">LIST OF INSPECTED APPLICATIONS</a>
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