<?php
require_once('TCPDF-main/tcpdf.php');
include('db.php');
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
    require_once(dirname(__FILE__) . '/lang/eng.php');
    $pdf->setLanguageArray($l);
}
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);
$pdf->SetMargins(15, 5, 15);
$pdf->SetFont('times', '', 12);
$pdf->AddPage('P', 'A4');
$vClass = '';
$regNo = '';
$pHolderName = '';
$pHolder = '';
$name = '';
$address = '';
$filename = '';

$id = $_GET['id'];
$sql = "SELECT * FROM `entry` WHERE entry_id=$id";
$result = $con->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $name = $row['name'];
        $fName = $row['fname'];
        $pHolderName = $row['pHolderName'];
        $address = $row['address'];
        $regNo = $row['regNo'];
        $reason = $row['reason'];
        $pHolder = $row['pHolder'];
        $dot = $row['dot'];
        $pno = $row['pNo'];
        $vClass = $row['typeOfVehicle'];
        $dto = $row['dto'];
    }
}

$html = '<html>
                <head></head>
                <body>

                <div>
                <h3 style="text-align: center; line-height:5px;">GOVERNMENT OF MIZORAM</h3>
                <h3 style="text-align: center; line-height:5px;">OFFICE OF THE SECRETARY : STATE TRANSPORT AUTHORITY</h3>
                <h3 style="text-align: center; line-height:5px;">MIZORAM : AIZAWL</h3>
                <h1></h1>
                <h1></h1>
                <table>
                    <tr>
                        <td style="text-align: left;"><strong>F.20016/10/2023-DTE(STA)Vol-V</strong></td>
                        <td style="text-align: right;"><strong>Dated Aizawl the ' . date('d-M-Y') . '</strong></td>
                    </tr>
                </table>
                             <br/>
                <h3 style="text-align: center; text-decoration:underline;">ORDER</h3>
                <p style="text-align: justify; text-indent:30px;">On payment of Rs 1000/-(Rupees One thousand) only and as permissible under Sec 82 of MV Act 1988 r/w Rule 113 of the Mizoram Motor Vehicle Rules 1996 ' . $vClass . ' bearing Registration Number
                ' . $regNo . ' is hereby allowed transfer of permit from ' . $pHolderName . ' of ' . $pHolder . ' to ' . $name . ' of ' . $address . '</p>
                <p style="text-align: justify; text-indent:30px;">The new ' . $vClass . ' owner should contact DTO ' . $dto . ' District  with his/her Registration Certificates etc. for making necessary correnctions. Payment should be made at the concerned DTO
                </p>
                <br/>
                <br/>
                <br/>
                <br/>
                <table>
                <tr><td></td><td></td></tr>
                <tr><td></td><td></td></tr>
                <tr><td></td><td></td></tr>
                    <tr>
                        <td style="width:65%;"></td>
                        <td style="width:35%; text-align:center;">
                        Sd/-<br/>
                        Secretary<br/>
                        State Transport Authority<br/>
                        Mizoram, Aizawl        
                        </td>
                    </tr>
                    <tr><td></td><td></td></tr>

                    <tr>
                        <td style="text-align: left;"><strong>F.20016/10/2023-DTE(STA)Vol-V</strong></td>
                        <td style="text-align: right;"><strong>Dated Aizawl the ' . date('d-M-Y') . '</strong></td>
                    </tr>
                    <tr>
                    <td colspan=2>
                    Copy to:<br/>
                    1. DTO, ' . $dto . ' District for kind information<br/>
                    2. Holder concerned for information and necessary action.<br/>
                    3. IT Cell, Transport Dept. for information and necessary action.<br/>
                    4. Officer Order Book
                    </td>
                    </tr>
                    <tr><td></td><td></td></tr>
                <tr><td></td><td></td></tr>
                <tr><td></td><td></td></tr>
                    <tr>
                        <td style="width:65%;"></td>
                        <td style="width:35%; text-align:center;">
                        <div style="position: relative;">                            
                            <img style="width:550%;" src="img/DirectorSignature.png"/>    
                            <div style="position: absolute;  bottom: 20px;">
                                Secretary<br/> 
                                State Transport Authority<br/>
                                Mizoram, Aizawl 
                            </div>   
                        </div>    
                        </td>
                    </tr>
                </table>
                </div>

                </body>
                </html>';

$pdf->writeHTML($html, true, 0, true, 0);

$pdf->lastPage();
$filename = $regNo . '.pdf';
$pdf->Output($filename, 'I');
