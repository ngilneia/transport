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
$pdf->SetTitle('Route Transfer');
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
$sql = "SELECT a.name as Name,fname,address,regNo,reason,b.name as ClassName,dto,fromRoute,toRoute,routeRate,eFileNo,dApproveDate FROM `entry` a 
INNER JOIN class b on a.typeOfVehicle = b.id  
WHERE entry_id=$id";
$result = $con->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $name = strtoupper($row['Name'] ? $row['Name'] : "");
        $fName = strtoupper($row['fname'] ? $row['fname'] : "");
        $address = strtoupper($row['address'] ? $row['address'] : "");
        $regNo = strtoupper($row['regNo']);
        $fromRoute =
            strtoupper($row['fromRoute'] ? $row['fromRoute'] : "");
        $toRoute =
            strtoupper($row['toRoute'] ? $row['toRoute'] : "");

        $routeRate = $row['routeRate'] ? $row['routeRate'] : "";
        $reason = strtoupper($row['reason'] ? $row['reason'] : "");
        $vClass = strtoupper($row['ClassName']);
        $dto = strtoupper($row['dto'] ? $row['dto'] : "");
        $routeFileno = strtoupper($row['eFileNo'] ? $row['eFileNo'] : "");
        $dApproveDate = date('d-m-Y', strtotime($row['dApproveDate'] ? $row['dApproveDate'] : ""));
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
                        <td style="text-align: left;"><strong>' . $routeFileno . '</strong></td>
                        <td style="text-align: right;"><strong>Dated Aizawl the ' . $dApproveDate . '</strong></td>
                    </tr>
                </table>
                             <br/>
                <h3 style="text-align: center; text-decoration:underline;">ORDER</h3>
                <p style="text-align: justify; text-indent:30px;"><strong>' . $vClass . '</strong> bearing registration no <strong>' . $regNo . ' </strong>belonging to <strong>' . $name . ' s/o ' . $fName . ' of ' . $address . '</strong> is hereby
                allowed to change its service route from <strong>' . $fromRoute . ' to ' . $toRoute . '</strong>
                on usual payment of route transfer fee amounting to Rs ' . $routeRate . ' with immediate effect and until futher order. Payment should be made at the concerned DTO for issuance of fresh permit.
                
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
			<td style="width:2%;"></td>
                        <td style="width:68%;"></td>
                        <td style="width:30%; text-align:center;">
                        Sd/-<br/>
                        Secretary<br/>
                        State Transport Authority<br/>
                        Mizoram, Aizawl        
                        </td>
                    </tr>
                    <tr><td></td><td></td><td></td></tr>

                    <tr>
					<td></td>
                        <td style="text-align: left; width:65%;"><strong>' . $routeFileno . '</strong></td>
                        <td style="text-align: right; width:35%;"><strong>Dated Aizawl the ' . $dApproveDate . '</strong></td>
                    </tr>
                    <tr>
<td></td>
                    <td>
                    <p style="padding:0 0 0 60px;">Copy to:<br/>
                    1. DTO, ' . $dto . ' District for kind information<br/>
                    2. Holder concerned for information and necessary action<br/>
                    3. IT Cell, Transport Dept. for information and necessary action<br/>
                    4. Office Order Book<br/>
                    5. Dealing Assistant(STA) for information</p>
                    </td>
                    </tr>
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
