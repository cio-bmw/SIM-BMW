<? require_once ('login.php'); ?>  
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">  
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<title>technosoft Indonesia</title> 
<link rel="stylesheet" type="text/css" href="css/style-page.css" /> 
<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script> 
<script type="text/javascript" src="js/slsdtl.js"></script> 
</head> 
<body> 
<table class="white">
<tr><td class="white"><img src="images/logo.png"></td></tr>
<tr><td class="judul">Data slsdtl</td></tr>
</table>
<div id="divSearch"> 
  <form id="formSearch"> 
  <table><tr> 
  <td>Cari Berdasarkan</td><td><select id="pilihcari">  
      <option value="idslsdtl">idslsdtl</option> 
      <option value="cost_price">cost_price</option> 
      <option value="qty">qty</option> 
      <option value="dtl_discount">dtl_discount</option> 
      <option value="sales_price">sales_price</option> 
      <option value="dtl_percent">dtl_percent</option> 
      <option value="product_idproduct">product_idproduct</option> 
      <option value="slshdr_idslshdr">slshdr_idslshdr</option> 
      <option value="semua">Semua</option> 
  </select></td> 
  <td id="kolompilih"><input type="text" name="fieldcari" id="fieldcari" value="%" /></td><td> 
  <input type="submit" value="Cari" />
 <input type="button" value="Tambah" id="btntambah">
   <input type="button" value="Exit" id="btnexit">
  </td> </tr></table>
  </form><br /> 
</div> 
 
<div id="divPageData"></div> 
<div id="divLoading"></div> 
 
</body> 
</html> 
