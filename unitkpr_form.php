  <?  
  include_once("config.php"); 
   
	$action="add"; 
	$judul="Penambahan Data"; 
	$status="Simpan"; 
	if(isset($_GET['action']) and $_GET['action']=="update" and !empty($_GET['id'])) 
	{ 
		$str="select * from unitkpr where idunitkpr = '$_GET[id]'"; 
		$res=mysql_query($str) or die("query gagal dijalankan"); 
		$data=mysql_fetch_assoc($res); 
		$idunitkpr=$data['idunitkpr']; 
		$check_date=$data['check_date']; 
		$unit_idunit=$data['unit_idunit']; 
		$kprclmst_idkprclmst=$data['kprclmst_idkprclmst']; 
		$action="update"; 
		$readonly="readonly=readonly"; 
		$status="Simpan"; 
		$judul="Edit Data"; 
	} 
?> 
<script type="text/javascript"> 
 
$(function(){ 
  $("input#unitkpr").focus();  
  
 $("input").not($(":submit")).keypress(function (evt) {  
              if (evt.keyCode == 13) {  
                  iname = $(this).val();  
                  if (iname !== 'Submit') {  
                      var fields = $(this).parents('form:eq(0),body').find('button, input, textarea, select');  
                      var index = fields.index(this);  
                      if (index > -1 && (index + 1) < fields.length) {  
                          fields.eq(index + 1).focus();  
                      }  
                      return false;  
                  }  
              }  
          });  
  
  function loadData(){ 
	  var dataString; 
	  var cari = $("input#fieldcari").val(); 
	  var combo = $("select#pilihcari").val(); 
	   
	  if (combo == "idunitkpr"){ 
      dataString = 'idunitkpr='+ cari;  
   } 
   else if (combo == "check_date"){ 
      dataString = 'check_date='+ cari; 
    } 
   else if (combo == "unit_idunit"){ 
      dataString = 'unit_idunit='+ cari; 
    } 
   else if (combo == "kprclmst_idkprclmst"){ 
      dataString = 'kprclmst_idkprclmst='+ cari; 
    } 
 
    $.ajax({ 
      url: "unitkpr_display.php", 
      type: "GET", 
      data: dataString, 
  		success:function(data) 
  		{ 
  			$('#divPageData').html(data); 
  		} 
    }); 
  } 
 
  $("form#unitkpr_form").submit(function(){ 
    if (confirm("Apakah benar akan menyimpan data unitkpr ini?")){ 
    		$.ajax({ 
        	url: "unitkpr_process.php", 
        	type:$(this).attr("method"), //metode yg digunakan sesuai pada form, dalam hal ini 'POST' 
        	data:$(this).serialize(), //mengirim data secara serialize -- seluruh data input dikirim untuk diproses 
        	dataType: 'json', //respon yang diminta dalam format JSON 
        	success:function(response){ 
          	if(response.status == 2) // return nilai dari hasil proses 
          	{  
          	  alert("Data berhasil diupdate!"); 
              loadData(); //reload list data 
          		$("#divPageEntry").load("unitkpr_form.php");   
              $("#divPageEntry").hide(); 
            } 
          else if(response.status == 1) { 
          	  alert("Data Baru berhasil disimpan!"); 
              loadData(); //reload list data 
         //   window.location="unitkpr_detail.php?id="+$("input#idslshdr").val(); 
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
 $("#btnclose").click(function(){  
		$("#divPageEntry").hide();  
      $("#divLOV").hide();  
  
		page3="unitkpr_display.php";  
		$("#divPageData").load(page3);  
		$("#divPageData").show();  
		return false;  
	});  
 }); 
 </script> 
<script type="text/javascript" src="js/jquery-1.9.1.js"></script> 
<link rel="stylesheet" href="css/jquery-ui.css" />
<script type="text/javascript" src="js/jquery-ui.js"></script>
<script type="text/javascript" language="javascript">
			jQuery(function(){
				jQuery('input[name=rcv_date]').datepicker({changeYear:true, changeMonth:true, yearRange:"1990:2025",dateFormat: "dd-mm-yy"});
			})			
</script>	 
<form method="post" name="unitkpr_form" action="" id="unitkpr_form">  
<p class="judul">Form Memasukkan / Edit Data unitkpr</p>  
<table> 
<tr><th colspan="2"><b><?php echo $judul; ?></b></th></tr> 
<?php if ($_GET['action'] == "update"){?> <!-- //jika update maka textfield ID Pelanggan ditampilkan --> 
<tr><td class="right">idunitkpr</td><td><input type="text" id="idunitkpr" name="idunitkpr" size="10" <? echo $readonly;?> value="<? echo $idunitkpr;?>" /></td> 
</tr> 
<?php } else {?> 
<tr><td class="right">idunitkpr</td><td><input type="text" id="idunitkpr" name="idunitkpr" size="10" value="<? echo $idunitkpr;?>" /></td> 
</tr> 
<?php }?> 
<tr> 
<td class="right">check_date</td> 
<td><input type="text" id="check_date" name="check_date" size="30" maxlength="45" value="<? echo $check_date;?>" /></td> 
</tr> 
<tr> 
<td class="right">unit_idunit</td> 
<td><input type="text" id="unit_idunit" name="unit_idunit" size="30" maxlength="45" value="<? echo $unit_idunit;?>" /></td> 
</tr> 
<tr> 
<td class="right">kprclmst_idkprclmst</td> 
<td><input type="text" id="kprclmst_idkprclmst" name="kprclmst_idkprclmst" size="30" maxlength="45" value="<? echo $kprclmst_idkprclmst;?>" /></td> 
</tr> 
<tr> 
<td ><input class="button" type="submit" value="<? echo $status;?>"></td> 
<td ><input class="button" type="button" id="btnclose" value="Tutup Form"></td>  
</tr> 
</table> 
<input type="hidden" name="action" value="<? echo $action;?>" /> 
</form> 
