<script type="text/javascript">  

$("#btncetak").click(function(){ 
     var vstart = $("input#startdate").val();
     var vend = $("input#enddate").val();
     
     window.open('slssektor_rekappdf.php?startdate='+vstart+'&enddate='+vend,'_blank');

	});
		 
</script>

<?php 
// memanfaatkan class pagination dari Reneesh T.K 
include_once('config.php'); 
include_once('pagination_class.php'); 
$startdate = settanggal($_GET['startdate']);
$enddate = settanggal($_GET['enddate']);


$sql = "select distinct sektor_idsektor from slshdrsektor where sls_date between '$startdate' and '$enddate' order by sektor_idsektor"; 

$result = mysql_query($sql); 
?> 
	 
  <table id="slshdrsektor" width=500px> 
   
<tr><td colspan="2">Rekap Nilai Pengeluaran Barang Ke Sektor</td>
<td><input type="button" class="button" id="btncetak" value="Cetak Rekap"</td>
</tr>   
  
  <tr> 
<th>Kode</th>
<th>Nama Supplier</th>
<th>Total Tagihan</th>
  </tr> 
		<?php 
		//menampilkan data receivehdr 
		if(mysql_num_rows($result)!=0){ $alltotal =0;
  		while($row = mysql_fetch_array($result)){
  $idsektor = $row['sektor_idsektor'];			
$sektor = sektorinfo($row['sektor_idsektor']) ; 

$sql2="SELECT sum(sales_price * qty) vsales FROM slsdtlsektor a, slshdrsektor b  
where a.slshdrsektor_idslshdr = b.idslshdr and 
b.sls_date between '$startdate' and '$enddate' and 
sektor_idsektor = '$idsektor' group by sektor_idsektor";

$data2  = mysql_fetch_array(mysql_query($sql2));  
$mrcv = $data2[0];	

			
 ?>		 
 <tr> 
 <td><? echo $row['sektor_idsektor'];?></td>
<td><? echo $sektor['sektorname'];?></td>
<td class="right"><? echo nf($mrcv);?></td>
 </tr> 
  		<?  
$alltotal = $alltotal + $mrcv;  		
  		
  		} //end while ?> 
		 <tr id="nav"><td colspan=2>Total</td><td class="right"><? echo nf($alltotal);?></td></tr> 
    <?}else{?> 
   <tr><td align="center" colspan="10">Data tidak ditemukan!</td></tr> 
    <?}?> 
	</table> 
