<?php
include 'koneksi.php';

if(isset($_POST['simpan_barang'])){
	global $connect;
	// $kodebarang = $_POST['kodebarang'];
	$namabarang = $_POST['namabarang'];
	$namabarang = strtoupper($namabarang);
	$hargabarang = $_POST['hargabarang'];
	$hargabarang = str_replace(".", "", $hargabarang);

	$cek= "SELECT * FROM master_barang WHERE nama_barang ='$namabarang'";
	$query = $connect->query($cek);
	if($query->num_rows == 1){
		echo "<script type='text/javascript'>alert('Gagal Disimpan!!! , Nama Barang sudah ada'); </script>";
	}else{

	$sql = "INSERT INTO master_barang (nama_barang,hargajual) Values ('$namabarang','$hargabarang')";
	$query = $connect->query($sql);
	if($query === TRUE){
		echo "<script type='text/javascript'>alert('Berhasil Disimpan'); </script>";
		header("Location: ?page=list_barang");
	}else {
		echo "<script type='text/javascript'>alert('Gagal Disimpan'); </script>";
	}
}

}

if(isset($_POST['simpan_edit_barang'])){
	global $connect;
	// $kodebarang = $_POST['kodebarang'];
	$namabarang = $_POST['namabarangedit'];
	$namabarang = strtoupper($namabarang);
	$hargabarang = $_POST['hargabarangedit'];
	$hargabarang = str_replace(".", "", $hargabarang);
	$id=$_POST['hidden_id_edit'];

	$sql = "UPDATE master_barang SET `nama_barang` = '$namabarang', `hargajual` = '$hargabarang' WHERE `master_barang`.`kode` = $id; ";
	$query = $connect->query($sql);
	if($query === TRUE){
		echo "<script type='text/javascript'>alert('Berhasil Diupdate'); </script>";
		header("Location: ?page=list_barang");
	}else {
		echo "<script type='text/javascript'>alert('Gagal Disimpan'); </script>";
	}


}

if(isset($_POST['simpan_akun'])){
	global $connect;
	// $kodebarang = $_POST['kodebarang'];
	$namaakun = $_POST['namaakun'];
	$nomorakun = $_POST['nomorakun'];
	$jenisakun = $_POST['main_acc'];

	$cek= "SELECT * FROM account WHERE sub_acc ='$nomorakun'";
	$query = $connect->query($cek);
	if($query->num_rows == 1){
		echo "<script type='text/javascript'>alert('Gagal Disimpan!!! , Nomor Akun sudah ada'); </script>";
	}else{

	$sql = "INSERT INTO account (main_acc,sub_acc,sub_desc) Values ($jenisakun,$nomorakun,'$namaakun')";
	$query = $connect->query($sql);
	if($query === TRUE){
		echo "<script type='text/javascript'>alert('Berhasil Disimpan'); </script>";
		header("Location: ?page=coa");
	}else {
		echo "<script type='text/javascript'>alert('Gagal Disimpan'); </script>";
	}
}

}

if(isset($_POST['simpan_edit_akun'])){
	global $connect;
	// $kodebarang = $_POST['kodebarang'];
	$namaakun = $_POST['namaakunedit'];
	$nomorakun = $_POST['nomorakunedit'];
	$jenisakun = $_POST['main_acc_edit'];
	$id=$_POST['hidden_id_edit'];
	
	if($id>=8){
		$sql = "UPDATE account SET `sub_desc` = '$namaakun', `main_acc` = '$jenisakun', `sub_acc` = '$nomorakun' WHERE id = $id; ";
		$query = $connect->query($sql);
		if($query === TRUE){
			echo "<script type='text/javascript'>alert('Berhasil Diupdate'); </script>";
			header("Location: ?page=coa");
		}else {
			echo "<script type='text/javascript'>alert('Gagal Disimpan'); </script>";
		}
	}else{
		echo "<script type='text/javascript'>alert('Akun utama ditidak bisa diedit'); </script>";
	}

}


