  <?  
  include_once("config.php"); 
   $comp = $_GET['id'];
//	$action="update"; 
	$judul="Penambahan Data"; 
	$status="Simpan"; 
   $sql = "SELECT IFNULL(max(CAST(idcompany AS UNSIGNED)),0)+1  FROM company";  
   $result = mysql_query($sql);  
   $data  = mysql_fetch_array($result);  
   $idcompany = $data[0];	 	
	
	if(isset($_GET['action']) and $_GET['action']=="update" and !empty($_GET['id'])) 
	{ 
		$str="select * from company where idcompany = '$_GET[id]'"; 
		$res=mysql_query($str) or die("query gagal dijalankan"); 
		$data=mysql_fetch_assoc($res); 
		$idcompany=$data['idcompany']; 
		$company=$data['company']; 
		$action="update"; 
		$readonly="readonly=readonly"; 
		$status="Simpan"; 
		$judul="Edit Data"; 
	} 
?> 
<script type="text/javascript"> 
 
$(function(){ 
  $("input#company").focus();  
  
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
	  var comp = $("select#idcompany").val(); 
	   
      dataString = 'id='+comp+'&action=update'; 
 
    $.ajax({ 
      url: "companysetting_form.php", 
      type: "GET", 
      data: dataString, 
  		success:function(data) 
  		{ 
  			$('#divPageData').html(data); 
  		} 
    }); 
  } 
 
  $("form#company_form").submit(function(){ 
    if (confirm("Apakah benar akan menyimpan data company ini?")){ 
    		$.ajax({ 
        	url: "companysetting_process.php", 
        	type:$(this).attr("method"), //metode yg digunakan sesuai pada form, dalam hal ini 'POST' 
        	data:$(this).serialize(), //mengirim data secara serialize -- seluruh data input dikirim untuk diproses 
        	dataType: 'json', //respon yang diminta dalam format JSON 
        	success:function(response){ 
          	if(response.status == 2) // return nilai dari hasil proses 
          	{  
          	  alert("Data berhasil diupdate!"); 
              loadData(); //reload list data 
          		$("#divPageEntry").load("company_form.php");   
              $("#divPageEntry").hide(); 
            } 
          else if(response.status == 1) { 
          	  alert("Data Baru berhasil disimpan!"); 
              loadData(); //reload list data 
         //   window.location="company_detail.php?id="+$("input#idslshdr").val(); 
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
  
		page3="company_display.php";  
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
<form method="post" name="company_form" action="" id="company_form">  
<p class="judul">Form Memasukkan / Edit Data company</p>  
<table> 
<tr><th colspan="2"><b><?php echo $judul; ?></b></th></tr> 
<?php if ($_GET['action'] == "update"){?> <!-- //jika update maka textfield ID Pelanggan ditampilkan --> 
<tr><td class="right">Id</td><td><input type="text" id="idcompany" name="idcompany" size="10" <? echo $readonly;?> value="<? echo $idcompany;?>" /></td> 
</tr> 
<?php } else {?> 
<tr><td class="right">Id</td><td><input type="text" id="idcompany" name="idcompany" size="10" value="<? echo $idcompany;?>" /></td> 
</tr> 
<?php }?> 
<tr> 
<td class="right">Unit Usaha</td> 
<td><input type="text" id="company" name="company" size="30" maxlength="45" value="<? echo $company;?>" readonly /></td> 
</tr> 
<tr> 
<td class="right">Account Saldo Kas</td> 
<td>
<select id="kas_idacc" name="kas_idacc" >
<? createacccompanyoption($kas_idacc,$comp); ?>
</select>
</td> 
</tr> 


<tr> 
<td ><input class="button" type="submit" value="<? echo $status;?>"></td> 
<td ><input class="button" type="button" id="btnclose" value="Tutup Form"></td>  
</tr> 
</table> 
<input type="hidden" name="action" value="<? echo $action;?>" /> 
</form> 
