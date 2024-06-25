<?php
include("header.php");
include("db.php");
$mvicount = 0;
$ddcount = 0;
$jdcount = 0;
$sql = "SELECT SUM(CASE WHEN mvi is null THEN 1 ELSE 0 END) AS mvi_null FROM entry; ";
$result = $con->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $mvicount = $row['mvi_null'];
    }
}
$sql = "SELECT SUM(CASE WHEN dd is null AND mvi is not NULL THEN 1 ELSE 0 END) AS dd_null FROM entry; ";
$result = $con->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $ddcount = $row['dd_null'];
    }
}
$sql = "SELECT SUM(CASE WHEN jd is null AND dd is not null THEN 1 ELSE 0 END) AS jd_null FROM entry; ";
$result = $con->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $jdcount = $row['jd_null'];
    }
}
?>
<div class="form">
    <p>Welcome <?php echo $_SESSION['username']; ?></p>

    <div class="container">
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
                        <a href="dealingentryList.php" class="btn btn-success">Entry List</a>
                    </div>
                </div>

            </div>
            <div class="col">
                <h4>MVI</h4>
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Transfer of Permit</h5>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                            <?php echo $mvicount; ?></span>
                        <a href="inspectionList.php" class="btn btn-primary">List of Applications</a><br />
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Replacement of Vehicle</h5>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                            <?php echo $mvicount; ?></span>
                        <a href="" class="btn btn-info">List of Applications</a><br />
                    </div>
                </div>

            </div>
        </div>
        <div class="row">
            <div class="col">
                <h4>DEPUTY DIRECTOR</h4>
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Transfer of Permit</h5>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                            <?php echo $ddcount; ?>
                        </span>
                        <a href="inspectedList.php" class="btn btn-primary">LIST OF INSPECTED APPLICATIONS</a>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Replacement of Vehicle</h5>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                            <?php echo $ddcount; ?>
                        </span>
                        <a href="" class="btn btn-info">LIST OF INSPECTED APPLICATIONS</a>
                    </div>
                </div>
            </div>
            <div class="col">
                <h4>JOINT DIRECTOR</h4>
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Transfer of Permit</h5>
                        <a href="jdApprovalList.php" class="btn btn-primary">List of Applications
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                <?php echo $jdcount; ?>
                            </span></a><br />
                        </a><br />
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Replacement of Vehicle</h5>
                        <a href="" class="btn btn-info">List of Applications
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                <?php echo $jdcount; ?>
                            </span></a><br />
                        </a><br />
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
<script src="js/bootstrap.bundle.min.js"></script>

</html>