if(isset($_POST['simpan_penerimaan'])){
$id = $_POST['idx'];
$trxid = $_POST['trxid'];
$trxdate = $_POST['trxdate'];
$trxdate = date("Y-m-d", strtotime($trxdate));
$keterangan = $_POST['keterangan'];
$akun = $_POST['akun'];
$total = $_POST['total'];
$total = str_replace(".", "", $total);


$debit = "INSERT INTO jurnal (tanggal,jurnal,debit,kredit,ref) Values ('$trxdate','101','$total','0','$trxid')";
$kredit = "INSERT INTO jurnal (tanggal,jurnal,debit,kredit,ref) Values ('$trxdate','$akun','0','$total','$trxid')";
$cash = "INSERT INTO cash_flow (tanggal,id_cash,debit,kredit,ref,type,keterangan) Values ('$trxdate','$trxid','$total','0','$akun','IN','$keterangan')";
$updateid = "UPDATE master SET id_penerimaan = '$id' WHERE master.id = 1";

$query1 = $connect->query($debit);
$query2 = $connect->query($kredit);
$query3 = $connect->query($cash);
$query4 = $connect->query($updateid);

	if($query4 === TRUE){
		echo "<script type='text/javascript'>alert('Berhasil Disimpan!!!'); </script>";
	}else{
		echo "<script type='text/javascript'>alert('Gagal Disimpan'); </script>";
	}
}

if(isset($_POST['simpan_pengeluaran'])){
$id = $_POST['idx'];
$trxid = $_POST['trxid'];
$trxdate = $_POST['trxdate'];
$trxdate = date("Y-m-d", strtotime($trxdate));
$keterangan = $_POST['keterangan'];
$akun = $_POST['akun'];
$total = $_POST['total'];
$total = str_replace(".", "", $total);


$debit = "INSERT INTO jurnal (tanggal,jurnal,debit,kredit,ref) Values ('$trxdate','101','0','$total','$trxid')";
$kredit = "INSERT INTO jurnal (tanggal,jurnal,debit,kredit,ref) Values ('$trxdate','$akun','$total','0','$trxid')";
$cash = "INSERT INTO cash_flow (tanggal,id_cash,debit,kredit,ref,type,keterangan) Values ('$trxdate','$trxid','0','$total','$akun','OUT','$keterangan')";
$updateid = "UPDATE master SET id_pengeluaran = '$id' WHERE master.id = 1";

$query1 = $connect->query($kredit);
$query2 = $connect->query($debit);
$query3 = $connect->query($cash);
$query4 = $connect->query($updateid);

	if($query4 === TRUE){
		echo "<script type='text/javascript'>alert('Berhasil Disimpan!!!'); </script>";
	}else{
		echo "<script type='text/javascript'>alert('Gagal Disimpan'); </script>";
	}

}


if(isset($_POST['simpan_sup'])){
	global $connect;
	// $kodebarang = $_POST['kodebarang'];
	$namasup = $_POST['namasup'];

	$cek= "SELECT * FROM master_supplier WHERE nama_sup ='$namasup'";
	$query = $connect->query($cek);
	if($query->num_rows == 1){
		echo "<script type='text/javascript'>alert('Gagal Disimpan!!! , Nama Supplier sudah ada'); </script>";
	}else{

	$sql = "INSERT INTO master_supplier (nama_sup) Values ('$namasup')";
	$query = $connect->query($sql);
	if($query === TRUE){
		echo "<script type='text/javascript'>alert('Berhasil Disimpan'); </script>";
		header("Location: ?page=list_sup");
	}else {
		echo "<script type='text/javascript'>alert('Gagal Disimpan'); </script>";
	}
	}
}

if(isset($_POST['simpan_edit_sup'])){
	global $connect;
	// $kodebarang = $_POST['kodebarang'];
	$namasup = $_POST['namasupedit'];
	$id=$_POST['hidden_id_edit'];

	$cek= "SELECT * FROM master_supplier WHERE nama_sup ='$namasup'";
	$query = $connect->query($cek);
	if($query->num_rows == 1){
		echo "<script type='text/javascript'>alert('Gagal Disimpan!!! , Nama Supplier sudah ada'); </script>";
	}else{

	$sql = "UPDATE master_supplier SET `nama_sup` = '$namasup' WHERE id = $id; ";
	$query = $connect->query($sql);
	if($query === TRUE){
		echo "<script type='text/javascript'>alert('Berhasil Disimpan'); </script>";
		header("Location: ?page=list_sup");
	}else {
		echo "<script type='text/javascript'>alert('Gagal Disimpan'); </script>";
	}
	}
}

