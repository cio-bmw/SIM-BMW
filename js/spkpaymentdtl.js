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
		page1="spkpaymentdtl_form.php"; 
		$("#divPageEntry").load(page1); 
		$("#divPageEntry").show(); 
   
		page2="spkpaymentdtl_lov.php"; 
		$("#divLOV").load(page2); 
		$("#divLOV").show(); 
   
		page3="spkpaymentdtl_display.php"; 
		$("#divPageData").load(page3); 
		$("#divPageData").show(); 
		return false; 
	}); 
   
	$("#btnexit").click(function(){ 
		window.location='index.php'; 
	}); 
	 
	$("#btnhide").click(function(){ 
		loadData(); 
	}); 
	 
	//menangani jika user melakukan pilihan pada combo #pilihcari 
	$("select#pilihcari").change(function(){  
  	if ($(this).val() == "idspkpaymentdtl"){ 
  	  $("td#kolompilih").show(); 
      $("input#fieldcari").show(); 
      $("input#fieldcari").focus(); 
    } 
    else if ($(this).val() == "payvalue"){ 
      $("td#kolompilih").show(); 
      $("input#fieldcari").show(); 
      $("input#fieldcari").focus(); 
    } 
    else if ($(this).val() == "spkpaymenthdr_idspkpaymenthdr"){ 
      $("td#kolompilih").show(); 
      $("input#fieldcari").show(); 
      $("input#fieldcari").focus(); 
    } 
    else if ($(this).val() == "unitspk_idunitspk"){ 
      $("td#kolompilih").show(); 
      $("input#fieldcari").show(); 
      $("input#fieldcari").focus(); 
    } 
   else{ 
     $("td#kolompilih").show(); 
   } 
	}); 
	 
	//menampilkan list data spkpaymentdtl 
	loadData(); 
	 
  // fungsi untuk me-load tampilan list data spkpaymentdtl, data yang ditampilkan disesuaikan 
  // juga dengan input data pada bagian search 
  function loadData(){ 
	  var dataString; 
	  var vsektor = $("select#idsektor").val();
	  var vstartdate = $("input#startdate").val(); 
     var venddate = $("input#enddate").val(); 
     var vdsp = $("select#dsp").val();
		  
   dataString = 'sektor='+vsektor+'&startdate='+vstartdate+'&enddate='+venddate+'&dsp='+vdsp;
 
   $.ajax({ 
     url: "spkpaymentdtl_display.php", 
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
   
}); 
