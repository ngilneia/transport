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
$pdf->SetTitle('Replacement of Vehicle');
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
$sql = "SELECT a.name,a.fName, a.pHolderName,a.address,a.regNo,a.reason,a.pHolder,a.dot,a.pno,b.name as className,a.dto,a.replacement,b.RRate,a.domain,eFileNo, a.dApproveDate 
FROM `entry` a INNER JOIN class b on a.typeOfVehicle = b.id WHERE a.entry_id=$id";
$result = $con->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $name = strtoupper($row['name'] ? $row['name'] : "NA");
        $fName = strtoupper($row['fName'] ? $row['fName'] : "NA");
        $pHolderName = strtoupper($row['pHolderName'] ? $row['pHolderName'] : "NA");
        $address = strtoupper($row['address'] ? $row['address'] : "NA");
        $regNo = strtoupper($row['regNo'] ? $row['regNo'] : "NA");
        $reason = strtoupper($row['reason'] ? $row['reason'] : "NA");
        $pHolder = strtoupper($row['pHolder'] ? $row['pHolder'] : "NA");
        $dot = strtoupper($row['dot'] ? $row['dot'] : "NA");
        $pno = strtoupper($row['pno'] ? $row['pno'] : "NA");
        $vClass = strtoupper($row['className'] ? $row['className'] : "NA");
        $dto = strtoupper($row['dto'] ? $row['dto'] : "NA");
        $replacement = strtoupper($row['replacement'] ? $row['replacement'] : "NA");
        $rate = strtoupper($row['RRate'] ? $row['RRate'] : "NA");
        $domain = strtoupper($row['domain'] ? $row['domain'] : "NA");
        $file_no = strtoupper($row['eFileNo'] ? $row['eFileNo'] : "NA");
        $dApproveDate = date('d-m-Y', strtotime($row['dApproveDate']));
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
                        <td style="text-align: left;"><strong>' . $file_no . '</strong></td>
                        <td style="text-align: right;"><strong>Dated Aizawl the ' . $dApproveDate . '</strong></td>
                    </tr>
                </table>
                   <h3 style="text-align: center; text-decoration:underline;">ORDER</h3>
                <p style="text-align: justify; text-indent:30px;">
                As per Section 83 of the Central Motor Vehicle Act, 1988 and STA meeting decision made on the date 26/07/2016, <strong>' . $domain . ' ' . $vClass . '</strong> bearing Regn No <strong>' . $regNo . '</strong>
                belonging to, <strong>Pi/Pu ' . $name . ' s/o ' . $fName . ' of ' . $address . ' </strong>is hereby allowed for <strong>' . $replacement . '</strong> replacement, subjected to the following terms and condition.</p>
                <ol>
                <li>Replacement should be done within 1(One) year from the date of issue of this order and should replace only with brand new vehicle.</li>
                <li>The old taxi(Two wheeler) should be converted into private vehicle/off roaded immediately.</li>
                <li>Replacement is allowed for once only.</li>
                <li>Replacement fee of Rs <strong>' . $rate . ' only </strong>should be paid to their respective registering authority i.e DTO.</li>
                </ol>
                <br/>
                <br/>
                <table>
                <tr><td></td><td></td></tr>
                <tr><td></td><td></td></tr>
                    <tr>
                        <td style="width:69%;"></td>
                        <td style="width:31%; text-align:center;">
                        Sd/-<br/>
                        Secretary<br/>
                        State Transport Authority<br/>
                        Mizoram, Aizawl        
                        </td>
                    </tr>
                    <tr><td></td><td></td></tr>

                    <tr>
                        <td style="text-align: left;"><strong>' . $file_no . '</strong></td>
                        <td style="text-align: right;"><strong>Dated Aizawl the ' . $dApproveDate . '</strong></td>
                    </tr>
                    <tr>
                    <td colspan=2>
                    <br/><br/>Copy to:<br/>
                    1. DTO, ' . $dto . ' (RA) District for information &amp; necessary action.<br/>&nbsp;&nbsp;&nbsp; Care must be taken to convert the old vehicle into private/Off roaded.<br/>
                    2. Person concerned for compliance.<br/>
                    3. Office Order Book
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
