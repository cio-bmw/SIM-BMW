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
		page1="accsetting_form.php?id="+$("input#idaccsetting").val(); 
		$("#divPageEntry").load(page1); 
		$("#divPageEntry").show(); 
   
		page2="accsetting_lov.php"; 
		$("#divLOV").load(page2); 
		$("#divLOV").show(); 
   
		page3="accsetting_display.php?id="+$("input#idaccsetting").val(); 
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
		window.location='accsetting.php'; 
	}); 
	 
$("#btnconfirm").click(function(){  
	if (confirm("Apakah benar akan Konfirmasi Data Transaksi Ini?")){  
	    window.open("accsetting_confirm.php?id="+$("input#idslshdr").val(),"_blank"); }  
	    else { 
    alert('Anda membatalkan Confirmasi Data');	 
   } 
  	window.location='accsetting.php';
  
	});  
	$("#btnreopen").click(function(){  
	if (confirm("Apakah benar akan membatalkan Konfirmasi Penerimaan Barang ini?")){  
    window.open('slsdtlsektor_reopen.php?id='+$("input#idslshdr").val(),'_blank');	 } 
    else { 
    alert('Anda Tidak Jadi membatalkan Confirmasi Data');	 
    	} 
	window.location='accsetting.php'; 	 
	});  
	//menangani jika user melakukan pilihan pada combo #pilihcari 
	$("select#pilihcari").change(function(){  
  	if ($(this).val() == "idaccsetting"){ 
  	  $("td#kolompilih").show(); 
      $("input#fieldcari").show(); 
      $("input#fieldcari").focus(); 
    } 
    else if ($(this).val() == "app"){ 
      $("td#kolompilih").show(); 
      $("input#fieldcari").show(); 
      $("input#fieldcari").focus(); 
    } 
    else if ($(this).val() == "dacc_idacc"){ 
      $("td#kolompilih").show(); 
      $("input#fieldcari").show(); 
      $("input#fieldcari").focus(); 
    } 
    else if ($(this).val() == "kacc_idacc"){ 
      $("td#kolompilih").show(); 
      $("input#fieldcari").show(); 
      $("input#fieldcari").focus(); 
    } 
   else{ 
     $("td#kolompilih").show(); 
   } 
	}); 
	 
	//menampilkan list data accsetting 
	loadData(); 
	 
  // fungsi untuk me-load tampilan list data accsetting, data yang ditampilkan disesuaikan 
  // juga dengan input data pada bagian search 
  function loadData(){ 
	  var dataString; 
	  var cari = $("input#fieldcari").val(); 
	  var combo = $("select#pilihcari").val(); 
	   
	  if (combo == "idaccsetting"){ 
      dataString = 'idaccsetting='+ cari;  
   } 
   else if (combo == "app"){ 
      dataString = 'app='+ cari; 
    } 
   else if (combo == "dacc_idacc"){ 
      dataString = 'dacc_idacc='+ cari; 
    } 
   else if (combo == "kacc_idacc"){ 
      dataString = 'kacc_idacc='+ cari; 
    } 
 
   $.ajax({ 
     url: "accsetting_display.php", 
     type: "GET", 
     data: dataString, 
 		success:function(data) 
		{ 
			$('#divPageData').html(data); 
 		} 
   }); 
 } 
  
 // melakukan pemrosesan data untuk bagian search (pencarian data) 
 $("form#accsetting_detail").submit(function(){  
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
