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
		page="unit_materialbudget_display.php?idunit="+$("input#idunit").val(); 
		$("#divPageData").load(page); 
		$("#divPageData").show(); 

		$("#divLOV").hide(); 
		$("#divPageEntry").hide(); 

		
		return false; 
	}); 
	
	$("#btnimport").click(function(){ 
		page="unit_budget_importform.php?idunit="+$("input#idunit").val(); 
		$("#divPageData").load(page); 
		$("#divPageData").show(); 
		
		
		return false; 
	}); 
	
		$("#btnreimport").click(function(){ 
		if (confirm("Apakah benar akan menghapus RAB ini?")){ 
       window.open('unit_budget_delete.php?idunit='+$("input#idunit").val(),'_blank');
		
		page="unit_budget_importform.php?idunit="+$("input#idunit").val(); 
		$("#divPageData").load(page); 
		$("#divPageData").show(); 
	
    	}

			
		return false; 
	}); 
	
	$("#btnadd").click(function(){ 
	
		page="unit_materialbudget_displaymini.php?idunit="+$("input#idunit").val(); 
		$("#divPageData").load(page); 
		$("#divPageData").show(); 

		page1="unit_materialbudget_form.php?idunit="+$("input#idunit").val(); 
		$("#divPageEntry").load(page1); 
		$("#divPageEntry").show(); 

   	page2="unit_materialbudget_dspproduct.php?idunit="+$("input#idunit").val(); 
		$("#divLOV").load(page2); 
		$("#divLOV").show(); 

		
		return false; 
	}); 
	
	
	
   
	$("#btnexit").click(function(){ 
		window.location='index.php'; 
	}); 
	 
	$("#btnlist").click(function(){ 
		window.location='unit_materialbudget_menu.php'; 
	}); 
	  
	  
	  $("#btncetakteknik").click(function(){ 
     var cari = $("input#idunit").val();
     window.location='unit_materialbudget_pdf.php?id='+cari;

	});
	  $("#btncetakadmin").click(function(){ 
     var cari = $("input#idunit").val();
     window.location='unit_materialbudget_pdfadmin.php?id='+cari;

	});
	  $("#btncetakprogress").click(function(){ 
     var cari = $("input#idunit").val();
     window.location='unit_materialbudget_pdfprogress.php?id='+cari;

	});
	loadData(); 
	 
  // fungsi untuk me-load tampilan list data unit, data yang ditampilkan disesuaikan 
  // juga dengan input data pada bagian search 
  function loadData(){ 
	  var dataString; 
	  var cari = $("input#idunit").val(); 
     dataString = 'idunit='+ cari; 
   
 
   $.ajax({ 
     url: "unit_materialbudget_display.php", 
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
   var cari = $("select#carisektor").val(); 
  
     loadData(); 
     return false; 
    
}); 
}); 