if(isset($_POST['changepw'])){
	global $connect;
	// $kodebarang = $_POST['kodebarang'];
	$username = $_POST['username'];
	$oldpassword = $_POST['oldpw'];
	$newpassword = $_POST['newpw'];
	$newpassword2= $_POST['newpw2'];

	if($newpassword == $newpassword2){
	$cek= "SELECT * FROM login WHERE username ='$username'";
	$result = mysqli_query($connect,$cek);
	$query = $connect->query($cek);
		if($query->num_rows == 1){
			$row = mysqli_fetch_assoc($result);
			if ($oldpassword == $row["password"]){
				$sql = "UPDATE login SET `password` = '$newpassword' WHERE id = $row[id]; ";
				$query = $connect->query($sql);
				if($query === TRUE){
					echo "<script type='text/javascript'>alert('Berhasil Disimpan'); </script>";
				}else {
					echo "<script type='text/javascript'>alert('Gagal Disimpan'); </script>";
				}
			}else{
				echo "<script type='text/javascript'>alert('Gagal Disimpan'); </script>";
			}
		}else{
			echo "<script type='text/javascript'>alert('Gagal Disimpan'); </script>";
		}
	}else{
		echo "<script type='text/javascript'>alert('Gagal Disimpan'); </script>";
	}
}

if(isset($_POST['update_form'])){
	$trxid=$_GET['trxid'];
	$tanggal=date("Y-m-d");
    $tanggal=date("Y-m-d",strtotime($tanggal));
	$sql="SELECT * FROM pembelian_detail where trxid='$trxid' ";
	$count=mysqli_num_rows(mysqli_query($connect,$sql));
	$keputusan="";

	// Validasi stock masuk tidak melebihi pemesanan stock
	for($i=0;$i<$count;$i++){
	$stock_valid= $_POST['stock'][$i];
	$id = $_POST['hidden_id'][$i];
	$catch_jumlah = mysqli_fetch_array(mysqli_query($connect,"SELECT * FROM pembelian_detail where id='$id' "));
	$jumlah_barang = $catch_jumlah['jumlah'];
	$jumlah_valid = 0;
	$jumlah_valid += $jumlah_barang;
	$stock = 0;
	$stock += $stock_valid;
		if($jumlah_valid <  $stock){
			$keputusan="Salah";
			break;
		}else{
			$keputusan="Benar";
		}

	}

	if($keputusan=="Benar"){
	for($i=0;$i<$count;$i++){
	$stock= $_POST['stock'][$i];
	$id = $_POST['hidden_id'][$i];

	$sql1="UPDATE pembelian_detail SET stock_in = '$stock', stock = '$stock' , instockdate ='$tanggal' WHERE id = '$id'";
	$catch_kode = mysqli_fetch_array(mysqli_query($connect,"SELECT * FROM pembelian_detail where id='$id' "));
	$kode_item = $catch_kode['kode'];
	$catch_stock = mysqli_fetch_array(mysqli_query($connect,"SELECT * FROM master_barang where kode = '$kode_item' "));
	$stock_item = $catch_stock['jumlah'];
	$stock_item += $stock;
	$update_stock_master = mysqli_query($connect,"UPDATE master_barang SET jumlah = '$stock_item' WHERE kode ='$kode_item'");

	$result1=mysqli_query($connect,$sql1);
	}
		mysqli_query($connect,"UPDATE pembelian SET status = 'Delivered' WHERE pemid ='$trxid'");
		echo "<script type='text/javascript'>alert('Berhasil Disimpan!!!'); </script>";
		header("Location: ?page=in_stock");
	}elseif($keputusan=="Salah"){
		echo "<script type='text/javascript'>alert('Stock Barang masuk tidak boleh melebihi pemesanan'); </script>";
	}


	}




?>