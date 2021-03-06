 <script type="text/javascript">  
 
// fungsi ini untuk menampilkan list data pelanggan sesuai halaman (page) yang dipilih. 
// list data yang ditampilkan disesuaikan juga dengan input data pada bagian search. 
function pagination(page){ 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
	  if (combo == "idprogress"){ 
    dataString = 'starting='+page+'&idprogress='+cari+'&random='+Math.random(); 
   } 
   else if (combo == "progressname"){ 
    dataString = 'starting='+page+'&progressname='+cari+'&random='+Math.random(); 
    } 
  else{ 
    dataString = 'starting='+page+'&random='+Math.random(); 
  } 
   
  $.ajax({ 
    url:"progress_display.php", 
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
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
	  if (combo == "idprogress"){ 
      dataString = 'idprogress='+ cari;  
   } 
   else if (combo == "progressname"){ 
      dataString = 'progressname='+ cari; 
    } 
 
  $.ajax({ 
    url: "progress_display.php", //file tempat pemrosesan permintaan (request) 
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
  $('#progress tr:even:not(#nav):not(#total)').addClass('even'); 
  $('#progress tr:odd:not(#nav):not(#total)').addClass('odd'); 
   
	$("a.edit").click(function(){ 
		page=$(this).attr("href"); 
		$("#divPageData").load(page); // me-load formpelanggan untuk melakukan edit data 
		$("#divPageData").show(); 
		$("#btnhide").show(); 
		return false; 
	}); 
	 
	$("a.delete").click(function(){ 
		el=$(this); 
		if(confirm("Apakah benar akan menghapus data progress ini?")) 
		{ 
			$.ajax({ 
				url:$(this).attr("href"),  
				type:"GET", 
				dataType: 'json', //respon yang diminta dalam format JSON 
				success:function(response) 
				{ 
					if(response.status == 1){ 
						loadData(); 
						$("#divFormContent").load("progress_form.php"); 
						$("#divFormContent").hide(); 
            $("#btnhide").hide(); 
            alert("Data progress berhasil di hapus!"); 
					} 
					else{ 
						alert("data progress gagal di hapus!"); 
					} 
				} 
			}); 
		} 
		return false; 
	}); 
	 
}); 
 
</script> 
 
<?php 
// memanfaatkan class pagination dari Reneesh T.K 
include_once('config.php'); 
include_once('pagination_class.php'); 
 
if (isset($_GET['idprogress']) and !empty($_GET['idprogress'])){ 
 $idprogress = $_GET['idprogress']; 
  $sql = "select * from progress where idprogress like '%$idprogress%' order by idprogress"; 
} 
else if (isset($_GET['progressname']) and !empty($_GET['progressname'])){ 
 $progressname = $_GET['progressname']; 
  $sql = "select * from progress where progressname like '%$progressname%' order by progressname"; 
} 
else{ 
  $sql = "select * from progress"; 
} 
 
if(isset($_GET['starting'])){ //starting page 
	$starting=$_GET['starting']; 
}else{ 
	$starting=0; 
} 
 
$recpage = 25;//jumlah data yang ditampilkan per page(halaman) 
$obj = new pagination_class($sql,$starting,$recpage);		 
$result = $obj->result; 
?> 
	 
  <table id="progress"> 
  <tr> 
 <th>idprogress</th>
<th>progressname</th>
<th>Aksi</th> 
  </tr> 
		<?php 
		//menampilkan data pelanggan 
		if(mysql_num_rows($result)!=0){ 
  		while($row = mysql_fetch_array($result)){ ?>		 
       <tr> 
 <td><? echo $row['idprogress'];?></td>
<td><? echo $row['progressname'];?></td>
 
        <td><a href="progress_form.php?action=update&id=<? echo $row['idprogress'];?>" class="edit">edit</a> | <a href="proses_data.php?action=delete&id=<? echo $row['idprogress'];?>" class="delete">delete</a></td></tr> 
  		<?} //end while ?> 
		 <tr id="nav"><td colspan="5"><?php echo $obj->anchors; ?></td></tr> 
	   <tr id="total"><td colspan="5"><?php echo $obj->total; ?></td></tr> 
    <?}else{?> 
   <tr><td align="center" colspan="5">Data tidak ditemukan!</td></tr> 
    <?}?> 
	</table> 
