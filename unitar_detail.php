<? require_once ('login.php'); 
$idunit=$_POST['idunit'];
$dsp = $_POST['dsp'] ? : 15;
?>  
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">  
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<title>technosoft Indonesia</title> 
<link rel="stylesheet" type="text/css" href="css/style-page.css" /> 
<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script> 
<script type="text/javascript" src="js/unitar_detail.js"></script> 

<script type="text/javascript" src="js/jquery-1.9.1.js"></script>
<link rel="stylesheet" href="css/jquery-ui.css" />
<script type="text/javascript" src="js/jquery-ui.js"></script>
<script type="text/javascript" language="javascript">
			jQuery(function(){
				jQuery('input[name=createdate]').datepicker({changeYear:true, changeMonth:true, yearRange:"1990:2025",dateFormat: "dd-mm-yy"});
				jQuery('input[name=duedate]').datepicker({changeYear:true, changeMonth:true, yearRange:"1990:2025",dateFormat: "dd-mm-yy"});
				
			})			
</script>		
		

</head> 
<body> 
<? include_once "header.php"; ?>
<div id="divSearch"> 
  <form id="formSearch" method="POST" action=""> 
  <table  class="header" ><tr><td class="judul">Data Detail unit &nbsp; 
  
 Show :<select id="dsp" name="dsp" onchange="this.form.submit()">
  <? createdspoption($dsp); ?>
  </select> 
    
 
<input class="button" type="button" id="btnaddar" value="Tambah Piutang">
<input class="button" type="button" id="btnmundur" value="User Mundur">
 <input  class="button" type="button" value="Kembali ke Daftar" id="btnlist">
  
  </td> </tr></table>
</div> 
	<?  
		$str="select * from unit where idunit = '$_GET[idunit]'"; 
		$res=mysql_query($str) or die("query gagal dijalankan"); 
		$data=mysql_fetch_assoc($res); 
		$idunit=$data['idunit']; 
		$kavling=$data['kavling']; 
		$tipe=$data['tipe']; 
		$luastanah=$data['luastanah']; 
		$owner=$data['owner']; 
		$address=$data['address']; 
		$phone=$data['phone']; 
		$sp3=$data['sp3']; 
		$realisasi=$data['realisasi']; 
		$stk=$data['stk']; 
		$bangun=$data['bangun']; 
		$jual=$data['jual']; 
		$latestimg=$data['latestimg']; 
		$latestimg2=$data['latestimg2']; 
		$nkontrakuser=$data['nkontrakuser']; 
		$nkontrakcont=$data['nkontrakcont']; 
		$startbangun=$data['startbangun']; 
		$endbangun=$data['endbangun']; 
		$kpr_idkpr=$data['kpr_idkpr']; 
		$tglduedate=$data['tglduedate']; 
		
		$sektor_idsektor=$data['sektor_idsektor']; 
		$contractor_idcontractor=$data['contractor_idcontractor']; 
		$action="update"; 
		$readonly="readonly=readonly"; 
		$status="Update"; 
		$judul="Update data unit"; 
		$sektor =sektorinfo($data['sektor_idsektor']);
  		$sektorname = $sektor['sektorname'];
?> 
 <div id="hdr">
 <p class="judul">Detail Piutang Customer</p>
<table class="grid">
<?php if ($_GET['action'] == "update"){?> <!-- //jika update maka textfield ID Pelanggan ditampilkan --> 
<tr><td class="right">idunit</td><td><input type="text" id="idunit" name="idunit" size="5" <? echo $readonly;?> value="<? echo $idunit;?>" /></td> 
</tr> 
<?php } else {?> 
<tr><td class="right">idunit</td><td><input type="text" id="idunit" name="idunit" size="5" value="<? echo $idunit;?>" /></td> 
</tr> 
<?php }?> 
<tr> 
<td class="right">sektor_idsektor</td> 
<td>
<input type="text" id="sektor_idsektor" name="sektor_idsektor" size="5" maxlength="35" value="<? echo $sektor_idsektor;?>" />
<input class="button" type="button" id="btnlovsektor" onClick="lovsektor()" value="..."/>
<input type="text" id="sektorname" name="sektorname" size="30" maxlength="35" value="<? echo $sektorname;?>" />

</td> 
</tr> 
<tr> 
<td class="right">kavling</td> 
<td><input type="text" id="kavling" name="kavling" size="30" maxlength="25" value="<? echo $kavling;?>" /></td> 
</tr> 
<tr> 
<td class="right">Luas Bangunan</td> 
<td><input type="text" id="tipe" name="tipe" size="10" maxlength="25" value="<? echo $tipe;?>" />
Luas Tanah : <input type="text" id="luastanah" name="luastanah" size="10" maxlength="25" value="<? echo $luastanah;?>" />
</td> 
</tr> 
<tr> 
<td class="right">Pemilik</td> 
<td><input type="text" id="owner" name="owner" size="30" maxlength="25" value="<? echo $owner;?>" /></td> 
</tr> 
<tr> 
<td class="right">Tanggal Jatuh Tempo</td> 
<td><input type="text" id="tglduedate" name="tglduedate" size="5" maxlength="5" value="<? echo $tglduedate;?>" /></td> 
</tr> 
<tr> 
</table>
<input type="hidden" name="action" value="<? echo $action;?>" /> 
</form> 

</div>  
<br>
<div id="column1-wrap" style="width:550px;">
  <div id="divPageEntry"></div>
   <div id="divPageData"></div> 
 </div> 
    <div id="divLOV" style="width:450px;" ></div>
<div id="clear"></div><br>

 
</body> 
</html> 

