	<?  
require_once ('login.php'); 
		$str="select * from activity where idactivity = '$_GET[id]'"; 
		$res=mysql_query($str) or die("query gagal dijalankan"); 
		$data=mysql_fetch_assoc($res); 
		$idactivity=$data['idactivity']; 
		$activity=$data['activity']; 
		$soptype_idsoptype=$data['soptype_idsoptype']; 
		$unitact_idunitact=$data['unitact_idunitact']; 
		$action="update"; 
		$readonly="readonly=readonly"; 
		$status="Update"; 
		$judul="Update data activity"; 
?>  
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">  
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<title>technosoft Indonesia</title> 
<link rel="stylesheet" type="text/css" href="css/style-page.css" /> 
<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script> 
<script type="text/javascript" src="js/activity_detail.js"></script> 
</head> 
<body> 
<? include_once "header.php"; ?>  
<div id="divSearch"> 
 <form id="activity_detail" method="POST" action="" name="activity_detail"> 
  <table  class="header" ><tr><td class="judul"> 
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
<p class="judul">Data Detail activity</p>
 <table> 
<tr><td class="right">idactivity</td><td><input type="text" id="idactivity" name="idactivity" size="10" <? echo readonly;?> value="<? echo $idactivity;?>" /></td> 
</tr> 
<tr> 
<td class="right">activity</td> 
<td><input type="text" id="activity" name="activity" size="30" maxlength="25" value="<? echo $activity;?>" readonly /></td> 
</tr> 
<tr> 
<td class="right">soptype_idsoptype</td> 
<td><input type="text" id="soptype_idsoptype" name="soptype_idsoptype" size="30" maxlength="25" value="<? echo $soptype_idsoptype;?>" readonly /></td> 
</tr> 
<tr> 
<td class="right">unitact_idunitact</td> 
<td><input type="text" id="unitact_idunitact" name="unitact_idunitact" size="30" maxlength="25" value="<? echo $unitact_idunitact;?>" readonly /></td> 
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
