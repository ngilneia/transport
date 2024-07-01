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
                        <td style="text-align: left;"><strong>F.20016/92/2020-DTE(STA)Vol-I</strong></td>
                        <td style="text-align: right;"><strong>Dated Aizawl the ' . date('d-M-Y') . '</strong></td>
                    </tr>
                </table>
                   <h3 style="text-align: center; text-decoration:underline;">ORDER</h3>
                <p style="text-align: justify; text-indent:30px;">
                As per Section 83 of the Central Motor Vehicle Act, 1988 and STA meeting decision made on the date 26/07/2016,' . $vClass . ' bearing Regn No' . $regNo . '
                belonging to, Pi/Pu ' . $name . ' s/o ' . $fName . ' of ' . $address . ' is hereby allowed replacement, subjected to the following terms and condition.</p>
                <ol>
                <li>Replacement should be done within 1(One) year from the date of issue of this order and should replace only with brand new vehicle.</li>
                <li>The old taxi(Two wheeler) should be converted into private vehicle/off roaded immediately.</li>
                <li>Replacement is allowed for once only.</li>
                <li>Replacement fee of Rs 1000/-(One Thousand Only) should be paid to their respective registering authority i.e DTO.</li>
                </ol>
                <br/>
                <br/>
                <table>
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
                        <td style="text-align: left;"><strong>F.20016/92/2020-DTE(STA)Vol-I</strong></td>
                        <td style="text-align: right;"><strong>Dated Aizawl the ' . date('d-M-Y') . '</strong></td>
                    </tr>
                    <tr>
                    <td colspan=2>
                    <br/><br/>Copy to:<br/>
                    1. DTO, ' . $dto . ' (RA) District for information &amp; necessary action. Care must be taken to convert the old vehicle into private/Off roaded.<br/>
                    2. Person concerned for compliance.<br/>
                    3. Officer Order Book
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
