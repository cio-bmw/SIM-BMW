<? 
  // file proses_data.php merupakan halaman untuk menangani request Ajax baik untuk proses tambah, ubah, maupun hapus 
  // respon balikan dari masing-masing proses tersebut adalah dalam format JSON. 
   
	include_once("config.php"); 
	 
  $action=$_POST['action']; 
 $idcustomer=$_POST['idcustomer']; 
 $custname=$_POST['custname']; 
 $birthdate=$_POST['birthdate']; 
 $address=$_POST['address']; 
 $phone=$_POST['phone']; 
 $creditlimit=$_POST['creditlimit']; 
 $tolerance=$_POST['tolerance']; 
 $active_record=$_POST['active_record']; 
 $cm_status=$_POST['cm_status']; 
 $cm_phone=$_POST['cm_phone']; 
 $age=$_POST['age']; 
 $agedesc=$_POST['agedesc']; 
	 
	//fungsi untuk men-generate ID pelanggan, ex: P0001  
	function buatID($tabel, $inisial){ 
    $struktur = mysql_query("select * from $tabel") or die("query tidak dapat dijalankan!"); 
    $field = mysql_field_name($struktur,0); 
   $panjang = mysql_field_len($struktur,0); 
    $row = mysql_num_rows($struktur); 
     
    $panjanginisial = strlen($inisial); 
    $awal = $panjanginisial + 1; 
    $bnyk = $panjang-$panjanginisial; 
     
    if ($row >= 1){ 
      $query = mysql_query("select max(substring($field,$awal,$bnyk)) as max from $tabel") or die("query tidak dapat dijalankan!"); 
      $hasil = mysql_fetch_assoc($query); 
      $angka = intval($hasil['max']); 
    } 
    else{ 
      $angka = 0; 
    } 
    
    $angka++; 
    $tmp= ""; 
    for ($i=0; $i < ($panjang-$panjanginisial-strlen($angka)) ; $i++){ 
      $tmp = $tmp."0"; 
    } 
    //return hasil generate ID 
    return strval($inisial.$tmp.$angka); 
  } 
	 
	if($action=="add") //menangani aksi penambahan data pelanggan 
	{ 
	//  $idpelanggan = buatID("tbl_pelanggan","P"); 
 mysql_query(" insert into customer (idcustomer,custname,birthdate,address,phone,creditlimit,tolerance,active_record,cm_status,cm_phone,age,agedesc)  values  ('$idcustomer','$custname','$birthdate','$address','$phone','$creditlimit','$tolerance','$active_record','$cm_status','$cm_phone','$age','$agedesc')")  or die("Data gagal Di Tambahkan!");  
    // mengembalikan respon dalam format JSON. 
    // status "1" berarti proses berhasil dilakukan. 
    echo '{"status":"1"}';   
		exit; 
	} 
	elseif($action=="update") //menangani aksi perubahan data pelanggan 
	{ 
$sql = " update customer set idcustomer='$idcustomer',custname='$custname',birthdate='$birthdate',address='$address',phone='$phone',creditlimit='$creditlimit',tolerance='$tolerance',active_record='$active_record',cm_status='$cm_status',cm_phone='$cm_phone',age='$age',agedesc='$agedesc' where idcustomer = $idcustomer";  
		$test = mysql_query($sql); 
		echo '{"status":"1"}'; 
		exit; 
	} 
	elseif($_GET['action']=="delete") //menangani aksi penghapusan data pelanggan 
	{ 
		$id = $_GET['id']; 
		$test = mysql_query("delete from customer where idcustomer ='$id'"); 
    if(mysql_affected_rows() == 1){ //jika jumlah baris data yang dikenai operasi delete == 1 
      echo '{"status":"1"}'; 
    }else{ 
      echo '{"status":"0"}'; 
		} 
		exit; 
	} 
	 
?> 
