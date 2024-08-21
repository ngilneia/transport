<?php
require('db.php');
include("header.php");
$ids = $_GET['id'];
if (isset($_POST['submit'])) {
    $entry_id = $ids;
    $regNo = $_POST['regNo'];
    $name = $_POST['name'];
    $address = $_POST['address'];
    $vClass = $_POST['vClass'];
    $mYear = $_POST['mYear'];
    $rTax = date('Y-m-d', strtotime($_POST['rTax']));
    $pTax = date('Y-m-d', strtotime($_POST['pTax']));
    $fc = date('Y-m-d', strtotime($_POST['fc']));
    $fp = date('Y-m-d', strtotime($_POST['fp']));
    $i = date('Y-m-d', strtotime($_POST['i']));
    $p = date('Y-m-d', strtotime($_POST['p']));
    $remarks = $_POST['remarks'];
    $chasis = $_POST['chasis'];
    $place = $_POST['place'];

    $sql = "INSERT INTO `inspection`(`entry_id`,`regNo`,`name`,`address`,`vClass`,`mYear`,`rTax`,`pTax`,`fc`,`fp`,`i`,`p`,`remarks`) 
    values ('$entry_id','$regNo','$name','$address','$vClass','$mYear','$rTax','$pTax','$fc','$fp','$i','$p','$remarks')";
    $insert = $con->query($sql);

    $updateSql = "UPDATE `entry` set `mvi`=1,`adtsta`=NULL, inspection=now(),`chasis`='$chasis', `inspectionPlace`='$place' where entry_id=$ids";
    $result = $con->query($updateSql);
    if ($result == TRUE && $insert == TRUE) {
        echo
        '';
    } else {
        echo "Error:" . $updateSql . "<br>" . $con->error;
        echo "Error:" . $sql . "<br>" . $con->error;
    }
}
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM `entry` WHERE entry_id='$id'";
    $result = $con->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $entry_id = $row['entry_id'];
            $name = $row['name'];
            $fName = $row['fname'];
            $address = $row['address'];
            $regNo = $row['regNo'];
            $reason = $row['reason'];
            $pHolder = $row['pHolder'];
        }
