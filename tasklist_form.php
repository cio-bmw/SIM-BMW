  <?  
  include_once("config.php"); 
   
	$action="add"; 
	$judul="Penambahan Data tasklist"; 
	$status="Simpan"; 
   $sql = "SELECT IFNULL(max(CAST(idtasklist AS UNSIGNED)),0)+1  FROM tasklist";  
   $result = mysql_query($sql);  
   $data  = mysql_fetch_array($result);  
   $idtasklist = $data[0];	 
	if(isset($_GET['action']) and $_GET['action']=="update" and !empty($_GET['id'])) 
	{ 
		$str="select * from tasklist where idtasklist = '$_GET[id]'"; 
		$res=mysql_query($str) or die("query gagal dijalankan"); 
		$data=mysql_fetch_assoc($res); 
		$idtasklist=$data['idtasklist']; 
		$project_idproject=$data['project_idproject']; 
		$emp_idemp=$data['emp_idemp']; 
		$taskname=$data['taskname']; 
		$keterangan=$data['keterangan']; 
		$startdate=$data['startdate']; 
		$enddate=$data['enddate']; 
		$finishdate=$data['finishdate']; 
		$files=$data['files']; 
		$taskstatus=$data['taskstatus']; 
		$action="update"; 
		$readonly="readonly=readonly"; 
		$status="Simpan"; 
		$judul="Update data tasklist"; 
	} 
?> 
<script type="text/javascript"> 
 
$(function(){ 
  $("input#tasklist").focus();  
  
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
	   
	  if (combo == "idtasklist"){ 
      dataString = 'idtasklist='+ cari;  
   } 
   else if (combo == "project_idproject"){ 
      dataString = 'project_idproject='+ cari; 
    } 
   else if (combo == "emp_idemp"){ 
      dataString = 'emp_idemp='+ cari; 
    } 
   else if (combo == "taskname"){ 
      dataString = 'taskname='+ cari; 
    } 
   else if (combo == "keterangan"){ 
      dataString = 'keterangan='+ cari; 
    } 
   else if (combo == "startdate"){ 
      dataString = 'startdate='+ cari; 
    } 
   else if (combo == "enddate"){ 
      dataString = 'enddate='+ cari; 
    } 
   else if (combo == "finishdate"){ 
      dataString = 'finishdate='+ cari; 
    } 
   else if (combo == "files"){ 
      dataString = 'files='+ cari; 
    } 
   else if (combo == "taskstatus"){ 
      dataString = 'taskstatus='+ cari; 
    } 
 
    $.ajax({ 
      url: "tasklist_display.php", 
      type: "GET", 
      data: dataString, 
  		success:function(data) 
  		{ 
  			$('#divPageData').html(data); 
  		} 
    }); 
  } 
 
  $("form#tasklist_form").submit(function(){ 
    if (confirm("Apakah benar akan menyimpan data tasklist ini?")){ 
    		$.ajax({ 
        	url: "tasklist_process.php", 
        	type:$(this).attr("method"), //metode yg digunakan sesuai pada form, dalam hal ini 'POST' 
        	data:$(this).serialize(), //mengirim data secara serialize -- seluruh data input dikirim untuk diproses 
        	dataType: 'json', //respon yang diminta dalam format JSON 
        	success:function(response){ 
          	if(response.status == 2) // return nilai dari hasil proses 
          	{  
          	  alert("Data berhasil diupdate!"); 
              loadData(); //reload list data 
          		$("#divPageEntry").load("tasklist_form.php");   
              $("#divPageEntry").hide(); 
            } 
          else if(response.status == 1) { 
          	  alert("Data Baru berhasil disimpan!"); 
              loadData(); //reload list data 
         //   window.location="tasklist_detail.php?id="+$("input#idslshdr").val(); 
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
  
		page3="tasklist_display.php";  
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
<form method="post" name="tasklist_form" action="" id="tasklist_form">  
<p class="judul">Form Memasukkan / Edit Data tasklist</p>  
<table> 
<tr><th colspan="2"><b><?php echo $judul; ?></b></th></tr> 
<?php if ($_GET['action'] == "update"){?> <!-- //jika update maka textfield ID Pelanggan ditampilkan --> 
<tr><td class="right">idtasklist</td><td><input type="text" id="idtasklist" name="idtasklist" size="10" <? echo $readonly;?> value="<? echo $idtasklist;?>" /></td> 
</tr> 
<?php } else {?> 
<tr><td class="right">idtasklist</td><td><input type="text" id="idtasklist" name="idtasklist" size="10" value="<? echo $idtasklist;?>" /></td> 
</tr> 
<?php }?> 
<tr> 
<td class="right">project_idproject</td> 
<td><input type="text" id="project_idproject" name="project_idproject" size="30" maxlength="25" value="<? echo $project_idproject;?>" /></td> 
</tr> 
<tr> 
<td class="right">emp_idemp</td> 
<td><input type="text" id="emp_idemp" name="emp_idemp" size="30" maxlength="25" value="<? echo $emp_idemp;?>" /></td> 
</tr> 
<tr> 
<td class="right">taskname</td> 
<td><input type="text" id="taskname" name="taskname" size="30" maxlength="25" value="<? echo $taskname;?>" /></td> 
</tr> 
<tr> 
<td class="right">keterangan</td> 
<td><input type="text" id="keterangan" name="keterangan" size="30" maxlength="25" value="<? echo $keterangan;?>" /></td> 
</tr> 
<tr> 
<td class="right">startdate</td> 
<td><input type="text" id="startdate" name="startdate" size="30" maxlength="25" value="<? echo $startdate;?>" /></td> 
</tr> 
<tr> 
<td class="right">enddate</td> 
<td><input type="text" id="enddate" name="enddate" size="30" maxlength="25" value="<? echo $enddate;?>" /></td> 
</tr> 
<tr> 
<td class="right">finishdate</td> 
<td><input type="text" id="finishdate" name="finishdate" size="30" maxlength="25" value="<? echo $finishdate;?>" /></td> 
</tr> 
<tr> 
<td class="right">files</td> 
<td><input type="text" id="files" name="files" size="30" maxlength="25" value="<? echo $files;?>" /></td> 
</tr> 
<tr> 
<td class="right">taskstatus</td> 
<td><input type="text" id="taskstatus" name="taskstatus" size="30" maxlength="25" value="<? echo $taskstatus;?>" /></td> 
</tr> 
<tr> 
<td ><input class="button" type="submit" value="<? echo $status;?>"></td> 
<td ><input class="button" type="button" id="btnclose" value="Tutup Form"></td>  
</tr> 
</table> 
<input type="hidden" name="action" value="<? echo $action;?>" /> 
</form> 
