<?php
require('db.php');
include("header.php");
?>

<div class="container">
    <p>Entry Application</p>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Add new Application
    </button>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Entry Application</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="row g-3">
                        <div class="col-md-6">
                            <label for="name" class="form-label">Name of Applicant</label>
                            <input type="text" class="form-control" id="name" placeholder="Name">
                        </div>
                        <div class="col-md-6">
                            <label for="fName" class="form-label">S/o / D/o / W/o</label>
                            <input type="text" class="form-control" id="fName" placeholder="S/o / D/o / W/o Name">
                        </div>
                        <div class="col-12">
                            <label for="inputAddress" class="form-label">Address</label>
                            <input type="text" class="form-control" id="inputAddress" placeholder="Proof of address to be enclosed">
                        </div>
                        <div class="col-6">
                            <label for="regNo" class="form-label">Registration No</label>
                            <input type="text" class="form-control" id="regNo" placeholder="MZ0XXX1234">
                        </div>
                        <div class="col-6">
                            <label for="reason" class="form-label">Reason</label>
                            <input type="text" class="form-control" id="reason" placeholder="Reason">
                        </div>
                        <div class="col-md-12">
                            <label for="currentOwner" class="form-label">Name of Present Permit Holder with Full address</label>
                            <input type="text" class="form-control" id="currentOwner" placeholder="Name of Present Permit Holder with Full address">
                        </div>
                        <div class="mb-3">
                            <label for="formFile" class="form-label">Upload File(Combile all scanned document in one pdf)</label>
                            <input class="form-control" type="file" id="formFile">
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="js/bootstrap.bundle.min.js"></script>
</body>

</html>