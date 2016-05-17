 <script type="text/javascript">  
 
function pagination(page){ 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
	  if (combo == "idslshdr"){ 
    dataString = 'starting='+page+'&idslshdr='+cari+'&random='+Math.random(); 
   } 
   else if (combo == "sls_date"){ 
    dataString = 'starting='+page+'&sls_date='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "sls_bon"){ 
    dataString = 'starting='+page+'&sls_bon='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "sls_titip"){ 
    dataString = 'starting='+page+'&sls_titip='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "due_date"){ 
    dataString = 'starting='+page+'&due_date='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "sls_blj"){ 
    dataString = 'starting='+page+'&sls_blj='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "sls_tambahan"){ 
    dataString = 'starting='+page+'&sls_tambahan='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "sls_total"){ 
    dataString = 'starting='+page+'&sls_total='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "sls_bayar"){ 
    dataString = 'starting='+page+'&sls_bayar='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "sls_kembali"){ 
    dataString = 'starting='+page+'&sls_kembali='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "sls_desc"){ 
    dataString = 'starting='+page+'&sls_desc='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "payment_date"){ 
    dataString = 'starting='+page+'&payment_date='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "sls_status"){ 
    dataString = 'starting='+page+'&sls_status='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "sls_diskon"){ 
    dataString = 'starting='+page+'&sls_diskon='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "emp_idemp"){ 
    dataString = 'starting='+page+'&emp_idemp='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "sektor_idsektor"){ 
    dataString = 'starting='+page+'&sektor_idsektor='+cari+'&random='+Math.random(); 
    } 
  else{ 
    dataString = 'starting='+page+'&random='+Math.random(); 
  } 
   
  $.ajax({ 
    url:"slshdrsektor_lov.php", 
    data: dataString, 
		type:"GET", 
		success:function(data) 
		{ 
			$('#divPageData').html(data); 
		} 
  }); 
} 
 
// fungsi untuk me-load tampilan list data slshdrsektor, data yang ditampilkan disesuaikan 
// juga dengan input data pada bagian search 
function loadData(){ 
  var dataString; 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
	  if (combo == "idslshdr"){ 
      dataString = 'idslshdr='+ cari;  
   } 
   else if (combo == "sls_date"){ 
      dataString = 'sls_date='+ cari; 
    } 
   else if (combo == "sls_bon"){ 
      dataString = 'sls_bon='+ cari; 
    } 
   else if (combo == "sls_titip"){ 
      dataString = 'sls_titip='+ cari; 
    } 
   else if (combo == "due_date"){ 
      dataString = 'due_date='+ cari; 
    } 
   else if (combo == "sls_blj"){ 
      dataString = 'sls_blj='+ cari; 
    } 
   else if (combo == "sls_tambahan"){ 
      dataString = 'sls_tambahan='+ cari; 
    } 
   else if (combo == "sls_total"){ 
      dataString = 'sls_total='+ cari; 
    } 
   else if (combo == "sls_bayar"){ 
      dataString = 'sls_bayar='+ cari; 
    } 
   else if (combo == "sls_kembali"){ 
      dataString = 'sls_kembali='+ cari; 
    } 
   else if (combo == "sls_desc"){ 
      dataString = 'sls_desc='+ cari; 
    } 
   else if (combo == "payment_date"){ 
      dataString = 'payment_date='+ cari; 
    } 
   else if (combo == "sls_status"){ 
      dataString = 'sls_status='+ cari; 
    } 
   else if (combo == "sls_diskon"){ 
      dataString = 'sls_diskon='+ cari; 
    } 
   else if (combo == "emp_idemp"){ 
      dataString = 'emp_idemp='+ cari; 
    } 
   else if (combo == "sektor_idsektor"){ 
      dataString = 'sektor_idsektor='+ cari; 
    } 
 
  $.ajax({ 
    url: "slshdrsektor_lov.php", //file tempat pemrosesan permintaan (request) 
    type: "GET", 
    data: dataString, 
		success:function(data) 
		{ 
			$('#divPageData').html(data); 
		} 
  }); 
} 
   
$(function(){  
  // membuat warna tampilan baris data pada tabel menjadi selang-seling 
  $('#slshdrsektor tr:even:not(#nav):not(#total)').addClass('even'); 
  $('#slshdrsektor tr:odd:not(#nav):not(#total)').addClass('odd'); 
   
   
   $("a.pilih").click(function(){ 
		page=$(this).attr("href"); 
		$("#divPageEntry").load(page); // me-load formpelanggan untuk melakukan edit data 
		$("#divPageEntry").show(); 
		$("#btnhide").show(); 
		return false; 
	}); 
	 
}); 
 
 function sendslshdrsektor(n1,n2) 
 {
    document.getElementById('slshdrsektor_idslshdr').value=n1;
    document.getElementById('slshdrsektor').value=n2;
  } 
</script> 
 
<?php 
// memanfaatkan class pagination dari Reneesh T.K 
include_once('config.php'); 
include_once('pagination_class.php'); 
$fieldcari = $_POST['fieldcari']; 
$idsektor = $_GET['idsektor'];
$arphdr=$_GET['arphdr'];
 
$sql = "select * from slshdrsektor where sektor_idsektor ='$idsektor'";  

 
if(isset($_GET['starting'])){ //starting page 
	$starting=$_GET['starting']; 
}else{ 
	$starting=0; 
} 
 
$recpage = 25;//jumlah data yang ditampilkan per page(halaman) 
$obj = new pagination_class($sql,$starting,$recpage);		 
$result = $obj->result; 
?> 
	 
	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">  
	<html xmlns="http://www.w3.org/1999/xhtml"> 
	<head> 
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
	<title>technosoft Indonesia</title> 
	<link rel="stylesheet" type="text/css" href="css/style-page.css" /> 
	<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script> 
 
	</head> 
	<body> 
	<form method="post" name="agama_lov" action="" id="agama_lov">  
	<table>  
	<tr><td colspan=5 > 
	Cari Data <? echo $idsektor; ?> : <input size=10 type="text" name="fieldcari" id="fieldcari" value="%" />  
	<input class="button"  type="submit" id="btncari" value="Tampilkan" /> 
	<input type="hidden" name="id" value=<? echo $id; ?> 
	</td></tr>   
  <tr> 
 <th>No Dok</th>
<th>Tanggal</th>
<th>Status</th>
<th>Sektor</th>
<th>Aksi</th> 
  </tr> 
		<?php 
		//menampilkan data slshdrsektor 
		if(mysql_num_rows($result)!=0){ 
  		while($row = mysql_fetch_array($result)){ ?>		 
       <tr> 
 <td><? echo $row['idslshdr'];?></td>
<td><? echo gettanggal($row['sls_date']);?></td>
<td><? echo $row['sls_status'];?></td>
<td><? echo $row['sektor_idsektor'];?></td>

<td><a href="arpdtl_form.php?arphdr=<? echo $arphdr; ?>&idsls=<? echo $row['idslshdr'];?>" class="pilih"><input class="button" type="button" id="btnpilih" value="Pilih" /></a></td></tr> 
 
 
  		<?} //end while ?> 
		 <tr id="nav"><td colspan="5"><?php echo $obj->anchors; ?></td></tr> 
	   <tr id="total"><td colspan="5"><?php echo $obj->total; ?></td></tr> 
    <?}else{?> 
   <tr><td align="center" colspan="5">Data tidak ditemukan!</td></tr> 
    <?}?> 
	</table> 
	</form>	
	</body>
	</html>	
