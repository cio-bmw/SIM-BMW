  <?  
  include_once("config.php"); 
   
	$action="add"; 
	$judul="Penambahan Data kprcheckdtl"; 
	$status="Simpan"; 
   $sql = "SELECT IFNULL(max(CAST(idkprcheckdtl AS UNSIGNED)),0)+1  FROM kprcheckdtl";  
   $result = mysql_query($sql);  
   $data  = mysql_fetch_array($result);  
   $idkprcheckdtl = $data[0];	 
	if(isset($_GET['action']) and $_GET['action']=="update" and !empty($_GET['id'])) 
	{ 
		$str="select * from kprcheckdtl where idkprcheckdtl = '$_GET[id]'"; 
		$res=mysql_query($str) or die("query gagal dijalankan"); 
		$data=mysql_fetch_assoc($res); 
		$idkprcheckdtl=$data['idkprcheckdtl']; 
		$startdate=$data['startdate']; 
		$enddate=$data['enddate']; 
		$kprclmst_idkprclmst=$data['kprclmst_idkprclmst']; 
		$kprcheckhdr_idkprcheckhdr=$data['kprcheckhdr_idkprcheckhdr']; 
		$action="update"; 
		$readonly="readonly=readonly"; 
		$status="Simpan"; 
		$judul="Update data kprcheckdtl"; 
	} 
?> 
<script type="text/javascript"> 
 
$(function(){ 
  $("input#kprcheckdtl").focus();  
  
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
	   
	  if (combo == "idkprcheckdtl"){ 
      dataString = 'idkprcheckdtl='+ cari;  
   } 
   else if (combo == "startdate"){ 
      dataString = 'startdate='+ cari; 
    } 
   else if (combo == "enddate"){ 
      dataString = 'enddate='+ cari; 
    } 
   else if (combo == "kprclmst_idkprclmst"){ 
      dataString = 'kprclmst_idkprclmst='+ cari; 
    } 
   else if (combo == "kprcheckhdr_idkprcheckhdr"){ 
      dataString = 'kprcheckhdr_idkprcheckhdr='+ cari; 
    } 
 
    $.ajax({ 
      url: "kprcheckdtl_display.php", 
      type: "GET", 
      data: dataString, 
  		success:function(data) 
  		{ 
  			$('#divPageData').html(data); 
  		} 
    }); 
  } 
 
  $("form#kprcheckdtl_form").submit(function(){ 
    if (confirm("Apakah benar akan menyimpan data kprcheckdtl ini?")){ 
    		$.ajax({ 
        	url: "kprcheckdtl_process.php", 
        	type:$(this).attr("method"), //metode yg digunakan sesuai pada form, dalam hal ini 'POST' 
        	data:$(this).serialize(), //mengirim data secara serialize -- seluruh data input dikirim untuk diproses 
        	dataType: 'json', //respon yang diminta dalam format JSON 
        	success:function(response){ 
          	if(response.status == 2) // return nilai dari hasil proses 
          	{  
          	  alert("Data berhasil diupdate!"); 
              loadData(); //reload list data 
          		$("#divPageEntry").load("kprcheckdtl_form.php");   
              $("#divPageEntry").hide(); 
            } 
          else if(response.status == 1) { 
          	  alert("Data Baru berhasil disimpan!"); 
              loadData(); //reload list data 
         //   window.location="kprcheckdtl_detail.php?id="+$("input#idslshdr").val(); 
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
  
		page3="kprcheckdtl_display.php";  
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
				jQuery('input[name=rcv_date]').datepicker({changeYear:true, changeMonth:true, yearRange:"1990:2025",dateFormat: "dd-mm-yyyy"});
			})			
</script>	 
<form method="post" name="kprcheckdtl_form" action="" id="kprcheckdtl_form">  
<p class="judul">Form Memasukkan / Edit Data kprcheckdtl</p>  
<table> 
<tr><th colspan="2"><b><?php echo $judul; ?></b></th></tr> 
<?php if ($_GET['action'] == "update"){?> <!-- //jika update maka textfield ID Pelanggan ditampilkan --> 
<tr><td class="right">idkprcheckdtl</td><td><input type="text" id="idkprcheckdtl" name="idkprcheckdtl" size="10" <? echo $readonly;?> value="<? echo $idkprcheckdtl;?>" /></td> 
</tr> 
<?php } else {?> 
<tr><td class="right">idkprcheckdtl</td><td><input type="text" id="idkprcheckdtl" name="idkprcheckdtl" size="10" value="<? echo $idkprcheckdtl;?>" /></td> 
</tr> 
<?php }?> 
<tr> 
<td class="right">startdate</td> 
<td><input type="text" id="startdate" name="startdate" size="30" maxlength="25" value="<? echo $startdate;?>" /></td> 
</tr> 
<tr> 
<td class="right">enddate</td> 
<td><input type="text" id="enddate" name="enddate" size="30" maxlength="25" value="<? echo $enddate;?>" /></td> 
</tr> 
<tr> 
<td class="right">kprclmst_idkprclmst</td> 
<td><input type="text" id="kprclmst_idkprclmst" name="kprclmst_idkprclmst" size="30" maxlength="25" value="<? echo $kprclmst_idkprclmst;?>" /></td> 
</tr> 
<tr> 
<td class="right">kprcheckhdr_idkprcheckhdr</td> 
<td><input type="text" id="kprcheckhdr_idkprcheckhdr" name="kprcheckhdr_idkprcheckhdr" size="30" maxlength="25" value="<? echo $kprcheckhdr_idkprcheckhdr;?>" /></td> 
</tr> 
<tr> 
<td ><input class="button" type="submit" value="<? echo $status;?>"></td> 
<td ><input class="button" type="button" id="btnclose" value="Tutup Form"></td>  
</tr> 
</table> 
<input type="hidden" name="action" value="<? echo $action;?>" /> 
</form> 
