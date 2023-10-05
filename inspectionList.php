<?php
require('db.php');
include("header.php");
?>
<div>
    <p>Inspection</p>
    <table id="example" class="table table-striped" style="width:100%">
        <thead>
            <tr>
                <th>Registration No</th>
                <th>Name</th>
                <th>Entry Date</th>
                <th>Inspection Date</th>
                <th colspan="2">Action</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>MZ01H2020</td>
                <td>Javascript Developer</td>
                <td>29/06/2023</td>
                <td>30/06/2023</td>
                <td><a href="inspection.php"><button type="button" class="btn btn-primary">Approve</button></a></td>
                <td><a href=""><button type="button" class="btn btn-danger">Cancel</button></a></td>
            </tr>
        </tbody>
    </table>

</div>


<script src="js/bootstrap.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
</body>

</html>