	
<?php 

include_once('config.php'); 
$id = $_GET['id']; 


$sql = "select * from slshdrsektor where idslshdr = '$id'";
$result = mysql_query($sql);
$datahdr = mysql_fetch_array($result);
$status = $datahdr['sls_status'];
$idslshdr = $datahdr['idslshdr'];

if ($status=='confirm') {
echo "<script> alert('Data sudah pernah di Konfirmasi. Tidak ada update stock '); </script>";	
}

else {
$sqlc = "update slshdrsektor set sls_status='confirm' where idslshdr ='".$id."'";
$confirm = mysql_query($sqlc);		
	

$sql0 = "SELECT IFNULL(max(idreceivehdr),0)+1  FROM receivehdrsektor";
$result0 = mysql_query($sql0);
$data  = mysql_fetch_array($result0);
$idreceivehdr = $data[0];	


$supplier_idsupp='00';
$rcv_date = date('Y-m-d');
$rcv_desc = 'Transfer dari Dok no : '.$idslshdr;
$faktur = $datahdr['faktur'];
$sektor = $datahdr['sektor_idsektor'];

$sql="insert into receivehdrsektor (sektor_idsektor,idreceivehdr,supplier_idsupp,rcv_date,rcv_desc,faktur) 
values ('$sektor','$idreceivehdr','$supplier_idsupp','$rcv_date','$rcv_desc','$faktur')";
$inserthdr = mysql_query($sql);

//insert detail 

$sqld = "select * from slsdtlsektor where slshdrsektor_idslshdr = '$id'";
$resultd = mysql_query($sqld);
while($row = mysql_fetch_array($resultd)){

$sqldtl = "SELECT IFNULL(max(idreceivedtl),0)+1  FROM receivedtlsektor";  
$resultdtl = mysql_query($sqldtl);  
$datadtl  = mysql_fetch_array($resultdtl);  
$idreceivedtl = $datadtl[0];	 	

$qty = $row['qty'];
$product_idproduct = $row['product_idproduct'];
$receivehdrsektor_idreceivehdr = $idreceivehdr;
$receive_price = $row['sales_price'];

$sqld=" insert into receivedtlsektor (idreceivedtl,qty,receive_price,dtl_ppn,receive_priceppn,receive_pricedisc,dtl_percent,dtl_discount,batch_no,exp_date,receivehdrsektor_idreceivehdr,product_idproduct)  values  ('$idreceivedtl','$qty','$receive_price','$dtl_ppn','$receive_priceppn','$receive_pricedisc','$dtl_percent','$dtl_discount','$batch_no','$exp_date','$receivehdrsektor_idreceivehdr','$product_idproduct')";  
$insertdtl=mysql_query($sqld);

$sqlstock = "update product set stock = stock-'$qty' where idproduct = '".$product_idproduct."'";
$updstok = mysql_query($sqlstock);

}	 

echo "<script> alert('Konfirmasi dan proses update record selesai'); </script>";
}

?>  		
<script> alert('proses confirm berhasil'); 
window.close();
</script>		