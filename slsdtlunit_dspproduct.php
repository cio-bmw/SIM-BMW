 <script type="text/javascript">  
function pagination(page){ 
  var datastring;
  var vcari = $("input#fieldcari").val(); 
  var vid = $("input#idslshdr").val(); 
   
    dataString = 'starting='+page+'&fieldcari='+vcari+'&id='+vid+'&random='+Math.random(); 
       
  $.ajax({ 
    url:"slsdtlunit_dspproduct.php", 
    data: dataString, 
		type:"GET", 
		success:function(data) 
		{ 
			$('#divLOV').html(data); 
			
			
		} 
  }); 
} 
 
// fungsi untuk me-load tampilan list data pelanggan, data yang ditampilkan disesuaikan 
// juga dengan input data pada bagian search 
function loadData(){ 
  var dataString; 
  var vcari = $("input#fieldcari").val(); 
  var vid = $("input#idslshdr").val(); 
   
  
   dataString = 'fieldcari='+ vcari + '&id='+vid; 
  
 
  $.ajax({ 
    url: "slsdtlunit_dspproduct.php", //file tempat pemrosesan permintaan (request) 
    type: "GET", 
    data: dataString, 
		success:function(data) 
		{ 
			$('#divLOV').html(data); 
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
		$("#btnhide").show(); 
		
  //  alert(getParameterByName("product",page));
  // var elem = document.getElementById("check_fisik");
  //  elem.value = getParameterByName("product",page);    
    
    return false; 
		
		
	}); 
	

	
	


$("#btncarilov").click(function(){ 

 	page="slsdtlunit_dspproduct.php?id="+$("input#idslshdr").val()+"&fieldcari="+$("input#fieldcari").val();
		$("#divLOV").load(page); 
		$("#divLOV").show(); 
		$("#btnhide").show(); 
		return false; 
	}); 

	 
}); 

 function sendpilih(n1,n2,n3) 
 {
          document.getElementById('product_idproduct').value=n1;
          document.getElementById('productname').value=n2;
          document.getElementById('sales_price').value=n3;
          $("input#qty").focus();  
  
     //     $('#divLOV').hide();
 } 
 
</script> 
 

<?php 
// memanfaatkan class pagination dari Reneesh T.K 
include_once('config.php'); 
include_once('pagination_class.php'); 
$fieldcari = $_GET['fieldcari'];
$id=$_GET['id'];

$sqllov = "select * from product where productname like '%".$fieldcari."%'";  
 
if(isset($_GET['starting'])){ //starting page 
	$starting=$_GET['starting']; 
}else{ 
	$starting=0; 
} 
 
$recpagelov = 15;//jumlah data yang ditampilkan per page(halaman) 
$objlov = new pagination_class($sqllov,$starting,$recpagelov);		 
$resultlov = $objlov->result; 
?> 
<form method="post" name="dspobat" action="" id="dspobat">
<table width="495px"> 
<tr><td colspan=5 >
Cari Nama Barang : <input size=10 type="text" name="fieldcari"  id="fieldcari" value="<? echo $fieldcari; ?>" /> 
<input type="button" class="button" id="btncarilov" value="Tampilkan" />
<input type="hidden" name="id" value=<? echo $id; ?>
</td></tr>  
  <tr> 
 <th>Kode><? echo $id; ?></th>
<th>Nama Obat</th>
<th>H Jual</th>
<th>Stock</th>
<th>Aksi</th> 
  </tr> 
		<?php 
		//menampilkan data pelanggan 
		if(mysql_num_rows($resultlov)!=0){ 
  		while($row = mysql_fetch_array($resultlov)){ ?>		 
       <tr> 
 <td width=15px><? echo $row['idproduct'];?></td>
<td width=300px><? echo $row['productname'];?></td>
<td  width=20px class="right"><? echo nf($row['salesprice']);?></td>
<td  width=15px class="right"><? echo nf($row['stock']);?></td>
 
<td><input class="button" type=button value="Pilih" onClick="sendpilih('<? echo $row['idproduct'];?>','<? echo $row['productname'];?>','<? echo $row['salesprice'];?>' )"></td>

  		<?} //end while ?> 
		 
  
		 <tr id="nav"><td colspan="7"><?php echo $objlov->anchors; ?></td></tr> 
	   <tr id="total"><td colspan="7"><?php echo $objlov->total; ?></td></tr> 
    <?}else{?> 
    
   <tr><td align="center" colspan="5">Data tidak ditemukan!</td></tr> 
    <?}?> 
	</table> 

	</form>