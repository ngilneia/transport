<?php
include("header.php");
?>
<div class="form">
    <p>Welcome <?php echo $_SESSION['username']; ?></p>
    <p>This is secure area.</p>
    <p><a href="dashboard.php">Dashboard</a></p>
    <a href="logout.php">Logout</a>
</div>
</body>
<script src="js/bootstrap.bundle.min.js"></script>

</html>