<?php 
require("fpdf.php"); 
require_once "config.php"; 
$id = $_GET['id'];
//Create new pdf file
$pdf=new FPDF();
//Disable automatic page break
$pdf->SetAutoPageBreak(false);
//Add first L landscape P portrait page
$pdf->AddPage('P');
//set initial y axis position per page
$y = 0;
$x = 0;
$rh = 6;
$pdf -> SetMargins(30,30);
//    Image(Resource id #19, =null, =null, =0, =0, int(1)='', ='') 
$pdf->image('./images/logo.jpeg',$x,$y,150,20);
$pdf->SetFont('helvetica','B',14);
 $yr= $pdf->getY()+$rh; $pdf->setY($yr);$pdf->SetX($x); 
$pdf->cell(30,$rh,'Daftar emp',0,0,'C',0);
$pdf->SetFont('helvetica','B',10);
$yx = $pdf->getY()+$rh;
///function Cell($w, $h=0, $txt='', =0, =0, ='', =false, ='')
$pdf->SetFillColor(236,147,109);
$pdf->SetFont('helvetica','B',12);
$pdf->SetY($yx);
//buat header tabel//
 $pdf->cell(30,$rh,idemp,1,0,'C',0); 
$pdf->cell(30,$rh,empasswd,1,0,'C',0); 
$pdf->cell(30,$rh,empname,1,0,'C',0); 
$pdf->cell(30,$rh,empphone,1,0,'C',0); 
$pdf->cell(30,$rh,gp,1,0,'C',0); 
$pdf->cell(30,$rh,gs,1,0,'C',0); 
$pdf->cell(30,$rh,mkt,1,0,'C',0); 
$pdf->cell(30,$rh,tch,1,0,'C',0); 
$pdf->cell(30,$rh,acc,1,0,'C',0); 
$pdf->cell(30,$rh,kpr,1,0,'C',0); 
$pdf->cell(30,$rh,adm,1,0,'C',0); 
 
 $yr= $pdf->getY()+$rh; $pdf->setY($yr);$pdf->SetX($x); 
$sql = " select * from emp"; 
$result = mysql_query($sql); 
$i=1;  
$no=1;  
$max =21;  
 while($row = mysql_fetch_array($result)) { 
 $pdf->cell(30,$rh,$row['idemp'],1,0,'L',0); 
$pdf->cell(30,$rh,$row['empasswd'],1,0,'L',0); 
$pdf->cell(30,$rh,$row['empname'],1,0,'L',0); 
$pdf->cell(30,$rh,$row['empphone'],1,0,'L',0); 
$pdf->cell(30,$rh,$row['gp'],1,0,'L',0); 
$pdf->cell(30,$rh,$row['gs'],1,0,'L',0); 
$pdf->cell(30,$rh,$row['mkt'],1,0,'L',0); 
$pdf->cell(30,$rh,$row['tch'],1,0,'L',0); 
$pdf->cell(30,$rh,$row['acc'],1,0,'L',0); 
$pdf->cell(30,$rh,$row['kpr'],1,0,'L',0); 
$pdf->cell(30,$rh,$row['adm'],1,0,'L',0); 
 
 $yr= $pdf->getY()+$rh; $pdf->setY($yr);$pdf->SetX($x); 
$i++;
$no++; 
 } 
#output file PDF 
$pdf->Output(); 
?> 
