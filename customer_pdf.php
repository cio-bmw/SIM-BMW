<?php 
require("fpdf.php"); 
require_once "config/config.php"; 
require_once "config/common.php"; 
$id = $_GET['id'];
//Create new pdf file
$pdf=new FPDF();
//Disable automatic page break
$pdf->SetAutoPageBreak(false);
//Add first L landscape P portrait page
$pdf->AddPage('P');
//set initial y axis position per page
$y = 20;
$x = 30;
$rh = 6;
$pdf -> SetMargins(30,30);
//    Image(Resource id #16, =null, =null, =0, =0, varchar(10)='', ='') 
$pdf->image('./images/logo.jpeg',$x,$y,150,20);
$pdf->SetFont('helvetica','B',14);
$yx = $pdf->getY()+40;
$pdf->SetY($yx);
$pdf->text($x,$yx,'Daftar customer');
$pdf->SetFont('helvetica','B',10);
$yx = $pdf->getY()+$rh;
///function Cell($w, $h=0, $txt='', =0, =0, ='', =false, ='')
$pdf->SetFillColor(236,147,109);
$pdf->SetFont('helvetica','B',12);
$pdf->SetY($yx);
//buat header tabel//
 $pdf->cell(30,$rh,idcustomer,1,'C',0); 
$pdf->cell(30,$rh,custname,1,'C',0); 
$pdf->cell(30,$rh,birthdate,1,'C',0); 
$pdf->cell(30,$rh,address,1,'C',0); 
$pdf->cell(30,$rh,phone,1,'C',0); 
$pdf->cell(30,$rh,creditlimit,1,'C',0); 
$pdf->cell(30,$rh,tolerance,1,'C',0); 
$pdf->cell(30,$rh,active_record,1,'C',0); 
$pdf->cell(30,$rh,cm_status,1,'C',0); 
$pdf->cell(30,$rh,cm_phone,1,'C',0); 
$pdf->cell(30,$rh,age,1,'C',0); 
$pdf->cell(30,$rh,agedesc,1,'C',0); 
 
$yx =$pdf->getY()+$rh; 
$pdf->SetY($yx);
$sql = " select idcustomer,custname,birthdate,address,phone,creditlimit,tolerance,active_record,cm_status,cm_phone,age,agedesc from customer"; 
$result = execsql($sql); 
$i=1;  
$no=1;  
$max =21;  
 while($row = mysql_fetch_array($result)) { 
 $pdf->cell(30,$rh,$row['idcustomer'],1,'L',0); 
$pdf->cell(30,$rh,$row['custname'],1,'L',0); 
$pdf->cell(30,$rh,$row['birthdate'],1,'L',0); 
$pdf->cell(30,$rh,$row['address'],1,'L',0); 
$pdf->cell(30,$rh,$row['phone'],1,'L',0); 
$pdf->cell(30,$rh,$row['creditlimit'],1,'L',0); 
$pdf->cell(30,$rh,$row['tolerance'],1,'L',0); 
$pdf->cell(30,$rh,$row['active_record'],1,'L',0); 
$pdf->cell(30,$rh,$row['cm_status'],1,'L',0); 
$pdf->cell(30,$rh,$row['cm_phone'],1,'L',0); 
$pdf->cell(30,$rh,$row['age'],1,'L',0); 
$pdf->cell(30,$rh,$row['agedesc'],1,'L',0); 
 
$yx =$pdf->getY()+$rh; 
$pdf->SetY($yx);
$i++;
$no++; 
 } 
#output file PDF 
$pdf->Output(); 
?> 
