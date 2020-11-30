<?php
include "support/koneksi.php";

if(isset($_POST['update'])){

	$kode = $_POST['kodebarang'];
	$namabarang = $_POST['namabarang'];
	$namabarang = strtoupper($namabarang);
	$hargabarang = $_POST['hargabarang'];
	$hargabarang = str_replace(".", "", $hargabarang);


	$updatequery = mysqli_query($connect,"UPDATE master_barang SET nama_barang ='$namabarang' , hargajual ='$hargabarang' WHERE kode =$kode");
	header("Location: list_barang.php");

}
?>

<?php
$kode= $_GET['kode'];
$fetchdata= mysqli_query($connect,"SELECT * FROM master_barang WHERE kode = $kode");

while($data= mysqli_fetch_array($fetchdata)){
	$nama = $data['nama_barang'];
	$hargabarang = $data['hargajual'];
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
		
		<input type="hidden" name="kodebarang" id="kodebarang" autocomplete="off" placeholder="Kode Barang" value="<?php echo $kode; ?>" required>
		<br>
		<label>Nama Barang</label>
		<input type="text" name="namabarang" id="namabarang" autocomplete="off" placeholder="Nama Barang" value="<?php echo $nama;?>" required>
		<br>
		<label>Harga</label>
		<input type="text" name="hargabarang" id="hargabarang" autocomplete="off" placeholder="Harga Barang" value="<?php echo $hargabarang;?>" required>
		<br>
		<button type="submit" name="update">Update</button>
		<a href="list_barang.php"><button type="button">back</button></a>

	</form>
<script>
	
	$(document).ready(function($){

    // Format mata uang.
  $( '#hargabarang' ).mask('0.000.000.000', {reverse: true});
  

});

</script>
</body>



</html>