 <script type="text/javascript">  
function pagination(page){ 
  var datastring;
  var vcari = $("input#fieldcari").val(); 
  var vid = $("input#idunit").val(); 
   
    dataString = 'starting='+page+'&fieldcari='+vcari+'&idunit='+vid+'&random='+Math.random(); 
       
  $.ajax({ 
    url:"sektorstok_dspproduct.php", 
    data: dataString, 
		type:"GET", 
		success:function(data) 
		{ 
			$('#divPageData').html(data); 
			
			
		} 
  }); 
} 
 
// fungsi untuk me-load tampilan list data pelanggan, data yang ditampilkan disesuaikan 
// juga dengan input data pada bagian search 
function loadData(){ 
  var dataString; 
  var vcari = $("input#fieldcari").val(); 
  var vid = $("input#idunit").val(); 
   
  
   dataString = 'fieldcari='+ vcari + '&idunit='+vid; 
  
 
  $.ajax({ 
    url: "sektorstok_dspproduct.php", //file tempat pemrosesan permintaan (request) 
    type: "GET", 
    data: dataString, 
		success:function(data) 
		{ 
			$('#divPageData').html(data); 
		} 
  }); 
} 

function getParameterByName( name,href )
{
  name = name.replace(/[\[]/,"\\\[").replace(/[\]]/,"\\\]");
  var regexS = "[\\?&]"+name+"=([^&#]*)";
  var regex = new RegExp( regexS );
  var results = regex.exec( href );
  if( results == null )
    return "";
  else
    return decodeURIComponent(results[1].replace(/\+/g, " "));
}


   
$(function(){  
  // membuat warna tampilan baris data pada tabel menjadi selang-seling 
  $('#product tr:even:not(#nav):not(#total)').addClass('even'); 
  $('#product tr:odd:not(#nav):not(#total)').addClass('odd'); 
   
	
	$("a.pilih").click(function(){ 
		page=$(this).attr("href"); 
		$("#divPageEntry").load(page); // me-load formpelanggan untuk melakukan edit data 
		$("#divPageEntry").show(); 
	    return false; 
	}); 
	

$("#btncarilov").click(function(){ 

 	page="sektorstok_dspproduct.php?idunit="+$("input#idunit").val()+"&fieldcari="+$("input#fieldcari").val();
		$("#divLOV").load(page); 
		$("#divLOV").show(); 
		$("#btnhide").show(); 
		return false; 
	}); 

	 
}); 

 function sendlov(n1,n2) 
 {
          document.getElementById('idproduct').value=n1;
          document.getElementById('productname').value=n2;
          $('#divLOV').hide();
 } 
 
</script> 
 

<?php 
// memanfaatkan class pagination dari Reneesh T.K 
include_once('config.php'); 
include_once('pagination_class.php'); 
$fieldcari = $_GET['fieldcari'];
$idunit=$_GET['idunit'];

$sql = "select * from product where productname like '%".$fieldcari."%'";  
 
if(isset($_GET['starting'])){ //starting page 
	$starting=$_GET['starting']; 
}else{ 
	$starting=0; 
} 
 
$recpage = 15;//jumlah data yang ditampilkan per page(halaman) 
$obj = new pagination_class($sql,$starting,$recpage);		 
$result = $obj->result; 
?> 
<form method="post" name="dspobat" action="" id="dspobat">
<table width="90%"> 
<tr><td colspan=5 >
Cari Nama Barang : <input size=10 type="text" name="fieldcari"  id="fieldcari" value="<? echo $fieldcari; ?>" /> 
<input type="button" class="button" id="btncarilov" value="Tampilkan" />
<input type="hidden" name="id" value=<? echo $id; ?>
</td></tr>  
  <tr> 
 <th>Kode</th>
<th>Nama Obat</th>
<th>Aksi</th> 
  </tr> 
		<?php 
		//menampilkan data pelanggan 
		if(mysql_num_rows($result)!=0){ 
  		while($row = mysql_fetch_array($result)){ ?>		 
       <tr> 
 <td width=15px><? echo $row['idproduct'];?></td>
<td width=300px><? echo $row['productname'];?></td>
 
<td><a href="sektorstok_form.php?action=addproduct&product=<? echo $row['idproduct'];?>&idunit=<? echo $idunit; ?>" class="pilih">Pilih</a></td></tr> 

  		<?} //end while ?> 
		 
  
		 <tr id="nav"><td colspan="7"><?php echo $obj->anchors; ?></td></tr> 
	   <tr id="total"><td colspan="7"><?php echo $obj->total; ?></td></tr> 
    <?}else{?> 
    
   <tr><td align="center" colspan="5">Data tidak ditemukan!</td></tr> 
    <?}?> 
	</table> 

	</form>