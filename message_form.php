  <?  
  include_once("config.php"); 
   
	$action="add"; 
	$judul="Penambahan Data message"; 
	$status="Tambah"; 
	if(isset($_GET['action']) and $_GET['action']=="update" and !empty($_GET['id'])) 
	{ 
		$str="select * from message where idmessage = '$_GET[id]'"; 
		$res=mysql_query($str) or die("query gagal dijalankan"); 
		$data=mysql_fetch_assoc($res); 
		$id=$data['id']; 
		$message=$data['message']; 
		$sender=$data['sender']; 
		$action="update"; 
		$readonly="readonly=readonly"; 
		$status="Update"; 
		$judul="Update Data Pelanggan"; 
	} 
?> 
<script type="text/javascript"> 
 
$(function(){ 
  $("input#message").focus();  
  
  function loadData(){ 
	  var dataString; 
	  var cari = $("input#fieldcari").val(); 
	  var combo = $("select#pilihcari").val(); 
	   
	  if (combo == "id"){ 
      dataString = 'id='+ cari;  
   } 
   else if (combo == "message"){ 
      dataString = 'message='+ cari; 
    } 
   else if (combo == "sender"){ 
      dataString = 'sender='+ cari; 
    } 
 
    $.ajax({ 
      url: "message_display.php", 
      type: "GET", 
      data: dataString, 
  		success:function(data) 
  		{ 
  			$('#divPageData').html(data); 
  		} 
    }); 
  } 
 
  $("form#message_form").submit(function(){ 
    if (confirm("Apakah benar akan menyimpan data pelanggan ini?")){ 
   //   var vNama = $("input#namapelanggan").val(); //mengambil id dari input 
   //   var vAlamat = $("textarea#alamat").val(); 
   //   var vNoHP = $("input#nohp").val(); 
   //   var myRegExp=/^\+62[0-9]+$/; 
   //    
   //   // cek validasi form dahulu, semua field data harus diisi 
   //   if ((vNama.replace(/\s/g,"") == "") || (vAlamat.replace(/\s/g,"") == "") || (vNoHP.replace(/\s/g,"") == "")) { 
   //     alert("Mohon melengkapi semua field data!"); 
   //     $("input#namapelanggan").focus(); 
   //     return false; 
   //   } 
   //   // cek validasi no handphone 
   //   else if (!myRegExp.test(vNoHP)){ 
   //     alert ('No handphone harus angka dan diawali +62 (contoh: +62818040567890)'); 
   //     $("input#nohp").focus(); 
   //    return false; 
   //   } 
   //   else{   
    		$.ajax({ 
        	url: "message_process.php", 
        	type:$(this).attr("method"), //metode yg digunakan sesuai pada form, dalam hal ini 'POST' 
        	data:$(this).serialize(), //mengirim data secara serialize -- seluruh data input dikirim untuk diproses 
        	dataType: 'json', //respon yang diminta dalam format JSON 
        	success:function(response){ 
          	if(response.status == 1) // return nilai dari hasil proses 
          	{  
          	  alert("Data berhasil disimpan!"); 
              loadData(); //reload list data 
          		$("#divFormContent").load("message_form.php");   
              $("#divFormContent").hide(); 
              $("#btnhide").hide(); 
            } 
          	else 
          	{ 
          		alert("Data gagal di simpan!"); 
           	} 
        	} 
         }); 
     //		return false; 
     	} 
     //} 
     return false; 
   }); 
 }); 
 </script> 
<form method="post" name="message_form" action="" id="message_form">  
<table> 
<tr><th colspan="2"><b><?php echo $judul; ?></b></th></tr> 
<?php if ($_GET['action'] == "update"){?> <!-- //jika update maka textfield ID Pelanggan ditampilkan --> 
<tr><td>ID Pelanggan</td><td><input type="text" id="idpelanggan" name="idpelanggan" size="10" <? echo $readonly;?> value="<? echo $idplgn;?>" /></td> 
</tr> 
<?php }?> 
<tr> 
<td>id</td> 
<td><input type="text" id="id" name="id" size="30" maxlength="25" value="<? echo $id;?>" /></td> 
</tr> 
<tr> 
<td>message</td> 
<td><input type="text" id="message" name="message" size="30" maxlength="25" value="<? echo $message;?>" /></td> 
</tr> 
<tr> 
<td>sender</td> 
<td><input type="text" id="sender" name="sender" size="30" maxlength="25" value="<? echo $sender;?>" /></td> 
</tr> 
<tr> 
<td colspan="2"><input type="submit" value="<? echo $status;?>"</td> 
</tr> 
</table> 
<input type="hidden" name="action" value="<? echo $action;?>" /> 
</form> 
