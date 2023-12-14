<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include("auth.php");
include('db.php');
$users = $_SESSION["username"];
$role = 0;
$sql = "SELECT * FROM `users` where username like '$users'";
$result = $con->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $role = $row['role'];
    }

?>

    <!doctype html>
    <html lang="en" data-bs-theme="dark">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
        <meta name="generator" content="Hugo 0.118.2">
        <title>Transport Department</title>
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/sweetalert2.min.css" rel="stylesheet">
        <link href="DataTables/datatables.min.css" rel="stylesheet">
        <script src="js/jquery-3.7.1.min.js"></script>

    <body class="col-lg-12 mx-auto p-4 py-md-5">
        <nav class="navbar navbar-expand-lg bg-body-tertiary rounded" aria-label="Eleventh navbar example">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Transport Department</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample09" aria-controls="navbarsExample09" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarsExample09">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                        </li>
                    <?php if ($role == 1) {
                        echo '
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-expanded="false">Dealing</a>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="dealingentryList.php">Application Entry</a></li>
                                        <li><a class="dropdown-item" href="inspectionList.php">Inspection Form</a></li>
                                    </ul>
                                </li>';
                    } else if ($role == 2) {
                        echo '<li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-expanded="false">Asst. Director(STA)</a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="adtApprovalList_I.php">Part I</a></li>
                                    <li><a class="dropdown-item" href="adtApprovalList_II.php">Part II</a></li>
                                </ul>
                            </li>';
                    } else if ($role == 5) {
                        echo '<li class="nav-item">
                                <a class="nav-link" href="adtmvApprovalList_I.php">Asst. Director(MV)</a>
                            </li>';
                    } else if ($role == 3) {
                        echo '<li class="nav-item">
                                <a class="nav-link" href="ddApprovalList.php">Director Director</a>
                            </li>';
                    } else if ($role == 4) {
                        echo '<li class="nav-item">
                                <a class="nav-link" href="jdApprovalList.php">Joint Director</a>
                            </li>';
                    } else if ($role == 6) {
                        echo '<li class="nav-item">
                                <a class="nav-link" href="dApprovalList.php">Director</a>
                            </li>';
                    } else {
                        echo 'Wrong User Name';
                    }
                }
                    ?>

                    </ul>
                    <ul class="navbar-nav">
                        <li class=" nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
                    </ul>

                </div>
            </div>
        </nav>