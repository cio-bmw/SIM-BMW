 <script type="text/javascript">  
 
function pagination1(page){ 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
	  if (combo == "idunitamclist"){ 
    dataString = 'starting='+page+'&idunitamclist='+cari+'&random='+Math.random(); 
   } 
   else if (combo == "clstatus"){ 
    dataString = 'starting='+page+'&clstatus='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "unit_idunit"){ 
    dataString = 'starting='+page+'&unit_idunit='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "amclist_idamclist"){ 
    dataString = 'starting='+page+'&amclist_idamclist='+cari+'&random='+Math.random(); 
    } 
  else{ 
    dataString = 'starting='+page+'&random='+Math.random(); 
  } 
   
  $.ajax({ 
    url:"unitamclist_lov.php", 
    data: dataString, 
		type:"GET", 
		success:function(data) 
		{ 
			$('#divLOV').html(data); 
		} 
  }); 
} 
 
// fungsi untuk me-load tampilan list data unitamclist, data yang ditampilkan disesuaikan 
// juga dengan input data pada bagian search 
function loadData(){ 
  var dataString; 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
	  if (combo == "idunitamclist"){ 
      dataString = 'idunitamclist='+ cari;  
   } 
   else if (combo == "clstatus"){ 
      dataString = 'clstatus='+ cari; 
    } 
   else if (combo == "unit_idunit"){ 
      dataString = 'unit_idunit='+ cari; 
    } 
   else if (combo == "amclist_idamclist"){ 
      dataString = 'amclist_idamclist='+ cari; 
    } 
 
  $.ajax({ 
    url: "unitamclist_lov.php", //file tempat pemrosesan permintaan (request) 
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
  $('#unitamclist tr:even:not(#nav):not(#total)').addClass('even'); 
  $('#unitamclist tr:odd:not(#nav):not(#total)').addClass('odd'); 
   
	 
}); 
 
 function sendunitamclist(n1,n2) 
 {
     document.getElementById('unitamclist_idunitamclist').value=n1;
     document.getElementById('unitamclist').value=n2;
 } 
</script> 
 
<?php 
// memanfaatkan class pagination dari Reneesh T.K 
include_once('config.php'); 
include_once('pagination_class1.php'); 
$fieldcari = $_POST['fieldcari']; 
 
  $sql = "select * from unitamclist where idunitamclist like '%".$fieldcari."%'";  
 
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
	<form method="post" name="agama_lov" action="" id="agama_lov">  
	<table>  
	<tr><td colspan=5 > 
	Cari Data : <input size=10 type="text" name="fieldcari" id="fieldcari" value="%" />  
	<input class="button"  type="submit" id="btncari" value="Tampilkan" /> 
	<input type="hidden" name="id" value=<? echo $id; ?> 
	</td></tr>   
  <tr> 
 <th>idunitamclist</th>
<th>clstatus</th>
<th>unit_idunit</th>
<th>amclist_idamclist</th>
<th>Aksi</th> 
  </tr> 
		<?php 
		//menampilkan data unitamclist 
		if(mysql_num_rows($result)!=0){ 
  		while($row = mysql_fetch_array($result)){ ?>		 
       <tr> 
 <td><? echo $row['idunitamclist'];?></td>
<td><? echo $row['clstatus'];?></td>
<td><? echo $row['unit_idunit'];?></td>
<td><? echo $row['amclist_idamclist'];?></td>
 
<td><input class="button" type=button value="Pilih" onClick="sendunitamclist('<? echo $row['idunitamclist'];?>','<? echo $row['unitamclist'];?>  ' )"></td>
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
