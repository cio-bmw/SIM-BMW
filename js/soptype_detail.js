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
		page1="soptype_form.php?id="+$("input#idsoptype").val(); 
		$("#divPageEntry").load(page1); 
		$("#divPageEntry").show(); 
   
		page2="soptype_lov.php"; 
		$("#divLOV").load(page2); 
		$("#divLOV").show(); 
   
		page3="soptype_display.php?id="+$("input#idsoptype").val(); 
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
		window.location='soptype.php'; 
	}); 
	 
		$("#btncetak").click(function(){ 
		window.open("soptype_pdf.php?id="+$("input#idsoptype").val(), "_blank");
		}); 
$("#btnconfirm").click(function(){  
	if (confirm("Apakah benar akan Konfirmasi Data Transaksi Ini?")){  
	    window.open("soptype_confirm.php?id="+$("input#idslshdr").val(),"_blank"); }  
	    else { 
    alert('Anda membatalkan Confirmasi Data');	 
   } 
  	window.location='soptype.php';
  
	});  
	$("#btnreopen").click(function(){  
	if (confirm("Apakah benar akan membatalkan Konfirmasi Penerimaan Barang ini?")){  
    window.open('slsdtlsektor_reopen.php?id='+$("input#idslshdr").val(),'_blank');	 } 
    else { 
    alert('Anda Tidak Jadi membatalkan Confirmasi Data');	 
    	} 
	window.location='soptype.php'; 	 
	});  
	//menangani jika user melakukan pilihan pada combo #pilihcari 
	$("select#pilihcari").change(function(){  
  	if ($(this).val() == "idsoptype"){ 
  	  $("td#kolompilih").show(); 
      $("input#fieldcari").show(); 
      $("input#fieldcari").focus(); 
    } 
    else if ($(this).val() == "soptype"){ 
      $("td#kolompilih").show(); 
      $("input#fieldcari").show(); 
      $("input#fieldcari").focus(); 
    } 
   else{ 
     $("td#kolompilih").show(); 
   } 
	}); 
	 
	//menampilkan list data soptype 
	loadData(); 
	 
  // fungsi untuk me-load tampilan list data soptype, data yang ditampilkan disesuaikan 
  // juga dengan input data pada bagian search 
  function loadData(){ 
	  var dataString; 
	  var cari = $("input#fieldcari").val(); 
	  var combo = $("select#pilihcari").val(); 
	   
	  if (combo == "idsoptype"){ 
      dataString = 'idsoptype='+ cari;  
   } 
   else if (combo == "soptype"){ 
      dataString = 'soptype='+ cari; 
    } 
 
   $.ajax({ 
     url: "soptype_display.php", 
     type: "GET", 
     data: dataString, 
 		success:function(data) 
		{ 
			$('#divPageData').html(data); 
 		} 
   }); 
 } 
  
 // melakukan pemrosesan data untuk bagian search (pencarian data) 
 $("form#soptype_detail").submit(function(){  
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
