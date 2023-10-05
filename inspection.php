<?php
require('db.php');
include("header.php");
?>
<div>
    <p>Inspection</p>
    <form class="row g-3">
        <div class="form-check col-3">
            <label class="form-check-label">
                1) Registration Number
            </label>
        </div>
        <div class="form-check col-3">
            <input class="form-check-input" type="checkbox" value="" id="1">
            <label class="form-check-label" for="1">
                2) Owner's Name and Address
            </label>
        </div>
        <div class="form-check col-3">
            <input class="form-check-input" type="checkbox" value="" id="2">
            <label class="form-check-label" for="2">
                3) Type & Class of Vehicle
            </label>
        </div>
        <div class="form-check col-3">
            <input class="form-check-input" type="checkbox" value="" id="3">
            <label class="form-check-label" for="3">
                4) Year of Manufascture as printed in RC
            </label>
        </div>
        <div class="form-check">
            <label class="form-check-label" for="">
                5) Validity of documents
            </label>
        </div>
        <div class="form-check col-4">
            <input class="form-check-input" type="checkbox" value="" id="4">
            <label class="form-check-label" for="4">
                1) Road Tax
            </label>
        </div>
        <div class="form-check col-4">
            <input class="form-check-input" type="checkbox" value="" id="5">
            <label class="form-check-label" for="5">
                2) P&G Tax
            </label>
        </div>
        <div class="form-check col-4">
            <input class="form-check-input" type="checkbox" value="" id="6">
            <label class="form-check-label" for="6">
                3) Fitness Certificate
            </label>
        </div>
        <div class="form-check col-4">
            <input class="form-check-input" type="checkbox" value="" id="7">
            <label class="form-check-label" for="7">
                4) Flying Permit
            </label>
        </div>
        <div class="form-check col-4">
            <input class="form-check-input" type="checkbox" value="" id="8">
            <label class="form-check-label" for="8">
                5) Insurance
            </label>
        </div>
        <div class="form-check col-4">
            <input class="form-check-input" type="checkbox" value="" id="9">
            <label class="form-check-label" for="9">
                6) Pollution
            </label>
        </div>
        <div class="form-check">
            <label class="form-check-label" for="remarks">
                Remarks
            </label>
            <input type="text" class="form-control" id="remarks" name="remarks" placeholder="Remarks">
        </div>
        <div class="col-12">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
</div>
<script src="js/bootstrap.bundle.min.js"></script>
</body>

</html>