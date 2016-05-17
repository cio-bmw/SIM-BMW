$(document).ready(function(){ 
	 
	//menangkap error dan men-set parameter global (timeout, dll) 
	$.ajaxSetup({ 
	  timeout: 10000, 
	  cache: false, 
		error:function(x,e){ 
			if(x.status==0){ 
			alert('Anda sedang offline! Silahkan cek koneksi anda!'); 
			}else if(x.status==404){ 
			alert('Permintaan URL tidak ditemukan!'); 
			}else if(x.status==500){ 
			alert('Internal Server Error!'); 
			}else if(e=='parsererror'){ 
			alert('Error.Parsing JSON Request failed!'); 
			}else if(e=='timeout'){ 
			alert('Request Time out!'); 
			}else { 
			alert('Error tidak diketahui: '+x.responseText); 
			} 
		} 
	}); 
	 
	// menampilkan image untuk menandakan proses Ajax sedang berlangsung atau telah selesai  
	$('#divLoading').ajaxStart(function(){ 
		$(this).fadeIn(); 
		$(this).html("<table><tr><td><img src='images/ajax-loader.gif' /></td></tr></table>"); 
	}).ajaxStop(function(){ 
		$(this).fadeOut(); 
	}); 
	 
	$("#btnhide").hide(); 
   
  // ketika tombol tambah di-klik, maka formpelanggan akan ditampilkan pada bagian #divFormContent 
  $("#btntambah").click(function(){ 
		page1="tasklist_form.php?id="+$("input#idtasklist").val(); 
		$("#divPageEntry").load(page1); 
		$("#divPageEntry").show(); 
   
		page2="tasklist_lov.php"; 
		$("#divLOV").load(page2); 
		$("#divLOV").show(); 
   
		page3="tasklist_display.php?id="+$("input#idtasklist").val(); 
		$("#divPageData").load(page3); 
		$("#divPageData").show(); 
		return false; 
	}); 
   
	$("#btntampil").click(function(){ 
		$("#divLOV").hide(); 
		$("#divPageEntry").hide(); 
   }); 
   
	$("#btnexit").click(function(){ 
		window.location='index.php'; 
	}); 
	 
	$("#btnlist").click(function(){ 
		window.location='tasklist.php'; 
	}); 
	 
$("#btnconfirm").click(function(){  
	if (confirm("Apakah benar akan Konfirmasi Data Transaksi Ini?")){  
	    window.open("tasklist_confirm.php?id="+$("input#idslshdr").val(),"_blank"); }  
	    else { 
    alert('Anda membatalkan Confirmasi Data');	 
   } 
  	window.location='tasklist.php';
  
	});  
	$("#btnreopen").click(function(){  
	if (confirm("Apakah benar akan membatalkan Konfirmasi Penerimaan Barang ini?")){  
    window.open('slsdtlsektor_reopen.php?id='+$("input#idslshdr").val(),'_blank');	 } 
    else { 
    alert('Anda Tidak Jadi membatalkan Confirmasi Data');	 
    	} 
	window.location='tasklist.php'; 	 
	});  
	//menangani jika user melakukan pilihan pada combo #pilihcari 
	$("select#pilihcari").change(function(){  
  	if ($(this).val() == "idtasklist"){ 
  	  $("td#kolompilih").show(); 
      $("input#fieldcari").show(); 
      $("input#fieldcari").focus(); 
    } 
    else if ($(this).val() == "project_idproject"){ 
      $("td#kolompilih").show(); 
      $("input#fieldcari").show(); 
      $("input#fieldcari").focus(); 
    } 
    else if ($(this).val() == "emp_idemp"){ 
      $("td#kolompilih").show(); 
      $("input#fieldcari").show(); 
      $("input#fieldcari").focus(); 
    } 
    else if ($(this).val() == "taskname"){ 
      $("td#kolompilih").show(); 
      $("input#fieldcari").show(); 
      $("input#fieldcari").focus(); 
    } 
    else if ($(this).val() == "keterangan"){ 
      $("td#kolompilih").show(); 
      $("input#fieldcari").show(); 
      $("input#fieldcari").focus(); 
    } 
    else if ($(this).val() == "startdate"){ 
      $("td#kolompilih").show(); 
      $("input#fieldcari").show(); 
      $("input#fieldcari").focus(); 
    } 
    else if ($(this).val() == "enddate"){ 
      $("td#kolompilih").show(); 
      $("input#fieldcari").show(); 
      $("input#fieldcari").focus(); 
    } 
    else if ($(this).val() == "finishdate"){ 
      $("td#kolompilih").show(); 
      $("input#fieldcari").show(); 
      $("input#fieldcari").focus(); 
    } 
    else if ($(this).val() == "files"){ 
      $("td#kolompilih").show(); 
      $("input#fieldcari").show(); 
      $("input#fieldcari").focus(); 
    } 
    else if ($(this).val() == "taskstatus"){ 
      $("td#kolompilih").show(); 
      $("input#fieldcari").show(); 
      $("input#fieldcari").focus(); 
    } 
   else{ 
     $("td#kolompilih").show(); 
   } 
	}); 
	 
	//menampilkan list data tasklist 
	loadData(); 
	 
  // fungsi untuk me-load tampilan list data tasklist, data yang ditampilkan disesuaikan 
  // juga dengan input data pada bagian search 
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
  
 // melakukan pemrosesan data untuk bagian search (pencarian data) 
 $("form#tasklist_detail").submit(function(){  
   var cari = $("input#fieldcari").val(); 
   var combo = $("select#pilihcari").val(); 
   if (cari.replace(/\s/g,"") != ""){ // mengecek field text kosong atau tidak) 
       loadData(); 
   } 
   else if ((cari.replace(/\s/g,"") == "") && (combo != "semua") ){ 
     alert("Maaf, field harus diisi!"); 
     $("input#fieldcari").focus(); 
   } 
   else{ 
     loadData(); 
   } 
   return false; 
  }); 
   
}); 
