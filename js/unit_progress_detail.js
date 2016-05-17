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
	
		
	$("#btndisplay").click(function(){ 
		page="unitclbangun_progressdisplay.php?idunit="+$("input#idunit").val()+"&spk="+$("select#idspkcat").val(); 
		$("#divPageData").load(page); 
		$("#divPageData").show(); 

		$("#divLOV").hide(); 
		$("#divPageEntry").hide(); 

		
		return false; 
	}); 
	
	$("#btnimport").click(function(){ 
		page="unitclbangun_importform.php?idunit="+$("input#idunit").val(); 
		$("#divPageData").load(page); 
		$("#divPageData").show(); 

			
		return false; 
	}); 
	
	$("#btnadd").click(function(){ 
	
		page="unitclbangun_display.php?idunit="+$("input#idunit").val(); 
		$("#divPageData").load(page); 
		$("#divPageData").show(); 

		page1="unitclbangun_form.php?idunit="+$("input#idunit").val(); 
		$("#divPageEntry").load(page1); 
		$("#divPageEntry").show(); 

   	page2="clbangun_lov.php?idunit="+$("input#idunit").val(); 
		$("#divLOV").load(page2); 
		$("#divLOV").show(); 

		
		return false; 
	}); 
	
	
	
   
	$("#btnexit").click(function(){ 
		window.location='index.php'; 
	}); 
	 
	$("#btnlist").click(function(){ 
		window.location='unit_progress_menu.php'; 
	}); 
	  
	
	loadData(); 
	 
  // fungsi untuk me-load tampilan list data unit, data yang ditampilkan disesuaikan 
  // juga dengan input data pada bagian search 
  function loadData(){ 
	  var dataString; 
	  var vunit = $("input#idunit").val(); 
	  var vspk = $("select#idspkcat").val(); 
     dataString = 'idunit='+ vunit+'&spk='+vspk; 
   
 
   $.ajax({ 
     url: "unitclbangun_progressdisplay.php", 
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
     loadData(); 
     return false; 
    
}); 
}); 
