<? require_once ('login.php'); ?>  
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">  
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<title>technosoft Indonesia</title> 
<link rel="stylesheet" type="text/css" href="css/style-page.css" /> 
<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script> 
<script type="text/javascript" src="js/cashouthdr.js"></script> 
</head> 
<body> 
<? include_once "header.php"; ?>
<div id="divSearch"> 
  <form id="formSearch"> 
  <table  class="header" ><tr> 
  <td>cashouthdr <select id="pilihcari">  
      <option value="idcashouthdr">No Dok</option> 
      <option value="txndate">Tanggal</option> 
      <option value="txndesc">Keterangan</option> 
      <option value="costcenter_idcostcenter">Unit Kerja</option> 
      <option value="semua">Semua</option> 
  </select>
  <input type="text" name="fieldcari" id="fieldcari" value="%" /> 
  <input class="button" type="submit" value="Tampilkan" />
 <input  class="button" type="button" value="Tambah" id="btntambah">
  
  </td> </tr></table>
  </form><br /> 
</div> 
<div id="column1-wrap">
    <div id="divPageData"></div> 
 </div> 
    <div id="divLOV">LOV</div>

<div id="clear"></div>
 <div id="divLoading"></div> 
 
</body> 
</html> 
