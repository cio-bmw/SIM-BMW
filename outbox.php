<? require_once ('login.php'); 
$startdate = $_POST['startdate'];
$enddate = $_POST['enddate'];
$dsp = $_POST['dsp'];

if ($startdate =='') {
$startdate = date('d-m-Y');
} else {
$startdate = $_POST['startdate'];
}
if ($enddate =='') {
$enddate = date('d-m-Y');
} else {
$enddate = $_POST['enddate'];
}
if ($dsp =='') {
	$dsp = 15;
} else {	
$dsp = $_POST['dsp'];
}
?>  
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">  
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<title>technosoft Indonesia</title> 
<link rel="stylesheet" type="text/css" href="css/style-page.css" /> 
<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script> 
<script type="text/javascript" src="js/outbox.js"></script> 
<script type="text/javascript" src="js/jquery-1.9.1.js"></script>
		<link rel="stylesheet" href="css/jquery-ui.css" />
		<script type="text/javascript" src="js/jquery-ui.js"></script>
<script type="text/javascript" language="javascript">
			jQuery(function(){
				jQuery('input[name=startdate]').datepicker({changeYear:true, changeMonth:true, yearRange:"1990:2025",dateFormat: "dd-mm-yy"});
				jQuery('input[name=enddate]').datepicker({changeYear:true, changeMonth:true, yearRange:"1990:2025",dateFormat: "dd-mm-yy"});
		})			
		</script>
</head> 
<body> 
<? include_once "header.php"; ?>  
<div id="divSearch"> 
  <table  class="header" ><tr> 
  <td> 
   <form id="outbox" method="POST" action="" name="outbox">  
  Cari Data : <select id="pilihcari">  
      <option value="UpdatedInDB">UpdatedInDB</option> 
      <option value="InsertIntoDB">InsertIntoDB</option> 
      <option value="SendingDateTime">SendingDateTime</option> 
      <option value="Text">Text</option> 
      <option value="DestinationNumber">DestinationNumber</option> 
      <option value="Coding">Coding</option> 
      <option value="UDH">UDH</option> 
      <option value="Class">Class</option> 
      <option value="TextDecoded">TextDecoded</option> 
      <option value="ID">ID</option> 
      <option value="MultiPart">MultiPart</option> 
      <option value="RelativeValidity">RelativeValidity</option> 
      <option value="SenderID">SenderID</option> 
      <option value="SendingTimeOut">SendingTimeOut</option> 
      <option value="DeliveryReport">DeliveryReport</option> 
      <option value="CreatorID">CreatorID</option> 
      <option value="semua">Semua</option> 
  </select>
  <input type="text" name="fieldcari" id="fieldcari" value="%" /> 
  <input class="button" type="submit" value="Tampilkan" />
 <input  class="button" type="button" value="Tambah" id="btntambah">
   <input  class="button" type="button" value="Cetak" id="btncetak">
  </form> 
  </td> </tr></table>
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
