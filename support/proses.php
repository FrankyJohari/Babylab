<?php
include "koneksi.php";
$data=mysqli_query($connect,"select * from master_barang");
$op=isset($_GET['op'])?$_GET['op']:null;


if($op=='ambildata'){
    $kode=$_GET['kode'];
    $dt=mysqli_query($connect,"select * from master_barang where kode='$kode'");
    $d=mysqli_fetch_array($dt);
    echo $d['nama_barang']."|".$d['hargajual']."|".$d['jumlah'];
}
?>