?>
        <div>
            <p>Inspection</p>
            <form class="row g-3" method="post" enctype="multipart/form-data">
                <div class="form-check col-2">
                    <label class="form-check-label" for="regNo">
                        1) Registration No
                    </label>
                    <input type="text" name="regNo" class="form-control border-primary" id="regNo" value="<?php echo $regNo; ?>" readonly="readonly">
                </div>
                <div class="form-check col-2">
                    <label class="form-check-label" for="name">
                        2) Owner's Name
                    </label>
                    <input type="text" name="name" class="form-control border-primary" id="name" value="<?php echo $name; ?>" readonly="readonly">
                </div>
                <div class="form-check col-4">
                    <label class="form-check-label" for="address">
                        3) Address
                    </label>
                    <input type="text" name="address" class="form-control border-primary" id="address" value="<?php echo $address; ?>" readonly="readonly">
                </div>
                <div class="form-check col-2">
                    <label for="vClass" class="form-check-label">4) Vehicle Class</label>
                    <select name="vClass" class="form-control border-primary" id="vClass">
                        <?php
                        $run = 'SELECT * from class';
                        $queryt = $con->query($run);
                        if ($queryt->num_rows > 0) {
                            while ($row = $queryt->fetch_assoc()) {
                                echo '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
                            }
                        }
                        ?>
                    </select>
                </div>
                <div class="form-check col-2">
                    <label for="mYear" class="form-check-label">5) Year of Manufacture as printed in RC</label>
                    <input type="text" name="mYear" class="form-control border-primary" id="mYear" autocomplete="off">
                </div>
                <div class="form-check">
                    <label class="form-check-label">
                        6) Validity of documents
                    </label>
                </div>
                <div class="form-check col-4">
                    <label class="form-check-label" for="rTax">1) Road Tax</label>
                    <input class="form-control border-primary" type="date" name="rTax" id="rTax" autocomplete="off">
                </div>
                <div class="form-check col-4">
                    <label class="form-check-label" for="pTax">2) P&amp;G TAX</label>
                    <input class="form-control border-primary" type="date" name="pTax" id="pTax" autocomplete="off">
                </div>
                <div class="form-check col-4">
                    <label class="form-check-label" for="fc">3) Fitness Certificate</label>
                    <input class="form-control border-primary" type="date" name="fc" id="fc" autocomplete="off">
                </div>
                <div class="form-check col-4">
                    <label class="form-check-label" for="fp">4) Plying Permit</label>
                    <input class="form-control border-primary" type="date" name="fp" id="fp" autocomplete="off">
                </div>
                <div class="form-check col-4">
                    <label class="form-check-label" for="i">5) Insurance</label>
                    <input class="form-control border-primary" type="date" name="i" id="i" autocomplete="off">
                </div>
                <div class="form-check col-4">
                    <label class="form-check-label" for="p">6) Pollution</label>
                    <input class="form-control border-primary" type="date" name="p" id="p" autocomplete="off">
                </div>
                <div>
                    <input type="text" id="dd" name="dd" value="DEPUTY DIRECTOR">
                    <input type="text" id="jd" name="jd" value="JOINT DIRECTOR">
                    <input type="text" id="director" name="director" value="DIRECTOR">
                </div>
        </div>
        <hr />
        <div class="col">
            <p>I, the udersigned hereby declare the above validity of documents shown are true and correct</p>
            <div class="row">
                <div class="form-check col-6">
                    <label class="form-check-label" for="chasis">Chasis No. Pencil Print enclosed</label>
                    <select name="chasis" id="chasis" class="form-select form-control border-primary">
                        <option value="YES">YES</option>
                        <option value="NO">NO</option>
                    </select>
                </div>
                <div class="form-check col-6">
                    <label class="form-check-label" for="place">Place of Inspection</label>
                    <input type="text" name="place" class="form-control border-primary" id="place">
                </div>
            </div>
            <div class="form-check col-8">
                <label class="form-check-label" for="remarks">Remarks</label>
                <input type="text" class="form-control border-primary" id="remarks" name="remarks" placeholder="Remarks">
            </div>
            <div class="col-12  text-center">
                <button type="submit" name="submit" value="submit" id="AddBtn" class="btn btn-primary"> Submit </button>
            </div>
            </form>
        </div>
        </div>
<?php }
} ?>
<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/sweetalert2.all.min.js"></script>
<script type="module">
    // Import the functions you need from the SDKs you need
    import {
        initializeApp
    } from "https://www.gstatic.com/firebasejs/10.13.0/firebase-app.js";

    const firebaseConfig = {
        apiKey: "AIzaSyC6GEHIsRxqejh-6WwXssKP9aHumxgkBbY",
        authDomain: "permit-43daf.firebaseapp.com",
        databaseURL: "https://permit-43daf-default-rtdb.firebaseio.com",
        projectId: "permit-43daf",
        storageBucket: "permit-43daf.appspot.com",
        messagingSenderId: "288540294121",
        appId: "1:288540294121:web:eacc6855623701ed6e6978"
    };

    // Initialize Firebase
    const app = initializeApp(firebaseConfig);
    import {
        getDatabase,
        ref,
        set
    } from "https://www.gstatic.com/firebasejs/10.13.0/firebase-database.js";

    const db = getDatabase();
    let name = document.getElementById('name');
    let regNo = document.getElementById('regNo');
    let dd = document.getElementById('dd');
    let jd = document.getElementById('jd');
    let director = document.getElementById('director');

    let AddBtn = document.getElementById('AddBtn');

    function AddData() {
        set(ref(db, 'exmp/' + regNo.value), {
                name: name.value,
                regNo: regNo.value,
                jd: jd.value,
                dd: dd.value,
                director: director.value
            })
            .then(() => {
                alert("Data Added Successfully")
            })
            .catch((error) => {
                alert("Unsuccessful");
                console.log(error)
            })

    }

    AddBtn.addEventListener('click', AddData);
</script>

</body>

</html>