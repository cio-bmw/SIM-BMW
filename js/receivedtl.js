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
	})
	.ajaxStop(function(){ 
		$(this).fadeOut(); 
	}); 
	
	
   
  // ketika tombol tambah di-klik, maka formpelanggan akan ditampilkan pada bagian #divFormContent 
  $("#btnrcvdtl").click(function(){ 
      var cari = $("input#idreceivehdr").val(); 
  		page="receivedtl_display.php?id="+cari;
		$("#divPageData").load(page); 
		$("#divPageData").show(); 
	
		$("#divPageEntry").hide(); 
		$("#divLOV").hide(); 
		
		return false; 
	}); 
   
	$("#btnexit").click(function(){ 
		window.location='index.php'; 
	}); 
	$("#btnlist").click(function(){ 
		window.location='receivehdr.php'; 
	}); 
	
 $("#btnaddproduct").click(function(){ 
  var cari = $("input#idreceivehdr").val(); 
   var check = $("input#rcv_status").val();
    if (check == "open") {  
		page="receivedtl_form.php?id="+cari; 
		$("#divPageEntry").load(page); 
		$("#divPageEntry").show(); 
		//$("#btnhide").show(); 
		page1="receivedtl_dspproduct.php?id="+cari; 
		$("#divLOV").load(page1); 
		$("#divLOV").show(); 
		//$("#btnhide").show(); 
		page2="receivedtl_displaymini.php?id="+cari;
		$("#divPageData").load(page2); 
		$("#divPageData").show(); 
		
		return false; 
		  }	else {
    alert('Data Sudah confirm, Tidak bisa di rubah lagi');	
	}	
	}); 
	$("#btncetak").click(function(){ 
	window.open('receivedtl_pdf.php?id='+$("input#idreceivehdr").val(),'_blank');
	}); 
      	
   
	$("#btnconfirm").click(function(){ 

	if (confirm("Apakah benar akan menyimpan Konfirmasi Penerimaan Barang ini?")){ 
    window.open('receivehdr_confirm.php?id='+$("input#idreceivehdr").val(),'_blank');	 }
    else {
    alert('Anda membatalkan Confirmasi Data');	
    	}
	window.location='receivehdr.php'; 	
	}); 

	$("#btnreopen").click(function(){ 

	if (confirm("Apakah benar akan membatalkan Konfirmasi Penerimaan Barang ini?")){ 
    window.open('receivehdr_reopen.php?id='+$("input#idreceivehdr").val(),'_blank');	 }
    else {
    alert('Anda Tidak Jadi membatalkan Confirmasi Data');	
    	}
	window.location='receivehdr.php'; 	
	}); 

	 
	loadData(); 
	 
  // fungsi untuk me-load tampilan list data receivedtl, data yang ditampilkan disesuaikan 
  // juga dengan input data pada bagian search 
  function loadData(){ 
  //alert('test load');  
  
	  var dataString; 
	  var cari = $("input#idreceivehdr").val(); 
	 	   
     dataString = 'id='+ cari; 
    
   $.ajax({ 
   
     url: "receivedtl_display.php", 
     type: "GET", 
     data: dataString, 
   		success:function(data) 
		{ 
			$('#divPageData').html(data); 
 		} 
   }); 
 } 
 

 // melakukan pemrosesan data untuk bagian search (pencarian data) 
 $("form#formSearch").submit(function(){  
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

  
 function getURLParameter(name) {
  return decodeURIComponent((new RegExp('[?|&]' + name + '=' + '([^&;]+?)(&|#|;|$)').exec(location.search)||[,""])[1].replace(/\+/g, '%20'))||null
} 
   
}); 
