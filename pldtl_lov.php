 <script type="text/javascript">  
 
function pagination1(page){ 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
	  if (combo == "idpldtl"){ 
    dataString = 'starting='+page+'&idpldtl='+cari+'&random='+Math.random(); 
   } 
   else if (combo == "plhdr_idplhdr"){ 
    dataString = 'starting='+page+'&plhdr_idplhdr='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "acc_idacc"){ 
    dataString = 'starting='+page+'&acc_idacc='+cari+'&random='+Math.random(); 
    } 
  else{ 
    dataString = 'starting='+page+'&random='+Math.random(); 
  } 
   
  $.ajax({ 
    url:"pldtl_lov.php", 
    data: dataString, 
		type:"GET", 
		success:function(data) 
		{ 
			$('#divLOV').html(data); 
		} 
  }); 
} 
 
// fungsi untuk me-load tampilan list data pldtl, data yang ditampilkan disesuaikan 
// juga dengan input data pada bagian search 
function loadData(){ 
  var dataString; 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
	  if (combo == "idpldtl"){ 
      dataString = 'idpldtl='+ cari;  
   } 
   else if (combo == "plhdr_idplhdr"){ 
      dataString = 'plhdr_idplhdr='+ cari; 
    } 
   else if (combo == "acc_idacc"){ 
      dataString = 'acc_idacc='+ cari; 
    } 
 
  $.ajax({ 
    url: "pldtl_lov.php", //file tempat pemrosesan permintaan (request) 
    type: "GET", 
    data: dataString, 
		success:function(data) 
		{ 
			$('#divLOV').html(data); 
		} 
  }); 
} 
   
$(function(){  
  // membuat warna tampilan baris data pada tabel menjadi selang-seling 
  $('#pldtl tr:even:not(#nav):not(#total)').addClass('even'); 
  $('#pldtl tr:odd:not(#nav):not(#total)').addClass('odd'); 
   
	 
}); 
 
 function sendpldtl(n1,n2) 
 {
     document.getElementById('pldtl_idpldtl').value=n1;
     document.getElementById('pldtl').value=n2;
 } 
</script> 
 
<?php 
// memanfaatkan class pagination dari Reneesh T.K 
include_once('config.php'); 
include_once('pagination_class1.php'); 
$fieldcari = $_POST['fieldcari']; 
 
  $sql = "select * from pldtl where idpldtl like '%".$fieldcari."%'";  
 
if(isset($_GET['starting'])){ //starting page 
	$starting=$_GET['starting']; 
}else{ 
	$starting=0; 
} 
 
$recpage = 25;//jumlah data yang ditampilkan per page(halaman) 
$obj = new pagination_class1($sql,$starting,$recpage);		 
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
	<form method="post" name="pldtl_lov" action="" id="pldtl_lov">  
	<table>  
	<tr><td colspan=5 > 
	Cari Data : <input size=10 type="text" name="fieldcari" id="fieldcari" value="%" />  
	<input class="button"  type="submit" id="btncari" value="Tampilkan" /> 
	<input type="hidden" name="id" value=<? echo $id; ?> 
	</td></tr>   
  <tr> 
 <th>idpldtl</th>
<th>plhdr_idplhdr</th>
<th>acc_idacc</th>
<th>Aksi</th> 
  </tr> 
		<?php 
		//menampilkan data pldtl 
		if(mysql_num_rows($result)!=0){ 
  		while($row = mysql_fetch_array($result)){ ?>		 
       <tr> 
 <td><? echo $row['idpldtl'];?></td>
<td><? echo $row['plhdr_idplhdr'];?></td>
<td><? echo $row['acc_idacc'];?></td>
 
<td><input class="button" type=button value="Pilih" onClick="sendpldtl('<? echo $row['idpldtl'];?>','<? echo $row['pldtl'];?>  ' )"></td>
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
