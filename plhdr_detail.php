	<?  
require_once ('login.php'); 
		$str="select * from plhdr where idplhdr = '$_GET[id]'"; 
		$res=mysql_query($str) or die("query gagal dijalankan"); 
		$data=mysql_fetch_assoc($res); 
		$idplhdr=$data['idplhdr']; 
		$plhdrname=$data['plhdrname']; 
		$plhdrseq=$data['plhdrseq']; 
		$pl_idpl=$data['pl_idpl']; 
		$plhdrsdk=$data['plhdrsdk']; 
		$action="update"; 
		$readonly="readonly=readonly"; 
		$status="Update"; 
		$judul="Update data plhdr"; 
?>  
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">  
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<title>technosoft Indonesia</title> 
<link rel="stylesheet" type="text/css" href="css/style-page.css" /> 
<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script> 
<script type="text/javascript" src="js/plhdr_detail.js"></script> 
</head> 
<body> 
<table class="white">
<tr><td class="white"><img src="images/logo.png"></td></tr>
</table>
<div id="divSearch"> 
  <form id="formSearch"> 
  <table  class="header" ><tr><td class="judul">Data Detail plhdr &nbsp; 
 <input  class="button" type="button" value="Tampilkan" id="btntampil">
 <input  class="button" type="button" value="Tambah Detail" id="btntambah">
 <? if($sls_status=='confirm') { ?>
 <input type="button" class="button" id="btnreopen" name="btnreopen" value="Batalkan Konfirmasi"> 
<? }  else { ?> 
 <input class="button" type="button"  name="btnconfirm" value="Konfirmasi" id="btnconfirm" />

  <? } ?>
 <input  class="button" type="button" value="Cetak" id="btncetak">
 <input  class="button" type="button" value="Kembali ke Daftar" id="btnlist">
   <input  class="button" type="button" value="Kembali Ke Menu" id="btnexit">
  </td> </tr></table>
  </form> 
</div> 
 <table> 
<tr><td class="right">idplhdr</td><td><input type="text" id="idplhdr" name="idplhdr" size="10" <? echo readonly;?> value="<? echo $idplhdr;?>" /></td> 
</tr> 
<tr> 
<td class="right">plhdrname</td> 
<td><input type="text" id="plhdrname" name="plhdrname" size="30" maxlength="25" value="<? echo $plhdrname;?>" readonly /></td> 
</tr> 
<tr> 
<td class="right">plhdrseq</td> 
<td><input type="text" id="plhdrseq" name="plhdrseq" size="30" maxlength="25" value="<? echo $plhdrseq;?>" readonly /></td> 
</tr> 
<tr> 
<td class="right">pl_idpl</td> 
<td><input type="text" id="pl_idpl" name="pl_idpl" size="30" maxlength="25" value="<? echo $pl_idpl;?>" readonly /></td> 
</tr> 
<tr> 
<td class="right">plhdrsdk</td> 
<td><input type="text" id="plhdrsdk" name="plhdrsdk" size="30" maxlength="25" value="<? echo $plhdrsdk;?>" readonly /></td> 
</tr> 
</table> 
</div>  
<div id="column1-wrap">
<div id="divPageEntry"></div>
<div id="divPageData"></div> 
</div>
<div id="divLOV"></div> 
<div id="clear"></div> 
<div id="divLoading"></div> 
</body> 
</html>  
