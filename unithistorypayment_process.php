<? 
  // file proses_data.php merupakan halaman untuk menangani request Ajax baik untuk proses tambah, ubah, maupun hapus 
  // respon balikan dari masing-masing proses tersebut adalah dalam format JSON. 
   
	include_once("config.php"); 
	 
  $action=$_POST['action']; 
 $idunithistorypayment=$_POST['idunithistorypayment']; 
 $pay_date=$_POST['pay_date']; 
 $pay_value=$_POST['pay_value']; 
 $pay_name=$_POST['pay_name']; 
 $pay_note=$_POST['pay_note']; 
 $unitmstpayment_idpayment=$_POST['unitmstpayment_idpayment']; 
 $unithistory_idunithistory=$_POST['unithistory_idunithistory']; 
	
	if($action=="add") //menangani aksi penambahan data unithistorypayment 
	{ 
   //$sql = "SELECT IFNULL(max(CAST(idunithistorypayment AS UNSIGNED)),0)+1  FROM unithistorypayment";  
   //$result = mysql_query($sql);  
  //$data  = mysql_fetch_array($result);  
  //$idunithistorypayment = $data[0];	 
    mysql_query(" insert into unithistorypayment (idunithistorypayment,pay_date,pay_value,pay_name,pay_note,unitmstpayment_idpayment,unithistory_idunithistory)  values  ('$idunithistorypayment','$pay_date','$pay_value','$pay_name','$pay_note','$unitmstpayment_idpayment','$unithistory_idunithistory')")  or die("Data gagal Di Tambahkan!");  
    // mengembalikan respon dalam format JSON. 
    // status "1" berarti proses berhasil dilakukan. 
    echo '{"status":"1"}';   
		exit; 
	} 
	elseif($action=="update") //menangani aksi perubahan data unithistorypayment 
	{ 
$sql = " update unithistorypayment set idunithistorypayment='$idunithistorypayment',pay_date='$pay_date',pay_value='$pay_value',pay_name='$pay_name',pay_note='$pay_note',unitmstpayment_idpayment='$unitmstpayment_idpayment',unithistory_idunithistory='$unithistory_idunithistory' where idunithistorypayment = $idunithistorypayment";  
		$test = mysql_query($sql); 
		echo '{"status":"2"}'; 
		exit; 
	} 
	elseif($_GET['action']=="delete") //menangani aksi penghapusan data unithistorypayment 
	{ 
		$id = $_GET['id']; 
		$test = mysql_query("delete from unithistorypayment where idunithistorypayment ='$id'"); 
    if(mysql_affected_rows() == 1){ //jika jumlah baris data yang dikenai operasi delete == 1 
      echo '{"status":"1"}'; 
    }else{ 
      echo '{"status":"0"}'; 
		} 
		exit; 
	} 
	 
?> 
