<?php
include("header.php");
include("db.php");
$adtstacount = 0;
$adtmvcount = 0;
$ddcount = 0;
$jdcount = 0;
$sql = "SELECT SUM(CASE WHEN adtsta is null THEN 1 ELSE 0 END) AS adtsta_null FROM entry; ";
$result = $con->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $adtstacount = $row['adtsta_null'];
    }
}
$sql = "SELECT SUM(CASE WHEN adtmv is null THEN 1 ELSE 0 END) AS adtmv_null FROM entry; ";
$result = $con->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $adtmvcount = $row['adtmv_null'];
    }
}
$sql = "SELECT SUM(CASE WHEN dd is null  AND adtmv is not null AND adtsta is not null THEN 1 ELSE 0 END) AS dd_null FROM entry; ";
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
                <h4>Dealing</h4>
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Transfer of Permit</h5>
                        <a href="dealingentryApplication.php" class="btn btn-info">Enter New Application</a><br />
                        <a href="dealingentryList.php" class="btn btn-success">Entry List</a>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Inspection</h5>
                        <a href="inspectionList.php" class="btn btn-primary">List of Inspection</a><br />
                    </div>
                </div>
            </div>
            <div class="col">

                <h4>Assistant Director(STA & MV)</h4>
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Assistant Director(STA)</h5>
                        <a href="adtApprovalList_I.php" class="btn btn-info">PART I
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                <?php echo $adtstacount; ?>
                            </span></a><br />
                        <a href="adtApprovalList_II.php" class="btn btn-success">PART II</a>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Assistant Director(MV)</h5>
                        <a href="adtmvApprovalList_I.php" class="btn btn-primary">LIST OF APPLICATIONS<span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                <?php echo $adtmvcount; ?>
                            </span></a><br /></a><br />
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <h4>Deputy Director</h4>
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Deputy Director</h5>
                        <a href="ddApprovalList.php" class="btn btn-info">LIST OF APPLICATIONS<span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                <?php echo $ddcount; ?>
                            </span></a><br /></a><br />
                    </div>
                </div>
            </div>
            <div class="col">
                <h4>Joint Director</h4>
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Joint Director</h5>
                        <a href="jdApprovalList.php" class="btn btn-info">List of Applications
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