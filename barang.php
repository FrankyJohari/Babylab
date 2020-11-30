<?php
include "support/koneksi.php";

if(isset($_POST['submit'])){
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
		header("Location: list_barang.php");
	}else {
		echo "<script type='text/javascript'>alert('Gagal Disimpan'); </script>";
	}
}

}

?>

<html>

<head>
	<title>Master Barang</title>
	<script src="support/jquery.js"></script>
	<script src="support/jquery.mask.js"></script>
	
	<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> -->
</head>

<body>
	<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
		<!-- <label>Kode Barang</label>
		<input type="text" name="kodebarang" id="kodebarang" autocomplete="off" placeholder="Kode Barang" required>
		<br> -->
		<label>Nama Barang</label>
		<input type="text" name="namabarang" id="namabarang" autocomplete="off" placeholder="Nama Barang" required>
		<br>
		<label>Harga</label>
		<input type="text" name="hargabarang" id="hargabarang" autocomplete="off" placeholder="Harga Barang" required>
		<br>
		<button type="submit" name="submit">Save</button>
		<a href="list_barang.php"><button type="button">Back</button></a>
	</form>
<script>
	
	$(document).ready(function($){

    // Format mata uang.
  $( '#hargabarang' ).mask('0.000.000.000', {reverse: true});

});

</script>
</body>



</html>