 <script type="text/javascript">  
 
function pagination1(page){ 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
	  if (combo == "idproject"){ 
    dataString = 'starting='+page+'&idproject='+cari+'&random='+Math.random(); 
   } 
   else if (combo == "startdate"){ 
    dataString = 'starting='+page+'&startdate='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "Keterangan"){ 
    dataString = 'starting='+page+'&Keterangan='+cari+'&random='+Math.random(); 
    } 
  else{ 
    dataString = 'starting='+page+'&random='+Math.random(); 
  } 
   
  $.ajax({ 
    url:"project_lov.php", 
    data: dataString, 
		type:"GET", 
		success:function(data) 
		{ 
			$('#divLOV').html(data); 
		} 
  }); 
} 
 
// fungsi untuk me-load tampilan list data project, data yang ditampilkan disesuaikan 
// juga dengan input data pada bagian search 
function loadData(){ 
  var dataString; 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
	  if (combo == "idproject"){ 
      dataString = 'idproject='+ cari;  
   } 
   else if (combo == "startdate"){ 
      dataString = 'startdate='+ cari; 
    } 
   else if (combo == "Keterangan"){ 
      dataString = 'Keterangan='+ cari; 
    } 
 
  $.ajax({ 
    url: "project_lov.php", //file tempat pemrosesan permintaan (request) 
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
  $('#project tr:even:not(#nav):not(#total)').addClass('even'); 
  $('#project tr:odd:not(#nav):not(#total)').addClass('odd'); 
   
	 
}); 
 
 function sendproject(n1,n2) 
 {
     document.getElementById('project_idproject').value=n1;
     document.getElementById('project').value=n2;
 } 
</script> 
 
<?php 
// memanfaatkan class pagination dari Reneesh T.K 
include_once('config.php'); 
include_once('pagination_class1.php'); 
$fieldcari = $_POST['fieldcari']; 
 
  $sql = "select * from project where idproject like '%".$fieldcari."%'";  
 
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
	<p class="judul">Daftar project</p>  
	<p>
	Cari Data : <input size=10 type="text" name="fieldcari" id="fieldcari" value="%" />  
	<input class="button"  type="submit" id="btncari" value="Tampilkan" /> 
	<input type="hidden" name="id" value=<? echo $id; ?> 
	</p>   
	<form method="post" name="project_lov" action="" id="project_lov">  
	<table>  
  <tr> 
 <th>idproject</th>
<th>startdate</th>
<th>Keterangan</th>
<th>Aksi</th> 
  </tr> 
		<?php 
		//menampilkan data project 
		if(mysql_num_rows($result)!=0){ 
  		while($row = mysql_fetch_array($result)){ ?>		 
       <tr> 
 <td><? echo $row['idproject'];?></td>
<td><? echo $row['startdate'];?></td>
<td><? echo $row['Keterangan'];?></td>
 
<td><input class="button" type=button value="Pilih" onClick="sendproject('<? echo $row['idproject'];?>','<? echo $row['project'];?>  ' )"></td>
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
